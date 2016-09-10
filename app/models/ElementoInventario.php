<?php

class ElementoInventario extends Eloquent
{

    protected $table = 'inventario';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = array('cod_dimension', 'cod_subdimension', 'cod_agrupacion', 'cod_subagrupacion', 'numero_orden', 'cod_objeto', 'cantidad_disponible');

    //Funcion que permite verificar si es la clase del reactivo que se le pasa por parametro
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

    static public function get_cantidad_disponible($_cod_dimension, $_cod_subdimension, $_cod_agrupacion, $_cod_objeto, $_numero_orden){

        $consulta = DB::table('inventario')
            ->select('cantidad_disponible')
            ->where('cod_dimension', '=', $_cod_dimension)
            ->where('cod_subdimension', '=', $_cod_subdimension)
            ->where('cod_agrupacion', '=', $_cod_agrupacion)
            ->where('cod_objeto', '=', $_cod_objeto)
            ->where('numero_orden', '=', $_numero_orden)
            ->first();

        return $consulta->cantidad_disponible;
    }

    static public function disponible($_cod_dimension, $_cod_subdimension, $_cod_agrupacion, $_cod_objeto, $_numero_orden, $_cantidad_solicitada)
    {
        //Comprobamos si es un reactivo
        if (self::verificar_is_clase_objeto(REACTIVO, $_cod_objeto)) {

            $num_registros = DB::table('elementos_retenidos')
                ->where('cod_dimension', '=', $_cod_dimension)
                ->where('cod_subdimension', '=', $_cod_subdimension)
                ->where('cod_agrupacion', '=', $_cod_agrupacion)
                ->where('cod_objeto', '=', $_cod_objeto)
                ->where('numero_orden', '=', $_numero_orden)
                ->count();

            //Si no se encuentran elementos en retenidos es porque esta disponible
            return ($num_registros === 0);
        }
        else{
            $disponibilidad_elemento = DB::select(
                RAW("SELECT obtener_cantidad_disponible_elemento('".$_cod_dimension."', '".$_cod_subdimension."', '".$_cod_agrupacion."', '".$_cod_objeto."') AS disponibilidad"));

           
            return $disponibilidad_elemento[0]->disponibilidad >= $_cantidad_solicitada;
        }

    }
}

?>