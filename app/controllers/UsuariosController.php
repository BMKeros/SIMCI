<?php

class UsuariosController extends Controller {
	
	public function __construct(){
        $this->beforeFilter('guest', array('except' => ''));
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
		$usuario->activo = true;
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
		$usuario->activo = Input::get('') ;
		
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