<?php namespace Anuncia\Managers;

class EmpleoManager extends BaseManager{
	public function getRules()
	{
		$rules = [
				'titulo'=>'required|min:3|max:100',
				'descripcion'=>'required|min:3|max:500',


				'seccion_id'=>'required',
				'categoria_id'=>'required',
				'subcategoria_id'=>'required',
				
				'valor'=>'required|numeric',
				
				'tipo'=>'required',
				'pregunta'=>'required'
		];
		
		return $rules;
	}
		
}