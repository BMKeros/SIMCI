<?php  
class Almacen extends Eloquent{

	protected $table = 'almacenes';
	protected $fillable = array('cod_almacen', 'id_responsable', 'descripcion');
}
?>