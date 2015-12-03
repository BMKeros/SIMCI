<?php

class UsuariosseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();


        //$this->call('PermisosTableSeeder');
        $this->call('UsuariosTableSeeder');
    }
}

class UsuariosTableSeeder extends Seeder {

    public function run()
    {
        DB::table('usuarios')->delete();

        $usuario = new Usuario;

        $usuario->usuario = 'simci';
        $usuario->email = 'simci@gmail.com';
        $usuario->password = 'admin';
        $usuario->cod_permiso = 'ad40';

        $usuario->save();
    }
}

/*
class AlmacenTableSeeder extends Seeder {

    public function run()
    {
       DB::table('almacenes')->delete();

        $campos = array(array('cod_almacen' => '', 'id_responsable' => '', 'descripcion'=> ''),
        );

        DB::table('almacenes')->insert($campos);
    }
}

*/
