<?php

class TiposUsuarioTableSeeder extends Seeder {

    public function run()
    {
       DB::table('tipos_usuario')->delete();

        $campos = array(array('codigo' => 'tu01', 'descripcion' => 'Root'),
        	array('codigo' => 'tu02', 'descripcion' => 'Administrador'),
        	array('codigo' => 'tu03', 'descripcion' => 'Profesor'),
        	array('codigo' => 'tu04', 'descripcion' => 'Estudiante'),
        	array('codigo' => 'tu05', 'descripcion' => 'Almacenista'),
        	array('codigo' => 'tu06', 'descripcion' => 'Supervisor'),
        );

        DB::table('tipos_usuario')->insert($campos);
    }
}
