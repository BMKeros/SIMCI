<?php  
class Unidad extends Eloquent{
	protected $table = 'unidades';
	protected $fillable = array('cod_unidad', 'descripcion','abreviatura', 'tipo_unidad');
	protected $primaryKey = 'cod_unidad';

	public function setDescripcionAttibute($value){
		if (!empty($value)) {
			$this->attributes['descripcion']=strtolower($value);
		}
	}

	public function setAbreviaturaAttibute($value){
		if (!empty($value)) {
			$this->attributes['abreviatura']=strtolower($value);
		}
	}
}

?>