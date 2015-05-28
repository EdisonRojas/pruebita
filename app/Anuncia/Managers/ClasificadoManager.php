<?php namespace Anuncia\Managers;

class ClasificadoManager extends BaseManager{
	public function getRules()
	{
		$rules = [
				'titulo'=>'required|min:3|max:100',
				'descripcion'=>'required|min:3|max:500',


				'seccion_id'=>'required',
				'categoria_id'=>'required',
				'subcategoria_id'=>'required',
				'estado'=>'required',
				'valor'=>'required|numeric',
				'opcionvalor'=>'required',
				'foto1' => 'mimes:jpeg,jpg,png|max:4000',
				'foto2' => 'mimes:jpeg,jpg,png|max:4000',
				'foto3' => 'mimes:jpeg,jpg,png|max:4000',
				'foto4' => 'mimes:jpeg,jpg,png|max:4000',
				'pregunta'=>'required'
				
		];
		
		return $rules;
	}
		
}