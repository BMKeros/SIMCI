<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearIndexTablas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//ELEMENTOS QUIMICOS
		Schema::table('elementos_quimicos', function($table){
    		$table->foreign('cod_estado')->references('id')
    			->on('estados_materia')
    			->onDelete('cascade');;
    		$table->foreign('cod_clasificacion')->references('id')
    			->on('clasificacion_elementos')
    			 ->onDelete('cascade');
    		$table->foreign('cod_sub_clasificacion')->references('id')
    			->on('sub_clasificacion_elementos')
    			->onDelete('cascade');
		});

		//USUARIOS
		Schema::table('usuarios', function($table){
			/*$table->foreign('cod_permiso')->references('id')
				->on('permisos')
				->onDelete('cascade');*/
		});

		//PERSONAS
		Schema::table('personas', function($table){

			$table->foreign('sexo_id')->references('id')
				->on('sexos')
				->onDelete('cascade');
		});

		//ALMACENES
		Schema::table('almacenes', function($table){
			$table->foreign('responsable')->references('id')
				->on('personas')
				->onDelete('cascade');

			$table->foreign('primer_auxiliar')->references('id')
				->on('personas')
				->onDelete('cascade');

			$table->foreign('segundo_auxiliar')->references('id')
				->on('personas')
				->onDelete('cascade');
		});
	}	



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}