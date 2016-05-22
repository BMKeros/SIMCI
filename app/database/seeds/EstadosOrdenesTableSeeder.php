<?php

class EstadosOrdenesTableSeeder extends Seeder
{


    public function run()
    {
        DB::table('estados_ordenes')->delete();

        $campos = array(
            array('codigo' => 'E01', 'nombre' => 'Activ'),
            array('codigo' => 'E02', 'nombre' => 'Pendiente'),
            array('codigo' => 'E03', 'nombre' => 'Cancelada'),
            array('codigo' => 'E04', 'nombre' => 'Completada'),
        );

        DB::table('estados_ordenes')->insert($campos);
    }
}