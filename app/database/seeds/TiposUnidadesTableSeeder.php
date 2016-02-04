<?php

class TiposUnidades extends Seeder {


    public function run()
    {
       DB::table('tipos_unidades')->delete();

        $campos = array(
        	array('nombre' => 'longitud'),
        	array('nombre' => 'peso'),
        	array('nombre' => 'temperatura'),
            array('nombre' => 'volumen'),
        	array('nombre' => 'otros')
        );

        DB::table('tipos_unidades')->insert($campos);
    }
}