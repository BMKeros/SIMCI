<?php

class ClasificacionElementosSeeder extends Seeder {

    public function run()
    {
       DB::table('clasificacion_elementos')->delete();

        $campos = array(
            array('cod_clasificacion' => 10, 'descripcion' => 'Metales'),
        	array('cod_clasificacion' => 20, 'descripcion' => 'No Metales'),
        	array('cod_clasificacion' => 30, 'descripcion' => 'Metaloides'),
        	array('cod_clasificacion' => 40, 'descripcion' => 'Sin clasificacion'),
        );

        DB::table('clasificacion_elementos')->insert($campos);
    }
}
