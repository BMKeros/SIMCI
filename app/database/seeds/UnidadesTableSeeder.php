<?php

class UnidadesTableSeeder extends Seeder {


    public function run()
    {
       DB::table('unidades')->delete();

        $campos = array(
        	array('cod_unidad' => '1', 'nombre' => 'mililitros', 'abreviatura'=>'ML'),
        	array('cod_unidad' => '2', 'nombre' => 'miligramos', 'abreviatura'=>'MG'),
        	array('cod_unidad' => '3', 'nombre' => 'gramos', 'abreviatura'=>'G'),
        	array('cod_unidad' => '4', 'nombre' => 'kilogramos', 'abreviatura'=>'KG'),
        );

        DB::table('unidades')->insert($campos);
    }
}