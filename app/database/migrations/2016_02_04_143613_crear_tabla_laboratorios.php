<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaLaboratorios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('laboratorios', function($table)
		{
			$table->string('codigo', 4);
			$table->string('nombre', 40);
			$table->string('descripcion', 150)->nullable();

			$table->increments('secuencia');
			$table->dropPrimary('secuencia');

			$table->primary('codigo');

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
		Schema::drop('laboratorios');
	}

}
