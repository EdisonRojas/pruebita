<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDenunciaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('denuncias', function(Blueprint $table)
		{
			

			$table->increments('id');
			$table->unsignedInteger('denunciante_id');
			$table->foreign('denunciante_id')->references('id')->on('usuarios');
			
			$table->integer('denunciado_id');
			$table->string('tipodedenuncia');
			$table->string('motivo');
			
			$table->integer('identificativo');
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
		Schema::drop('denuncias');
	}

}
