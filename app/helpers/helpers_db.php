<?php


function drop_cascade($table = null){
	DB::statement('DROP TABLE '.$table.' CASCADE;');
}