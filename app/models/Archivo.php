<?php

class Archivo extends Eloquent
{
    protected $table = 'archivos';
    protected $fillable = array('nombre_original', 'nombre_generado', 'ubicacion', 'extension');

}