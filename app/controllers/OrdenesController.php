<?php

class OrdenesController extends BaseController
{

    public function getMostrar()
    {
        $tipo_busqueda = Input::get('type', 'todos');
        $orden = Input::get('ordenar', ' asc');

        switch ($tipo_busqueda) {
            case 'paginacion':

                $consulta = DB::table('ordenes')
                    ->select('ordenes.id',
                        'ordenes.codigo',
                        RAW('formato_nombre_completo(PER1.primer_nombre, PER1.primer_apellido) as nombre_completo_responsable'),
                        RAW('formato_nombre_completo(PER2.primer_nombre, PER2.primer_apellido) as nombre_completo_solicitante'),
                        'ordenes.fecha_actividad',
                        'ordenes.status',
                        'nombre as nombre_status')
                    ->leftJoin(RAW('personas AS PER1'), RAW('PER1.usuario_id'), '=', 'ordenes.responsable')
                    ->leftJoin(RAW('personas AS PER2'), RAW('PER2.usuario_id'), '=', 'ordenes.solicitante')
                    ->join('condiciones', 'condiciones.codigo', '=', 'status');

                $response = $this->generar_paginacion_dinamica($consulta,
                    array('campo_where' => 'ordenes.codigo', 'campo_orden' => 'ordenes.id'));

                break;

            case 'agregar_elemento':

                $cod_laboratorio = Input::get('cod_laboratorio', null);
                $cod_dimension = Input::get('cod_dimension');
                $cod_subdimension = Input::get('cod_subdimension');
                $cod_agrupacion = Input::get('cod_agrupacion');
                $cod_objeto = Input::get('cod_objeto');
                $cantidad = Input::get('cantidad_solicitada');

                //quitamos las comas por puntos
                $cantidad = remplaza_coma_punto($cantidad);

                $consulta = "seleccionar_elemento_disponible('" . $cod_dimension . "','" . $cod_subdimension . "','" . $cod_agrupacion . "','" . $cod_objeto . "','" . $cantidad . "')";

                $consulta = DB::table(RAW($consulta));

                $data_elementos_seleccionado = $consulta->get();

                if ($consulta->count() === 0) {
                    $response = array('resultado' => false);
                } else {

                    $data_obj = DB::table('vista_objetos_full')
                        ->select('cod_objeto', 'nombre_objeto as nombre', RAW('formato_unidad_objeto(nombre_unidad,abreviatura_unidad) as unidad'), 'nombre_clase_objeto as clase_objeto')
                        ->where('cod_objeto', '=', $cod_objeto)
                        ->first();

                    $array_elementos_seleccionados = array();

                    foreach ($data_elementos_seleccionado as $elemento_seleccionado) {
                        $array_elementos_seleccionados[] = array(
                            'cod_dimension' => $elemento_seleccionado->cod_dimension,
                            'cod_subdimension' => $elemento_seleccionado->cod_subdimension,
                            'cod_agrupacion' => $elemento_seleccionado->cod_agrupacion,
                            'cod_objeto' => $elemento_seleccionado->cod_objeto,
                            'numero_orden' => $elemento_seleccionado->numero_orden,
                            'cantidad_disponible' => $elemento_seleccionado->cantidad_disponible,
                            'nombre_objeto' => $data_obj->nombre,
                            'unidad' => $data_obj->unidad,
                            'clase_objeto' => $data_obj->clase_objeto
                        );
                    }

                    $response = array(
                        'resultado' => true,
                        'datos' => $array_elementos_seleccionados
                    );
                }
                break;

            default:
                $response = array();
                break;

        }

        return Response::json($response);
    }

