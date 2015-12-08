<?php

class UsuariosController extends Controller {
	
	//tentativo una funcion que muestre todos los usuarios registrados
	
	public function getLogin(){
		return View::make('usuarios.formulario_login');
	}

	public function postLogin(){
		
		$logindata = array(
			'usuario' => Input::get('usuario'),	
			'password' => Input::get('password')
		);

		if(Auth::attempt($logindata, Input::get('remember')))
		{
			//falta agrgarle la ruta a la que dirigra
			return Redirect::to('/');
		}
		else{
			return Redirect::to('/usuarios/login')->with('mensaje_error', 'Usuario o Contraseña Invalidos');
		}
	}

	public function getLogout(){
		Auth::logout();
		return Redirect::to('/usuarios/login')->with('mensaje_exito', 'Has cerrado Sesion con Exito.!');		
	}

	public function getNuevoUsuario(){

		//falta agg la ruta para el registro de un nuevo usuario
		return View::make('/');
	}

	public function postNuevoUsuario(){
		$usuario = new Usuario;

		$usuario->usuario = Input::get('');
		$usuario->email = Input::get('');
		$usuario->password = Input::get('');
		$usuario->permiso_id = Input::get('');
		$usuario->tipo_id = Input::get('');
		$usuario->activo ;
	}

	public function getActualizarUsuario($id){
		
		$usuario = Usuario::find($id);

		//falta retornar una vista que muestre el formulario para actualizar
		return View::make('/')->with('usuario', $usuario);
	}

	public function postActualizarUsuario($id){

		$usuario = Usuario::find($id);

		$usuario->usuario = Input::get('');
		$usuario->email = Input::get('');
		$usuario->password = Input::get('');
		$usuario->permiso_id = Input::get('');
		$usuario->tipo_id = Input::get('');
		$usuario->activo ;
		
		if($usuario->save()){
			return View::make('/')->with('registro con exito');
		}
		else{
			return View::make('/')->with('mensaje', 'error registro no exitoso');
		}
	}

	public function getEliminarUsuario($id){
		$usuario = Usuario::find($id);

		$usuario->delete();

		return View::make('/')->with('mensaje', 'usuario eliminado con exito.!');
	}
}