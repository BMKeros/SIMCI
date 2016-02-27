<?php 
class Proveedor extends Eloquent{
	protected $table = 'proveedores';
	protected $fillable = array('codigo', 'razon_social', 'doc_identificacion', 'telefono_fijo', 'telefono_movil1', 'telefono_movil2', 'email', 'direccion', 'cod_estado', 'cod_ciudad', 'cod_municipio', 'cod_parroquia');
	protected $primaryKey = 'codigo';
}
?>