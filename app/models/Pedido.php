<?php

class Pedido extends Eloquent
{
    protected $table = "pedidos";
    protected $fillable = array(
        'cod_dimension',
        'cod_subdimension',
        'cod_agrupacion',
        'cod_objeto',
        'numero_orden',
        'cantidad_disponible',
        'cantidad_solicitada',
        'status'
    );

    public function orden()
    {
        return $this->belongsTo('Orden', 'cod_orden', 'codigo');
    }

    public function objeto()
    {
        return $this->hasOne('Catalogo', 'id', 'cod_objeto');
    }

    public function condicion()
    {
        return $this->hasOne('Condicion', 'codigo', 'status');
    }
}

?>