<?php 
class ProveedoresController extends Controller{

	public function getMostrar(){
		$tipo_busqueda = Input::get('type', 'todos');
		$id_proveedor = Input::get('codigo', null);
		$orden = Input::get('ordenar','desc');

		switch($tipo_busqueda){
			case 'todos':
				if($orden){
					//le falta aun los campos que traera la consulta
					$response = DB::table('proveedores')->orderBy($orden)->get();
				}
				else{
					$response = DB::table('proveedores')->get();
				}
			break;

			case 'full':
				if(!empty($id_proveedor)){
					$response = DB::table('proveedores')
						->select('codigo', 'razon_social', 'doc_identificacion', 'telefono_fijo1', 'telefono_fijo2',
								'telefono_movil1', 'telefono_movil2', 'email', 'direccion', 'cod_estado', 'estado','cod_ciudad',
								'ciudad', 'cod_municipio', 'municipio', 'cod_parroquia', 'parroquia')
						->join('estados', 'estados.id_estado', '=', 'cod_estado')
						->join('ciudades', 'ciudades.id_ciudad', '=', 'cod_ciudad')
						->join('municipios', 'municipios.id_municipio', '=', 'cod_municipio')
						->join('parroquias', 'parroquias.id_parroquia', '=', 'cod_parroquia')
						->where('codigo', '=', $id_proveedor)
						->first();
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
					
					$data = DB::table('proveedores')
						->select('codigo', 'razon_social', 'doc_identificacion', 'email', 'telefono_fijo1', 'telefono_movil1')
						->orderBy('codigo')
						->paginate($length);
				}
				else{
					$data = DB::table('proveedores')
						->select('codigo', 'razon_social', 'doc_identificacion', 'email')
						->where('razon_social', 'ILIKE', '%'.$value_search['value'].'%')
						->orderBy('codigo')
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

			default:
				$response = DB::table('proveedores')->get();
			break;

		}

		return Response::json($response);
	}


	public function postRegistrarProveedor(){
		$razon_social = Input::get('razon_social');
		$doc_identificacion = Input::get('doc_identificacion');
		$telefono_fijo1 = Input::get('telefono_fijo1');
		$telefono_fijo2 = Input::get('telefono_fijo2');
		$telefono_movil1 = Input::get('telefono_movil1');
		$telefono_movil2 = Input::get('telefono_movil2');
		$email = Input::get('email');
		$direccion = Input::get('direccion');
		$cod_estado = Input::get('cod_estado');
		$cod_ciudad = Input::get('cod_ciudad');
		$cod_municipio = Input::get('cod_municipio');
		$cod_parroquia = Input::get('cod_parroquia');

		$reglas = array(
			'razon_social' => 'required|min:3|max:150',
			'doc_identificacion' => 'required|min:3|max:11|unique:proveedores|alpha_num',
			//pendiente por evaluar si los numeros de tlf seran unicos
			'telefono_fijo1' => 'required|min:7|max:15',
			'telefono_fijo2' => 'min:7|max:15',
			'telefono_movil1' => 'required|min:7|max:15',
			'telefono_movil2' => 'min:7|max:15',
			'email' => 'required|email|max:100|unique:proveedores',
			'direccion' => 'required|min:5|max:200',
			'cod_estado' => 'required|numeric|exists:estados,id_estado',
			'cod_ciudad' => 'required|numeric|exists:ciudades,id_ciudad',
			'cod_municipio' => 'required|numeric|exists:municipios,id_municipio',
			'cod_parroquia' => 'required|numeric|exists:parroquias,id_parroquia'
		);

		$campos = array(
			'razon_social' => $razon_social,
			'doc_identificacion' => $doc_identificacion,
			//pendiente por evaluar si los numeros de tlf seran unicos
			'telefono_fijo1' => $telefono_fijo1,
			'telefono_fijo2' => $telefono_fijo2,
			'telefono_movil1' => $telefono_movil1,
			'telefono_movil2' => $telefono_movil2,
			'email' => $email,
			'direccion' => $direccion,
			'cod_estado' => $cod_estado,
			'cod_ciudad' => $cod_ciudad,
			'cod_municipio' => $cod_municipio,
			'cod_parroquia' => $cod_parroquia,

		);

		$mensajes = array(
			'required' => ':attribute no puede estar en blanco',
			'max' => ':attribute debe tener un maximo de :max caracteres',
            'min' => ':attribute debe tener un minimo de :min caracteres',
            'unique' => ':attribute ya existe',
            'email' => 'El :attribute debe ser un email valido',
            'numeric' => 'El :attribute debe ser solo numeros',
            'alpha_num' => ':attribute de contener caracteres alfanumericos',
         	'exists' => ':attribute no existe'
		);

		 $validacion = Validator::make($campos,$reglas,$mensajes);
        
    	if($validacion->fails()){
    		return Response::json(array('resultado'=>false, 'mensajes'=>$validacion->messages()->all()));
    	}
		else{

			$num_proveedores = DB::table('proveedores')->max('secuencia');
			
			$proveedor = new Proveedor;

			$proveedor->codigo = crear_codigo($num_proveedores, "PROVEEDOR");
			$proveedor->razon_social = $razon_social;
			$proveedor->doc_identificacion = $doc_identificacion;
			$proveedor->telefono_fijo1 = $telefono_fijo1;
			$proveedor->telefono_fijo2 = $telefono_fijo2;
			$proveedor->telefono_movil1 = $telefono_movil1;
			$proveedor->telefono_movil2 = $telefono_movil2;
			$proveedor->email = $email;
			$proveedor->direccion = $direccion;
			$proveedor->cod_estado = $cod_estado;
			$proveedor->cod_ciudad = $cod_ciudad;
			$proveedor->cod_municipio = $cod_municipio;
			$proveedor->cod_parroquia = $cod_parroquia;

			$proveedor->save();

			return Response::json(array(
				'resultado'=>true, 
				'mensajes'=>array('Proveedor registrados con exito.!'))
			);
		}
	}

	public function postActualizarProveedor(){
		$id = Input::get('id');

		$proveedor = Proveedor::find($id);

		if(!is_null($proveedor)){

			$codigo = input_default(Input::get('codigo'), $proveedor->codigo);
			$razon_social = input_default(Input::get('razon_social'), $proveedor->razon_social);
			$doc_identificacion = input_default(Input::get('doc_identificacion'), $proveedor->doc_identificacion);
			$telefono_fijo1 = input_default(Input::get('telefono_fijo1'), $proveedor->telefono_fijo1);
			$telefono_fijo2 = input_default(Input::get('telefono_fijo2'), $proveedor->telefono_fijo2);
			$telefono_movil1 = input_default(Input::get('telefono_movil1'), $proveedor->telefono_movil1);
			$telefono_movil2 = input_default(Input::get('telefono_movil2'), $proveedor->telefono_movil2);
			$email = input_default(Input::get('email'), $proveedor->email);
			$direccion = input_default(Input::get('direccion'), $proveedor->direccion);
			$cod_estado = input_default(Input::get('cod_estado'), $proveedor->cod_estado);
			$cod_ciudad = input_default(Input::get('cod_ciudad'), $proveedor->cod_ciudad);
			$cod_municipio = input_default(Input::get('cod_municipio'), $proveedor->cod_municipio);
			$cod_parroquia = input_default(Input::get('cod_parroquia'), $proveedor->cod_parroquia);

			$reglas = array(
				'codigo' => 'required|min:2|max:5|unique:proveedores',
				'razon_social' => 'required|min:3|max:150',
				'doc_identificacion' => 'required|min:3|max:11|unique:proveedores|alpha_num',
				//pendiente por evaluar si los numeros de tlf seran unicos
				'telefono_fijo1' => 'required|min:7|max:15',
				'telefono_fijo2' => 'required|min:7|max:15',
				'telefono_movil1' => 'required|min:7|max:15',
				'telefono_movil2' => 'required|min:7|max:15',
				'email' => 'required|email|max:100|unique:proveedores',
				'direccion' => 'required|min:5|max:200',
				'cod_estado' => 'required|numeric|exists:estados,id_estado',
				'cod_ciudad' => 'required|numeric|exists:ciudades,id_ciudad',
				'cod_municipio' => 'required|numeric|exists:municipios,id_municipio',
				'cod_parroquia' => 'required|numeric|exists:parroquias,id_parroquia'
			);

			$campos = array(
				'codigo' => $codigo,
				'razon_social' => $razon_social,
				'doc_identificacion' => $doc_identificacion,
				//pendiente por evaluar si los numeros de tlf seran unicos
				'telefono_fijo1' => $telefono_fijo1,
				'telefono_fijo2' => $telefono_fijo2,
				'telefono_movil1' => $telefono_movil1,
				'telefono_movil2' => $telefono_movil2,
				'email' => $email,
				'direccion' => $direccion,
				'cod_estado' => $cod_estado,
				'cod_ciudad' => $cod_ciudad,
				'cod_municipio' => $cod_municipio,
				'cod_parroquia' => $cod_parroquia,

			);

			$mensajes = array(
				'required' => ':attribute no puede estar en blanco',
				'max' => ':attribute debe tener un maximo de :max caracteres',
	            'min' => ':attribute debe tener un minimo de :min caracteres',
	            'unique' => ':attribute ya existe',
	            'email' => 'El :attribute debe ser un email valido',
	            'numeric' => 'El :attribute debe ser solo numeros',
	            'alpha_num' => ':attribute de contener caracteres alfanumericos',
	         	'exists' => ':attribute no existe'
			);

			 $validacion = Validator::make($campos,$reglas,$mensajes);
	        
	    	if($validacion->fails()){
	    		return Response::json(array('resultado'=>false, 'mensajes'=>$validacion->messages()->all()));
	    	}
			else{
				
				$proveedor->codigo = $codigo;
				$proveedor->razon_social = $razon_social;
				$proveedor->doc_identificacion = $doc_identificacion;
				$proveedor->telefono_fijo1 = $telefono_fijo1;
				$proveedor->telefono_fijo2 = $telefono_fijo2;
				$proveedor->telefono_movil1 = $telefono_movil1;
				$proveedor->telefono_movil2 = $telefono_movil2;
				$proveedor->email = $email;
				$proveedor->direccion = $direccion;
				$proveedor->cod_estado = $cod_estado;
				$proveedor->cod_ciudad = $cod_ciudad;
				$proveedor->cod_municipio = $cod_municipio;
				$proveedor->cod_parroquia = $cod_parroquia;

				$proveedor->save();

				return Response::json(array(
					'resultado'=>true, 
					'mensajes'=>array('Proveedor registrados con exito.!'))
				);
			}
		}
		else{
			return Response::json(array('resultado' => false, 'mensajes' => array('Proveedor no encontrado')));
		}
	}

	public function postEliminar(){
		$id_proveedor = Input::get('id');

		$proveedor = Proveedor::find($id_proveedor);

		if(!is_null($proveedor)){
			$proveedor->delete();
			return Response::json(array('resultado' => true, 'mensajes' => array('Proveedor eliminado con exito')));
		}
		else{
			return Response::json(array('resultado' => false, 'mensajes' => array('Proveedor no encontrado')));
		}
	}
	
}

?>