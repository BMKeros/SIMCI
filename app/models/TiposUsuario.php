<?php

class TiposUsuario extends Eloquent {

	protected $table = 'tipos_usuario';
	protected $fillable = array('codigo', 'descripcion');
	protected $primaryKey = 'codigo';


	public function usuarios()
    {
        return $this->belongsTo('Usuario');
    }

    public function setDescripcionAttibute($value){
		if (!empty($value)) {
			$this->attributes['descripcion']=strtolower($value);
		}
	}
}
