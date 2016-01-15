<?php  
Form::macro('select_permisos', function(){
	$permisos = DB::table('permisos')->lists('nombre', 'codigo');

	$html = '<select multiple="" name="skills" class="ui fluid normal dropdown">';
	$html .= '<option value="">Permisos</option>';
	        
	foreach ($permisos as $key => $value){
	    $html .= sprintf('<option value="%s">%s</option>', $key, $value);
	}    
	$html .= '</select>';

	return $html;

});


Form::macro('select_sexo', function($atributos = null){
	
	if($atributos){
		$sexo = DB::table('sexos')->lists('descripcion', 'id');

		$html = sprintf('<select %s>', atributos_dinamicos($atributos));
			$html .= '<option value="">Sexo</option>';
			foreach ($sexo as $key => $value) {
				$html .= sprintf('<option value="%s">%s</option>', $key, $value);
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
		$tipo_usuario = DB::table('tipos_usuario')->lists('descripcion', 'codigo');

		$html = sprintf('<select %s >', atributos_dinamicos($atributos));
			$html .= '<option value="">Tipo Usuario</option>';
			foreach ($tipo_usuario as $key => $value) {
				$html .= sprintf('<option value="%s">%s</option>', $key, $value);
			}
		$html .= '</select>';

		return $html;
	}
	else{
		return Form::select('');
	}
  
});

?>

