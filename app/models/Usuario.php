<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'usuarios';
	protected $fillable = array('usuario', 'email', 'password', 'cod_permiso','cod_tipo_usuario','imagen','activo');

	
	protected $hidden = array('password', 'remember_token');


	//un usuario pertenece a una persona
	public function persona(){
		return $this->hasOne('Persona');
	}


	public function setPasswordAttribute($value){
		if ( ! empty ($value)){
			$this->attributes['password'] = Hash::make($value);
		}
	}
}
