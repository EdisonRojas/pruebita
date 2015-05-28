<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensajeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mensajes', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->unsignedInteger('usuario_id');
			$table->foreign('usuario_id')->references('id')->on('usuarios');
			
			$table->string('nombre');
			$table->string('apellido');
			$table->string('correo');
			$table->string('asunto');
			$table->string('mensaje');
			$table->string('estatus_visto');
			
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
		Schema::drop('mensajes');
	}

}
