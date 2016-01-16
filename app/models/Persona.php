<?php  
class Persona Extends Eloquent{
	protected $table = 'personas';

	protected $fillable = array('primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'cedula', 'usuario_id','sexo_id', 'fecha_nacimiento');


	public function usuario(){
		return $this->belongsTo('Usuario');
	}

	public function sexo(){
		return $this->belongsTo('Sexo');
	}
}

?>