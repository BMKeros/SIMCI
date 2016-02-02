<?php  
	class ClaseObjeto extends Eloquent{

		protected $table = 'clase_objetos';
		protected $fillable = array('nombre', 'descripcion');


		public function setNombreAttibute($value){
			if (!empty($value)) {
				$this->attributes['nombre']=strtolower($value);
			}
		}


		public function setDescripcionAttibute($value){
			if (!empty($value)) {
				$this->attributes['descripcion']=strtolower($value);
			}
		}
	}
?>