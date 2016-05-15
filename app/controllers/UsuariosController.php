<?php

class UsuariosController extends BaseController {
	
	public function __construct(){
        //$this->beforeFilter('APICheckPermisos', array('except' => ''));
	}

	public function getMostrar(){
		$tipo_busqueda = Input::get('type', 'todos');
		$id_usuario = Input::get('id', null);
		$orden = Input::get('ordenar','asc');

		switch($tipo_busqueda){
			case 'todos':
				if($orden){
					$response = Usuario::where('cod_tipo_usuario', '<>', TIPO_USER_ROOT)->orderBy('id', $orden)->get();
				}
				else{
					$response = Usuario::where('cod_tipo_usuario', '<>', TIPO_USER_ROOT)->all();	
				}
			break;

			case 'usuario':
				if($id_usuario){
					$response = Usuario::where('cod_tipo_usuario', '<>', TIPO_USER_ROOT)->find($id_usuario);

					if(is_null($response)){
						$response = array();
					}
				}
				else{
					$response = array();
				}
			break;

			case 'usuario_full':
				if($id_usuario){
					$data = DB::table('usuarios')
					->select('usuarios.id as id',
						'usuarios.usuario as usuario',
						'usuarios.email as email', 
						'usuarios.activo',
						'usuarios.created_at',
						'usuarios.updated_at',
						DB::raw('permisos_usuario(usuarios.id) as permisos'),
						'TP.codigo as cod_tipo_usuario',
						'TP.nombre as nombre_tipo_usuario',
						'PER.primer_nombre',
						'PER.segundo_nombre',
						'PER.primer_apellido',
						'PER.segundo_apellido',
						'PER.cedula',
						'PER.fecha_nacimiento',
						'SEX.descripcion as sexo',
						'SEX.id as sexo_id'
					)
					->join('tipos_usuario as TP','TP.codigo','=','usuarios.cod_tipo_usuario')
					->leftJoin('personas as PER','PER.usuario_id','=','usuarios.id')
					->leftJoin('sexos as SEX','SEX.id','=','PER.sexo_id')
					->where('usuarios.cod_tipo_usuario', '<>', TIPO_USER_ROOT)
					->where('usuarios.id', '=', $id_usuario)
					->first();

					if(is_null($data)){
						$response = array();
					}
					else{
						$response = $data;
					}
				}
				else{
					$response = array();
				}
			break;

			case 'paginacion':

				$consulta = DB::table('usuarios')
				->select('usuarios.id as id',
					'usuarios.usuario as usuario',
					'usuarios.email as email',
					'usuarios.created_at',
					'usuarios.updated_at',
					RAW('permisos_usuario(id) as permisos'),
					'TP.codigo as cod_tipo_usuario',
					'TP.nombre as nombre_tipo_usuario'
					)
				->join('tipos_usuario as TP','TP.codigo','=','usuarios.cod_tipo_usuario')
				->where('cod_tipo_usuario', '<>', TIPO_USER_ROOT);

				$response = $this->generar_paginacion_dinamica($consulta,
					array('campo_where'=>'usuario', 'campo_orden'=>'id'));

			break;

			default:
				$response = Usuario::all();
			break;

		}

		return Response::json($response);
	}
	
