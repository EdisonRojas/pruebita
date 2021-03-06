<?php namespace Anuncia\Managers;

class ServicioManager extends BaseManager{
	public function getRules()
	{
		$rules = [
				'titulo'=>'required|min:3|max:100',
				'descripcion'=>'required|min:3|max:500',

				'seccion_id'=>'required',
				'categoria_id'=>'required',
				'subcategoria_id'=>'required',
				'foto1' => 'mimes:jpeg,jpg,png|max:4000',
				'pregunta'=>'required'
				
				
		];
		
		return $rules;
	}
		
}