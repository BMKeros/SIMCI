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