	public function postCrearUsuario(){

		$usuario = Input::get('usuario');
		$email = Input::get('email');
		$password = Input::get('password');
		$tipo_usuario = Input::get('tipo_usuario');
		$permisos = Input::get('permisos');
		$imagen = Input::file('imagen');
		$activo = Input::get('activo');

        $reglas = array(
            'usuario' =>'required|max:15|min:5|unique:usuarios|alpha_num' ,
            'email' =>'required|email|max:50|unique:usuarios' ,
            'password' => 'required|min:5',
            'tipo_usuario'=> 'required|exists:tipos_usuario,codigo',
            'permisos' => 'required|exists:permisos,codigo',
            'imagen' => 'mimes:jpeg,bmp,png',
            'activo' => 'boolean'
        );

        $campos = array(
        	'usuario'=>$usuario,
            'email'=>$email,
            'password'=>$password,
            'tipo_usuario'=> $tipo_usuario,
            'permisos' => $permisos,
            'imagen' => $imagen,
            'activo' => $activo
        );

        $mensajes = array(
            'unique' => ':attribute ya existe',
            'required' => ':attribute no puede estar en blanco',
            'exists' => ':attribute no existe',
            'email' => 'El :attribute debe ser un email valido',
            'max' => ':attribute debe tener un maximo de :max caracteres',
            'min' => ':attribute debe tener un minimo de :min caracteres',
            'mimes' => ':attribute extensiones validas [JPG, PNG, BMP]',
            'alpha_num' => ':attribute de contener caracteres alfanumericos'
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
			$nuevo_usuario->cod_tipo_usuario = $tipo_usuario;
			$nuevo_usuario->permisos()->attach($permisos);

			if($imagen){
				$name_file = cargar_crear_imagen_usuario($imagen,$usuario);
				$nuevo_usuario->imagen = PATH_IMAGENES.$name_file; 
			}

			if($activo){ $nuevo_usuario->activo = $activo; }
			
			$nuevo_usuario->save();

			return Response::json(array(
				'resultado'=>true, 
				'mensajes'=>'Usuario creado con exito',
				'datos'=>array('usuario_creado'=>$nuevo_usuario->id)
				)
			);
		}
		
	}

	public function postCrearUsuarioCompleto(){

		DB::beginTransaction();

		//Datos del usuario
		$usuario = Input::get('usuario');
		$email = Input::get('email');
		$password = Input::get('password');
		$tipo_usuario = Input::get('tipo_usuario');
		$permisos = Input::get('permisos');
		$imagen = Input::file('imagen');
		$activo = Input::get('activo');

		//Datos personales
		$p_nombre = Input::get('primer_nombre');
		$s_nombre = Input::get('segundo_nombre');
		$p_apellido = Input::get('primer_apellido');
		$s_apellido = Input::get('segundo_apellido');
		$cedula = Input::get('cedula');
		$sexo = Input::get('sexo');
		$fecha_nacimiento = Input::get('fecha_nacimiento');

        $reglas = array(
            'usuario' =>'required|max:15|min:5|unique:usuarios|alpha_num' ,
            'email' =>'required|email|max:50|unique:usuarios' ,
            'password' => 'required|min:5',
            'tipo_usuario'=> 'required|exists:tipos_usuario,codigo',
            'permisos' => 'required|exists:permisos,codigo',
            'imagen' => 'mimes:jpeg,bmp,png',
            'activo' => 'boolean',
            
            //Reglas persona
            'cedula' =>'required|Digits Between:7,8|unique:personas|numeric',
        	'fecha_nacimiento' => 'required|date_format:Y-m-d',
        	'primer_nombre' => 'required|alpha|max:15',
        	'primer_apellido' => 'required|alpha|max:15',
        	'segundo_nombre' => 'alpha|max:15',
        	'segundo_apellido' => 'alpha|max:15',
        	'sexo' => 'required|exists:sexos,id|numeric'
        );

        $campos = array(
        	'usuario'=>$usuario,
            'email'=>$email,
            'password'=>$password,
            'tipo_usuario'=> $tipo_usuario,
            'permisos' => $permisos,
            'imagen' => $imagen,
            'activo' => $activo,
            
            //Campos persona
            'cedula'=>$cedula,
        	'fecha_nacimiento' => $fecha_nacimiento,
        	'primer_nombre' => $p_nombre,
        	'primer_apellido' => $p_apellido,
        	'segundo_nombre' => $s_nombre,
        	'segundo_apellido' => $s_apellido,
        	'sexo' => $sexo
        );

        $mensajes = array(
            'unique' => ':attribute ya existe',
            'required' => ':attribute no puede estar en blanco',
            'exists' => ':attribute no existe',
            'max' => ':attribute debe tener un maximo de :max caracteres',
            'min' => ':attribute debe tener un minimo de :min caracteres',
            'mimes' => ':attribute extensiones validas [JPG, PNG, BMP]',
            'alpha_num' => ':attribute de contener caracteres alfanumericos',
        	'alpha' => ':attribute debe contener solo caracteres',
        	'date_format' => ':attribute debe tener este formato YY-MM-DD',
        	'numeric' => ':attribute debe tener solo numeros'
        );

        $validacion = Validator::make($campos,$reglas,$mensajes);
        

		if($validacion->fails()){
			return Response::json(array('resultado'=>false, 'mensajes'=>$validacion->messages()->all()));
		}
		else{
	
			try{

				$datos = array(
					'usuario' => $usuario,
					'email' => $email,
					'password' => $password,
					'cod_tipo_usuario' => $tipo_usuario,
					//'cod_permiso' => $permisos,
				);

				if($imagen){
					$datos['imagen'] = PATH_IMAGENES.cargar_crear_imagen_usuario($imagen,$usuario);
				}
				if($activo){
					$datos['activo'] = $activo;
				}

				$nuevo_usuario = Usuario::create($datos);

				$nuevo_usuario->permisos()->attach($permisos);

				Persona::create(array(
					'primer_nombre' => $p_nombre,
					'primer_apellido' => $p_apellido,
					'segundo_nombre' => $s_nombre,
					'segundo_apellido' => $s_apellido,
					'cedula' => $cedula,
					'sexo_id' => $sexo,
					'fecha_nacimiento' => $fecha_nacimiento,
					'usuario_id' => $nuevo_usuario->id
				));
			}
			catch(ValidationException $e){
				DB::rollBack();

				return Response::json(array(
					'resultado'=>false, 
					'mensajes'=> $e->getErrors()
				));
			}
			catch(\Exception $e){
				DB::rollBack();

				return Response::json(array(
					'resultado'=>false, 
					'mensajes'=> array($e->getMessage())
				),500);
			}

			
			DB::commit();

			return Response::json(array(
				'resultado'=>true, 
				'mensajes'=>array('Usuario creado con exito'),
				'datos'=>array('usuario_creado'=>$nuevo_usuario->id)
				)
			);
		}
	}


