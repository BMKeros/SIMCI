<?php

class OrdenesController extends BaseController
{

    public function getMostrar()
    {
        $tipo_busqueda = Input::get('type', 'todos');
        $id_laboratorio = Input::get('id', null);
        $orden = Input::get('ordenar', ' asc');

        switch ($tipo_busqueda) {
            case 'paginacion':
                $consulta = DB::table('ordenes')
                    ->select('ordenes.id',
                        'ordenes.codigo',
                        'formato_nombre_completo(P_R.primer_nombre, P_R.primer_apellido) as nombre_completo_responsable',
                        'formato_nombre_completo(P_S.primer_nombre, P_S.primer_apellido) as nombre_completo_solicitante',
                        'ordenes.fecha_actividad',
                        'ordenes.status',
                        'nombre as nombre_status')
                    ->join('personas as P_R', 'P_R.id', '=', 'responsable')
                    ->join('personas as P_S', 'P_S.id', '=','solicitante')
                    ->join('estados_ordenes', 'estados_ordenes.codigo', '=', 'status');


                $response = $this->generar_paginacion_dinamica($consulta,
                    array('campo_where' => 'codigo', 'campo_orden' => 'id'));

                
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

                $consulta = DB::table(DB::raw($consulta));

                $data_elemento_seleccionado = $consulta->first();

                if ($consulta->count() === 0) {
                    $response = array('resultado' => false);
                } else {

                    $data_obj = DB::table('vista_objetos_full')
                        ->select('cod_objeto', 'nombre_objeto as nombre', DB::raw('formato_unidad_objeto(nombre_unidad,abreviatura_unidad) as unidad'),'nombre_clase_objeto as clase_objeto')
                        ->where('cod_objeto', '=', $cod_objeto)
                        ->first();

                    $response = array(
                        'resultado' => true,
                        'datos' => array(
                            'cod_dimension' => $data_elemento_seleccionado->cod_dimension,
                            'cod_subdimension' => $data_elemento_seleccionado->cod_subdimension,
                            'cod_agrupacion' => $data_elemento_seleccionado->cod_agrupacion,
                            'cod_objeto' => $data_elemento_seleccionado->cod_objeto,
                            'numero_orden' => $data_elemento_seleccionado->numero_orden,
                            'cantidad_disponible' => $data_elemento_seleccionado->cantidad_disponible,
                            'nombre_objeto' => $data_obj->nombre,
                            'unidad' => $data_obj->unidad,
                            'clase_objeto' => $data_obj->clase_objeto
                        )
                    );
                }

                return $response;

                break;
        }
    }
    public function postGenerarOrden(){

        DB::beginTransaction();

        try{
            $responsable = Input::get('responsable');
            $solicitante = Auth::user()->id;
            $cod_laboratorio = Input::get('laboratorio');
            $observaciones = Input::get('observaciones');
            $fecha_actividad = Input::get('fecha_actividad');

            $data_elementos_pedidos = Input::get('data_elementos_pedidos');

            if(is_null($responsable) || is_null($cod_laboratorio) || is_null($observaciones) || is_null($data_elementos_pedidos)){
                if(is_null($responsable)){
                    $mensajes[] = "El id del usuario no puede quedar vacio";
                }
                if(is_null($cod_laboratorio)){
                    $mensajes[] = "El codigo de laboratorio no puede quedar vacio";
                }
                if(is_null($observaciones)){
                    $mensajes[] = "El campo observaciones no puede quedar vacio";
                }
                if(is_null($data_elementos_pedidos)){
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
            $nueva_orden->fecha = date("Y-m-d");
            $nueva_orden->hora = date("H:i:s");
            $nueva_orden->cod_laboratorio = $cod_laboratorio;
            $nueva_orden->observaciones = $observaciones;
            $nueva_orden->status = PENDIENTE;

            $nueva_orden->save();

            //armado de la data de los elementos pedidos
            foreach ($data_elementos_pedidos as $value){

                $data[] = array(
                    'cod_orden' => $nueva_orden->codigo,
                    'cod_dimension' => $value['cod_dimension'],
                    'cod_subdimension' => $value['cod_subdimension'],
                    'cod_agrupacion' => $value['cod_agrupacion'],
                    'cod_objeto' => $value['cod_objeto'],
                    'numero_orden' => $value['numero_orden'],
                    'cantidad_solicitada' => $value['cantidad_solicitada'],
                    'created_at' => get_now(),
                    'updated_at' => get_now()
                );
            }

            //se crean los elementos pedidos en la orden
            DB::table('pedidos')->insert($data);
        }

        catch(\Exception $e){
            DB::rollBack();

            return Response::json(array(
                'resultado'=>false, 
                'mensajes'=> array($e->getMessage())
            ),500);
        }
        
        DB::commit();

        return Response::json(array(
                'resultado'=>true, 
                'mensajes'=> array('Orden generada con exito!')));
    }

    public function postProcesarOrden(){
        $codigo_orden = Input::get('codigo_orden');
        $cod_nuevo_estado = Input::get('cod_nuevo_estado');

        if(!is_null($codigo_orden)){
            if(!is_null($cod_nuevo_estado)){

                //actualizar el estado de la orden
                DB::table('ordenes')->where('codigo', $codigo_orden)->update(['status' => $cod_nuevo_estado]);

                if($cod_nuevo_estado == COMPLETADA){


                    //obtenemos todos lo elementos de la orden procesada
                    $elementos = DB::table('pedidos')->select('cod_dimension',
                        'cod_subdimension',
                        'cod_agrupacion',
                        'cod_objeto',
                        'numero_orden',
                        'cantidad_solicitada')
                        ->where('cod_orden', '=', $codigo_orden)
                        ->get();

                    foreach($elementos as $elemento){

                        $data_elementos_pedidos[] = array(
                            'cod_dimension' => $elemento->cod_dimension,
                            'cod_subdimension' => $elemento->cod_subdimension,
                            'cod_agrupacion' => $elemento->cod_agrupacion,
                            'cod_objeto' => $elemento->cod_objeto,
                            'numero_orden' => $elemento->numero_orden,
                            'cantidad_existente' => null,//null por ahora hasta que se decida si se va a quitar el campo o no
                            'cantidad_solicitada' => $elemento->cantidad_disponible
                        );

                    }

                    DB::table('elementos_retenidos')->insert($data_elementos_pedidos);

                    return Response::json(array('resultado' => true, 'mensajes' => array('Orden procesada con exito.!')));
                }
                else if($cod_nuevo_estado == CANCELADA){
                    return Response::json(array('resultado' => true, 'mensajes' => array('Orden cancelada con exito.!')));
                }
            }
            else{
                return Response::json(array('resultado' => false, 'mensajes' => array('El cod_estado de orden no debe quedar vacio')));
            }
        }
        else{
            return Response::json(array('resultado' => false, 'mensajes' => array('El cod_orden no debe quedar vacio')));
        }
    }
}

?>