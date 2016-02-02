<?php


function drop_cascade($table = null){
	if( Schema::hasTable($table) ){
		DB::statement('DROP TABLE '.$table.' CASCADE;');
	}
}

function redirect_por_tipo($tipo_usuario = null){
	if($tipo_usuario == TIPO_USER_ROOT ){
		return Redirect::action('ModulosController@getAdministracion');	
	}
	else if($tipo_usuario == TIPO_USER_ESTUDIANTE){
		return Redirect::action('ModulosController@getEstudiantes');	
	}
	else if($tipo_usuario == TIPO_USER_PROFESOR){
		return Redirect::action('ModulosController@getProfesores');	
	}
	else{
		Auth::logout();
		return Redirect::to('/')->with(array('mensaje_alerta'=>"Error ha ocurrido un problema con su tipo de usuario"));		
	}
}

function atributos_dinamicos($atributos = null, $default = null){
	
	if($atributos && !empty($atributos)){
		
		$default_atributos = ($default)?($default):(array('class'=>"ui",'id'=>'default', 'name' => 'default'));

		foreach ($default_atributos as $key => $value) {
		  (array_key_exists($key, $atributos))?'':$atributos[$key] = $value;
		}

		$tmp = "";
		foreach ($atributos as $key => $value) {
		  $tmp.= sprintf(" %s=\"%s\" ",$key,$value);
		}	

		return $tmp;
	}
	else{
		return "";
	}
}

function quitar_espacios($input = ''){
	return str_replace(array(' ','   '), '', $input);
}

function input_default($input = '', $default = ''){
	$num_char = strlen(quitar_espacios($input));
	return ($num_char == 0)? ($default): ($input);
}


function cargar_crear_imagen_usuario($archivo = null,$name_usuario = ""){
	if($archivo){
		$extension = explode(".", $archivo->getClientOriginalName());
		$extension = $extension[count($extension)-1];
		$name = sprintf('%s_img_perfil_user.%s',$name_usuario,$extension);
		$archivo->move('uploads/imagenes',$name);
		return $name;
	}
	else{
		return null;
	}
}

function agregar_ceros($numero = 0, $cantidad_ceros = 1){
	$ceros = "";
	for($i=0;$i<$cantidad_ceros;$i++){
		$ceros .= "0"; 
	}
	return ($numero > 0 && $numero < 10 )?( sprintf("%s%d",$ceros,$numero)):((String)$numero);
}

function crear_codigo_tipo_usuario($numero = 1){
	return sprintf("%s%s",CODIGO_TIPO_USUARIO,agregar_ceros($numero,2));
}

function crear_codigo_permiso($numero = 1){
	return sprintf("%s%s",CODIGO_PERMISO,agregar_ceros($numero,2));
}