	public function postActualizarUsuarioCompleto(){
		$id = Input::get('id');

		$usuario_actual = Usuario::find($id);
		
		if(!is_null($usuario_actual)){
			
			DB::beginTransaction();
			
			//Datos del usuario
			$usuario = input_default(Input::get('usuario'),$usuario_actual->usuario);
			$email = input_default(Input::get('email'),$usuario_actual->email);
			$password = Input::get('password');
			$tipo_usuario = input_default(Input::get('tipo_usuario'),$usuario_actual->cod_tipo_usuario);
			$permisos = Input::get('permisos');
			$imagen = Input::file('imagen');
			$activo = input_default(Input::get('activo'),$usuario_actual->activo);

			if($usuario_actual->persona){
				//Datos personaless
				$p_nombre = input_default(Input::get('primer_nombre'),$usuario_actual->persona->primer_nombre);
				$s_nombre = input_default(Input::get('segundo_nombre'),$usuario_actual->persona->segundo_nombre);
				$p_apellido = input_default(Input::get('primer_apellido'),$usuario_actual->persona->primer_apellido);
				$s_apellido = input_default(Input::get('segundo_apellido'),$usuario_actual->persona->segundo_apellido);
				$cedula = input_default(Input::get('cedula'),$usuario_actual->persona->cedula);
				$sexo = input_default(Input::get('sexo'),$usuario_actual->persona->sexo_id);
				$fecha_nacimiento = input_default(Input::get('fecha_nacimiento'),$usuario_actual->persona->fecha_nacimiento);	
			}
			else{
				//Datos personaless
				$p_nombre = Input::get('primer_nombre');
				$s_nombre = Input::get('segundo_nombre');
				$p_apellido = Input::get('primer_apellido');
				$s_apellido = Input::get('segundo_apellido');
				$cedula = Input::get('cedula');
				$sexo = Input::get('sexo');
				$fecha_nacimiento = Input::get('fecha_nacimiento');
			}
			

	        $reglas = array(
	            'usuario' =>'required|max:15|min:5|alpha_num' ,
	            'email' =>'required|email|max:50' ,
	            //'password' => 'required|min:5',
	            'tipo_usuario'=> 'required|exists:tipos_usuario,codigo',
	            'permisos' => 'required|exists:permisos,codigo',
	            'imagen' => 'mimes:jpeg,bmp,png',
	            'activo' => 'boolean',
	            
	            //Reglas persona
	            'cedula' =>'required|digits:8',
	        	'fecha_nacimiento' => 'required|date_format:Y-m-d',
	        	'primer_nombre' => 'required|alpha|max:15',
	        	'primer_apellido' => 'required|alpha|max:15',
	        	'segundo_nombre' => 'alpha|max:15',
	        	'segundo_apellido' => 'alpha|max:15',
	        	'sexo' => 'required|exists:sexos,id|numeric'
	        );

	        $campos = array(
	        	'usuario'=>$usuario,
	            'email'=>$email,
	            'password'=>$password,
	            'tipo_usuario'=> $tipo_usuario,
	            'permisos' => $permisos,
	            'imagen' => $imagen,
	            'activo' => $activo,
	            
	            //Campos persona
	            'cedula'=>$cedula,
	        	'fecha_nacimiento' => $fecha_nacimiento,
	        	'primer_nombre' => $p_nombre,
	        	'primer_apellido' => $p_apellido,
	        	'segundo_nombre' => $s_nombre,
	        	'segundo_apellido' => $s_apellido,
	        	'sexo' => $sexo
	        );

	        $mensajes = array(
	            'unique' => ':attribute ya existe',
	            'required' => ':attribute no puede estar en blanco',
	            'exists' => ':attribute no existe',
	            'max' => ':attribute debe tener un maximo de :max caracteres',
	            'min' => ':attribute debe tener un minimo de :min caracteres',
	            'mimes' => ':attribute extensiones validas [JPG, PNG, BMP]',
	            'alpha_num' => ':attribute de contener caracteres alfanumericos',
	        	'alpha' => ':attribute debe contener solo caracteres',
	        	'date_format' => ':attribute debe tener este formato YY-MM-DD',
	        	'numeric' => ':attribute debe tener solo numeros',
	        	'digits' => ':attribute debe tener solo :digits digitos',
	        );

	        $validacion = Validator::make($campos,$reglas,$mensajes);
	        

			if($validacion->fails()){
				return Response::json(array('resultado'=>false, 'mensajes'=>$validacion->messages()->all()));
			}
			else{

				try{

					$usuario_actual->usuario = $usuario;
					$usuario_actual->email = $email;
					$usuario_actual->password = $password;
					$usuario_actual->cod_tipo_usuario = $tipo_usuario;

					if($imagen){
						$usuario_actual->imagen  = PATH_IMAGENES.cargar_crear_imagen_usuario($imagen,$usuario_actual->usuario);
					}
					if($activo){
						$usuario_actual->activo = $activo;
					}

					if($usuario_actual->permisos){
						$usuario_actual->permisos()->detach();
						$usuario_actual->permisos()->attach($permisos);

					}else{
						$usuario_actual->permisos()->attach($permisos);
					}
					
					if($usuario_actual->persona){
						$persona = $usuario_actual->persona();
					}
					else{
						$persona = new Persona;

						$persona->primer_nombre = $p_nombre;
						$persona->primer_apellido = $p_apellido;
						$persona->segundo_nombre = $s_nombre;
						$persona->segundo_apellido = $s_apellido;
						$persona->cedula = $cedula;
						$persona->sexo_id = $sexo;
						$persona->fecha_nacimiento = $fecha_nacimiento;
					}

					if($usuario_actual->persona){
						$campos = array(
							'primer_nombre' => $p_nombre,
							'primer_apellido' => $p_apellido,
							'segundo_nombre' => $s_nombre,
							'segundo_apellido' => $s_apellido,
							'cedula' => $cedula,
							'sexo_id' => $sexo,
							'fecha_nacimiento' => $fecha_nacimiento
						);

						$usuario_actual->persona()->update($campos);

					}else{
						$usuario_actual->persona()->save($persona);
					}
					

					$usuario_actual->save();
				
				}
				catch(ValidationException $e){
					DB::rollBack();

					return Response::json(array(
						'resultado'=>false, 
						'mensajes'=> $e->getErrors()
					));
				}
				catch(\Exception $e){
					DB::rollBack();

					return Response::json(array(
						'resultado'=>false, 
						'mensajes'=> array($e->getMessage())
					),500);
				}

				
				DB::commit();

				return Response::json(array(
					'resultado'=>true, 
					'mensajes'=>array('Usuario actualizado con exito')
					)
				);
		
			}

		}else{
			return Response::json(array(
				'resultado'=>false, 
				'mensajes'=>array('Usuario no existe')
				)
			);
		}
	}

