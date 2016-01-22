<?php

class UnidadesTableSeeder extends Seeder {


    public function run()
    {
       DB::table('unidades')->delete();

        $campos = array(
        	array('cod_unidad' => '1', 'descripcion' => 'mililitros', 'abreviatura'=>'ML'),
        	array('cod_unidad' => '2', 'descripcion' => 'miligramos', 'abreviatura'=>'MG'),
        	array('cod_unidad' => '3', 'descripcion' => 'gramos', 'abreviatura'=>'G'),
        	array('cod_unidad' => '4', 'descripcion' => 'kilogramos', 'abreviatura'=>'KG'),
            
        );

        DB::table('unidades')->insert($campos);
    }
}