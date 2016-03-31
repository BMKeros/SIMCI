
<?php  
	class CatalogoController extends BaseController{

		public function getMostrar(){

			$tipo_busqueda = Input::get('type', 'todos');
			$id_objeto = Input::get('id', null);
			$orden = Input::get('ordenar','asc');

			switch($tipo_busqueda){
				case 'todos':
					if($orden){
						$response = DB::table('vista_objetos_full')->orderBy('id', $orden)->get();
					}
					else{
						$response = DB::table('vista_objetos_full')->get();
					}
				break;

				case 'objeto':
					if($id_objeto){
						$response = DB::table('vista_objetos_full')
							->select('nombre_objeto as nombre', 'descripcion_objeto as descripcion', 'especificaciones_objeto as especificaciones', 'cod_clase_objeto', 'nombre_clase_objeto as nombre_clase', 'cod_unidad', 'nombre_unidad', 'abreviatura_unidad')
							->where('cod_objeto', '=', $id_objeto)
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


				$consulta = DB::table('vista_objetos_full')
					->select('cod_objeto as id', 'nombre_objeto as nombre', 'especificaciones_objeto as especificaciones', 'nombre_unidad', 'abreviatura_unidad');
				
					$response = $this->generar_paginacion_dinamica($consulta,
					array('campo_where'=>'nombre_objeto', 'campo_orden'=>'cod_objeto'));
				break;

				case 'query':

					$value_search = Input::get('query');
					
					if(quitar_espacios($value_search) != ''){
						
						$data = DB::table('vista_objetos_full')
							->select(DB::raw('capitalize(nombre_objeto) as name'), 'cod_objeto as value')
							->where('nombre_objeto','ILIKE','%'.$value_search.'%')
							->get();


						$response = array("success"=>true, "results" => $data);
					}
					else{
						$data = DB::table('vista_objetos_full')
							->select(DB::raw('capitalize(nombre_objeto) as name'), 'cod_objeto as value')
							->orderBy('name', 'desc')
							->take(15)
							->get();
						
						$response = array("success"=>true, "results" => $data);
					}
				break;

				default:
					$response = Catalogo::all();
				break;

			}

			return Response::json($response);
		}

		public function postRegistrarObjeto(){
			$nombre = Input::get('nombre');
			$descripcion = Input::get('descripcion');
			$especificaciones = Input::get('especificaciones');
			$cod_unidad = Input::get('cod_unidad');
			$cod_clase_objeto = Input::get('cod_clase_objeto');

			$reglas = array(
				'nombre' => 'required|min:5|max:100|unique:catalogo_objetos', 
				'descripcion' => 'required|min:5|max:200',
				'especificaciones' => 'required|min:5|max:200',
				'cod_unidad' => 'required|numeric|exists:unidades,cod_unidad',
				'cod_clase_objeto' => 'required|numeric|exists:clase_objetos,id'
			);

			$campos = array(
				'nombre' => $nombre,
				'descripcion' => $descripcion,
				'especificaciones' => $especificaciones,
				'cod_unidad' => $cod_unidad,
				'cod_clase_objeto' => $cod_clase_objeto
			);

			$mensajes = array(
				'required' => 'El campo :attribute es necesario',
				'integer' => 'El campo :attribute debe ser numerico',
				'min' => 'El campo :attribute no debe contener menos de :min caracteres',
				'max' => 'El campo :attribute no debe exceder los :max caracteres',
				'exists' => ':attribute no existe',
				'numeric' => 'El :attribute debe ser solo numeros',
				'unique' => 'Este :attribute ya existe'
			);

			$validacion = Validator::make($campos, $reglas, $mensajes);

			if($validacion->fails()){
				return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
			}
			else{
				$catalogo = new Catalogo;

				$catalogo->nombre = $nombre;
				$catalogo->descripcion = $descripcion;
				$catalogo->especificaciones = $especificaciones;
				$catalogo->cod_unidad = $cod_unidad;
				$catalogo->cod_clase_objeto = $cod_clase_objeto;

				$catalogo->save();

				return Response::json(array('resultado' => true, 'mensajes' => 'Nuevo Catalogo de Objetos creado con exito'));
			}
		}

		public function postActualizarObjeto(){
			$id = Input::get('id');
			$objeto = Catalogo::find($id);

			if(!is_null($objeto)){

				$nombre = input_default(Input::get('nombre'),$objeto->nombre);
				$descripcion = input_default(Input::get('descripcion'),$objeto->descripcion);
				$especificaciones = input_default(Input::get('especificaciones'),$objeto->especificaciones);
				$cod_unidad = input_default(Input::get('cod_unidad'),$objeto->cod_unidad);
				$cod_clase_objeto = input_default(Input::get('cod_clase_objeto'),$objeto->cod_clase_objeto);

				$reglas = array(
					'nombre' => 'required|min:5|max:100', 
					'descripcion' => 'required|min:5|max:200',
					'especificaciones' => 'required|min:5|max:200',
					'cod_unidad' => 'required|numeric|exists:unidades,cod_unidad',
					'cod_clase_objeto' => 'required|numeric|exists:clase_objetos,id'
				);

				$campos = array(
					'nombre' => $nombre,
					'descripcion' => $descripcion,
					'especificaciones' => $especificaciones,
					'cod_unidad' => $cod_unidad,
					'cod_clase_objeto' => $cod_clase_objeto
				);

				$mensajes = array(
					'required' => ':attribute es necesario',
					'min' => ':attribute no debe contener menos de :min caracteres',
					'max' => ':attribute no debe exceder los :max caracteres',
					'exists' => ':attribute no existe',
					'numeric' => ':attribute debe contener solo numeros'
				);

				$validacion = Validator::make($campos, $reglas, $mensajes);

				if($validacion->fails()){
					return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
				}
				else{
					$objeto->nombre = $nombre;
					$objeto->descripcion = $descripcion;
					$objeto->especificaciones = $especificaciones;
					$objeto->cod_unidad = $cod_unidad;
					$objeto->cod_clase_objeto = $cod_clase_objeto;
					$objeto->save();

					return Response::json(array('resultado' => true, 'mensajes' => array('Objetos creado con exito')));
				}
			}
			else{
				return Response::json(array('resultado' => false, 'mensajes' => array('Objeto no encontrado')));
			}
		}

		public function postEliminar(){
			$id = Input::get('id');

			$objeto = Catalogo::find($id);
			
			if(!is_null($objeto)){
				$objeto->delete();
				return Response::json(array('resultado' => true, 'mensajes' => array('Objetos eliminado con exito')));
			}
			else{
				return Response::json(array('resultado' => false, 'mensajes' => array('Objeto no encontrado')));
			}
		}

		public function postRegistrarUnidad(){
			$nombre = Input::get('nombre');
			$abreviatura = Input::get('abreviatura');
			$tipo_unidad = Input::get('tipo_unidad');

			$reglas = array(
				'nombre' => 'required|min:5|max:50', 
				'abreviatura' => 'required|min:2|max:10',
				'tipo_unidad' => 'required'
			);

			$campos = array(
				'nombre' => $nombre,
				'abreviatura' => $abreviatura,
				'tipo_unidad' => $tipo_unidad
			);

			$mensajes = array(
				'required' => 'El campo :attribute es necesario',
				'min' => 'El campo :attribute no debe contener menos de :min caracteres',
				'max' => 'El campo :attribute no debe exceder los :max caracteres',
				'unique' => 'El campo :attribute ya existe.',
			);

			$validacion = Validator::make($campos, $reglas, $mensajes);

			if($validacion->fails()){
				return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
			}
			else{
				$unidad = new Unidad;

				$unidad->nombre = $nombre;
				$unidad->abreviatura = $abreviatura;
				$unidad->tipo_unidad = $tipo_unidad;
				
				$unidad->save();

				return Response::json(array('resultado' => true, 'mensajes' => 'Nueva Unidad creada con exito'));
			}
		}

		public function postRegistrarClaseObjeto(){
			$nombre = Input::get('nombre');
			$descripcion = Input::get('descripcion');
			
			$reglas = array(
				'nombre' => 'required|min:5|max:50', 
				'descripcion' => 'required|min:5|max:50',
			);

			$campos = array(
				'nombre' => $nombre,
				'descripcion' => $descripcion
			);

			$mensajes = array(
				'required' => 'El campo :attribute es necesario',
				'min' => 'El campo :attribute no debe contener menos de :min caracteres',
				'max' => 'El campo :attribute no debe exceder los :max caracteres',
				'unique' => 'El campo :attribute ya existe.'
			);

			$validacion = Validator::make($campos, $reglas, $mensajes);

			if($validacion->fails()){
				return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
			}
			else{
				$clase_objeto = new ClaseObjeto;

				$clase_objeto->nombre = $nombre;
				$clase_objeto->descripcion = $descripcion;
				
				$clase_objeto->save();

				return Response::json(array('resultado' => true, 'mensajes' => 'Nueva Clase de Objeto creada con exito'));
			}
		}
	}
?>