<?php

class Archivo extends Eloquent
{
    protected $table = 'archivos';
    protected $fillable = array('nombre_original', 'nombre_generado', 'path', 'extension');

    public function get_full_name()
    {
        return $this->nombre_generado . '.' . $this->extension;
    }

}