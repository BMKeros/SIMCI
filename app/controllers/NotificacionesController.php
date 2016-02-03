<?php  
	class NotificacionesController extends controller{
		
		//falta por desarrollar
		public function getMostrar(){

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