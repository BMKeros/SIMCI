<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearIndexTablas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	//prueba
	
	public function up()
	{
		//ELEMENTOS QUIMICOS
		Schema::table('elementos_quimicos', function($table){
    		$table->foreign('cod_estado')->references('cod_estado')
    			->on('estados_materia');
    			//->onDelete('cascade');
    		$table->foreign('cod_clasificacion')->references('cod_clasificacion')
    			->on('clasificacion_elementos');
    			//->onDelete('cascade');
    		$table->foreign('cod_subclasificacion')->references('cod_subclasificacion')
    			->on('subclasificacion_elementos');
    			//->onDelete('cascade');
		});

		//USUARIOS
		Schema::table('usuarios', function($table){
		
			$table->foreign('cod_tipo_usuario')->references('codigo')
				->on('tipos_usuario');
				//->onDelete('cascade');
		});

		//PERSONAS
		Schema::table('personas', function($table){

			$table->foreign('usuario_id')->references('id')
				->on('usuarios')
				->onDelete('cascade');

			$table->foreign('sexo_id')->references('id')
				->on('sexos');
				//->onDelete('cascade');
		});

		//ALMACENES
		Schema::table('almacenes', function($table){
			$table->foreign('responsable')->references('id')
				->on('personas');
				//->onDelete('cascade');

			$table->foreign('primer_auxiliar')->references('id')
				->on('personas');
				//->onDelete('cascade');

			$table->foreign('segundo_auxiliar')->references('id')
				->on('personas');
				//->onDelete('cascade');
		});

		//CATALOGO
		Schema::table('catalogo_objetos', function($table){
			$table->foreign('cod_unidad')->references('cod_unidad')
				->on('unidades');
				//->obDelete('cascade');
			$table->foreign('cod_clase_objeto')->references('id')
				->on('clase_objetos');
				//->onDelete('cascade');
		});

		//NOTIFICACIONES
		Schema::table('notificaciones', function($table){
			$table->foreign('mensaje_id')->references('id')
				->on('mensajes');

			$table->foreign('emisor')->references('id')
				->on('usuarios');

			$table->foreign('receptor')->references('id')
				->on('usuarios');
		});

		//UNIDADES
		Schema::table('unidades', function($table){
			$table->foreign('tipo_unidad')->references('id')
				->on('tipos_unidades');
		});

		//INVENTARIO
		Schema::table('inventario', function($table){
			$table->foreign('cod_dimension')->references('codigo')
				->on('almacenes');

			$table->foreign('cod_subdimension')->references('codigo')
				->on('sub_dimensiones');

			$table->foreign('cod_agrupacion')->references('codigo')
				->on('agrupaciones');

			/*$table->foreign('cod_subagrupacion')->references('codigo')
				->on('sub_agrupaciones');*/

			$table->foreign('cod_objeto')->references('id')
				->on('catalogo_objetos');
		});

		//CIUDADES
		Schema::table('ciudades', function($table){
			$table->foreign('id_estado')->references('id_estado')
				->on('estados');
		});

		//MUNICIPIOS
		Schema::table('municipios', function($table){
			$table->foreign('id_estado')->references('id_estado')
				->on('estados');
		});

		//PARROQUIAS
		Schema::table('parroquias', function($table){
			$table->foreign('id_municipio')->references('id_municipio')
				->on('municipios');
		});

		//ENTRADAS-INVENTARIO
		Schema::table('entradas_inventario', function($table){
			
			$table->foreign('id_proveedor')->references('codigo')
				->on('proveedores');

			$table->foreign('id_usuario')->references('id')
				->on('usuarios');

			$table
				->foreign(array('cod_dimension','cod_subdimension','cod_agrupacion','cod_objeto'))
				->references(array('cod_dimension','cod_subdimension','cod_agrupacion','cod_objeto'))
				->on('inventario');
		});

		//SALIDAS-INVENTARIOS
		Schema::table('salidas_inventario', function($table){
			$table->foreign('id_usuario')->references('id')
				->on('usuarios');
				
			$table
				->foreign(array('cod_dimension','cod_subdimension','cod_agrupacion','cod_objeto'))
				->references(array('cod_dimension','cod_subdimension','cod_agrupacion','cod_objeto'))
				->on('inventario');
		});

		//OBJETOS-LABORATORIO

		Schema::table('objetos_laboratorio', function($table){
			$table->foreign('cod_laboratorio')->references('codigo')
				->on('laboratorios');

			$table->foreign(array('cod_dimension','cod_subdimension','cod_agrupacion','cod_objeto'))
				->references(array('cod_dimension','cod_subdimension','cod_agrupacion','cod_objeto'))
				->on('inventario');

			$table->foreign('cod_objeto')->references('id')
				->on('catalogo_objetos');
		});

	}	


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

	}

}
