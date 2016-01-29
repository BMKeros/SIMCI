<?php

class UnidadesTableSeeder extends Seeder {


    public function run()
    {
       DB::table('unidades')->delete();

        $campos = array(
        	array('nombre' => 'mililitros', 'abreviatura'=>'ML'),
        	array('nombre' => 'miligramos', 'abreviatura'=>'MG'),
        	array('nombre' => 'gramos', 'abreviatura'=>'G'),
        	array('nombre' => 'kilogramos', 'abreviatura'=>'KG'),
        );

        DB::table('unidades')->insert($campos);
    }
}