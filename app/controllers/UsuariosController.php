<?php

class UsuariosController extends Controller {
	
	public function __construct(){
        $this->beforeFilter('CheckGuest', array('except' => ''));
	}

	public function getTodosUsuarios(){
		$usuarios = Usuario::all();

		return json_encode($usuarios);
	}
	
	public function getNuevoUsuario(){

		//falta agg la ruta para el registro de un nuevo usuario
		//return View::make('usuarios.registrar_usuario');
		return View::make('buscador_prueba');
	}

	public function postNuevoUsuario(){


		$usuario = Input::get('usuario');
		$email = Input::get('email');
		$password = Input::get('password');

        $reglas = array(
            'usuario' =>'required|unique:usuarios' ,
            'email' =>'required|email|unique:usuarios' ,
        );

        $campos = array('usuario'=>$usuario,
                        'email'=>$email
        );

        $mensajes = array(
            'unique' => 'Este :attribute ya existe',
        );

        $validacion = Validator::make($campos,$reglas,$mensajes);
        

		if($validacion->fails()){
			return Response::json(array('resultado'=>false, 'mensajes'=>$validacion->messages()->all()));
		}
		else{
			
			$nuevo_usuario = new Usuario;
			$nuevo_usuario->usuario = $usuario;
			$nuevo_usuario->email = $email;
			$nuevo_usuario->password = $password;

			$nuevo_usuario->save();

			return Response::json(array(
				'resultado'=>true, 
				'mensajes'=>'Usuario creado con exito',
				'datos'=>array('usuario_creado'=>$nuevo_usuario->id)
				)
			);
		}
		
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


