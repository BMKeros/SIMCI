<?php

class FuncionesDBSeeder extends Seeder {


    public function run()
    {
    	$path_file = PATH_ARCHIVOS_SQL."/funciones.sql";
    	
    	if(file_exists($path_file)){
    		$comando = sprintf("export PGPASSWORD=%s && psql -U %s -d %s < '%s'",$_ENV["DB_PASS"],$_ENV["DB_USER"],$_ENV["DB_NAME"],$path_file);
    		
    		$res = exec($comando);

    		$this->command->info($res);
    	}
    }
}