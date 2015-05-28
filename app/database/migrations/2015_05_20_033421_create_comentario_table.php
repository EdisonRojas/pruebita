<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comentarios', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('anuncio_id');

			$table->unsignedInteger('usuario_id');
			$table->foreign('usuario_id')->references('id')->on('usuarios');

			$table->text('comentario');

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
			Schema::drop('comentarios');
	}

}
