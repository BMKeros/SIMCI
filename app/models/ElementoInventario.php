<?php  
class ElementoInventario extends Eloquent{

	protected $table = 'inventario';
	protected $fillable = array('cod_dimension', 'cod_subdimension', 'cod_agrupacion', 'cod_subagrupacion', 'numero_orden', 'cod_objeto', 'cantidad_disponible', 'usa_recipientes', 'recipientes_disponible');
}
?>