<?php

class CondicionesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('condiciones')->delete();

        $campos = array(
            array('codigo' => ACTIVA, 'nombre' => 'Activo(a)'),
            array('codigo' => PENDIENTE, 'nombre' => 'Pendiente'),
            array('codigo' => CANCELADA, 'nombre' => 'Cancelado(a)'),
            array('codigo' => COMPLETADA, 'nombre' => 'Completado(a)'),
            array('codigo' => DISPONIBLE, 'nombre' => 'Disponible'),
            array('codigo' => NO_DISPONIBLE, 'nombre' => 'No Disponible'),
            array('codigo' => RETENIDO, 'nombre' => 'Retenido(a)'),
            array('codigo' => EN_ESPERA, 'nombre' => 'En Espera'),

        );

        DB::table('condiciones')->insert($campos);
    }
}