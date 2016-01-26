<?php  
class Unidad extends Eloquent{
	protected $table = 'unidades';
	protected $fillable = array('cod_unidad', 'descripcion','abreviatura');
	protected $primaryKey = 'cod_unidad';
}

?>