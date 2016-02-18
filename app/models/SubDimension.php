<?php  
	class SubDimension extends Eloquent{
		protected $table = 'sub_dimensiones';
		protected $fillable = array('codigo', 'descripcion');
		protected $primaryKey = 'codigo';

		public function setCodgioAttribute($value){
			if(!empty($value)){
				$this->attributes["codigo"] = strtolower($value);
			}
		}

	}
?>