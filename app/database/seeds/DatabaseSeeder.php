<?php

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        //Deben migrarse las tablas que continen datos primarios para que no
        // haya problema con las hijas que dependen de ellas

        $this->call('PermisosTableSeeder');
        $this->call('TiposUnidadesTableSeeder');
        $this->call('TiposUsuarioTableSeeder');
        $this->call('UnidadesTableSeeder');
        $this->call('ClaseObjetosTableSeeder');
        $this->call('CondicionesTableSeeder');
        $this->call('TiposMovimientoTableSeeder');
        $this->call('UsuariosTableSeeder');
        $this->call('ClasificacionElementosSeeder');
        $this->call('SubClasificacionElementosSeeder');
        $this->call('EstadosMateriaSeeder');
        $this->call('ElementosQuimicosTableSeeder');
        $this->call('SexosTableSeeder');
        $this->call('EstadosTableSeeder');
        $this->call('CiudadesTableSeeder');
        $this->call('MunicipiosTableSeeder');
        $this->call('ParroquiasTableSeeder');
        $this->call('FuncionesDBSeeder');
        $this->call('VistasDBSeeder');

    }
}

