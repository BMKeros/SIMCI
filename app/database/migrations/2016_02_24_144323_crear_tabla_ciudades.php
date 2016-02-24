<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCiudades extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ciudades', function($table)
		{
			$table->increments('id_ciudad');
			$table->integer('id_estado');
			$table->string('ciudad', 200);
			$table->boolean('capital')->default(false);

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ciudades', function($table)
		{
			Schema::drop('ciudades');
		});
	}

}
