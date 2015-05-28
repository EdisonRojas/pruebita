<?php namespace Anuncia\Asistentes;

class Cartero{

	public function cartaRegistro($usuario){
		//$usuario=$this->usuario;

		$random=array('random'=>$usuario->random);

		
		//\Mail::queue('cartas.registro', $this->data2, function($message) use ($usuario)
		\Mail::send('cartas.registro', $random, function($message) use ($usuario)
		{
			$message->to($usuario->correo)->subject('Bienvenido a mandrill miradita!');
			//dd($usuario);
		});
		
	}

	public function cartaReactivacion($usuario){
		//$usuario=$this->usuario;
		$credenciales=array('random'=>$usuario->random,
							'id_usuario'=>$usuario->id
							);
		
		//\Mail::queue('cartas.registro', $this->data2, function($message) use ($usuario)
		\Mail::send('cartas.reactivacion', $credenciales, function($message) use ($usuario)
		{
			$message->to($usuario->correo)->subject('Reactiva tu cuenta!');
			//dd($usuario);
		});
	}

	public function cartaRecuperacionPassword($usuario){
		//$usuario=$this->usuario;
		$credenciales=array('random'=>$usuario->random,
							'id_usuario'=>$usuario->id
							);
		
		//\Mail::queue('cartas.registro', $this->data2, function($message) use ($usuario)
		\Mail::send('cartas.recuperacion', $credenciales, function($message) use ($usuario)
		{
			$message->to($usuario->correo)->subject('Recuperar contraseña!');
			//dd($usuario);
		});
	}
}