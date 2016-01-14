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

function atributos_dinamicos($atributos = null){
	
	if($atributos && !empty($atributos)){
		$default_atributos = array('class'=>"ui dropdown capitalize",'id'=>'default', 'name' => 'default');

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