    public function postGenerarOrden()
    {

        DB::beginTransaction();

        try {
            $responsable = Input::get('responsable');
            $solicitante = Auth::user()->id;
            $cod_laboratorio = Input::get('laboratorio');
            $observaciones = Input::get('observaciones');
            $fecha_actividad = Input::get('fecha_actividad');

            $data_elementos_pedidos = Input::get('data_elementos_pedidos');

            if (is_null($responsable) || is_null($cod_laboratorio) || is_null($observaciones) || is_null($data_elementos_pedidos)) {
                if (is_null($responsable)) {
                    $mensajes[] = "El id del usuario no puede quedar vacio";
                }
                if (is_null($cod_laboratorio)) {
                    $mensajes[] = "El codigo de laboratorio no puede quedar vacio";
                }
                if (is_null($observaciones)) {
                    $mensajes[] = "El campo observaciones no puede quedar vacio";
                }
                if (is_null($data_elementos_pedidos)) {
                    $mensajes[] = "No has seleccionado ningun elemento.";
                }

                return Response::json(array('resultado' => false, 'mensajes' => $mensajes));
            }

            //primero se crea la orden
            $nueva_orden = new Orden;

            $nueva_orden->codigo = generar_codigo_orden();
            $nueva_orden->responsable = $responsable;
            $nueva_orden->solicitante = $solicitante;
            $nueva_orden->fecha_actividad = $fecha_actividad;
            $nueva_orden->fecha = get_fecha();
            $nueva_orden->hora = get_hora();
            $nueva_orden->cod_laboratorio = $cod_laboratorio;
            $nueva_orden->observaciones = $observaciones;
            $nueva_orden->status = ORDEN_PENDIENTE;

            $nueva_orden->save();

            //incializamos la variable
            $data = [];

            //armado de la data de los elementos pedidos
            foreach ($data_elementos_pedidos as $value) {

                $data[] = array(
                    'cod_orden' => $nueva_orden->codigo,
                    'cod_dimension' => $value['cod_dimension'],
                    'cod_subdimension' => $value['cod_subdimension'],
                    'cod_agrupacion' => $value['cod_agrupacion'],
                    'cod_objeto' => $value['cod_objeto'],
                    'numero_orden' => $value['numero_orden'],
                    'cantidad_solicitada' => $value['cantidad_solicitada'],
                    'status_elemento' => PEDIDO_EN_ESPERA,
                    'created_at' => get_now(),
                    'updated_at' => get_now()
                );
            }

            //se crean los elementos pedidos en la orden
            DB::table('pedidos')->insert($data);
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::json(array(
                'resultado' => false,
                'mensajes' => array($e->getMessage())
            ), 500);
        }

        DB::commit();

        return Response::json(array(
            'resultado' => true,
            'mensajes' => array('Orden generada con exito!')));
    }

    public function postProcesarOrden()
    {
        $codigo_orden = Input::get('codigo_orden');
        $accion_orden = Input::get('accion_orden');

        if (!is_null($codigo_orden)) {
            if (!is_null($accion_orden)) {

                $response = []; //Mensajes que se enviaran en el response

                DB::beginTransaction();

                try {

                    //obtenemos el id de los elementos pedidos en la orden
                    $id_elementos_pedidos = DB::table('pedidos')
                        ->select('id')
                        ->where('cod_orden', '=', $codigo_orden)
                        ->where('status_elemento', '=', PEDIDO_EN_ESPERA)
                        ->lists('id');

                    switch (strtoupper($accion_orden)) {

                        case 'ACEPTAR': {

                            //actualizar el estado de la orden
                            DB::table('ordenes')->where('codigo', $codigo_orden)->update(['status' => ORDEN_ACTIVA]);

                            //obtenemos todos los pedidos de la orden procesada
                            $pedidos = DB::table('pedidos')->select('cod_dimension',
                                'cod_subdimension',
                                'cod_agrupacion',
                                'cod_objeto',
                                'numero_orden',
                                'cantidad_solicitada',
                                'cod_orden')
                                ->where('cod_orden', '=', $codigo_orden)
                                ->get();

                            $data_elementos_pedidos = [];

                            foreach ($pedidos as $pedido) {

                                //Agregregamos solo al arreglo los pedidos que se encutren en estado espera
                                if ($pedido->status_elemento == PEDIDO_EN_ESPERA) {

                                    //obtenemos los datos de los elementos pedidos en la orden
                                    $data_elementos_pedidos[] = [
                                        'cod_dimension' => $pedido->cod_dimension,
                                        'cod_subdimension' => $pedido->cod_subdimension,
                                        'cod_agrupacion' => $pedido->cod_agrupacion,
                                        'cod_objeto' => $pedido->cod_objeto,
                                        'numero_orden' => $pedido->numero_orden,
                                        'cantidad_existente' => 0,//null por ahora hasta que se decida si se va a quitar el campo o no
                                        'cantidad_solicitada' => $pedido->cantidad_solicitada
                                    ];
                                }

                                //Antes de cambiar el estado de no disponible a los otros elemento se
                                //debe verificar si es un reactivo o un instrumento
                                //debido a que cada uno de ellos su numero_orden se maneja de manera distinta
                                if (ElementoInventario::verificar_is_clase_objeto(REACTIVO, $pedido->cod_objeto)) {
                                    //Actualizamos a no disponible aquel elemento que coinciada con alguno del pedido actual
                                    DB::table('pedidos')
                                        ->where('cod_dimension', '=', $pedido->cod_dimension)
                                        ->where('cod_subdimension', '=', $pedido->cod_subdimension)
                                        ->where('cod_agrupacion', '=', $pedido->cod_agrupacion)
                                        ->where('cod_objeto', '=', $pedido->cod_objeto)
                                        ->where('numero_orden', '=', $pedido->numero_orden)
                                        ->where('cod_orden', '<>', $pedido->cod_orden)
                                        ->where('status_elemento', '=', PEDIDO_EN_ESPERA)
                                        ->update(['status_elemento' => NO_DISPONIBLE]);
                                } else {
                                    /********** OJO ************* /
                                     * aun falta hacer la actualizacion de no disponible a los instrumentos y equipos
                                     *
                                     * */
                                }

                            }

                            //actualizamos el status de los elementos de la orden aceptada
                            DB::table('pedidos')->whereIn('id', $id_elementos_pedidos)->update(['status_elemento' => RETENIDO]);

                            //insertamos los elementos del pedido en la tabla retenidos
                            DB::table('elementos_retenidos')->insert($data_elementos_pedidos);


                            $response = ['resultado' => true, 'mensajes' => ['Orden aceptada con exito.!']];

                            break;
                        }

                        case 'CANCELAR': {
                            //Variable que almacena la razon de cancelar la orden
                            $razon_cancelar = Input::get('razon_cancelar', 'Razon no especificicada');

                            //actualizar el estado de la orden
                            DB::table('ordenes')->where('codigo', $codigo_orden)->update(['status' => ORDEN_CANCELADA]);

                            //actualizamos el status de los elementos de la orden a cancelar

                            DB::table('pedidos')
                                ->where('cod_orden', '=', $codigo_orden)
                                ->where('status_elemento', '=', PEDIDO_EN_ESPERA)
                                ->update(['status_elemento' => PEDIDO_CANCELADO /*, 'cantidad_retornada' => 0*/]);

                            //Enviamos un mensaje al responsable de la orden
                            Session::put('responsable', Orden::get_datos_responsable($codigo_orden));

                            enviar_email('emails.plantilla_cancelar_orden', [
                                'cod_orden' => $codigo_orden,
                                'razon_cancelar' => $razon_cancelar
                            ], function ($mensaje) {
                                $mensaje
                                    ->to(Session::get('responsable')->email, Session::get('responsable')->nombre_completo)
                                    ->subject('SIMCI - Orden Cancelada');
                            });

                            Session::forget('responsable');


                            $response = ['resultado' => true, 'mensajes' => ['Orden cancelada con exito.!']];

                            break;
                        }

                        case 'COMPLETAR':
                            break;

                        default:
                            $response = ['resultado' => false, 'mensajes' => ['Error no se ha especificado una accion para esta orden']];
                            break;

                    }

                } catch (\Exception $e) {
                    DB::rollBack();

                    return Response::json(array(
                        'resultado' => false,
                        'mensajes' => array($e->getMessage())
                    ), 500);
                }

                DB::commit();
                return Response::json($response);

            } else {
                return Response::json(array('resultado' => false, 'mensajes' => array('La accion que se aplicara a la orden no debe quedar vacio')));
            }
        } else {
            return Response::json(array('resultado' => false, 'mensajes' => array('El cod_orden no debe quedar vacio')));
        }
    }

