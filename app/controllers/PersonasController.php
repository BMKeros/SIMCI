<?php

class PersonasController extends Controller {
	
	public function __construct(){
        $this->beforeFilter('guest', array('except' => ''));
	}
	
	//mostrar formulario de registro de personas
	public function getRegistroPersonas()
	{
		return View::make('personas.registro_personas');
	}

	//procesar datos del formulario de personas
	public function postRegistroPersonas(){
		//capturamos los datos del formulario
		$datos = Input::all();

		//guardamos en la db los datos del usuario
		$persona = new Persona;

		$persona->primer_nombre = Input::get('');
		$persona->segundo_nombre = Input::get('');
		$persona->primer_apellido = Input::get('');
		$persona->segundo_apellido = Input::get('');
		$persona->cedula = Input::get('');
		$persona->sexo = Input::get('');
		$persona->fecha_nacimiento = Input::get('');

		if($persona->save()){
			//agg la ruta 
			return Redirect::to('/')->with('mensaje', 'registro con exito');
		}
		else{
			return Redirect::back()->with('mensaje', 'error, registro no exitoso');
		}
	}

	public function getActualizarPersona($id){
		
		$persona = Persona::find($id);

		//falta retornar una vista que muestre el formulario para actualizar
		return View::make('/')->with('persona', $persona);
	}

	public function postActualizarPersona($id){

		$persona = Persona::find($id);

		$persona->primer_nombre = Input::get('');
		$persona->segundo_nombre = Input::get('');
		$persona->primer_apellido = Input::get('');
		$persona->segundo_apellido = Input::get('');
		$persona->cedula = Input::get('');
		$persona->sexo = Input::get('');
		$persona->fecha_nacimiento = Input::get('');
		
		if($persona->save()){
			return View::make('/')->with('registro con exito');
		}
		else{
			return View::make('/')->with('mensaje', 'error registro no exitoso');
		}
	}

	public function getEliminar($id){
		$persona = Persona::find($id);

		$persona->delete();

		return View::make('/')->with('mensaje', 'Persona eliminada con Exito.!');

	}
}