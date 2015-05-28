<?php namespace Anuncia\Managers;

class RegistroSocialManager extends BaseManager{
	public function getRules()
	{
		$rules = [
				'genero'=>'',
				'nombres'=>'required',
				'correo'=>'required|email|unique:usuarios,correo',
		];
		
		return $rules;
	}
		
}