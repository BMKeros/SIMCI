<?php

class SexosTableSeeder extends Seeder {


    public function run()
    {
       DB::table('sexos')->delete();

        $campos = array(
        	array('id' => '10', 'descripcion' => 'Masculino'),
            array('id' => '20', 'descripcion'=> 'Femenino')
        );

        DB::table('sexos')->insert($campos);
    }
}