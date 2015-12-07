<?php

class AlmacenesTableSeeder extends Seeder {

    public function run()
    {
       DB::table('almacenes')->delete();

        $campos = array(array('cod_almacen' => '', 'id_responsable' => '', 'descripcion'=> ''),
        );

        DB::table('almacenes')->insert($campos);
    }
}
