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

		$persona->primer_nombre = Input::get('primer_nombre');
		$persona->segundo_nombre = Input::get('segundo_nombre');
		$persona->primer_apellido = Input::get('primer_apellido');
		$persona->segundo_apellido = Input::get('segundo_apellido');
		$persona->cedula = Input::get('cedula');
		$persona->sexo = Input::get('sexo');
		$persona->fecha_nacimiento = Input::get('fecha_nacimiento');

		//reglas
        $reglas = array(
            'usuario' =>'required|max:50|unique:usuarios|alpha_num' ,
            'email' =>'required|email|unique:usuarios' ,
            'password' =>'required|min:4' ,
       
        );

        $campos = array('usuario'=>Input::get('usuario'),
                        'email'=>Input::get('email'),
                        'password' => Input::get('password'),
        );

        $mensajes = array(
            'min' => 'El :attribute debe tener un minimo de :min caracteres!',
            'email'=> 'El formato del :attribute es invalido',
            'unique' => 'Este :attribute ya existe',
        );

        $validacion = Validator::make($campos,$reglas,$mensajes);
        
    	if($validacion->fails()){
    		return Redirect::to('/usuarios/crear-usuario')->with('mensaje_error','Error en el formulario');
    	}
		else{
			$usuario = new Usuario;

			$usuario->usuario = Input::get('usuario');
			$usuario->email = Input::get('email');
			$usuario->password = Input::get('password');
			$usuario->tipo_usuario = Input::get('tipo_usuario');
			$usuario->pais_id = Input::get('pais');

			$usuario->save();

			return Redirect::to('/usuarios/crear-usuario')->with('mensaje_exito','Usuario creado con exito');
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