<?php  
	class Estante extends Eloquent{
		protected $table = 'estantes';
		protected $fillable = array('cod_estante', 'descripcion');

		
		public function setDescripcionAttibute($value){
			if (!empty($value)) {
				$this->attributes['descripcion']=strtolower($value);
			}
		}
	}
?>