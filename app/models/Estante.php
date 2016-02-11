<?php  
	class Estante extends Eloquent{
		protected $table = 'estantes';
		protected $fillable = array('cod_estante', 'descripcion');
		protected $primaryKey = 'cod_estante';

		
		public function setDescripcionAttibute($value){
			if (!empty($value)) {
				$this->attributes['descripcion']=strtolower($value);
			}
		}
	}
?>