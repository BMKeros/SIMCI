<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAgrupacion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('agrupaciones', function(Blueprint $table)
		{
			$table->string('codigo', 3);
			$table->primary('codigo');
			$table->string('nombre', 20);
			$table->string('descripcion', 50);
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
		Schema::drop('agrupaciones');
	}

}