	public function postVerificar(){
		$id = Input::get('id');

		$persona_id = Persona::where('usuario_id', '=', $id)->get()->first();

		if(!is_null($persona_id)){
			$exists_relacion = DB::table('almacenes')
	            ->where('responsable', '=', $persona_id->id)
	        	->count();	
		}
		else{
			$exists_relacion = 0;
		}
		
		
        if($exists_relacion){
        	return Response::json(array(
				'resultado'=>true, 
				'mensajes'=> array()
				)
			);
        }
        else{
        	return Response::json(array(
				'resultado'=>false, 
				'mensajes'=> array()
				)
			);
        }
    }

	public function postEliminar(){
		$id = Input::get('id');
		
		$usuario = Usuario::find($id);
 
		if(!is_null($usuario)){

			if(Auth::user()->id != $usuario->id) {
				$usuario->delete();	
				return Response::json(array(
					'resultado'=>true, 
					'mensajes'=>array('Usuario eliminado con exito')
					)
				);
			}
			else{
				return Response::json(array(
					'resultado'=>true,
					'mensajes'=>array('¡Alerta!, usuario no puede ser eliminado')	
					)
				);
			}
			
		}
		else{
			return Response::json(array(
				'resultado'=>false, 
				'mensajes'=>array('Usuario no existe')
				)
			);
		}
	}

