<?php  
	class CatalogoController extends Controller{

		public function getMostrarCatalogos(){
			$catalogos = Catalogo::all();

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
				'cod_unidad' => 'required|integer',
				'cod_tipo_objeto' => 'required|integer'
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
				'max' => 'El campo :attribute no debe exceder los :max caracteres'
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
	}
?>