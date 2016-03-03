<?php

class FuncionesDBSeeder extends Seeder {


    public function run()
    {
    	$sql_funcion = 
		"CREATE OR REPLACE FUNCTION capitalize(text)".
		  "RETURNS text AS".
		"$BODY$".
		"declare".
			"total text;".
		"BEGIN".
		   "SELECT concat(UPPER(LEFT($1,1))::text , LOWER(SUBSTRING($1,2,length($1)))::text) into total;".
		   "RETURN total;".
		"END;".
		"$BODY$".
		  "LANGUAGE plpgsql VOLATILE".
		  "COST 100;".
		"ALTER FUNCTION capitalize(text)".
		  "OWNER TO postgres;";

       	DB::statement($sql_funcion);
    }
}