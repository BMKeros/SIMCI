<?php

class TiposUsuarioTableSeeder extends Seeder {

    public function run()
    {
       DB::table('tipos_usuario')->delete();

        $campos = array(
        	array('codigo' => 'TU01', 'descripcion' => 'Root'),
        	array('codigo' => 'TU02', 'descripcion' => 'Administrador'),
        	array('codigo' => 'TU03', 'descripcion' => 'Profesor'),
        	array('codigo' => 'TU04', 'descripcion' => 'Estudiante'),
        	array('codigo' => 'TU05', 'descripcion' => 'Almacenista'),
        	array('codigo' => 'TU06', 'descripcion' => 'Supervisor'),
        );

        DB::table('tipos_usuario')->insert($campos);
    }
}
