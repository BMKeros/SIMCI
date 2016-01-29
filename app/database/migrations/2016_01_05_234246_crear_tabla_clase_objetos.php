<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaClaseObjetos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clase_objetos', function($table)
		{
			$table->increments('id');
			$table->string('nombre',30);
			$table->string('descripcion',50);
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
		drop_cascade('clase_objetos');
	}

}
