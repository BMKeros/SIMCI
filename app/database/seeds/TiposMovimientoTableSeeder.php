<?php

class TiposMovimientoTableSeeder extends Seeder
{


    public function run()
    {
        DB::table('tipos_movimientos')->delete();

        $campos = array(
            array('id' => get_value_to_key(MOV01, 'id'), 'nombre' => get_value_to_key(MOV01, 'descripcion'), 'descripcion' => get_value_to_key(MOV01, 'descripcion'), 'created_at' => get_now()),
            array('id' => get_value_to_key(MOV02, 'id'), 'nombre' => get_value_to_key(MOV02, 'descripcion'), 'descripcion' => get_value_to_key(MOV01, 'descripcion'), 'created_at' => get_now()),
            array('id' => get_value_to_key(MOV03, 'id'), 'nombre' => get_value_to_key(MOV03, 'descripcion'), 'descripcion' => get_value_to_key(MOV01, 'descripcion'), 'created_at' => get_now()),
            array('id' => get_value_to_key(MOV04, 'id'), 'nombre' => get_value_to_key(MOV04, 'descripcion'), 'descripcion' => get_value_to_key(MOV01, 'descripcion'), 'created_at' => get_now()),
            array('id' => get_value_to_key(MOV05, 'id'), 'nombre' => get_value_to_key(MOV05, 'descripcion'), 'descripcion' => get_value_to_key(MOV01, 'descripcion'), 'created_at' => get_now()),
            array('id' => get_value_to_key(MOV06, 'id'), 'nombre' => get_value_to_key(MOV06, 'descripcion'), 'descripcion' => get_value_to_key(MOV01, 'descripcion'), 'created_at' => get_now()),
            array('id' => get_value_to_key(MOV07, 'id'), 'nombre' => get_value_to_key(MOV07, 'descripcion'), 'descripcion' => get_value_to_key(MOV01, 'descripcion'), 'created_at' => get_now()),
        );

        DB::table('tipos_movimientos')->insert($campos);
    }
}