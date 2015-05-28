<?php namespace Anuncia\Managers;

class MensajeManager extends BaseManager{
	public function getRules()
	{
		$rules = [
				'nombre'=>'required|alpha_spaces|max:12',
				'apellido'=>'required|alpha_spaces|max:12',
				'correo'=>'required|email',
				'asunto'=>'required|alpha_spaces|max:50',
				'mensaje'=>'required|min:3|max:300',
		];
		
		return $rules;
	}
		
}