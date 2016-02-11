<?php  
	class SubDimension extends Eloquent{
		protected $table = 'sub_dimensiones';
		protected $fillable = array('codigo', 'descripcion');
		protected $primaryKey = 'codigo';
	}
?>