    public function postMostrarPedido()
    {
        $cod_orden = Input::get('codigo', null);

        //evaluamos que el codigo de la orden no venga ni vacion ni sea null
        if (is_null($cod_orden) || empty($cod_orden)) {
            return Response::json(array('resultado' => false, 'mensajes' => array('Error codigo de orden no puede estar vacio')));
        } else {
            //obtenemos todos los elementos de la tabla pedidos que coincidan con el cod_orden dado
            $elementos_pedidos = DB::table('pedidos')->select('id', 'cod_dimension', 'cod_subdimension', 'cod_agrupacion', 'cod_objeto', 'cantidad_solicitada', 'numero_orden')
                ->where('cod_orden', '=', $cod_orden)
                ->get();

            foreach ($elementos_pedidos as $value) {
                //iteramos y verificamos si hay disponibilidad de cada elemento del pedido
                $elemento_disponible = DB::table('vista_reactivos_disponibles')
                    ->where('cod_dimension', '=', $value->cod_dimension)
                    ->where('cod_subdimension', '=', $value->cod_subdimension)
                    ->where('cod_agrupacion', '=', $value->cod_agrupacion)
                    ->where('cod_objeto', '=', $value->cod_objeto)
                    ->where('numero_orden', '=', $value->numero_orden)
                    ->first();

                //evaluamos si es distinto de vacio o de null si es asi resultado sera true de lo contrario si no hay
                //disponibilidad resultado sera false
                $disponibilidad[] = array('id_pedido' => $value->id, 'resultado' => (!is_null($elemento_disponible) || !empty($elemento_disponible)) ? (true) : (false));

            }
        }

        return Response::json(array('resultado' => true, 'data' => $disponibilidad));
    }
}

?>