<?php  
	class Estante extends Eloquent{
		protected $table = 'estantes';
		protected $fillable = array('cod_estante', 'descripcion');

		
	}
?>