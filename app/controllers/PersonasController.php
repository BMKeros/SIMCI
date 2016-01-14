<?php

class PersonasController extends Controller {
	
	public function __construct(){
        //$this->beforeFilter('guest', array('except' => ''));
	}
	
	//mostrar formulario de registro de personas
	public function getRegistroPersonas()
	{
		return View::make('personas.registro_personas');
	}

	//procesar datos del formulario de personas
	public function postRegistroPersonas(){

		$p_nombre = Input::get('primer_nombre');
		$s_nombre = Input::get('segundo_nombre');
		$p_apellido = Input::get('primer_apellido');
		$s_apellido = Input::get('segundo_apellido');
		$cedula = Input::get('cedula');
		$sexo = Input::get('sexo');
		$fecha_nacimiento = Input::get('fecha_nacimiento');
		$usuario = Input::get('usuario_id');

		
		//reglas
        $reglas = array('cedula' =>'required|unique:personas');

        $campos = array('cedula'=>$cedula);

        $mensajes = array('unique' => 'Esta :attribute ya existe');

        $validacion = Validator::make($campos,$reglas,$mensajes);
        
    	if($validacion->fails()){
    		return Response::json(array('resultado'=>false, 'mensajes'=>$validacion->messages()->all()));
    	}
		else{
			
			$persona = new Persona;

			$persona->primer_nombre = $p_nombre;
			$persona->segundo_nombre = $s_nombre;
			$persona->primer_apellido = $p_apellido;
			$persona->segundo_apellido = $s_apellido;
			$persona->cedula = $cedula;
			$persona->sexo = $sexo;
			$persona->fecha_nacimiento = $fecha_nacimiento;
			$persona->usuario_id = $usuario;

			return Response::json(array(
				'resultado'=>false, 
				'mensajes'=>$validacion->messages()->all(),
				'datos'=>array('persona_creada'=>$persona->id)
				)
			);
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