<?php  
	class Catalogo extends Eloquent{
		protected $table = 'catalogo_objetos';
		protected $fillable = array('nombre', 'descripcion', 'especificaciones', 'cod_unidad', 'cod_tipo_objeto');
	}

?>