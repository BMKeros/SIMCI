<?php  
class Almacen extends Eloquent{

	protected $table = 'almacenes';
	protected $fillable = array('cod_almacen', 'responsable', 'primer_auxiliar', 'segundo_auxiliar','descripcion');
}
?>