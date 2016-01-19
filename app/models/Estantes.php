<?php  
	class Estantes extends Eloquent{
		protected $table = 'estantes';
		protected $fillable = array('cod_estante', 'descripcion');

		
	}
?>