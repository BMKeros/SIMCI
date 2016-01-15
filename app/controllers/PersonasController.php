<?php

class PersonasController extends Controller {
	
	public function __construct(){
        //$this->beforeFilter('guest', array('except' => ''));
	}
	
	//mostrar formulario de registro de personas
	public function getRegistroPersonas(){}

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

	public function getActualizarPersona($id){}

	public function postActualizarPersona($id){

		$persona = Persona::find($id);

		$p_nombre = Input::get('primer_nombre',$persona->primer_nombre);
		$s_nombre = Input::get('segundo_nombre', $persona->segundo_nombre);
		$p_apellido = Input::get('primer_apellido',$persona->primer_apellido);
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

	public function postEliminar($id){
		
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