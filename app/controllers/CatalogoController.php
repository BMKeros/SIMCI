<?php  
	class CatalogoController extends Controller{

		public function getMostrarCatalogos(){
			//$catalogos = Catalogo::all()->paginate(15);
			$catalogos = DB::table('usuarios')->paginate(2);

			return Response::json($catalogos);
		}

		public function postRegistrarObjeto(){
			$nombre = Input::get('nombre');
			$descripcion = Input::get('descripcion');
			$especificaciones = Input::get('especificaciones');
			$cod_unidad = Input::get('cod_unidad');
			$cod_tipo_objeto = Input::get('cod_tipo_objeto');

			$reglas = array(
				'nombre' => 'required|min:5|max:100', 
				'descripcion' => 'required|min:5|max:200',
				'especificaciones' => 'required|min:5|max:200',
				'cod_unidad' => 'required|numeric|exists:catalogo_objetos,cod_unidad',
				'cod_tipo_objeto' => 'required|numeric|exists:catalogo_objetos,cod_tipo_objeto'
			);

			$campos = array(
				'nombre' => $nombre,
				'descripcion' => $descripcion,
				'especificaciones' => $especificaciones,
				'cod_unidad' => $cod_unidad,
				'cod_tipo_objeto' => $cod_tipo_objeto
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
				$catalogo->cod_tipo_objeto = $cod_tipo_objeto;

				$catalogo->save();

				return Response::json(array('resultado' => true, 'mensajes' => 'Nuevo Catalogo de Objetos creado con exito'));
			}
		}

		public function postActualizarCatalogo($id){
			$objeto = Catalogo::find($id);

			if(!is_null($objeto)){


				$nombre = input_default(Input::get('nombre'),$objeto->nombre);
				$descripcion = input_default(Input::get('descripcion'),$objeto->descripcion);
				$especificaciones = input_default(Input::get('especificaciones'),$objeto->especificaciones);
				$cod_unidad = input_default(Input::get('cod_unidad'),$catalogo->cod_unidad);
				$cod_tipo_objeto = input_default(Input::get('cod_tipo_objeto'),$objeto->cod_tipo_objeto);

				$reglas = array(
					'nombre' => 'required|min:5|max:100', 
					'descripcion' => 'required|min:5|max:200',
					'especificaciones' => 'required|min:5|max:200',
					'cod_unidad' => 'required|numeric|exists:catalogo_objetos,cod_unidad',
					'cod_tipo_objeto' => 'required|numeric|exists:catalogo_objetos,cod_tipo_objeto'
				);

				$campos = array(
					'nombre' => $nombre,
					'descripcion' => $descripcion,
					'especificaciones' => $especificaciones,
					'cod_unidad' => $cod_unidad,
					'cod_tipo_objeto' => $cod_tipo_objeto
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
					$catalogo->nombre = $nombre;
					$catalogo->descripcion = $descripcion;
					$catalogo->especificaciones = $especificaciones;
					$catalogo->cod_unidad = $cod_unidad;
					$catalogo->cod_tipo_objeto = $cod_tipo_objeto;
					$catalogo->save();

					return Response::json(array('resultado' => true, 'mensajes' => array('Objetos creado con exito')));
				}
			}
			else{
				return Response::json(array('resultado' => false, 'mensajes' => array('Objeto no encontrado')));
			}
		}
	}
?>