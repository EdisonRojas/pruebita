<?php namespace Anuncia\Managers;

class DenunciaManager extends BaseManager{
	public function getRules()
	{
		$rules = [
				'denunciado_id'=>'required',
				'motivo'=>'required|min:5|max:250',
				'identificativo'=>'required',
		];
		
		return $rules;
	}
		
}