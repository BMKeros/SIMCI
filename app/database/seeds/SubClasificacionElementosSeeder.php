<?php

class SubClasificacionElementosSeeder extends Seeder {

    public function run()
    {
       DB::table('subclasificacion_elementos')->delete();

        $campos = array(
            array('cod_clasificacion' => 10,'cod_subclasificacion' => 101, 'descripcion' => 'Alcalinos'),
        	array('cod_clasificacion' => 10,'cod_subclasificacion' => 102, 'descripcion' => 'Alcalinotérreos'),
        	array('cod_clasificacion' => 10,'cod_subclasificacion' => 103, 'descripcion' => 'Lantanidos'),
            array('cod_clasificacion' => 10,'cod_subclasificacion' => 104, 'descripcion' => 'Actinidos'),
            array('cod_clasificacion' => 10,'cod_subclasificacion' => 105, 'descripcion' => 'Metales de Transición'),
            array('cod_clasificacion' => 10,'cod_subclasificacion' => 106, 'descripcion' => 'Metales de Bloque P'),
            array('cod_clasificacion' => 20,'cod_subclasificacion' => 201, 'descripcion' => 'Halogenos'),
            array('cod_clasificacion' => 20,'cod_subclasificacion' => 202, 'descripcion' => 'Otros no Metales'),
            array('cod_clasificacion' => 20,'cod_subclasificacion' => 203, 'descripcion' => 'Gases Nobles'),
        	array('cod_clasificacion' => 40,'cod_subclasificacion' => 400, 'descripcion' => 'Sin clasificacion'),
        );

        DB::table('subclasificacion_elementos')->insert($campos);
    }
}
