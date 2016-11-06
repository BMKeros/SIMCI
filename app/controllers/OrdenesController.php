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
            $nueva_orden->status = PENDIENTE;

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
                    'status_elemento' => EN_ESPERA,
                    'created_at' => get_now(),
                    'updated_at' => get_now()
                );
            }

            //se crean los elementos pedidos en la orden
            DB::table('pedidos')->insert($data);

            DB::commit();

            //Enviamos un mensaje al responsable de la orden
            $datos_email = [
                'datos_orden' => $nueva_orden,
                'responsable' => Orden::get_datos_responsable($nueva_orden->codigo),
                'solicitante' => Orden::get_datos_solicitante($nueva_orden->codigo),
                'data_pedidos' => $data
            ];


            enviar_email('emails.plantilla_comprobante_solicitud', $datos_email, function ($mensaje) use ($datos_email) {
                $mensaje
                    ->to($datos_email['solicitante']->email, $datos_email['solicitante']->nombre_completo)
                    ->cc($datos_email['responsable']->email, $datos_email['responsable']->nombre_completo)
                    ->subject('SIMCI - Comprobante de solicitud orden [' . $datos_email['datos_orden']->codigo . ']');
            });

            return Response::json(array(
                'resultado' => true,
                'mensajes' => array('Orden generada con exito!', "El comprobante de su solicitud ha sido enviado a su correo")));

        } catch (\Exception $e) {
            DB::rollBack();

            return Response::json(array(
                'resultado' => false,
                'mensajes' => array($e->getMessage())
            ), 500);
        }
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
                        ->where('status_elemento', '=', EN_ESPERA)
                        ->lists('id');

                    switch (strtoupper($accion_orden)) {
                        //Accion que se ejecuta antes de aceptar una orden
                        //Esta accion es para verificar si algun elemento ya no se encuentra disponible
                        case 'PRE_ACEPTAR': {

                            //obtenemos todos los pedidos de la orden que se va aceptar

                            $pedidos = DB::table('pedidos')->select('id',
                                'cod_dimension',
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

                                $data_elementos_pedidos[] = [
                                    'id' => $pedido->id,
                                    'cod_dimension' => $pedido->cod_dimension,
                                    'cod_subdimension' => $pedido->cod_subdimension,
                                    'cod_agrupacion' => $pedido->cod_agrupacion,
                                    'cod_objeto' => $pedido->cod_objeto,
                                    'numero_orden' => $pedido->numero_orden,
                                    'cantidad_existente' => 0,//null por ahora hasta que se decida si se va a quitar el campo o no
                                    'cantidad_solicitada' => $pedido->cantidad_solicitada,
                                    'disponible' =>
                                        ElementoInventario::disponible($pedido->cod_dimension,
                                            $pedido->cod_subdimension, $pedido->cod_agrupacion,
                                            $pedido->cod_objeto, $pedido->numero_orden,
                                            $pedido->cantidad_solicitada)
                                ];
                            }

                            //Almacenamos la data de los pedidos de la orden que sera aceptada en una session flash
                            //El key de la session llevara concatenado el codigo de la orden, para no mezclar data
                            $key_session_orden = "pedidos_orden_" . $codigo_orden;

                            Session::flash($key_session_orden, $data_elementos_pedidos);

                            $response = ['resultado' => true, 'datos' => $data_elementos_pedidos];

                            break;
                        }

                        case 'ACEPTAR': {

                            //El key de la session llevara concatenado el codigo de la orden, para no mezclar data
                            $key_session_orden = "pedidos_orden_" . $codigo_orden;

                            //Verificamos si existe la data del pedido en la sesion
                            if (Session::has($key_session_orden)) {

                                $data_pedidos_orden = Session::get($key_session_orden);

                                foreach ($data_pedidos_orden as $pedido) {

                                    //Verificamos si el pedido actual en el recorrido esta disponible para aceptarlo
                                    if ($pedido['disponible']) {

                                        //Insertamos el pedido en la tabla de retenidos
                                        DB::table('elementos_retenidos')->insert([
                                            'cod_dimension' => $pedido['cod_dimension'],
                                            'cod_subdimension' => $pedido['cod_subdimension'],
                                            'cod_agrupacion' => $pedido['cod_agrupacion'],
                                            'cod_objeto' => $pedido['cod_objeto'],
                                            'numero_orden' => $pedido['numero_orden'],
                                            'cantidad_existente' => 0,//null por ahora hasta que se decida si se va a quitar el campo o no
                                            'cantidad_solicitada' => $pedido['cantidad_solicitada'],
                                            'created_at' => get_now(),
                                            'updated_at' => get_now()
                                        ]);

                                        //El pedido que este disponible lo pasamos a activo
                                        DB::table('pedidos')
                                            ->where('id', $pedido['id'])
                                            ->update([
                                                'status_elemento' => ACTIVO,
                                                'updated_at' => get_now()
                                            ]);

                                    } else {
                                        //El pedido que no este disponible lo cancelamos
                                        DB::table('pedidos')
                                            ->where('id', $pedido['id'])
                                            ->update([
                                                'status_elemento' => CANCELADO,
                                                'updated_at' => get_now()
                                            ]);
                                    }
                                }

                                //actualizar el estado de la orden
                                DB::table('ordenes')
                                    ->where('codigo', $codigo_orden)
                                    ->update([
                                        'status' => ACTIVA,
                                        'updated_at' => get_now()
                                    ]);

                                //Borramos la session
                                Session::forget($key_session_orden);

                                $response = ['resultado' => true, 'mensajes' => ['Orden aceptada con exito.!']];
                            } else {
                                $response = ['resultado' => false, 'mensajes' => ['Error al procesar la orden, no se consiguieron pedidos asociados a la orden']];
                            }

                            break;
                        }

                        case 'CANCELAR': {
                            //Variable que almacena la razon de cancelar la orden
                            $razon_cancelar = Input::get('razon_cancelar', 'Razon no especificicada');

                            //actualizar el estado de la orden
                            DB::table('ordenes')->where('codigo', $codigo_orden)->update(['status' => CANCELADA]);

                            //actualizamos el status de los elementos de la orden a cancelar

                            DB::table('pedidos')
                                ->where('cod_orden', '=', $codigo_orden)
                                ->where('status_elemento', '=', EN_ESPERA)
                                ->update(['status_elemento' => CANCELADO /*, 'cantidad_retornada' => 0*/]);

                            //Enviamos un mensaje al responsable de la orden
                            $data_email = [
                                'cod_orden' => $codigo_orden,
                                'razon_cancelar' => $razon_cancelar,
                                'responsable' => Orden::get_datos_responsable($codigo_orden),
                                'solicitante' => Orden::get_datos_solicitante($codigo_orden),
                            ];

                            enviar_email('emails.plantilla_cancelar_orden', $data_email, function ($mensaje) use ($data_email) {
                                $mensaje
                                    ->to($data_email['solicitante']->email, $data_email['solicitante']->nombre_completo)
                                    ->cc($data_email['responsable']->email, $data_email['responsable']->nombre_completo)
                                    ->subject('SIMCI - Orden Cancelada');
                            });

                            $response = ['resultado' => true, 'mensajes' => ['Orden cancelada con exito.!']];

                            break;
                        }

                        case 'PRE_COMPLETAR': {

                            //obtenemos todos los pedidos de la orden que se va completar
                            $pedidos = DB::table('pedidos')->select('id',
                                'cod_dimension',
                                'cod_subdimension',
                                'cod_agrupacion',
                                'cod_objeto',
                                'numero_orden',
                                'cantidad_solicitada',
                                'cod_orden')
                                ->where('cod_orden', '=', $codigo_orden)
                                ->where('status_elemento', '=', ACTIVA)
                                ->get();

                            $data_elementos_pedidos = [];

                            foreach ($pedidos as $pedido) {

                                $data_elementos_pedidos[] = [
                                    'id' => $pedido->id,
                                    'cod_dimension' => $pedido->cod_dimension,
                                    'cod_subdimension' => $pedido->cod_subdimension,
                                    'cod_agrupacion' => $pedido->cod_agrupacion,
                                    'cod_objeto' => $pedido->cod_objeto,
                                    'numero_orden' => $pedido->numero_orden,
                                    'cantidad_solicitada' => $pedido->cantidad_solicitada,
                                    'cantidad_retornada' => 0
                                ];
                            }

                            $response = ['resultado' => true, 'datos' => $data_elementos_pedidos];

                            break;
                        }
                        //AUN FALTA TERMINAR ESTA ACCION
                        case 'COMPLETAR': {

                            $data_pedido_completar = Input::get('data_pedido', null);

                            if(is_null($data_pedido_completar)){
                                $response = ['resultado' => false,'mensajes' => ['Error no se ha pasado la data del pedido que se va a completar']];
                            }
                            else{
                                $error_en_pedidos = 0;
                                $error_especial = 0;

                                foreach ($data_pedido_completar as $pedido_aceptar) {

                                    $pedido_original = DB::table('pedidos')->select('id',
                                        'cod_dimension',
                                        'cod_subdimension',
                                        'cod_agrupacion',
                                        'cod_objeto',
                                        'numero_orden',
                                        'cantidad_solicitada',
                                        'cod_orden')
                                        ->where('id', '=', $pedido_aceptar['id'])
                                        ->where('cod_dimension', '=', $pedido_aceptar['cod_dimension'])
                                        ->where('cod_subdimension', '=', $pedido_aceptar['cod_subdimension'])
                                        ->where('cod_agrupacion', '=', $pedido_aceptar['cod_agrupacion'])
                                        ->where('cod_objeto', '=', $pedido_aceptar['cod_objeto'])
                                        ->where('numero_orden', '=', $pedido_aceptar['numero_orden'])
                                        ->where('cod_orden', '=', $codigo_orden)
                                        ->where('status_elemento', '=', ACTIVA)
                                        ->get();

                                    if($pedido_aceptar['cantidad_retornada'] > $pedido_original[0]->cantidad_solicitada ||
                                        $pedido_aceptar['cantidad_retornada'] < 0){

                                        $error_en_pedidos++;
                                    }

                                    $cantidad_disponible_elemento  = ElementoInventario::get_cantidad_disponible($pedido_aceptar['cod_dimension'],
                                        $pedido_aceptar['cod_subdimension'], $pedido_aceptar['cod_agrupacion'], $pedido_aceptar['cod_objeto'],$pedido_aceptar['numero_orden']);

                                    //En este caso se verifica si la cantidad que esta retornando es mayor a la existente en el inventario
                                    if($pedido_aceptar['cantidad_retornada'] > $cantidad_disponible_elemento){
                                        $error_especial++;
                                    }

                                }

                                if($error_en_pedidos === 0 && $error_especial === 0){

                                    /***************** OJO ******************/
                                    // SE DEBE VERIFICAR ESTA FUNCION PARA EL CASO DE CUANDO SE SELECCIONAN DOS ELEMENTOS
                                    // DEBIDO A QUE UN SOLO ELEMENTO NO SATISFACE LA CANTIDAD DESEADA POR EL USUARIO
                                    /***************************************/

                                    //Eliminar el elemento de retenidos
                                    //cambiar el estado a la orrden
                                    //cambiar el estado al pedido
                                    //restar la cantidad retornada con la solicitada
                                    //registrar la salida del elemento


                                    foreach ($data_pedido_completar as $pedido_aceptar) {

                                        //Eliminamos el pedido de la tabla de elementos retenidos
                                        DB::table('elementos_retenidos')
                                            ->where('cod_dimension', '=', $pedido_aceptar['cod_dimension'])
                                            ->where('cod_subdimension', '=', $pedido_aceptar['cod_subdimension'])
                                            ->where('cod_agrupacion', '=', $pedido_aceptar['cod_agrupacion'])
                                            ->where('cod_objeto', '=', $pedido_aceptar['cod_objeto'])
                                            ->where('numero_orden', '=', $pedido_aceptar['numero_orden'])
                                            ->delete();

                                        $cantidad_disponible_elemento  = ElementoInventario::get_cantidad_disponible($pedido_aceptar['cod_dimension'],
                                            $pedido_aceptar['cod_subdimension'], $pedido_aceptar['cod_agrupacion'], $pedido_aceptar['cod_objeto'],$pedido_aceptar['numero_orden']);

                                        //Restamos la cantidad disponible con la cantidad retornada para obtener la cantidad restante
                                        $nueva_cantidad_elemento = $cantidad_disponible_elemento - $pedido_aceptar['cantidad_retornada'];

                                        //Actualizamos la cantidad disponible del elemento
                                        DB::table('inventario')
                                            ->where('cod_dimension', '=', $pedido_aceptar['cod_dimension'])
                                            ->where('cod_subdimension', '=', $pedido_aceptar['cod_subdimension'])
                                            ->where('cod_agrupacion', '=', $pedido_aceptar['cod_agrupacion'])
                                            ->where('cod_objeto', '=', $pedido_aceptar['cod_objeto'])
                                            ->where('numero_orden', '=', $pedido_aceptar['numero_orden'])
                                            ->update(['cantidad_disponible' => $nueva_cantidad_elemento ]);


                                        //Creamos un asiento de salida para este elemento del inventario
                                        /*DB::table('salidas_inventario')->insert([
                                            'id_usuario' => Auth::user()->id,
                                            'cod_dimension' => $pedido_aceptar['cod_dimension'],
                                            'cod_subdimension' => $pedido_aceptar['cod_subdimension'],
                                            'cod_agrupacion' => $pedido_aceptar['cod_agrupacion'],
                                            'cod_objeto' => $pedido_aceptar['cod_objeto'],
                                            'numero_orden' => $pedido_aceptar['numero_orden'],
                                            'cantidad' => $pedido_aceptar['cantidad_retornada'],
                                            'hora' => get_hora(),
                                            'fecha' => get_fecha(),
                                            'observaciones' => get_value_to_key(MOV03, 'descripcion'),
                                            'cod_tipo_movimiento' => get_value_to_key(MOV03, 'id')
                                        ]);*/

                                    }

                                    //actualizar el estado de la orden
                                    DB::table('ordenes')->where('codigo', $codigo_orden)->update(['status' => COMPLETADA]);

                                    //actualizamos el status de los elementos de la orden a completar
                                    DB::table('pedidos')
                                        ->where('cod_orden', '=', $codigo_orden)
                                        ->where('status_elemento', '=', ACTIVA)
                                        ->update(['status_elemento' => COMPLETADO /*, 'cantidad_retornada' => $pedido_aceptar['cantidad_retornada']*/]);

                                    $response = ['resultado' => true,'mensajes' => ['']];
                                }
                                elseif($error_especial > 0){
                                    $response = ['resultado' => false,'mensajes' => ['Error, existe algun problema con las cantidades retornadas, sobrepasan las cantidades existenten en el inventario']];
                                }
                                else{
                                    $response = ['resultado' => false,'mensajes' => ['Error, verifique las cantidades retornadas de los pedidos']];
                                }
                            }

                            break;
                        }

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