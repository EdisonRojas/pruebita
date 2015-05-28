<?php namespace Anuncia\Managers;

class FotoManager extends BaseManager{
	public function getRules()
	{
		$rules = [
				
				//'fotoperfil'=>'image'
				'fotoperfil'=>'mimes:jpeg,jpg,png'
		
		];
		
		return $rules;
	}
		
}