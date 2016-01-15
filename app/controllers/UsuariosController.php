<?php

class UsuariosController extends Controller {
	
	public function __construct(){
        //$this->beforeFilter('CheckGuest', array('except' => ''));
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

	public function postNuevoUsuario(){

		$usuario = Input::get('usuario');
		$email = Input::get('email');
		$password = Input::get('password');
		$tipo_usuario = Input::get('tipo_usuario');
		$permisos = Input::get('permisos');

        $reglas = array(
            'usuario' =>'required|unique:usuarios' ,
            'email' =>'required|email|unique:usuarios' ,
            'password' => 'required|min:5',
            'tipo_usuario'=> 'required|exists:tipos_usuario,codigo',
            'permisos' => 'required|exists:permisos,codigo'
        );

        $campos = array(
        	'usuario'=>$usuario,
            'email'=>$email,
            'password'=>$password,
            'tipo_usuario'=> $tipo_usuario,
            'permisos' => $permisos
        );

        $mensajes = array(
            'unique' => 'Este :attribute ya existe',
            'required' => ':attribute no puede estar en blanco',
            'exists' => 'Este :attribute no existe'
        );

        $validacion = Validator::make($campos,$reglas,$mensajes);
        

		if($validacion->fails()){
			return Response::json(array('resultado'=>false, 'mensajes'=>$validacion->messages()));
		}
		else{
	
			$nuevo_usuario = new Usuario;
			$nuevo_usuario->usuario = $usuario;
			$nuevo_usuario->email = $email;
			$nuevo_usuario->password = $password;
			$nuevo_usuario->cod_tipo_usuario = $tipo_usuario;
			$nuevo_usuario->cod_permiso = $permisos;

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


