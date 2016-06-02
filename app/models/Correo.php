<?php

class Correo extends Eloquent
{
    protected $table = 'correos';
    protected $fillable = array('emisor', 'destinatario', 'asunto', 'archivo', 'descripcion');

}