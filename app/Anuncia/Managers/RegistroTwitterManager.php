<?php namespace Anuncia\Managers;

class RegistroTwitterManager extends BaseManager{
	public function getRules()
	{
		$rules = [
				'nombres'=>'required',
				'twitter_id'=>'required|unique:usuarios,twitter_id',
		];
		
		return $rules;
	}
		
}