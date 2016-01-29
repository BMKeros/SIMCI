<?php  
	class ClaseObjeto extends Eloquent{

		protected $table = 'clase_objetos';
		protected $fillable = array('nombre', 'descripcion');
	}
?>