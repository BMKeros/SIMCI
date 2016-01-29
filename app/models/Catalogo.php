<?php  
class Catalogo extends Eloquent{
	protected $table = 'catalogo_objetos';
	protected $fillable = array('nombre', 'descripcion', 'especificaciones', 'cod_unidad', 'cod_tipo_objeto');
	protected $visible = array('id','nombre', 'descripcion', 'especificaciones', 'cod_unidad', 'cod_tipo_objeto','data_unidad','data_clase_objeto');

	public function unidad(){
		return $this->belongsTo('Unidad','cod_unidad');
	}

	public function claseObjeto(){
		return $this->belongsTo('ClaseObjeto','cod_clase_objeto');
	}

	public function getDataUnidadAttribute()
    {
        return $this->unidad->toArray();
    }

    public function getDataClaseObjetoAttribute()
    {
        return $this->claseObjeto;
    }

    protected $appends = array('data_unidad', 'data_clase_objeto');
}

?>