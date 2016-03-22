<?php  
	class LaboratorioController extends BaseController{
		
		//pendiente para mostrar lo necesaio
		public function getMostrar(){
			$tipo_busqueda = Input::get('type', 'todos');
			$id_laboratorio = Input::get('id', null);
			$orden = Input::get('ordenar',' asc');

			switch($tipo_busqueda){
				case 'todos':
					if($orden){
						//le falta aun los campos que traera la consulta
						$response = DB::table('laboratorios')->orderBy($orden)->get();
					}
					else{
						$response = DB::table('laboratorios')->get();
					}
				break;

				case 'laboratorio_full':
					if($id_laboratorio){
						$response = DB::table('laboratorios')
							->select('codigo', 'nombre', 'descripcion')
							->where('codigo', '=', $id_laboratorio)
							->first();

						if(is_null($response)){
							$response = array();
						}
					}
					else{
						$response = array();
					}
				break;

				case 'paginacion':
					
					$consulta = DB::table('laboratorios')
							->select('codigo', 'nombre', 'descripcion');

					$response = $this->generar_paginacion_dinamica($consulta,
						array('campo_where'=>'nombre', 'campo_orden'=>'codigo'));

				break;

				case 'agregar_stock':
					$cod_laboratorio = Input::get('cod_laboratorio', null);
					$cod_objeto = Input::get('cod_objeto', null);

					$data_lab = DB::table('laboratorios')
					->select('codigo as cod_laboratorio', 'nombre')
					->where('codigo','=',$cod_laboratorio);
					->get();

					$data_obj = DB::table('catalogo_objetos')
					->select('id as cod_objeto','nombre')
					->where('id','=',$cod_objeto)
					->get();

					$response = array(
						//'l' => $data_lab,
						//'o'=> $data_obj
					);

				break;

				default:
					$response = DB::table('laboratorios')->get();
				break;

			}

			return Response::json($response);
		}

		public function postRegistrarLaboratorio(){
			
			$nombre = Input::get('nombre');
			$descripcion = Input::get('descripcion');

			$reglas = array(
				'nombre' => 'required|min:5|max:40',
				'descripcion' => 'min:5|max:150'
			);

			$campos = array(
				'nombre' => $nombre,
				'descripcion' => $descripcion
			);

			$mensajes = array(
	            'required' => ':attribute no puede estar en blanco',
	            'max' => ':attribute debe tener un maximo de :max caracteres',
	            'min' => ':attribute debe tener un minimo de :min caracteres'
			);

			$validacion = Validator::make($campos, $reglas, $mensajes);

			if($validacion->fails()){
				return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
			}
			else{

				$num_lab = DB::table('laboratorios')->max('secuencia');

				$laboratorio = new Laboratorio;
				$laboratorio->codigo = crear_codigo($num_lab, 'LABORATORIO');
				$laboratorio->nombre = $nombre;
				$laboratorio->descripcion = $descripcion;
				
				$laboratorio->save();

				return Response::json(array('resultado' => true, 'mensajes' => 'Laboratorio creado con exito'));
			}
		}

		public function postActualizarLaboratorio(){
			
			$id_laboratorio = Input::get('id');

			$lab_actual = Laboratorio::find($id_laboratorio);

			
			if(!is_null($lab_actual)){
				$nombre = input_default(Input::get('nombre'), $lab_actual->nombre);
				$descripcion = input_default(Input::get('descripcion'), $lab_actual->descripcion);	

				$reglas = array(
				'nombre' => 'required|min:5|max:40',
				'descripcion' => 'min:5|max:150'
				);

				$campos = array(
					'nombre' => $nombre,
					'descripcion' => $descripcion
				);

				$mensajes = array(
		            'required' => ':attribute no puede estar en blanco',
		            'max' => ':attribute debe tener un maximo de :max caracteres',
		            'min' => ':attribute debe tener un minimo de :min caracteres'
				);

				$validacion = Validator::make($campos, $reglas, $mensajes);
				
				if($validacion->fails()){
					return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
				}
				else{

					$lab_actual->nombre = $nombre;
					$lab_actual->descripcion = $descripcion;
					
					$lab_actual->save();

					return Response::json(array('resultado' => true, 'mensajes' => 'Laboratorio actualizado con exito'));
				}



			}
		}

		public function postVerificar(){
			$id = Input::get('id');

			if($id){
				$exists_relacion = DB::table('objetos_laboratorio')
		            ->where('cod_laboratorio', '=', $id)
		        	->count();	
			}
			else{
				$exists_relacion = 0;
			}
			
			
	        if($exists_relacion){
	        	return Response::json(array(
					'resultado'=>true, 
					'mensajes'=> "No puede eliminar este laboratorio debido que mantiene relaciones con otras entidades. Verifique para proceder con la accion."
					)
				);
	        }
	        else{
	        	return Response::json(array(
					'resultado'=>false, 
					'mensajes'=> "Confirme si desea eliminar"
					)
				);
	        }
	    }

	    public function postEliminar(){
	    	$id_laboratorio = Input::get('id');

	    	$laboratorio = Laboratorio::find($id_laboratorio);

			if($laboratorio){
				
				$laboratorio->delete();	
				
				return Response::json(array(
					'resultado'=>true, 
					'mensajes'=>array('Laboratorio eliminado con exito')
					)
				);
			}
			else{
				return Response::json(array(
					'resultado'=>false, 
					'mensajes'=>array('Laboratorio no existe')
					)
				);
			}
	    }

	    public function postAgregarStock(){
	    	$cod_laboratorio = Input::get('cod_laboratorio');
	    	$cod_objeto = Input::get('cod_objeto');

	    	$reglas = array(
	    		'cod_laboratorio' => 'required',
	    		'cod_objeto' => 'required'
	    	);

	    	$campos = array(
	    		'cod_laboratorio' => $cod_laboratorio,
	    		'cod_objeto' => $cod_laboratorio
	    	);

	    	$validacion = Validator::make($campos, $reglas, $mensajes);

	    	if($validacion->fails()){
	    		return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
	    	}
	    	else{
	    		$objeto_laboratorio = new ObjetoLaboratorio;

	    		$objeto_laboratorio->cod_laboratorio = $cod_laboratorio;
	    		$objeto_laboratorio->cod_objeto = $cod_objeto;

	    		$objeto_laboratorio->save();

	    		return Response::json(array(
	    				'resultazdo' => true,
	    				'mensajes' => array('Objeto asignado con exito.!')
	    			)
	    		);

	    	}

	    }

	}
?>