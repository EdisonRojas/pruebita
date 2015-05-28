<?php namespace Anuncia\Managers;

class ComentarioManager extends BaseManager{
	public function getRules()
	{
		$rules = [
				
				'comentario'=>'required|min:3|max:200',
				'anuncio_id'=>'required',
			
		];
		
		return $rules;
	}
		
}