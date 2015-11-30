<?php

class UsuariosController extends Controller {

/*
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

*/

	//mostrar formulario de registro de usuarios
	public function getLogin(){
		return View::make('usuarios.formulario_registro');
	}

	//procesar datos del formuolario de usuario
	public function postRegistroUsuario(){
		//capturamos los datos del formulario
		$datos = Input::all();

		//insertamos en la tabla usuarios
		DB::table('usuarios')->insert($datos);
	}
}