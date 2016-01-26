<?php  
	class TipoObjeto extends Eloquent{

		protected $table = 'tipo_objetos';
		protected $fillable = array('nombre', 'descripcion');
	}
?>