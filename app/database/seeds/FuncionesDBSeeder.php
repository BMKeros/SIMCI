<?php

class FuncionesDBSeeder extends Seeder {


    public function run()
    {
    	$path_file = PATH_ARCHIVOS_SQL."/funciones.sql";
    	
    	if(file_exists($path_file)){
    		$sql_funcion = file_get_contents($path_file);
    	}else{
    		$sql_funcion = "";
    	}
    	
       	DB::statement($sql_funcion);
    }
}