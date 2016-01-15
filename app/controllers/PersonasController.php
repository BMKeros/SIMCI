<?php

class PersonasController extends Controller {
	
	public function __construct(){
        //$this->beforeFilter('guest', array('except' => ''));
	}
	
	public function getTodasPersonas(){
		$personas = Persona::all();

		return Response::json($personas);
	}

	public function getVerPersona($id){
		
		$persona = Persona::find($id);

		if($persona){
			return Response::json(array(
				'resultado'=>true,
				'mensajes'=> $persona
				)
			);
		}
		else{
			return Response::json(array(
				'resultado'=>false,
				'mensajes'=> array('error'=>'Error, Persona no encontrada')
				)
			,404);
		}
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
			$persona->sexo_id = $sexo;
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

	public function getActualizarPersona($id){}

	public function postActualizarPersona($id){

		$persona = Persona::find($id);

		$p_nombre = input_default(Input::get('primer_nombre'),$persona->primer_nombre);
		$s_nombre = input_default(Input::get('segundo_nombre'),$persona->segundo_nombre);
		$p_apellido = input_default(Input::get('primer_apellido'),$persona->primer_apellido);
		$s_apellido = input_default(Input::get('segundo_apellido'),$persona->segundo_apellido);
		$cedula = input_default(Input::get('cedula'),$persona->cedula);
		$sexo = input_defualt(Input::get('sexo'),$persona->sexo_id);
		$fecha_nacimiento = input_default(Input::get('fecha_nacimiento'),$persona->fecha_nacimiento);
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
			$persona->sexo_id = $sexo;
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

	public function postEliminarPersona($id){
		
		$persona = Persona::find($id);

		if($persona){
			$persona->delete();

			return Response::json(array(
				'resultado'=>true,
				'mensajes'=> array('exito'=>'Se ha eliminado la persona con exito')
				)
			);
		}
		else{
			return Response::json(array(
				'resultado'=>false,
				'mensajes'=> array('error'=>'Error, Persona no encontrada')
				)
			,404);
		}
	}
}