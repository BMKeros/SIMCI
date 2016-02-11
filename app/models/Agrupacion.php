<?php  
class Agrupacion extends Eloquent{
	protected $table = 'agrupaciones';
	protected $fillable = array('codigo' , 'nombre', 'descripcion');
	protected $primary = 'codigo';

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