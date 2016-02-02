<?php  
class Sexo Extends Eloquent{
	protected $table = 'sexos';

	protected $fillable = array('descripcion');

	public function setDescripcionAttibute($value){
		if (!empty($value)) {
			$this->attributes['descripcion']=strtolower($value);
		}
	}
}

?>