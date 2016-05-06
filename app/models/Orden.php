<?php  
	class Orden extends Eloquent{
		protected $table = 'ordenes';
		protected $fillable = array('id', 'codigo', 'usuario_id', 'fecha', 'hora', 'cod_laboratorio', 'observaciones', 'status');
	}
?>