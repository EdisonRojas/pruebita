<?php namespace Anuncia\Managers;

class RespuestaManager extends BaseManager{
	public function getRules()
	{
		$rules = [
				
				'respuesta'=>'required|min:3|max:200',
				'comentario_id'=>'required',
			
		];
		
		return $rules;
	}
		
}