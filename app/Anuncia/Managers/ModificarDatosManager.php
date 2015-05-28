<?php namespace Anuncia\Managers;

class ModificarDatosManager extends BaseManager{
	public function getRules()
	{
	$rules = [
				'nombres'=>'alpha_spaces',
				'telefono'=>'numeric|digits_between:6,9',
				'celular'=>'numeric|digits:10',
				'genero'=>'',
				'compania_id'=>''
		];
		
		return $rules;
	}
		
}