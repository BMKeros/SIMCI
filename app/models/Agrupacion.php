<?php  
class Agrupacion extends Eloquent{
	protected $table = 'tipo_objetos';
	protected $fillable = array('nombre', 'descripcion');

	public function setNombreAttribute($value){
		if (! empty($value)) {
			$this->attributes['nombre']=strtolower($value);
		}
	}

	public function setDescripcionAttribute($value){
		if (! empty($value)) {
			$this->attributes['descripcion']=strtolower($value);
		}
	}

}

?>