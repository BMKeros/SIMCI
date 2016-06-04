<?php

class Correo extends Eloquent
{
    protected $table = 'correos';
    protected $fillable = array('emisor', 'asunto', 'archivo', 'descripcion');

}