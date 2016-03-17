<?php  
	class ObjetoLaboratorio extends Eloquent{
		protected $table = 'objetos_laboratorio';

		protected $fillable = array('cod_laboratorio', 'cod_objeto');
		
	}
?>