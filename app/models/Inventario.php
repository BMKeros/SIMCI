<?php  
	class Inventario extends Eloquent{
		protected $table = 'inventario';
		protected $primaryKey = null;
		public $incrementing = false;
		protected $fillable = array('cod_dimension', 'cod_subdimension', 'cod_agrupacion', 'cod_subagrupacion', 'numero_orden', 'cod_objeto', 'cantidad_disponible', 'usa_recipientes', 'stock', 'recipientes_disponibles');
		
	}

?>