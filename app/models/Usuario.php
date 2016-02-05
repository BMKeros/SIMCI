<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'usuarios';
	protected $fillable = array('usuario', 'email', 'password','cod_tipo_usuario','imagen','activo');

	protected $visible = array('id','usuario', 'email', 'password','cod_tipo_usuario','imagen','activo', 'data_permisos','data_tipo_usuario');
	
	protected $hidden = array('password', 'remember_token');

	public function persona(){
		return $this->hasOne('Persona');
	}

	public function permisos(){
        return $this->belongsToMany('Permiso','permisos_usuarios','usuario_id','cod_permiso');
    }

    public function tipousuario(){
    	return $this->belongsTo('TiposUsuario', 'cod_tipo_usuario');
    }
    public function nombre_corto(){
    	return ucfirst($this->persona->primer_nombre).' '.ucfirst($this->persona->primer_apellido);
    }
    public function nombre_tipo_usuario(){
    	return ucfirst($this->tipousuario->nombre);
    }



    public function getDataPermisosAttribute(){
        return $this->permisos->toArray();
    }

    public function getDataTipoUsuarioAttribute(){
        return $this->tipousuario->toArray();
    }

    protected $appends = ['data_permisos','data_tipo_usuario'];


	public function setPasswordAttribute($value){
		if ( ! empty ($value)){
			$this->attributes['password'] = Hash::make($value);
		}
	}

	public function setUsuarioAttibute($value){
		if (!empty($value)) {
			$this->attributes['usuario']=strtolower($value);
		}
	}
}
