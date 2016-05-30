<?php  
class ElementoInventario extends Eloquent{

	protected $table = 'inventario';
	protected $primaryKey = null;
	public $incrementing = false;
    protected $fillable = array('cod_dimension', 'cod_subdimension', 'cod_agrupacion', 'cod_subagrupacion', 'numero_orden', 'cod_objeto', 'cantidad_disponible');


    static public function verificar_is_clase_objeto($cod_clase_objeto, $cod_objeto)
    {
        $string_select = sprintf("clase_objetos.id = '%s'::integer as resultado", (string)$cod_clase_objeto);

        $consulta = DB::table('catalogo_objetos')
            ->select(RAW($string_select))
            ->join('clase_objetos', 'clase_objetos.id', '=', 'catalogo_objetos.cod_clase_objeto')
            ->where('catalogo_objetos.id', '=', $cod_objeto)
            ->first();

        return $consulta->resultado;
    }
}
?>