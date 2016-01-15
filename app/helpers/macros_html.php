<?php  
Form::macro('select_permisos', function($atributos = null){
	if($atributos){
		$permisos = DB::table('permisos')->lists('nombre', 'codigo');
 		
 		$default_values=array('class'=>"ui fluid normal dropdown");
	
		$html = sprintf('<select multiple="" %s >',atributos_dinamicos($atributos,$default_values));
		$html .= '<option value="">Permisos</option>';
		        
		foreach ($permisos as $key => $value){
		    $html .= sprintf('<option value="%s">%s</option>', $key, $value);
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

		$html = sprintf('<select %s>', atributos_dinamicos($atributos, $default_values));
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
		
		$default_values = array('class'=>"ui dropdown capitalize");
		
		$html = sprintf('<select %s >', atributos_dinamicos($atributos,$default_values));
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

