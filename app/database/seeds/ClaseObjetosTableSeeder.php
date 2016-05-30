<?php

class ClaseObjetosTableSeeder extends Seeder {


    public function run()
    {
       DB::table('clase_objetos')->delete();

        $campos = array(
            array('id' => REACTIVO, 'nombre' => 'Reactivo', 'descripcion' => 'reactivos quimicos'),
            array('id' => INSTRUMENTO, 'nombre' => 'Instrumento', 'descripcion' => 'intrumentos de laboratorio'),
            array('id' => EQUIPO, 'nombre' => 'Equipo', 'descripcion' => 'equipos de laboratorio')
        );

        DB::table('clase_objetos')->insert($campos);
    }
}