	public function postRegistrarTipoUsuario(){
		
		$nombre = Input::get('nombre');
		$descripcion = Input::get('descripcion');

		$reglas = array(
			'nombre' => 'required|min:5|max:15|unique:tipos_usuario',
            'descripcion' => 'required|min:5|max:50'
        );

	    $campos = array(
	    	'nombre' => $nombre,
	        'descripcion'=>$descripcion
	    );

        $mensajes = array(
            'required' => ':attribute no puede estar en blanco',
            'max' => ':attribute debe tener un maximo de :max caracteres',
            'min' => ':attribute debe tener un minimo de :min caracteres',
            'unique' => 'El campo :attribute ya existe.'
        );

        $validacion = Validator::make($campos, $reglas, $mensajes);

        if($validacion->fails()){
        	return Response::json(array('resultado'=>false, 'mensajes'=>$validacion->messages()->all()));
        }
        else{
        	$nuevo_TipoUsuario = new TiposUsuario;

        	$num_tipo_usuario = DB::table('tipos_usuario')->max('secuencia');

        	//comentado porque al codigo se le igualara a una funcion ya esta probada y funciona (y)
        	$nuevo_TipoUsuario->codigo = crear_codigo($num_tipo_usuario,"TIPO_USUARIO");
        	$nuevo_TipoUsuario->nombre = $nombre;
        	$nuevo_TipoUsuario->descripcion = $descripcion;

        	$nuevo_TipoUsuario->save();

        	return Response::json(array('resultado' => true, 'mensajes' => 'Tipo de Usuario creado con exito.'));
        }


	}	
}


