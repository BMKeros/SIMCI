<?php  
	class CatalogoController extends Controller{

		public function getMostrar(){

			$tipo_busqueda = Input::get('type', 'todos');
			$id_objeto = Input::get('id', null);
			$orden = Input::get('ordenar','asc');

			switch($tipo_busqueda){
				case 'todos':
					if($orden){
						$response = Catalogo::orderBy('id', $orden)->get();
					}
					else{
						$response = Catalogo::all();	
					}
				break;

				case 'objeto':
					if($id_objeto){
						$response = Catalogo::find($id_objeto);

						if(is_null($response)){
							$response = array();
						}
					}
					else{
						$response = array();
					}
				break;

				case 'paginacion':
					$length = Input::get('length', 10);
					$value_search = Input::get('search');
					$draw = Input::get('draw',1);

					if(quitar_espacios($value_search['value']) == ''){
						//$data = Catalogo::paginate($length);	
						$data = DB::table('catalogo_objetos as CO')
							->select('CO.id', 'CO.nombre', 'CO.especificaciones', 'unidades.nombre as nombre_unidad', 'unidades.abreviatura as abreviatura_unidad')
							->join('unidades', 'unidades.cod_unidad', '=', 'CO.cod_unidad')
							->orderBy('id','asc')
							->paginate($length);
					}
					else{
						//$data = Catalogo::where('nombre','ILIKE','%'.$value_search['value'].'%')->paginate($length);	
						$data = DB::table('catalogo_objetos as CO')
							->select('CO.id', 'CO.nombre', 'CO.especificaciones', 'unidades.nombre as nombre_unidad', 'unidades.abreviatura as abreviatura_unidad')
							->join('unidades', 'unidades.cod_unidad', '=', 'CO.cod_unidad')
							->where('CO.nombre', 'ILIKE', '%'.$value_search['value'].'%')
							->orderBy('id','asc')
							->paginate($length);
					}
					
					$response = array(
						"draw"=>$draw,
						"page"=>$data->getCurrentPage(),
						"recordsTotal"=>$data->getTotal(),
						"recordsFiltered"=> $data->count(),
						"data" => $data->all()
					);

				break;

				case 'query':

					$value_search = Input::get('query');
					
					if(quitar_espacios($value_search) != ''){
						
						$data = DB::table('catalogo_objetos')
						//DB::raw('concat(UPPER(LEFT(nombre,1))::text , LOWER(SUBSTRING(nombre,2,length(nombre)))::text) as name', 'id as value')
							->select('nombre as name', 'id as value')
							->where('nombre','ILIKE','%'.$value_search.'%')
							->get();


						$response = array("success"=>true, "results" => $data);
					}
					else{
						$response = array("success"=>false, "results" => array());
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
				'required' => 'El campo :attribute es necesario',
				'integer' => 'El campo :attribute debe ser numerico',
				'min' => 'El campo :attribute no debe contener menos de :min caracteres',
				'max' => 'El campo :attribute no debe exceder los :max caracteres',
				'exists' => ':attribute no existe',
				'numeric' => 'El :attribute debe ser solo numeros'
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
			
			$reglas = array(
				'nombre' => 'required|min:5|max:50', 
				'abreviatura' => 'required|min:2|max:10',
			);

			$campos = array(
				'nombre' => $nombre,
				'abreviatura' => $abreviatura
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
				$unidad = new Unidad;

				$unidad->nombre = $abreviatura;
				$unidad->abreviatura = $abreviatura;
				
				$unidad->save();

				return Response::json(array('resultado' => true, 'mensajes' => 'Nueva Unidad creada con exito'));
			}
		}
	}
?>