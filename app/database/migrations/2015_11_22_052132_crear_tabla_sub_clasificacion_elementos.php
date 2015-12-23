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
			$table->integer('cod_clasificacion');
			$table->integer('cod_subclasificacion');
			$table->primary('cod_subclasificacion');
			$table->string('descripcion', 25);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		drop_cascade('subclasificacion_elementos');
	}

}
