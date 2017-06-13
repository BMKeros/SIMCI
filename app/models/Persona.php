<?php

class Persona Extends Eloquent
{
    protected $table = 'personas';

    protected $fillable = array('primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'cedula', 'usuario_id', 'sexo_id', 'fecha_nacimiento');

    protected $visible = array('id', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'cedula', 'usuario_id', 'sexo_id', 'fecha_nacimiento', 'data_sexo');

    public function usuario()
    {
        return $this->belongsTo('Usuario');
    }

    public function sexo()
    {
        return $this->belongsTo('Sexo');
    }

    public function getDataSexoAttribute()
    {
        return $this->sexo->toArray();
    }

    protected $appends = ['data_sexo'];


    public function setPrimerNombreAttibute($value)
    {
        if (!empty($value)) {
            $this->attributes['primer_nombre'] = strtolower($value);
        }
    }


    public function setSegundoNombreAttibute($value)
    {
        if (!empty($value)) {
            $this->attributes['segundo_nombre'] = strtolower($value);
        }
    }


    public function setPrimerApellidoAttibute($value)
    {
        if (!empty($value)) {
            $this->attributes['primer_apellido'] = strtolower($value);
        }
    }


    public function setSegundoApellidoAttibute($value)
    {
        if (!empty($value)) {
            $this->attributes['segundo_apellido'] = strtolower($value);
        }
    }

    public function get_nombre_completo()
    {
        return ucwords($this->primer_nombre . " " . $this->primer_apellido);
    }


}

?>