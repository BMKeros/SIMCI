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
						$response = DB::table('vista_laboratorio_full')->orderBy($orden)->get();
					}
					else{
						$response = DB::table('vista_laboratorio_full')->get();
					}
				break;

				case 'laboratorio_full':
					if($id_laboratorio){
						$response = DB::table('vista_laboratorio_full')
							->select('cod_laboratorio as codigo', 'nombre_laboratorio as nombre', 'descripcion_laboratorio as descripcion')
							->where('cod_laboratorio', '=', $id_laboratorio)
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
					
					$consulta = DB::table('vista_laboratorio_full')
							->select('cod_laboratorio as codigo', 'nombre_laboratorio as nombre', 'descripcion_laboratorio as descripcion');

					$response = $this->generar_paginacion_dinamica($consulta,
						array('campo_where'=>'nombre_laboratorio', 'campo_orden'=>'cod_laboratorio'));

				break;

				case 'agregar_stock':
					$cod_laboratorio = Input::get('cod_laboratorio', null);
					$cod_objeto = Input::get('cod_objeto', null);

					$data_lab = DB::table('vista_laboratorio_full')
					->select('cod_laboratorio', 'nombre_laboratorio as nombre')
					->where('cod_laboratorio','=',$cod_laboratorio)
					->first();

					$data_obj = DB::table('vista_objetos_full')
					->select('cod_objeto','nombre_objeto as nombre')
					->where('cod_objeto','=',$cod_objeto)
					->first();

					
					$response = array(
						'cod_objeto' => $data_obj->cod_objeto,
						'nombre_objeto' => $data_obj->nombre,
						'cod_laboratorio' => $data_lab->cod_laboratorio,
						'nombre_laboratorio' => $data_lab->nombre
					);

				break;

				case 'paginacion_stock':
					$consulta = DB::table('vista_stock_laboratorio_full')
						->select('id', 'cod_laboratorio', 'nombre_laboratorio', 'cod_objeto', 'nombre_objeto','cantidad');

					$response = $this->generar_paginacion_dinamica($consulta,
						array('campo_where'=>'nombre_objeto', 'campo_orden'=>'nombre_objeto'));
				break;

				case 'stock_laboratorio':
					$cod_laboratorio_origen = Input::get('cod_laboratorio');

					$response = DB::table('vista_stock_laboratorio_full')
						->select('cod_objeto', 'nombre_objeto', 'cantidad')
						->where('cod_laboratorio', '=', $cod_laboratorio_origen)
						->get();

				break;

				default:
					$response = DB::table('vista_laboratorio_full')->get();
				break;

			}

			return Response::json($response);
		}

		public function  getVerificar(){
			$tipo_verificacion = Input::get('type', null);

			switch($tipo_verificacion){

				case 'existe_stock_laboratorio':
					$cod_laboratorio = Input::get('cod_laboratorio',null);
					$cod_objeto = Input::get('cod_objeto', null);

					$existe = DB::table('objetos_laboratorio')
						->where('cod_laboratorio','=',$cod_laboratorio)
						->where('cod_objeto','=',$cod_objeto)
						->count();

					$response = array(
						'resultado' => ($existe == 0)?(false):(true)
					);
				break;

				case 'relacion_laboratorio':
					$id = Input::get('cod_laboratorio');

					if($id){
						$exists_relacion = DB::table('objetos_laboratorio')
							->where('cod_laboratorio', '=', $id)
							->count();
					}
					else{
						$exists_relacion = 0;
					}


					if($exists_relacion){
						$response = array(
								'resultado'=>true,
								'mensajes'=> "No puede eliminar este laboratorio debido que mantiene relaciones con otras entidades. Verifique para proceder con la accion."
							);
					}
					else{
						$response = array(
								'resultado'=>false,
								'mensajes'=> "Confirme si desea eliminar"
							);
					}

				break;

				default:
					$response = array();
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

		public function postAgregarStock(){
			$items_stock_tabla = Input::get('items_stock');

			foreach ($items_stock_tabla as $item) {
				
				//aqui va la consulta a la funcion sql que se encargara de de hacer el agregado
				//a la db pasando por parametro cod_objeto, cod_laboratorio, cantidad
				$campos[] = array(
					'cod_laboratorio' => $item['cod_laboratorio'],
					'cod_objeto' => $item['cod_objeto'],
					'cantidad' => $item['cantidad'],
					'created_at' => get_now(),
					'updated_at' => get_now()
				);
			}

			DB::table('objetos_laboratorio')->insert($campos);

			return Response::json(array('resultado' => true, 'mensajes' => array('Objetos agregados con exito.!')));
		}

		public function postRetornarStock(){
			$id = Input::get('id');
			$cantidad = Input::get('cantidad');

			dd($id.$cantidad);
		}

		public function postMoverStock(){
			//data porque nose como vendra del frontend, este sera el que traiga todos los datos
			$data = Input::get('data');

			if(is_null($data)){
				return Response::json(array('resultado' => false));
			}
			else{
				foreach($data as $value){
					DB::select("select mover_stock_laboratorio('".$value['cod_laboratorio_origen']."','".$value['cod_laboratorio_destino']."',".$value['cod_objeto'].",".$value['cantidad_mover'].")");
				}	

				return Response::json(array('resultado' => true));
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

	}
?>