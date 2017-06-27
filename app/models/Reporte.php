<?php

class Reporte extends Eloquent
{
    protected $table = 'reportes';
    protected $fillable = array('titulo', 'consulta');

}