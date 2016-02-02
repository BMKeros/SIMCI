<?php

class UsuariosController extends Controller {
	
	public function __construct(){
        //$this->beforeFilter('APICheckGuest', array('except' => ''));
	}

	public function getMostrar(){
		$tipo_busqueda = Input::get('type', 'todos');
		$id_usuario = Input::get('id', null);
		$orden = Input::get('ordenar','asc');

		switch($tipo_busqueda){
			case 'todos':
				if($orden){
					$response = Usuario::orderBy('id', $orden)->get();
				}
				else{
					$response = Usuario::all();	
				}
			break;

			case 'usuario':
				if($id_usuario){
					$response = Usuario::find($id_usuario);

					if(is_null($response)){
						$response = array();
					}
				}
				else{
					$response = array();
				}
			break;

			case 'usuario_full':
				if($id_usuario){
					$data = Usuario::find($id_usuario);

					if(is_null($data)){
						$response = array();
					}
					else{
						$response = array('usuario'=>$data, 'persona'=>$data->persona);
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
					$data = Usuario::paginate($length);	
				}
				else{

					$data = Usuario::where('usuario','ILIKE','%'.$value_search['value'].'%')->paginate($length);	
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
				$response = Usuario::all();
			break;

		}

		return Response::json($response);
	}
	
	public function postCrearUsuario(){

		$usuario = Input::get('usuario');
		$email = Input::get('email');
		$password = Input::get('password');
		$tipo_usuario = Input::get('tipo_usuario');
		$permisos = Input::get('permisos');
		$imagen = Input::file('imagen');
		$activo = Input::get('activo');

        $reglas = array(
            'usuario' =>'required|max:15|min:5|unique:usuarios|alpha_num' ,
            'email' =>'required|email|max:50|unique:usuarios' ,
            'password' => 'required|min:5',
            'tipo_usuario'=> 'required|exists:tipos_usuario,codigo',
            'permisos' => 'required|exists:permisos,codigo',
            'imagen' => 'mimes:jpeg,bmp,png',
            'activo' => 'boolean'
        );

        $campos = array(
        	'usuario'=>$usuario,
            'email'=>$email,
            'password'=>$password,
            'tipo_usuario'=> $tipo_usuario,
            'permisos' => $permisos,
            'imagen' => $imagen,
            'activo' => $activo
        );

        $mensajes = array(
            'unique' => ':attribute ya existe',
            'required' => ':attribute no puede estar en blanco',
            'exists' => ':attribute no existe',
            'max' => ':attribute debe tener un maximo de :max caracteres',
            'min' => ':attribute debe tener un minimo de :min caracteres',
            'mimes' => ':attribute extensiones validas [JPG, PNG, BMP]',
            'alpha_num' => ':attribute de contener caracteres alfanumericos'
        );

        $validacion = Validator::make($campos,$reglas,$mensajes);
        

		if($validacion->fails()){
			return Response::json(array('resultado'=>false, 'mensajes'=>$validacion->messages()->all()));
		}
		else{
	
			$nuevo_usuario = new Usuario;
			$nuevo_usuario->usuario = $usuario;
			$nuevo_usuario->email = $email;
			$nuevo_usuario->password = $password;
			$nuevo_usuario->cod_tipo_usuario = $tipo_usuario;
			$nuevo_usuario->permisos()->attach($permisos);

			if($imagen){
				$name_file = cargar_crear_imagen_usuario($imagen,$usuario);
				$nuevo_usuario->imagen = PATH_IMAGENES.$name_file; 
			}

			if($activo){ $nuevo_usuario->activo = $activo; }
			
			$nuevo_usuario->save();

			return Response::json(array(
				'resultado'=>true, 
				'mensajes'=>'Usuario creado con exito',
				'datos'=>array('usuario_creado'=>$nuevo_usuario->id)
				)
			);
		}
		
	}

	public function postCrearUsuarioCompleto(){

		DB::beginTransaction();

		//Datos del usuario
		$usuario = Input::get('usuario');
		$email = Input::get('email');
		$password = Input::get('password');
		$tipo_usuario = Input::get('tipo_usuario');
		$permisos = Input::get('permisos');
		$imagen = Input::file('imagen');
		$activo = Input::get('activo');

		//Datos personales
		$p_nombre = Input::get('primer_nombre');
		$s_nombre = Input::get('segundo_nombre');
		$p_apellido = Input::get('primer_apellido');
		$s_apellido = Input::get('segundo_apellido');
		$cedula = Input::get('cedula');
		$sexo = Input::get('sexo');
		$fecha_nacimiento = Input::get('fecha_nacimiento');

        $reglas = array(
            'usuario' =>'required|max:15|min:5|unique:usuarios|alpha_num' ,
            'email' =>'required|email|max:50|unique:usuarios' ,
            'password' => 'required|min:5',
            'tipo_usuario'=> 'required|exists:tipos_usuario,codigo',
            'permisos' => 'required|exists:permisos,codigo',
            'imagen' => 'mimes:jpeg,bmp,png',
            'activo' => 'boolean',
            
            //Reglas persona
            'cedula' =>'required|digits:8|unique:personas|numeric',
        	'fecha_nacimiento' => 'required|date_format:Y-m-d',
        	'primer_nombre' => 'required|alpha|max:15',
        	'primer_apellido' => 'required|alpha|max:15',
        	'segundo_nombre' => 'alpha|max:15',
        	'segundo_apellido' => 'alpha|max:15',
        	'sexo' => 'required|exists:sexos,id|numeric'
        );

        $campos = array(
        	'usuario'=>$usuario,
            'email'=>$email,
            'password'=>$password,
            'tipo_usuario'=> $tipo_usuario,
            'permisos' => $permisos,
            'imagen' => $imagen,
            'activo' => $activo,
            
            //Campos persona
            'cedula'=>$cedula,
        	'fecha_nacimiento' => $fecha_nacimiento,
        	'primer_nombre' => $p_nombre,
        	'primer_apellido' => $p_apellido,
        	'segundo_nombre' => $s_nombre,
        	'segundo_apellido' => $s_apellido,
        	'sexo' => $sexo
        );

        $mensajes = array(
            'unique' => ':attribute ya existe',
            'required' => ':attribute no puede estar en blanco',
            'exists' => ':attribute no existe',
            'max' => ':attribute debe tener un maximo de :max caracteres',
            'min' => ':attribute debe tener un minimo de :min caracteres',
            'mimes' => ':attribute extensiones validas [JPG, PNG, BMP]',
            'alpha_num' => ':attribute de contener caracteres alfanumericos',
        	'alpha' => ':attribute debe contener solo caracteres',
        	'date_format' => ':attribute debe tener este formato YY-MM-DD',
        	'numeric' => ':attribute debe tener solo numeros',
        	'digits' => ':attribute debe tener solo :digits digitos',
        );

        $validacion = Validator::make($campos,$reglas,$mensajes);
        

		if($validacion->fails()){
			return Response::json(array('resultado'=>false, 'mensajes'=>$validacion->messages()->all()));
		}
		else{
	
			try{

				$datos = array(
					'usuario' => $usuario,
					'email' => $email,
					'password' => $password,
					'cod_tipo_usuario' => $tipo_usuario,
					//'cod_permiso' => $permisos,
				);

				if($imagen){
					$datos['imagen'] = PATH_IMAGENES.cargar_crear_imagen_usuario($imagen,$usuario);
				}
				if($activo){
					$datos['activo'] = $activo;
				}

				$nuevo_usuario = Usuario::create($datos);

				$nuevo_usuario->permisos()->attach($permisos);

				Persona::create(array(
					'primer_nombre' => $p_nombre,
					'primer_apellido' => $p_apellido,
					'segundo_nombre' => $s_nombre,
					'segundo_apellido' => $s_apellido,
					'cedula' => $cedula,
					'sexo_id' => $sexo,
					'fecha_nacimiento' => $fecha_nacimiento,
					'usuario_id' => $nuevo_usuario->id
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
				'mensajes'=>array('Usuario creado con exito'),
				'datos'=>array('usuario_creado'=>$nuevo_usuario->id)
				)
			);
		}
	}


	public function postActualizarUsuarioCompleto(){
		$id = Input::get('id');

		$usuario = Usuario::find($id);
		
		if(!is_null($usuario)){
			//Datos del usuario
			$usuario = input_default(Input::get('usuario'));
			$email = input_default(Input::get('email'));
			$password = input_default(Input::get('password'));
			$tipo_usuario = input_default(Input::get('tipo_usuario'));
			$permisos = input_default(Input::get('permisos'));
			$imagen = Input::file('imagen');
			$activo = input_default(Input::get('activo'));

			//Datos personales
			$p_nombre = input_default(Input::get('primer_nombre'));
			$s_nombre = input_default(Input::get('segundo_nombre'));
			$p_apellido = input_default(Input::get('primer_apellido'));
			$s_apellido = input_default(Input::get('segundo_apellido'));
			$cedula = input_default(Input::get('cedula'));
			$sexo = input_default(Input::get('sexo'));
			$fecha_nacimiento = input_default(Input::get('fecha_nacimiento'));

	        $reglas = array(
	            'usuario' =>'required|max:15|min:5|alpha_num' ,
	            'email' =>'required|email|max:50' ,
	            'password' => 'required|min:5',
	            'tipo_usuario'=> 'required|exists:tipos_usuario,codigo',
	            'permisos' => 'required|exists:permisos,codigo',
	            'imagen' => 'mimes:jpeg,bmp,png',
	            'activo' => 'boolean',
	            
	            //Reglas persona
	            'cedula' =>'required|digits:8|unique:personas|numeric',
	        	'fecha_nacimiento' => 'required|date_format:Y-m-d',
	        	'primer_nombre' => 'required|alpha|max:15',
	        	'primer_apellido' => 'required|alpha|max:15',
	        	'segundo_nombre' => 'alpha|max:15',
	        	'segundo_apellido' => 'alpha|max:15',
	        	'sexo' => 'required|exists:sexos,id|numeric'
	        );

	        $campos = array(
	        	'usuario'=>$usuario,
	            'email'=>$email,
	            'password'=>$password,
	            'tipo_usuario'=> $tipo_usuario,
	            'permisos' => $permisos,
	            'imagen' => $imagen,
	            'activo' => $activo,
	            
	            //Campos persona
	            'cedula'=>$cedula,
	        	'fecha_nacimiento' => $fecha_nacimiento,
	        	'primer_nombre' => $p_nombre,
	        	'primer_apellido' => $p_apellido,
	        	'segundo_nombre' => $s_nombre,
	        	'segundo_apellido' => $s_apellido,
	        	'sexo' => $sexo
	        );

	        $mensajes = array(
	            'unique' => ':attribute ya existe',
	            'required' => ':attribute no puede estar en blanco',
	            'exists' => ':attribute no existe',
	            'max' => ':attribute debe tener un maximo de :max caracteres',
	            'min' => ':attribute debe tener un minimo de :min caracteres',
	            'mimes' => ':attribute extensiones validas [JPG, PNG, BMP]',
	            'alpha_num' => ':attribute de contener caracteres alfanumericos',
	        	'alpha' => ':attribute debe contener solo caracteres',
	        	'date_format' => ':attribute debe tener este formato YY-MM-DD',
	        	'numeric' => ':attribute debe tener solo numeros',
	        	'digits' => ':attribute debe tener solo :digits digitos',
	        );

	        $validacion = Validator::make($campos,$reglas,$mensajes);
	        

			if($validacion->fails()){
				return Response::json(array('resultado'=>false, 'mensajes'=>$validacion->messages()->all()));
			}
			else{

				$usuario->usuario = $usuario;
				$usuario->email = $email;
				$usuario->password = $password;
				$usuario->cod_tipo_usuario = $tipo_usuario;

				if($imagen){
					$usuario->imagen  = PATH_IMAGENES.cargar_crear_imagen_usuario($imagen,$usuario->usuario);
				}
				if($activo){
					$usuario->activo = $activo;
				}

				/*$nuevo_usuario->permisos()->attach($permisos);


				$persona = $usuario->persona();

				$persona->primer_nombre = $p_nombre;
				$persona->primer_apellido = $p_apellido;
				$persona->segundo_nombre = $s_nombre;
				$persona->segundo_apellido = $s_apellido;
				$persona->cedula = $cedula;
				$persona->sexo_id = $sexo;
				$persona->fecha_nacimiento = $fecha_nacimiento;

				$usuario->persona()->associate($persona);**/

				$usuario->save();
				
			}

		}else{
			return Response::json(array(
				'resultado'=>false, 
				'mensajes'=>array('Usuario no existe')
				)
			);
		}
	}


	public function postEliminar(){
		$id = Input::get('id');
		
		$usuario = Usuario::find($id);

		if($usuario){
			$usuario->delete();	
			return Response::json(array(
				'resultado'=>true, 
				'mensajes'=>array('Usuario eliminado con exito')
				)
			);
		}
		else{
			return Response::json(array(
				'resultado'=>false, 
				'mensajes'=>array('Usuario no existe')
				)
			);
		}
	}

	public function postRegistrarPermiso(){
		$nombre = Input::get('nombre');
		$descripcion = Input::get('descripcion');

		$reglas = array(
        	'codigo' =>'required|min:2|max:4|alpha_num',
            'nombre' =>'required|min:5|max:15|unique:permisos',
            'descripcion' => 'required|min:5|max:150'
        );

	    $campos = array(
	        'nombre'=>$nombre,
	        'descripcion'=>$descripcion
	    );

        $mensajes = array(
            'unique' => ':attribute ya existe',
            'required' => ':attribute no puede estar en blanco',
            'max' => ':attribute debe tener un maximo de :max caracteres',
            'min' => ':attribute debe tener un minimo de :min caracteres',
            'alpha_num' => ':attribute de contener caracteres alfanumericos',
        );

        $validacion = Validator::make($campos, $reglas, $mensajes);

        if($validacion->fails()){
        	return Response::json(array('resultado'=>false, 'mensajes'=>$validacion->messages()->all()));
        }
        else{
        	$nuevo_permiso = new Permiso;

        	$num_perimso = DB::table('permisos')->count();

        	//comentado porque al codigo se le igualara a una funcion ya esta probada y funciona (y)
        	$nuevo_permiso->codigo = crear_codigo_permiso($num_perimso);
        	$nuevo_permiso->nombre = $nombre;
        	$nuevo_permiso->descripcion = $descripcion;

        	$nuevo_permiso->save();

        	return Response::json(array('resultado' => true, 'mensajes' => 'Permiso creado con exito.'));
        }

	}

	public function postRegistrarTipoUsuario(){
		
		$descripcion = Input::get('descripcion');

		$reglas = array(
            'descripcion' => 'required|min:5|max:150'
        );

	    $campos = array(
	        'descripcion'=>$descripcion
	    );

        $mensajes = array(
            'required' => ':attribute no puede estar en blanco',
            'max' => ':attribute debe tener un maximo de :max caracteres',
            'min' => ':attribute debe tener un minimo de :min caracteres'
        );

        $validacion = Validator::make($campos, $reglas, $mensajes);

        if($validacion->fails()){
        	return Response::json(array('resultado'=>false, 'mensajes'=>$validacion->messages()->all()));
        }
        else{
        	$nuevo_TipoUsuario = new TiposUsuario;

        	$num_tipo_usuario = DB::table('tipos_usuario')->count();

        	//comentado porque al codigo se le igualara a una funcion ya esta probada y funciona (y)
        	$nuevo_TipoUsuario->codigo = crear_codigo_tipo_usuario($num_tipo_usuario);
        	$nuevo_TipoUsuario->descripcion = $descripcion;

        	$nuevo_TipoUsuario->save();

        	return Response::json(array('resultado' => true, 'mensajes' => 'Tipo de Usuario creado con exito.'));
        }


	}	
}


