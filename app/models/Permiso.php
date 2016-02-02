<?php  

class Permiso extends Eloquent{

	protected $table = 'permisos';
	protected $fillable = array('codigo', 'nombre', 'descripcion');
	protected $primaryKey = 'codigo';


	public function usuarios(){
        return $this->belongsToMany('Usuario','permisos_usuarios','cod_permiso','usuario_id');
    }


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