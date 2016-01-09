<?php

class AutenticacionController extends Controller {
	
	public function __construct(){
		$this->beforeFilter('CheckAuth',array('except'=>array('getLogout')));
	}

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
			if(Auth::user()->activo){
				
				$tipo = Auth::user()->cod_tipo_usuario;
				
				return redirect_por_tipo($tipo);
			}
			else{
				Auth::logout();
				return Redirect::to('/autenticacion/login')->with('mensaje_alerta', 'Su usuario se encuentra inactivo ');
			}
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
