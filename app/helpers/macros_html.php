<?php  

Form::macro('select_permisos', function($atributos = null){
	if($atributos){
		$permisos = DB::table('permisos')->lists('nombre', 'codigo');
 		
 		$default_values=array('class'=>"ui fluid normal dropdown");
	
		$html = sprintf('<select multiple="" %s >',atributos_dinamicos($atributos,$default_values));
		$html .= '<option value="">Permisos</option>';
		        
		foreach ($permisos as $key => $value){
		    $html .= sprintf('<option value="%s">%s</option>', $key, ucfirst($value));
		}    
		$html .= '</select>';

		return $html;
	}
	else{
		return Form::select('');
	}
});


Form::macro('select_sexo', function($atributos = null){
	
	if($atributos){
		$sexo = DB::table('sexos')->lists('descripcion', 'id');

		$default_values = array('class'=>"ui dropdown capitalize");

		$html = sprintf('<select %s >', atributos_dinamicos($atributos, $default_values));
		$html .= '<option value="">Sexo</option>';
		
		foreach ($sexo as $key => $value) {
			$html .= sprintf('<option value="%s">%s</option>', $key, ucfirst($value));
		}

		$html .= '</select>';

		return $html;
	}
	else{
		return Form::select('');	
	}
  
});


Form::macro('select_tipo_usuario', function($atributos = null){
	
	if($atributos){
		$tipo_usuario = DB::table('tipos_usuario')->lists('nombre', 'codigo');
		
		$default_values = array('class'=>"ui dropdown capitalize");
		
		$html = sprintf('<select %s >', atributos_dinamicos($atributos,$default_values));
		$html .= '<option value="">Tipo Usuario</option>';
		
		foreach ($tipo_usuario as $key => $value) {
			if($key != TIPO_USER_ROOT){
				$html .= sprintf('<option value="%s">%s</option>', $key, ucfirst($value));
			}	
		}
		
		$html .= '</select>';

		return $html;
	}
	else{
		return Form::select('');
	}
  
});


//a partir de aqui estan version betra los nombres de las funciones y demas
//detalles que estan para un cambio...

Form::macro('select_dimension', function($atributos = null){
	if($atributos){

		$almacenes = DB::table('almacenes')->lists('descripcion', 'codigo');

		$default_values = array('class'=>"ui dropdown capitalize");
		
		$html = sprintf('<select %s >', atributos_dinamicos($atributos,$default_values));
		$html .= '<option value="">Dimensión</option>';
		
		foreach ($almacenes as $key => $value) {
			$html .= sprintf('<option value="%s">%s - %s</option>', $key, strtoupper($key),ucfirst($value));
		}
		
		$html .= '</select>';

		return $html;
	}
	else{
		return Form::select('');
	}
});



Form::macro('select_sub_dimension', function($atributos = null){
	if($atributos){

		$estantes = DB::table('sub_dimensiones')->lists('descripcion', 'codigo');

		$default_values = array('class'=>"ui dropdown capitalize");
		
		$html = sprintf('<select %s >', atributos_dinamicos($atributos,$default_values));
		$html .= '<option value="">Sub Dimension</option>';
		
		foreach ($estantes as $key => $value) {
			$html .= sprintf('<option value="%s">%s - %s</option>', $key,strtoupper($key), ucfirst($value));
		}
		
		$html .= '</select>';

		return $html;
	}
});

Form::macro('select_agrupacion', function($atributos = null){
	if($atributos){

		$agrupaciones = DB::table('agrupaciones')->lists('nombre', 'codigo');

		$default_values = array('class'=>"ui dropdown capitalize");
		
		$html = sprintf('<select %s >', atributos_dinamicos($atributos,$default_values));
		$html .= '<option value="">Agrupacion</option>';
		
		foreach ($agrupaciones as $key => $value) {
			$html .= sprintf('<option value="%s">%s - %s</option>', $key, strtoupper($key),ucfirst($value));
		}
		
		$html .= '</select>';

		return $html;
	}
});


