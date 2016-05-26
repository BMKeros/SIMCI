<?php

class CondicionesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('condiciones')->delete();

        $campos = array(
            array('codigo' => ORDEN_ACTIVA, 'nombre' => 'Activa'),
            array('codigo' => ORDEN_PENDIENTE, 'nombre' => 'Pendiente'),
            array('codigo' => ORDEN_CANCELADA, 'nombre' => 'Cancelada'),
            array('codigo' => ORDEN_COMPLETADA, 'nombre' => 'Completada'),
            array('codigo' => DISPONIBLE, 'nombre' => 'Disponible'),
            array('codigo' => NO_DISPONIBLE, 'nombre' => 'No Disponible'),
            array('codigo' => RETENIDO, 'nombre' => 'Retenido'),
            array('codigo' => PEDIDO_CANCELADO, 'nombre' => 'Pedido Cancelado'),
            array('codigo' => PEDIDO_EN_ESPERA, 'nombre' => 'Pedido en Espera'),

        );

        DB::table('condiciones')->insert($campos);
    }
}