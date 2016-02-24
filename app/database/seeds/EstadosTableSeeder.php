<?php

class EstadosTableSeeder extends Seeder {


    public function run()
    {
       	DB::table('estados')->delete();
        
        $estados = array(
		  array('id_estado' => '1','estado' => 'Amazonas','iso_3166-2' => 'VE-X'),
		  array('id_estado' => '2','estado' => 'Anzoátegui','iso_3166-2' => 'VE-B'),
		  array('id_estado' => '3','estado' => 'Apure','iso_3166-2' => 'VE-C'),
		  array('id_estado' => '4','estado' => 'Aragua','iso_3166-2' => 'VE-D'),
		  array('id_estado' => '5','estado' => 'Barinas','iso_3166-2' => 'VE-E'),
		  array('id_estado' => '6','estado' => 'Bolívar','iso_3166-2' => 'VE-F'),
		  array('id_estado' => '7','estado' => 'Carabobo','iso_3166-2' => 'VE-G'),
		  array('id_estado' => '8','estado' => 'Cojedes','iso_3166-2' => 'VE-H'),
		  array('id_estado' => '9','estado' => 'Delta Amacuro','iso_3166-2' => 'VE-Y'),
		  array('id_estado' => '10','estado' => 'Falcón','iso_3166-2' => 'VE-I'),
		  array('id_estado' => '11','estado' => 'Guárico','iso_3166-2' => 'VE-J'),
		  array('id_estado' => '12','estado' => 'Lara','iso_3166-2' => 'VE-K'),
		  array('id_estado' => '13','estado' => 'Mérida','iso_3166-2' => 'VE-L'),
		  array('id_estado' => '14','estado' => 'Miranda','iso_3166-2' => 'VE-M'),
		  array('id_estado' => '15','estado' => 'Monagas','iso_3166-2' => 'VE-N'),
		  array('id_estado' => '16','estado' => 'Nueva Esparta','iso_3166-2' => 'VE-O'),
		  array('id_estado' => '17','estado' => 'Portuguesa','iso_3166-2' => 'VE-P'),
		  array('id_estado' => '18','estado' => 'Sucre','iso_3166-2' => 'VE-R'),
		  array('id_estado' => '19','estado' => 'Táchira','iso_3166-2' => 'VE-S'),
		  array('id_estado' => '20','estado' => 'Trujillo','iso_3166-2' => 'VE-T'),
		  array('id_estado' => '21','estado' => 'Vargas','iso_3166-2' => 'VE-W'),
		  array('id_estado' => '22','estado' => 'Yaracuy','iso_3166-2' => 'VE-U'),
		  array('id_estado' => '23','estado' => 'Zulia','iso_3166-2' => 'VE-V'),
		  array('id_estado' => '24','estado' => 'Distrito Capital','iso_3166-2' => 'VE-A'),
		  array('id_estado' => '25','estado' => 'Dependencias Federales','iso_3166-2' => 'VE-Z')
		);

        DB::table('estados')->insert($estados);
    }
}