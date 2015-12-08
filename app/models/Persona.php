<?php  
class Persona Extends Eloquent{
	protected $table = 'personas';

	protected $fillable = array('primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'cedula', 'sexo', 'fecha_nacimiento');


	public function usuarios(){

		return $this->hasMany('Usuario');
	}
}

?>