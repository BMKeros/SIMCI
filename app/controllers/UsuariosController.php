<?php

class UsuariosController extends Controller {
	
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
			return "Exito";
			//return View::make('usuarios.formulario_registro');
		}
		else{
			return Redirect::to('/usuarios/login')->with(array('mensaje_error' => 'Usuario o Contraseña Invalidos'));
		}
	}

	public function getLogout(){
		Auth::logout();
		return Redirect::to('/usuarios/login')->with('mensaje_exito', 'Has cerrado Sesion con Exito.!');		
	}

	//mostrar formulario de registro de personas
	public function getFormularioPersonas()
	{
		return View::make('usuarios.formulario_registro');
	}

	//procesar datos del formulario de personas
	public function postRegistroPersonas(){
		//capturamos los datos del formulario
		$datos = Input::all();

		//guardamos en la db los datos del usuario
		DB::table('personas')->insert($datos);

	}
}