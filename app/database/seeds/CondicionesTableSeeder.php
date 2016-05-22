<?php

class CondicionesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('estados_ordenes')->delete();

        $campos = array(
            array('codigo' => ORDEN_ACTIVA, 'nombre' => 'Activa'),
            array('codigo' => ORDEN_PENDIENTE, 'nombre' => 'Pendiente'),
            array('codigo' => ORDEN_CANCELADA, 'nombre' => 'Cancelada'),
            array('codigo' => ORDEN_COMPLETADA, 'nombre' => 'Completada'),
            array('codigo' => DISPONIBLE, 'nombre' => 'Disponible'),
            array('codigo' => NO_DISPONIBLE, 'nombre' => 'No Disponible'),
            array('codigo' => RETENIDO, 'nombre' => 'Retenido'),

        );

        DB::table('estados_ordenes')->insert($campos);
    }
}