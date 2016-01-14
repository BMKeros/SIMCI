<?php

class SexosTableSeeder extends Seeder {


    public function run()
    {
       DB::table('sexos')->delete();

        $campos = array(
        	array('id' => '40010', 'descripcion' => 'Masculino'),
            array('id' => '40011', 'descripcion'=> 'Femenino')
        );

        DB::table('sexos')->insert($campos);
    }
}