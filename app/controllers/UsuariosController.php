<?php

class UsuariosController extends Controller {
	
	public function __construct(){
        //$this->beforeFilter('APICheckGuest', array('except' => ''));
	}

	public function getTodosUsuarios(){
		$usuarios = Usuario::all();

		return Response::json($usuarios);
	}
	
	public function getVerUsuario($id){
		$usuario = Usuario::find($id);

		if($usuario){
			return Response::json(array(
				'resultado'=>true, 
				'datos'=>$usuario
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
			$nuevo_usuario->cod_permiso = $permisos;

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


