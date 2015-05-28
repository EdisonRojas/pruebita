<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioTable extends Migration {
public function up()
	{
		Schema::create('usuarios', function(Blueprint $table)
		{
			$table->increments('id');
			
			//referencias externas para las otras tablas
			
			//Referencias para la tabla roles
		
			
			//Referencias para la tabla colroeselulares
			$table->unsignedInteger('compania_id');
			$table->foreign('compania_id')->references('id')->on('companias');
			
			$table->unsignedInteger('rol_id');
			$table->foreign('rol_id')->references('id')->on('roles');

			$table->unsignedInteger('estado_id');
			$table->foreign('estado_id')->references('id')->on('estados');
			//Atributos de la tabla usuarios
			$table->string('twitter_id')->nullable();
			
			$table->string('nombres',30);
			$table->char('genero', 4);
			
			$table->string('correo');
			$table->string('foto');

			$table->boolean('bandera_social');
			$table->string('password',750);

			//random usado para activar la cuenta de usuario despuésde registro
			//llave unica
			$table->string('random',50)->nullable();
			$table->string('tokenpass',100)->nullable();
			$table->string('telefono',9)->nullable();
			$table->string('celular',10)->nullable();
			$table->string('slug');
			$table->rememberToken();
			//atributo pra determinar si el usuario a cambiado su nombre
			//puede cambiar su nombre una sola vez
			$table->boolean('cambio');
			//para añadir las columnas created_at y updated_at
			$table->timestamps();
			$table->boolean('nav_avanzada');
			$table->integer('msm');

			
		});
	}


	public function down()
	{
		Schema::drop('usuarios');
		
	}


}
