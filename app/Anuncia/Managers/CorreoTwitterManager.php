<?php namespace Anuncia\Managers;

class CorreoTwitterManager extends BaseManager{
	public function getRules()
	{
		$rules = [
				'correo'=>'required|email|unique:usuarios,correo,'.$this->entidad->id,
				'genero'=>'required'
		];
		
		return $rules;
	}
		
}