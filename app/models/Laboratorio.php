<?php  
class Laboratorio extends Eloquent{

	protected $table = 'laboratorios';
	protected $fillable = array('codigo', 'nombre', 'descripcion');
	protected $primaryKey = 'codigo';
}
?>