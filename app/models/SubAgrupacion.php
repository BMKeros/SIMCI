<?php  
class SubAgrupacion extends Eloquent{

	protected $table = 'sub_agrupaciones';
	protected $fillable = array('codigo', 'nombre', 'descripcion');
	protected $primaryKey = 'codigo';
}
?>