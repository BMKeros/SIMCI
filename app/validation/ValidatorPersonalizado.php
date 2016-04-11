<?php

class ValidatorPersonalizado extends \Illuminate\Validation\Validator
{

    public function validateExistsElemento($field, $value, $parameters)
    {
        $values = explode('-', $value);

        $tmp_dimension = $values[0];
        $tmp_subdimension = $values[1];
        $tmp_agrupacion = $values[2];
        $tmp_objeto = $values[3];

        $existe = DB::table("inventario")
            ->where('cod_dimension', '=', $tmp_dimension)
            ->where('cod_subdimension', '=', $tmp_subdimension)
            ->where('cod_agrupacion', '=', $tmp_agrupacion)
            ->where('cod_objeto', '=', $tmp_objeto)
            ->count();

        return ($existe >= 1) ? (false): (true);
    }
}
