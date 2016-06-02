<?php

class Archivo extends Eloquent
{
    protected $table = 'archivos';
    protected $fillable = array('nombre', 'ubicacion', 'extension');

}