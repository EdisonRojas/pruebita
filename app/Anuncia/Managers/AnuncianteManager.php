<?php namespace Anuncia\Managers;

class AnuncianteManager extends BaseManager{
	public function getRules()
	{
		$rules = [
				'anunciante'=>'required|alpha_spaces',
				'correo'=>'required|email',
				'celular'=>'numeric|digits:10',
				'telefono'=>'numeric|digits_between:6,9',
				'tipopersona'=>'required'
				
		];
		
		return $rules;
	}
		
}