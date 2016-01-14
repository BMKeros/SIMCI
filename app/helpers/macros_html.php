<?php  
Form::macro('select_permisos', function(){
	$permisos = DB::table('permisos')->lists('nombre', 'codigo');

	$html = '<div class="ui fluid multiple search selection dropdown">';
	$html .= '<input name="tags" type="hidden">';
	$html .= '<i class="dropdown icon"></i>';
	$html .= '<div class="default text">Permisos</div>';

	$html .= '<div class="menu mayuscula">';
	        
	foreach ($permisos as $key => $value){
	    $html .= sprintf('<div class="item" data-value="%s">%s</div>', $key, $value);
	}    
	$html .= '</div></div>';

	return $html;
});


Form::macro('select_sexo', function(){
	$sexo = DB::table('sexos')->lists('descripcion', 'id');

	$html = '<select name="gender" class="ui dropdown capitalize" id="select">';
		$html .= '<option value="">Sexo</option>';
		foreach ($sexo as $key => $value) {
			$html .= sprintf('<option value="%s">%s</option>', $key, $value);
		}
	$html .= '</select>';

	return $html;
  
});


Form::macro('select_tipo_usuario', function(){
	$tipo_usuario = DB::table('tipos_usuario')->lists('descripcion', 'codigo');

	$html = '<select name="gender" class="ui dropdown capitalize" id="select">';
		$html .= '<option value="">Tipo Usuario</option>';
		foreach ($tipo_usuario as $key => $value) {
			$html .= sprintf('<option value="%s">%s</option>', $key, $value);
		}
	$html .= '</select>';

	return $html;
  
});

?>

?>

