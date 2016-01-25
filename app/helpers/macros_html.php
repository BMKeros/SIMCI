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

		$html = sprintf('<select %s >', atributos_dinamicos($atributos, $default_values));
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


//a partir de aqui estan version betra los nombres de las funciones y demas
//detalles que estan para un cambio...

Form::macro('select_dimension', function($atributos = null){
	if($atributos){

		$almacenes = DB::table('almacenes')->lists('descripcion', 'cod_almacen');

		$default_values = array('class'=>"ui dropdown capitalize");
		
		$html = sprintf('<select %s >', atributos_dinamicos($atributos,$default_values));
		$html .= '<option value="">Dimensión</option>';
		
		foreach ($almacenes as $key => $value) {
			$html .= sprintf('<option value="%s">%s</option>', $key, $value);
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

		$estantes = DB::table('estantes')->lists('descripcion', 'cod_estante');

		$default_values = array('class'=>"ui dropdown capitalize");
		
		$html = sprintf('<select %s >', atributos_dinamicos($atributos,$default_values));
		$html .= '<option value="">Sub-Dimension</option>';
		
		foreach ($estantes as $key => $value) {
			$html .= sprintf('<option value="%s">%s</option>', $key, $value);
		}
		
		$html .= '</select>';

		return $html;
	}
});

Form::macro('select_agrupacion', function($atributos = null){
	if($atributos){

		$tipo_objetos = DB::table('tipo_objetos')->lists('nombre', 'id');

		$default_values = array('class'=>"ui dropdown capitalize");
		
		$html = sprintf('<select %s >', atributos_dinamicos($atributos,$default_values));
		$html .= '<option value="">Tipo de Objeto</option>';
		
		foreach ($tipo_objetos as $key => $value) {
			$html .= sprintf('<option value="%s">%s</option>', $key, $value);
		}
		
		$html .= '</select>';

		return $html;
	}
});

Form::macro('select_unidades', function($atributos = null){
	if($atributos){

		$unidades = DB::table('unidades')->select('cod_unidad', 'nombre', 'abreviatura')->get();
	
		$default_values = array('class'=>"ui dropdown capitalize");
		
		$html = sprintf('<select %s >', atributos_dinamicos($atributos,$default_values));
		$html .= '<option value="">Unidades</option>';
		
		foreach ($unidades as $unidad) {
			$html .= sprintf('<option value="%s">[%s] - %s</option>', $unidad->cod_unidad, $unidad->abreviatura, $unidad->nombre);
		}
		
		$html .= '</select>';

		return $html;
	}
});

?>

