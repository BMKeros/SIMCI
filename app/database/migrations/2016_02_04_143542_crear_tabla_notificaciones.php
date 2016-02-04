<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Notificaciones extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notificaciones', function($table)
		{
			$table->increments('id');
			$table->integer('mensaje_id');
			$table->date('fecha');
			$table->time('hora');
			$table->integer('emisor');
			$table->integer('receptor');
			$table->boolean('visto')->default(false);
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
		Schema::drop('notificaciones');
	}

}
