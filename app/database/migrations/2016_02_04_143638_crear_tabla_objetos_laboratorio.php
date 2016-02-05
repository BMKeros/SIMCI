<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaObjetosLaboratorio extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('objetos_laboratorio', function($table)
		{
			$table->increments('id');
			$table->string('cod_laboratorio');
			$table->integer('cod_objeto');

			//este campo esta tentativo
			$table->integer('cod_clase_objeto');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('objetos_laboratorio');
	}

}
