<?php

class UnidadesTableSeeder extends Seeder {


    public function run()
    {
       	DB::table('unidades')->delete();

        $campos = array(
        	array( "nombre"=>'metro', "abreviatura"=>'m', "tipo_unidad"=>'1'),
        	array( "nombre"=>'Pulgada', "abreviatura"=>'plg', "tipo_unidad"=>'1'),
        	array( "nombre"=>'Pie', "abreviatura"=>'ft', "tipo_unidad"=>'1
			'),array( "nombre"=>'Micro', "abreviatura"=>'µ', "tipo_unidad"=>'1
			'),array( "nombre"=>'Decimetro', "abreviatura"=>'dc', "tipo_unidad"=>'1
			'),array( "nombre"=>'Centimetro', "abreviatura"=>'cm', "tipo_unidad"=>'1
			'),array( "nombre"=>'Milimetro', "abreviatura"=>'mm', "tipo_unidad"=>'1
			'),array( "nombre"=>'Micrometro', "abreviatura"=>'µm', "tipo_unidad"=>'1
			'),array( "nombre"=>'Manometro', "abreviatura"=>'nm', "tipo_unidad"=>'1
			'),array( "nombre"=>'Picometro', "abreviatura"=>'pm', "tipo_unidad"=>'1
			'),array( "nombre"=>'Libra', "abreviatura"=>'lb', "tipo_unidad"=>'2
			'),array( "nombre"=>'Onza', "abreviatura"=>'oz', "tipo_unidad"=>'2
			'),array( "nombre"=>'Decigramo', "abreviatura"=>'dg', "tipo_unidad"=>'2
			'),array( "nombre"=>'Centigrados', "abreviatura"=>'cg', "tipo_unidad"=>'2
			'),array( "nombre"=>'Miligramos', "abreviatura"=>'mg', "tipo_unidad"=>'2
			'),array( "nombre"=>'Microgramos', "abreviatura"=>'µg', "tipo_unidad"=>'2
			'),array( "nombre"=>'Manogramos', "abreviatura"=>'ng', "tipo_unidad"=>'2
			'),array( "nombre"=>'Picogramos', "abreviatura"=>'pg', "tipo_unidad"=>'2
			'),array( "nombre"=>'Decagramos', "abreviatura"=>'deg', "tipo_unidad"=>'2
			'),array( "nombre"=>'Hectogramos', "abreviatura"=>'Hg', "tipo_unidad"=>'2'),
			array( "nombre"=>'Kilogramos', "abreviatura"=>'Kg', "tipo_unidad"=>'2'),
			array( "nombre"=>'Miriagramos', "abreviatura"=>'Mig', "tipo_unidad"=>'2'),
			array( "nombre"=>'Fahreheint', "abreviatura"=>'F', "tipo_unidad"=>'3'),
			array( "nombre"=>'Kelvin', "abreviatura"=>'K', "tipo_unidad"=>'3'),
			array( "nombre"=>'Celsius', "abreviatura"=>'C', "tipo_unidad"=>'3'),
			array( "nombre"=>'Galon', "abreviatura"=>'gal', "tipo_unidad"=>'4'),
			array( "nombre"=>'Pie cubico', "abreviatura"=>'pie3', "tipo_unidad"=>'4'),
			array( "nombre"=>'Decimetros cubicos', "abreviatura"=>'dm3', "tipo_unidad"=>'4'),
			array( "nombre"=>'Centimetros cubicos', "abreviatura"=>'cm3', "tipo_unidad"=>'4'),
			array( "nombre"=>'Milimetros cubicos', "abreviatura"=>'mm3', "tipo_unidad"=>'4'),
			array( "nombre"=>'Micrometros cubicos', "abreviatura"=>'µm3', "tipo_unidad"=>'4'),
			array( "nombre"=>'Manometros cubicos', "abreviatura"=>'nm3', "tipo_unidad"=>'4'),
			array( "nombre"=>'Picometros cubicos', "abreviatura"=>'pm3', "tipo_unidad"=>'4'),
			array( "nombre"=>'Decametros cubicos', "abreviatura"=>'dem3', "tipo_unidad"=>'4'),
			array( "nombre"=>'Hectometros cubicos', "abreviatura"=>'Hm3', "tipo_unidad"=>'4'),
			array( "nombre"=>'Kilometros cubicos', "abreviatura"=>'km3', "tipo_unidad"=>'4'),
			array( "nombre"=>'Miriametros cubicos', "abreviatura"=>'Min3', "tipo_unidad"=>'4'),
			array( "nombre"=>'Decametros', "abreviatura"=>'dem', "tipo_unidad"=>'1'),
			array( "nombre"=>'Hectometros', "abreviatura"=>'Hm', "tipo_unidad"=>'1'),
			array( "nombre"=>'Kilometros', "abreviatura"=>'Km', "tipo_unidad"=>'1'),
			array( "nombre"=>'Miriametros', "abreviatura"=>'Min', "tipo_unidad"=>'1'),
			array( "nombre"=>'Tonelada metrica', "abreviatura"=>'t', "tipo_unidad"=>'2'),
			array( "nombre"=>'Cajas', "abreviatura"=>'caj', "tipo_unidad"=>'5'),
			array( "nombre"=>'Unidad', "abreviatura"=>'unid', "tipo_unidad"=>'5'),
			array( "nombre"=>'Sacos', "abreviatura"=>'sac', "tipo_unidad"=>'5')
		);

        DB::table('unidades')->insert($campos);
    }
}

