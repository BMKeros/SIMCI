<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'usuarios';
	protected $fillable = array('usuario', 'email', 'password','cod_tipo_usuario','imagen','activo', 'created_at', 'updated_at');

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
    	return ($this->persona)?(ucfirst($this->persona->primer_nombre).' '.ucfirst($this->persona->primer_apellido)):(null);
    }
    public function nombre_tipo_usuario(){
    	return ucfirst($this->tipousuario->nombre);
    }

    public function get_avatar(){
    	if($this->persona){
    		if($this->persona->sexo_id == SEXO_MASCULINO){
    			return PATH_AVATAR_MASCULINO;
    		}
    		else{
    			return PATH_AVATAR_FEMENINO;
    		}
    	}
    	else{
    		return PATH_NO_AVATAR;
    	}
    }

    //Funcion para verificar si el usuario posee los permisos que se reciben por parametros
    public function check_permisos($permisos_verificar = array()){
    	if(!empty($permisos_verificar)){
    		$permisos_usuario = get_array_permisos_usuario($this->id);
    		foreach ($permisos_usuario as $value) {
    			if(in_array($value, $permisos_verificar)){
    				return true;
    			}
    		}
    	}
    	return false;
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
