<?php namespace Anuncia\Managers;

class EditarPasswordManager extends BaseManager{
	public function getRules()
	{
		$rules = [
				
				
				'password'=>'required|confirmed|min:3',
				'password_confirmation'=>'required',
				
		];
		
		return $rules;
	}
		
}