<?php  
	class Pedido extends Eloquent{
		protected $table = "pedidos";
		protected $fillable = array('cod_dimension', 
									'cod_subdimension', 
									'cod_agrupacion', 
									'cod_objeto',
									'numero_orden',
									'cantidad_disponible',
									'cantidad_solicitada',
									'cod_referencia',
									'cod_tipo_movimiento'
								);
	}
?>