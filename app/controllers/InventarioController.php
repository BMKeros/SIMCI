<?php 	 
	class InventarioController extends controller{
		
		public function __construct(){
        	//$this->beforeFilter('APICheckPermisos');
		}
		
		public function postRegistrarElemento(){

			$cod_dimension = Input::get('cod_dimension');
			$cod_sub_dimension = Input::get('cod_sub_dimension');
			$cod_agrupacion = Input::get('cod_agrupacion');
			$cod_sub_agrupacion = Input::get('cod_sub_agrupacion');
			$cod_objeto = Input::get('cod_objeto');
			$numero_orden = Input::get('numero_orden');
			$cantidad_disponible = Input::get('cantidad_disponible');
			$usa_recipientes = Input::get('usa_recipientes');
			$recipientes_disponibles = Input::get('recipientes_disponibles');
			$elemento_movible = Input::get('elemento_movible');

			$reglas = array(
				'cod_dimension' => 'required|alpha_num|exists:almacenes,codigo',
				'cod_sub_dimension' =>'required|alpha_num|exists:sub_dimensiones,codigo',
				'cod_agrupacion' => 'required|alpha_num|exists:agrupaciones,codigo',
				'cod_sub_agrupacion' => 'alpha_num|exists:sub_agrupaciones,codigo',
				'numero_orden' => 'required|numeric',
				'cod_objeto' => 'required|numeric|exists:catalogo_objetos,id|unique:inventario',
				'cantidad_disponible' => 'required|numeric',
				'usa_recipientes' => 'required|boolean',
				'recipientes_disponibles' => 'numeric',
				'elemento_movible' => 'required|boolean'
			);

			$campos = array(
				'cod_dimension' => $cod_dimension,
				'cod_sub_dimension' => $cod_sub_dimension,
				'cod_agrupacion' => $cod_agrupacion,
				'cod_sub_agrupacion' => $cod_sub_agrupacion,
				'numero_orden' => $numero_orden,
				'cod_objeto' => $cod_objeto,
				'cantidad_disponible' => $cantidad_disponible,
				'usa_recipientes' => $usa_recipientes,
				'recipientes_disponibles' => $recipientes_disponibles,
				'elemento_movible' => $elemento_movible
			);

			$mensajes = array(
				'required' => 'El campo :attribute es necesario',
				'alpha_num' => 'El campo :attribute debe contener caracteres alfanumericos',
				'unique' => 'El campo :attribute debe ser unico',
				'integer' => 'El campo :attribute debe ser numerico',
				'boolean' => 'El campo :attribute debe ser una eleccion logita Ej:(true o false)',
				':attribute no existe',
				'numeric' => 'El :attribute debe ser solo numeros',
				'exists' => ':attribute no existe!'
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
				$nuevo_elemento->usa_recipientes = $usa_recipientes;
				$nuevo_elemento->recipientes_disponibles = $recipientes_disponibles;
				$nuevo_elemento->elemento_movible = $elemento_movible;

				$nuevo_elemento->save();

				return Response::json(array(
					'resultado' => true,
					'mensajes' => array('Nuevo Elemento creado con exito.',
					//pendiente colocar o no del id de los objetos que se crean
					))
				);
			}
		}

		public function postActualizarElemento($id){

			$elemento = ElementoInventario::find($id);

			if($elemento){
				$cod_dimension = input_default(Input::get('cod_dimension'), $elemento->cod_dimension);
				$cod_sub_dimension = input_default(Input::get('cod_sub_dimension'), $elemento->cod_subdimension);
				$cod_agrupacion = input_default(Input::get('cod_agrupacion'), $elemento->cod_agrupacion);
				//$cod_sub_agrupacion = input_default(Input::get('cod_sub_agrupacion'), $elemento->cod_subagrupacion);
				$numero_orden = input_default(Input::get('numero_orden'), $elemento->numero_orden);
				$cod_objeto = input_default(Input::get('cod_objeto'), $elemento->cod_objeto);
				$cantidad_disponible = input_default(Input::get('cantidad_disponible'), $elemento->cantidad_disponible);
				$usa_recipientes = input_default(Input::get('usa_recipientes'), $elemento->usa_recipientes);
				$recipientes_disponibles = input_default(Input::get('recipientes_disponibles'), $elemento->recipientes_disponibles);

				$reglas = array(
					'cod_dimension' => 'required|exists:almacenes,cod_almacen',
					'cod_sub_dimension' =>'required|exists:estantes,cod_estante',
					'cod_agrupacion' => 'required|exists:tipo_objetos,id',
					//'cod_sub_agrupacion' => 'exists:inventario,cod_subagrupacion',
					'numero_orden' => 'required',
					//pendiente evaluar si cod_objeto sera unique
					'cod_objeto' => 'required|exists:catalogo_objetos,id',
					'cantidad_disponible' => 'required',
					//campos aun no se sabe si se dejaran o se quitaran
					'usa_recipientes' => 'required|boolean',
					'recipientes_disponibles' => 'numeric'
				);

				$campos = array(
					'cod_dimension' => $cod_dimension,
					'cod_sub_dimension' => $cod_sub_dimension,
					'cod_agrupacion' => $cod_agrupacion,
					//'cod_sub_agrupacion' => $cod_sub_agrupacion,
					'numero_orden' => $numero_orden,
					'cod_objeto' => $cod_objeto,
					'cantidad_disponible' => $cantidad_disponible,
					'usa_recipientes' => $usa_recipientes,
					'recipientes_disponibles' => $recipientes_disponibles
				);

				$mensajes = array(
					'required' => 'El campo :attribute es necesario',
					'integer' => 'El campo :attribute debe ser numerico',
					'boolean' => 'El campo :attribute debe ser una eleccion logita Ej:(true o false)',
					':attribute no existe',
					'numeric' => 'El :attribute debe ser solo numeros',
					'exists' => ':attribute no existe!'
				);

				$validacion = Validator::make($campos, $reglas, $mensajes);

				if($validacion->fails()){
					return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
				}
				else{
					
					$elemento->cod_dimension = $cod_dimension;
					$elemento->cod_subdimension = $cod_sub_dimension;
					$elemento->cod_agrupacion = $cod_agrupacion;
					//elemento->cod_subagrupacion = $cod_sub_agrupacion;
					$elemento->numero_orden = $numero_orden;
					$elemento->cod_objeto = $cod_objeto;
					$elemento->cantidad_disponible = $cantidad_disponible;
					$elemento->usa_recipientes = $usa_recipientes;
					$elemento->recipientes_disponibles = $recipientes_disponibles;

					$elemento->save();

					return Response::json(array(
						'resultado' => true,
						'mensajes' => 'Elemento Actualizado con exito.'
						)
					);
				}
			}
			else{
				return Response::json(array('resultado' => false, 'mensajes' => 'ID no existe'));
			}
		}

		public function postEliminarElemento($id){
		
			$elemento = ElementoInventario::find($id);

			if($elemento){
				$elemento->delete();
				return Response::json(array('resultado' => true, 'mensajes' => 'Elemento eliminado con exito'));
			}
			else{
				return Response::json(array('resultado' => false, 'mensajes' => 'ID no existe'));	
			}
		}

		public function postRegistrarAlmacen(){
			$responsable = Input::get('responsable');
			$primer_auxiliar = Input::get('primer_auxiliar');
			$segundo_auxiliar = Input::get('segundo_auxiliar');
			$descripcion = Input::get('descripcion');

			$reglas = array(
				'responsable' => 'required|integer|exists:personas,id',
				//pendientes por modificar si seran o no unicos
				'primer_auxiliar' => 'required|integer|exists:personas,id',
				'segundo_auxiliar' => 'required|integer|exists:personas,id',
				'descripcion' => 'required|min:3|max:150'
			);

			$campos = array(
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
				'max' => 'El campo :attribute no debe exceder los :max caracteres',
				'exists' => ':attribute no existe'
			);

			$validacion = Validator::make($campos, $reglas, $mensajes);

			if($validacion->fails()){
				return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
			}
			else{
				$nuevo_almacen = new Almacen;

				$num_almacen = DB::table('almacenes')->count();

				$nuevo_almacen->codigo = crear_codigo($num_almacen,"ALMACEN");
				$nuevo_almacen->responsable = $responsable;
				$nuevo_almacen->primer_auxiliar = $primer_auxiliar;
				$nuevo_almacen->segundo_auxiliar = $segundo_auxiliar;
				$nuevo_almacen->descripcion = $descripcion;

				$nuevo_almacen->save();

				return Response::json(array('resultado' => true, 'mensajes' => array('Nuevo Almacen creado con exito.')));
			}
		}

		public function postRegistrarSubDimension(){
			
			$codigo = Input::get('codigo');
			$descripcion = Input::get('descripcion');

			$reglas = array(
				'codigo' => 'required|unique:sub_dimensiones|min:2|max:3',
				'descripcion' => 'required|min:2|max:50'
			);

			$campos = array(
				'codigo' => $codigo,
				'descripcion' => $descripcion
			);

			$mensajes = array(
				'required' => 'El campo :attribute es obligatorio',
				'unique' => 'El campo :attribute ya existe, intente con otro',
				'min' => 'El campo :attribute no debe tener menos de :min caracteres',
				'max' => 'El campo :attribute no debe exceder los :max caracteres'
			);

			$validacion = Validator::make($campos, $reglas, $mensajes);

			if($validacion->fails()){
				return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
			}
			else{
				$nuevo_estantes = new SubDimension;

				$nuevo_estantes->codigo = $codigo;
				$nuevo_estantes->descripcion = $descripcion;

				$nuevo_estantes->save();

				return Response::json(array('resultado' => true, 'mensajes' => array('Nueva Sub Dimension creado con exito.')));
			}
		}

		public function postRegistrarAgrupacion(){
			$codigo = Input::get('codigo');
			$nombre = Input::get('nombre');
			$descripcion = Input::get('descripcion');

			$reglas = array(
				'codigo' => 'required|unique:agrupaciones|min:1|max:3',
				'nombre' => 'required|min:5|max:50',
				'descripcion' => 'min:5|max:50'
			);

			$campos = array(
				'codigo' => $codigo,
				'nombre' => $nombre,
				'descripcion' => $descripcion
			);

			$mensajes = array(
				'unique' => 'El campo :attribute ya existe, intente con otro',
				'required' => 'El campo :attribute es obligatorio',
				'min' => 'El campo :attribute no debe tener menos de :min caracteres',
				'max' => 'El campo :attribute no debe exceder los :max caracteres'
			);

			$validacion = Validator::make($campos, $reglas, $mensajes);

			if($validacion->fails()){
				return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
			}
			else{
				$agrupacion = new Agrupacion;

				$agrupacion->codigo = $codigo;
				$agrupacion->nombre = $nombre;
				$agrupacion->descripcion = $descripcion;

				$agrupacion->save();

				return Response::json(array('resultado' => true, 'mensajes' => array('Nueva agrupacion creado con exito.')));
			}
		}

		public function postRegistrarSubAgrupacion(){
			$codigo = Input::get('codigo');
			$nombre = Input::get('nombre');
			$descripcion = Input::get('descripcion');

			$reglas = array(
				'codigo' => 'required|unique:sub_agrupaciones|min:1|max:3',
				'nombre' => 'required|min:5|max:50',
				'descripcion' => 'min:5|max:50'
			);

			$campos = array(
				'codigo' => $codigo,
				'nombre' => $nombre,
				'descripcion' => $descripcion
			);

			$mensajes = array(
				'unique' => 'El campo :attribute ya existe, intente con otro',
				'required' => 'El campo :attribute es obligatorio',
				'min' => 'El campo :attribute no debe tener menos de :min caracteres',
				'max' => 'El campo :attribute no debe exceder los :max caracteres'
			);

			$validacion = Validator::make($campos, $reglas, $mensajes);

			if($validacion->fails()){
				return Response::json(array('resultado' => false, 'mensajes' => $validacion->messages()->all()));
			}
			else{
				$sub_agrupacion = new SubAgrupacion;

				$sub_agrupacion->codigo = $codigo;
				$sub_agrupacion->nombre = $nombre;
				$sub_agrupacion->descripcion = $descripcion;

				$sub_agrupacion->save();

				return Response::json(array('resultado' => true, 'mensajes' => array('Nueva sub-agrupacion creado con exito.')));
			}
		}
	}

?>