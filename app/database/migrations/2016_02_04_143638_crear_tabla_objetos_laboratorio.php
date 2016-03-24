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
			$table->string('cod_laboratorio', 4);
			$table->integer('cod_objeto');
			$table->nullableTimestamps();
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
