<?php

class AutenticacionController extends Controller {
	
	//tentativo una funcion que muestre todos los usuarios registrados
	
	public function getLogin(){
		return View::make('autenticacion.formulario_login');
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
			return Redirect::to('/autenticacion/login')->with('mensaje_error', 'Usuario o Contraseña Invalidos');
		}
	}

	public function getLogout(){
		Auth::logout();
		return Redirect::to('/autenticacion/login')->with('mensaje_exito', 'Has cerrado Sesion con Exito.!');		
	}
}
