<?php  

class Permiso extends Eloquent{

	protected $table = 'permisos';
	protected $fillable = array('codigo', 'nombre', 'descripcion');
	protected $primaryKey = 'codigo';


	public function usuarios(){
        return $this->belongsToMany('Usuario','permisos_usuarios','cod_permiso','usuario_id');
    }
}


?>