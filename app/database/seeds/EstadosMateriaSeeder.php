<?php

class EstadosMateriaSeeder extends Seeder {

    public function run()
    {
       DB::table('estados_materia')->delete();

        $campos = array(
            array('cod_estado' => 1, 'descripcion' => 'Gas'),
            array('cod_estado' => 2, 'descripcion' => 'Solido (No Magnetico)'),
            array('cod_estado' => 3, 'descripcion' => 'Solido (Diamagnetico)'),
            array('cod_estado' => 4, 'descripcion' => 'Gas (Paramagnetico)'),
            array('cod_estado' => 5, 'descripcion' => 'Gas (No Magnetico)'),
            array('cod_estado' => 6, 'descripcion' => 'Solido (Paramagnetico)'),
            array('cod_estado' => 7, 'descripcion' => 'Solido'),
            array('cod_estado' => 8, 'descripcion' => 'Solido (Ferromagnetico)'),
            array('cod_estado' => 9, 'descripcion' => 'Liquido (muy Movil y Volatil)'),
            array('cod_estado' => 10, 'descripcion' => 'Sin Estado'),
            array('cod_estado' => 11, 'descripcion' => 'Liquido'),
            array('cod_estado' => 12, 'descripcion' => 'Desconocido'),
            array('cod_estado' => 13, 'descripcion' => 'Solido (predicción)'),
        );

        DB::table('estados_materia')->insert($campos);
    }
}
