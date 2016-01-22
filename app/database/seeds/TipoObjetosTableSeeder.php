<?php

class TipoObjetosTableSeeder extends Seeder {


    public function run()
    {
       DB::table('tipo_objetos')->delete();

        $campos = array(
        	array('nombre' => 'Reactivo', 'descripcion' => 'reactivos quimicos'),
            array('nombre' => 'Instrumento', 'descripcion'=> 'intrumentos de laboratorio'),
            array('nombre' => 'Equipo', 'descripcion'=> 'equipos de laboratorio')
        );

        DB::table('tipo_objetos')->insert($campos);
    }
}