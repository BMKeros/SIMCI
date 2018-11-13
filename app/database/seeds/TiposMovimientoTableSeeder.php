<?php

class TiposMovimientoTableSeeder extends Seeder
{


    public function run()
    {
        DB::table('tipos_movimientos')->delete();
        
        $MOV01 = array('id' => 1, 'descripcion' => 'ENTRADA POR PROVEEDOR');
        $MOV02 = array('id' => 2, 'descripcion' => 'ENTRADA POR DONACON');
        $MOV03 = array('id' => 3, 'descripcion' => 'SALIDA POR PEDIDO');
        $MOV04 = array('id' => 4, 'descripcion' => 'SALIDA POR PERDIDA');
        $MOV05 = array('id' => 5, 'descripcion' => 'SALIDA DESCONOCIDA');
        $MOV06 = array('id' => 6, 'descripcion' => 'RETENIDO STOCK');
        $MOV07 = array('id' => 7, 'descripcion' => 'RETENIDO POR PEDIDO');

        $campos = array(
            array('id' => get_value_to_key($MOV01, 'id'), 'nombre' => get_value_to_key($MOV01, 'descripcion'), 'descripcion' => get_value_to_key($MOV01, 'descripcion'), 'created_at' => get_now()),
            array('id' => get_value_to_key($MOV02, 'id'), 'nombre' => get_value_to_key($MOV02, 'descripcion'), 'descripcion' => get_value_to_key($MOV02, 'descripcion'), 'created_at' => get_now()),
            array('id' => get_value_to_key($MOV03, 'id'), 'nombre' => get_value_to_key($MOV03, 'descripcion'), 'descripcion' => get_value_to_key($MOV03, 'descripcion'), 'created_at' => get_now()),
            array('id' => get_value_to_key($MOV04, 'id'), 'nombre' => get_value_to_key($MOV04, 'descripcion'), 'descripcion' => get_value_to_key($MOV04, 'descripcion'), 'created_at' => get_now()),
            array('id' => get_value_to_key($MOV05, 'id'), 'nombre' => get_value_to_key($MOV05, 'descripcion'), 'descripcion' => get_value_to_key($MOV05, 'descripcion'), 'created_at' => get_now()),
            array('id' => get_value_to_key($MOV06, 'id'), 'nombre' => get_value_to_key($MOV06, 'descripcion'), 'descripcion' => get_value_to_key($MOV06, 'descripcion'), 'created_at' => get_now()),
            array('id' => get_value_to_key($MOV07, 'id'), 'nombre' => get_value_to_key($MOV07, 'descripcion'), 'descripcion' => get_value_to_key($MOV07, 'descripcion'), 'created_at' => get_now()),
        );

        DB::table('tipos_movimientos')->insert($campos);
    }
}
