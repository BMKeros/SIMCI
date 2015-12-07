<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class TiposUsuario extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tipos_usuario';
	protected $fillable = array('codigo', 'descripcion');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public function usuarios()
    {
        return $this->belongsTo('Usuario');
    }
}