Form::macro('select_sub_agrupacion', function($atributos = null){
	if($atributos){

		$sub_agrupaciones = DB::table('sub_agrupaciones')->lists('nombre', 'codigo');

		$default_values = array('class'=>"ui dropdown capitalize");
		
		$html = sprintf('<select %s >', atributos_dinamicos($atributos,$default_values));
		$html .= '<option value="">Sub agrupacion</option>';
		
		foreach ($sub_agrupaciones as $key => $value) {
			$html .= sprintf('<option value="%s">%s - %s</option>', $key, strtoupper($key),ucfirst($value));
		}
		
		$html .= '</select>';

		return $html;
	}
});

Form::macro('select_clase_objeto', function($atributos = null){
	if($atributos){

		$tipo_objetos = DB::table('clase_objetos')->lists('nombre', 'id');

		$default_values = array('class'=>"ui dropdown capitalize");
		
		$html = sprintf('<select %s >', atributos_dinamicos($atributos,$default_values));
		$html .= '<option value="">Clase de Objeto</option>';
		
		foreach ($tipo_objetos as $key => $value) {
			$html .= sprintf('<option value="%s">%s</option>', $key, ucfirst($value));
		}
		
		$html .= '</select>';

		return $html;
	}
});

Form::macro('select_unidades', function($atributos = null, $selected = null){
	if($atributos){

		$unidades = DB::table('unidades')->select('cod_unidad', 'nombre', 'abreviatura')->get();
	
		$default_values = array('class'=>"ui dropdown search capitalize");
		
		$html = sprintf('<select %s >', atributos_dinamicos($atributos,$default_values));
		$html .= '<option value="">Unidades</option>';
		
		foreach ($unidades as $unidad) {
			$html .= sprintf('<option value="%s">%s - [%s]</option>', $unidad->cod_unidad, ucfirst($unidad->nombre), $unidad->abreviatura);	
		}
		
		$html .= '</select>';

		return $html;
	}
});

Form::macro('select_personas', function($atributos = null, $selected = null){

	$personas = DB::table('personas')->select('primer_nombre', 'primer_apellido', 'personas.id')
		->join('usuarios', 'usuarios.id', '=', 'personas.usuario_id')
		->whereIn('usuarios.cod_tipo_usuario', array(TIPO_USER_ADMIN, TIPO_USER_ALMACENISTA))
		->get();

	$default_values = array('class'=>"ui dropdown search capitalize");

	$html = sprintf('<select %s >', atributos_dinamicos($atributos,$default_values));
		$html .= '<option value="">Primer Auxiliar</option>';
		
	foreach ($personas as $persona) {
		$html .= sprintf('<option value="%s">%s %s</option>', $persona->id, ucfirst($persona->primer_nombre), ucfirst($persona->primer_apellido));	
	}
		
	$html .= '</select>';

	return $html;
});

Form::macro('select_estados', function($atributos = null){
	
	if($atributos){
		$sexo = DB::table('estados')->lists('estado', 'id_estado');

		$default_values = array('class'=>"ui dropdown capitalize");

		$html = sprintf('<select %s >', atributos_dinamicos($atributos, $default_values));
		$html .= '<option value="">Estado</option>';
		
		foreach ($sexo as $key => $value) {
			$html .= sprintf('<option value="%s">%s</option>', $key, ucfirst($value));
		}

		$html .= '</select>';

		return $html;
	}
	else{
		return Form::select('');	
	}
  
});

Form::macro('select_proveedores', function($atributos = null, $selected = null){
	if($atributos){

		$proveedores = DB::table('proveedores')->lists('codigo', 'razon_social');
	
		$default_values = array('class'=>"ui dropdown search capitalize");
		
		$html = sprintf('<select %s >', atributos_dinamicos($atributos,$default_values));
		$html .= '<option value="">Proveedores</option>';
		
		foreach ($proveedores as $key => $value) {
			$html .= sprintf('<option value="%s">%s</option>', $key, ucfirst($value));
		}
		
		$html .= '</select>';

		return $html;
	}
});

?>

