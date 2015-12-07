<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSubClasificacionElementos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subclasificacion_elementos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cod_subclasificacion');
			$table->string('descripcion', 20);
			
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
		Schema::drop('subclasificacion_elementos');
	}

}
