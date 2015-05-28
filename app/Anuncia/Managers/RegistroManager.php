<?php namespace Anuncia\Managers;

class RegistroManager extends BaseManager{
	public function getRules()
	{
		$rules = [
				'nombres'=>'required|min:3|max:20|alpha_spaces',
				'correo'=>'required|email|unique:usuarios,correo',
				'password'=>'required|confirmed|min:3',
				'password_confirmation'=>'required',
				'genero'=>'required',
		];
		
		return $rules;
	}
		
}