<?php 	 
	class InventarioController extends controller{
		
		public function postRegistrarElemento(){

			$cod_dimension = Inmput::get('');
			$cod_sub_dimension = Input::get('');
			$cod_agrupacion = Input::get('');
			$cod_sub_agrupacion = Input::get('');
			$nuemero_orden = Input::get('');
			$cod_objeto = Input::get('');
			$cantidad_disponible = Input::get('');
			$usa_recipiente = Input::get('');
			$recipientes_disponible = Input::get('');		

			$reglas = array(
				'cod_dimension' => 'required|integer',
				'cod_sub_dimension' =>'required|integer',
				'cod_agrupacion' => 'required|integer',
				'cod_sub_agrupacion' => 'required|integer',
				'nuemero_orden' => 'required|integer',
				//pendiente evaluar si cod_objeto sera unique
				'cod_objeto' => 'required|integer',
				'cantidad_disponible' => 'required',
				//campos aun no se sabe si se dejaran o se quitaran
				'usa_recipiente' => 'required|boolean',
				'recipientes_disponible' => 'required|integer'
			);

			$campos = array(
				'cod_dimension' => $cod_dimension,
				'cod_sub_dimension' => $cod_sub_dimension,
				'cod_agrupacion' => $cod_agrupacion,
				'cod_sub_agrupacion' => $cod_sub_agrupacion,
				'nuemero_orden' => $nuemero_orden,
				'cod_objeto' => $cod_objeto,
				'cantidad_disponible' => $cantidad_disponible,
				'usa_recipiente' => $usa_recipiente,
				'recipientes_disponible' => $recipientes_disponible

			);

			$mensajes = array(
				'required' => 'El campo :attribute es necesario',
				'integer' => 'El campo :attribute debe ser numerico',
				'boolean' => 'El campo :attribute debe ser una eleccion logita Ej:(true o false)'
			);

			$validacion = Validator::make($campos, $reglas, $mensajes);

			if($validacion->fails()){
				return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
			}
			else{
				$nuevo_elemento = new ElementoInventario;

				$nuevo_elemento->cod_dimension = $cod_dimension;
				$nuevo_elemento->cod_subdimension = $cod_sub_dimension;
				$nuevo_elemento->cod_agrupacion = $cod_agrupacion;
				$nuevo_elemento->cod_subagrupacion = $cod_sub_agrupacion;
				$nuevo_elemento->numero_orden = $numero_orden;
				$nuevo_elemento->cod_objeto = $cod_objeto;
				$nuevo_elemento->cantidad_disponible = $cantidad_disponible;
				$nuevo_elemento->usa_recipiente = $usa_recipiente;
				$nuevo_elemento->recipientes_disponible = $recipientes_disponible;

				$nuevo_elemento->save();

				return Response::json(array(
					'resultado' => true,
					'mensajes' => 'Nuevo Elemento creado con exito.',
					//pendiente colocar o no del id de los objetos que se crean
					)
				);
			}
		}

		public function postRegistrarAlmacen(){
			$cod_almacen = Input::get('');
			$responsable = Input::get('');
			$primer_auxiliar = Input::get('');
			$segundo_auxiliar = Input::get('');
			$descripcion = Input::get('descripcion');

			$reglas = array(
				'cod_almacen' => 'required|integer|unique',
				'responsable' => 'required|integer|unique',

				//pendientes por modificar si seran o no unicos
				'primer_auxiliar' => 'required|integer|unique',
				'segundo_auxiliar' => 'integer|unique',

				'descripcion' => 'required|min:3|max:8'
			);

			$campos = array(
				'cod_almacen' => $cod_almacen,
				'responsable' => $responsable,
				'primer_auxiliar' => $primer_auxiliar,
				'segundo_auxiliar' => $segundo_auxiliar,
				'descripcion' => $descripcion
			);

			$mensajes = array(
				'required' => 'El campo :attribute es obligatorio',
				'integer' => 'El campo :attribute debe ser numerico',
				'unique' => 'El campo :attribute ya existe, intente con otro',
				'min' => 'El campo :attribute no debe tener menos de :min caracteres',
				'max' => 'El campo :attribute no debe exceder los :max caracteres'
			);

			$validacion = Validator::make($campos, $reglas, $mensajes);

			if($validacion->fails()){
				return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
			}
			else{
				$nuevo_almacen = new Almacen;

				$nuevo_almacen->cod_almacen = $cod_almacen;
				$nuevo_almacen->responsable = $responsable;
				$nuevo_almacen->primer_auxiliar = $primer_auxiliar;
				$nuevo_almacen->segundo_auxiliar = $segundo_auxiliar;
				$nuevo_almacen->descripcion = $descripcion;

				$nuevo_almacen->save();

				return Response::json(array('resultado' => true, 'mensajes' => 'Nuevo Almacen creado con exito.'));
			}
		}

		public function postRegistrarEstante(){
			$cod_estante = Input::get('');
			$descripcion = Input::get('');

			$reglas = array(
				'cod_estante' => 'required|integer|unique',
				'descripcion' => 'required|min:3|max:8'
			);

			$campos = array(
				'cod_estante' => $cod_estante,
				'descripcion' => $descripcion
			);

			$mensajes = array(
				'required' => 'El campo :attribute es obligatorio',
				'integer' => 'El campo :attribute debe ser numerico',
				'unique' => 'El campo :attribute ya existe, intente con otro',
				'min' => 'El campo :attribute no debe tener menos de :min caracteres',
				'max' => 'El campo :attribute no debe exceder los :max caracteres'
			);

			$validacion = Validator::make($campos, $reglas, $mensajes);

			if($validacion->fails()){
				return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages->all()));
			}
			else{
				$nuevo_estantes = new Estante;

				$nuevo_estantes->cod_estante = $cod_estante;
				$nuevo_estantes->descripcion = $descripcion;

				$nuevo_estantes->save();

				return Response::json(array('resultado' => true, 'mensajes' => 'Nuevo Estante creado con exito.'));
			}
		}


		public function postRegistrarAgrupacion(){
			$nombre = Input::get('');
			$descripcion = Input::get('');

			$reglas = array(
				'nombre' => 'required|min:5|max:30',
				'descripcion' => 'min:5|max:50'
			);

			$campos = array(
				'nombre' => $nombre,
				'descripcion' => $descripcion
			);

			$mensajes = array(
				'required' => 'El campo :attribute es obligatorio',
				'min' => 'El campo :attribute no debe tener menos de :min caracteres',
				'max' => 'El campo :attribute no debe exceder los :max caracteres'
			);

			$validacion = Validator::make($campos, $reglas, $mensajes);

			if($validacion->fails()){
				return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages->all()));
			}
			else{
				$nuevo_objeto = new Agrupacion;

				$nuevo_objeto->nombre = $nombre;
				$nuevo_objeto->descripcion = $descripcion;

				$nuevo_objeto->save();

				return Response::json(array('resultado' => true, 'mensajes' => 'Nuevo Objeto creado con exito.'));
			}
		}
	}

?>