<?php  
	class NotificacionesController extends controller{
		
		//falta por desarrollar
		public function getMostrar(){
			$tipo_busqueda = Input::get('type', 'todos');
			$id_usuario = Input::get('id_usuario', null);
			$contar = (bool)Input::get('contar', false);

			$orden = Input::get('ordenar', 'fecha');
			$visto = Input::get('visto', false);

			if(is_null($id_usuario) || $id_usuario != "null"){
				return Response::json(array(
						'resultado' => false, 
						'mensajes' => array('debe especificar el ID del usuario')), 404
				);
			}

			switch($tipo_busqueda){
				case 'todos':
					if($contar){
						
						//consulta para saber numero de notificaciones del usuario
						$consulta = DB::table('notificaciones as NO')
							->where('NO.visto', '=', $visto)
							->where('NO.receptor', '=', $id_usuario)
							->count();

						$response = array(
							'resultado' => true,
							'datos' => $consulta
						);
					}
					else{

						//consulta para saber las notificaciones del usuario
						$consulta = DB::table('notificaciones as NO')
							->select('NO.id', 'NO.fecha', 'NO.hora', 'NO.visto', 'mensajes.id as id_mensaje', 'mensajes.mensaje', 'usuarios.id as id_usuario', 'usuarios.usuario')
							->join('usuarios', 'usuarios.id', '=', 'NO.emisor')
							->join('mensajes', 'mensajes.id', '=', 'NO.mensaje_id')
							->where('NO.receptor', '=', $id_usuario)
							->where('NO.visto', '=', $visto)
							->orderBy('NO.fecha')
							->get();

						$response = array(
							'resultado' => true,
							'datos' => $consulta
						);
					}
				break;

				case 'paginacion':
					$length = Input::get('length', 10);
					$value_search = Input::get('search');
					$draw = Input::get('draw',1);

					if(quitar_espacios($value_search['value']) == ''){
						//$data = Usuario::orderBy($orden)->paginate($length);	
						
						$response = DB::table('notificaciones as NO')
							->select('NO.id', 'NO.fecha', 'NO.hora', 'NO.visto', 'mensajes.id as id_mensaje', 'mensajes.mensaje', 'usuarios.id as id_usuario', 'usuarios.usuario')
							->join('usuarios', 'usuarios.id', '=', 'NO.emisor')
							->join('mensajes', 'mensajes.id', '=', 'NO.mensaje_id')
							->where('NO.receptor', '=', $id_usuario)
							->orderBy('fecha')
							->paginate($length);

					}
					else{

						$data = Usuario::where('usuario','ILIKE','%'.$value_search['value'].'%')->paginate($length);	
					}
					

					$response = array(
						"draw"=>$draw,
						"page"=>$data->getCurrentPage(),
						"recordsTotal"=>$data->getTotal(),
						"recordsFiltered"=> $data->count(),
						"data" => $data->all()
					);

				break;

				default:
					$response = Usuario::all();
				break;

			}

			return Response::json($response);

		}

		public function postCrearNotificaciones(){
			DB::beginTransaction();

			//Datos del mensaje
			$mensaje = Input::get('mensaje');

			//Datos de la Notificacion
			$emisor = Input::get('emisor');
			$receptor = Input::get('receptor');

	        $reglas = array(
	            'mensaje' =>'required|max:200|min:5|alpha_num',
	            	            
	            //Reglas de la notificacion
	            'emisor' =>'required|exists:usuarios,id|numeric',
	        	'receptor' => 'required|exists:usuarios,id|numeric'
	        );

	        $campos = array(
	        	'mensaje'=>$mensaje,
	            
	            //Campos persona
	            'emisor'=>$emisor,
	        	'receptor' => $receptor
	        );

	        $mensajes = array(
	            'required' => ':attribute no puede estar en blanco',
	            'exists' => ':attribute no existe',
	            'max' => ':attribute debe tener un maximo de :max caracteres',
	            'min' => ':attribute debe tener un minimo de :min caracteres',
	        );

	        $validacion = Validator::make($campos,$reglas,$mensajes);      

			if($validacion->fails()){
				return Response::json(array('resultado'=>false, 'mensajes'=>$validacion->messages()->all()));
			}
			else{
		
				try{
					
					$nuevo_mensaje = new Mensaje;
					$nuevo_mensaje->mensaje = $mensaje;
					$nuevo_mensaje->save();

					Notificacion::create(array(
						'mensaje_id' => $nuevo_mensaje->id,
						'emisor' => $emisor,
						'receptor' => $receptor,
						'visto' => false
					));
				}
				catch(ValidationException $e){
					DB::rollBack();

					return Response::json(array(
						'resultado'=>false, 
						'mensajes'=> $e->getErrors()
					));
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
					'mensajes'=>array('Notificacion creada con exito')
					)
				);
			}
		}
	}
?>