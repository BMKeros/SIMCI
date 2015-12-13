<?php


function drop_cascade($table = null){
	if( Schema::hasTable($table) ){
		DB::statement('DROP TABLE '.$table.' CASCADE;');
	}

}