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

	public function postActualizarUsuario($id){

		$usuario = Usuario::find($id);

		$usuario->usuario = Input::get('');
		$usuario->email = Input::get('');
		$usuario->password = Input::get('');
		$usuario->permiso_id = Input::get('');
		$usuario->tipo_id = Input::get('');
		$usuario->activo = Input::get('') ;
		
		if($usuario->save()){
			return View::make('/')->with('registro con exito');
		}
		else{
			return View::make('/')->with('mensaje', 'error registro no exitoso');
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
					'mensajes'=> $e->getMessage()
				));
			}

			
			DB::commit();

			return Response::json(array(
				'resultado'=>true, 
				'mensajes'=>'Usuario creado con exito',
				'datos'=>array('usuario_creado'=>$nuevo_usuario->id)
				)
			);
		}

	}

	public function postEliminarUsuario($id){
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
}


