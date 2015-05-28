<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Jenssegers\Date\Date;
class CreateAnuncioTable extends Migration {
/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('anuncios', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->unsignedInteger('seccion_id');
			$table->foreign('seccion_id')->references('id')->on('secciones');
			$table->unsignedInteger('estado_id');
			$table->foreign('estado_id')->references('id')->on('estados');
			$table->unsignedInteger('usuario_id');
			$table->foreign('usuario_id')->references('id')->on('usuarios');

			$table->unsignedInteger('categoria_id');
			$table->foreign('categoria_id')->references('id')->on('categorias');

			$table->unsignedInteger('subcategoria_id');
			$table->foreign('subcategoria_id')->references('id')->on('subcategorias');
			



			$table->string('titulo');
			$table->text('descripcion');
			
			$table->string('imagen');
			$table->string('foto1')->nullable();
			$table->string('foto2')->nullable();
			$table->string('foto3')->nullable();
			$table->string('foto4')->nullable();


			$table->integer('valor');

			$table->string('opcionvalor');
			$table->string('estado');
			$table->string('tipo');
			
			$table->timestamp('publicaciondate');//->default(Date::now());
			
			$table->timestamp('expiradate');//->default(Date::now());
			$table->integer('pregunta');

			$table->string('estatus_revision');
			$table->integer('admin');

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
		Schema::drop('anuncios');
	}

}
