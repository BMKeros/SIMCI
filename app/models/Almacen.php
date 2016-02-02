<?php  
class Almacen extends Eloquent{

	protected $table = 'almacenes';
	protected $fillable = array('cod_almacen', 'responsable', 'primer_auxiliar', 'segundo_auxiliar','descripcion');

	public function setResponsableAttibute($value){
		if (!empty($value)) {
			$this->attributes['responsable']=strtolower($value);
		}
	}


	public function setPrimerAuxiliarAttibute($value){
		if (!empty($value)) {
			$this->attributes['primer_auxiliar']=strtolower($value);
		}
	}


	public function setSegundoAuxiliarAttibute($value){
		if (!empty($value)) {
			$this->attributes['segundo_auxiliar']=strtolower($value);
		}
	}


	public function setDescripcionAttibute($value){
		if (!empty($value)) {
			$this->attributes['descripcion']=strtolower($value);
		}
	}
}
?>