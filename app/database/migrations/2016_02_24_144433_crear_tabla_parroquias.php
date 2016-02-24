<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaParroquias extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('parroquias', function($table)
		{
			$table->increments('id_parroquia');
			$table->integer('id_municipio');
			$table->string('parroquia', 250);

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('parroquias', function($table)
		{
			Schema::drop('parroquias');
		});
	}

}
