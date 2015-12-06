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
		Schema::create('sub_clasificacion_elementos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cod_subclasificacion');
			$table->string('descripcion', 20);
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
		Schema::drop('sub_clasificacion_elementos');
	}

}
