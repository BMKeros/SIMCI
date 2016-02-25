<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaProveedores extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proveedores', function($table)
		{
			$table->string('codigo',5);
			$table->primary('codigo');
			$table->string('razon_social', 50);
			$table->string('doc_identificacion', 11);
			$table->string('telefono_fijo1', 15);
			$table->string('telefono_fijo2', 15)->nullable();
			$table->string('telefono_movil1', 15);
			$table->string('telefono_movil2', 15)->nullable();
			$table->string('email',100);
			$table->string('direccion', 200);
			//$table->integer('pais');
			$table->integer('cod_estado');
			$table->integer('cod_ciudad');
			$table->integer('cod_municipio');
			$table->integer('cod_parroquia');
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
		Schema::drop('proveedores');
	}

}
