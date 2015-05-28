<?php namespace Anuncia\Managers;

class AnuncioManager extends BaseManager{
	public function getRules()
	{
		$rules = [
				'titulo'=>'required|min:3|max:50',
				'descripcion'=>'required|min:3|max:20',


				'seccion_id'=>'required',
				'categoria_id'=>'required',
				'subcategoria_id'=>'required',
				'estado'=>'',
				'valor'=>'required|numeric',
				'opcionvalor'=>'',
				'tipo'=>'',
				
				'foto1' => 'mimes:jpeg,jpg,png|max:5000',
				'foto2' => 'mimes:jpeg,jpg,png|max:5000',
				'foto3' => 'mimes:jpeg,jpg,png|max:5000',
				'foto4' => 'mimes:jpeg,jpg,png|max:5000'
				/*'foto1'=>'mimes:jpeg,jpg,png',
				'foto2'=>'mimes:jpeg,jpg,png',
				'foto3'=>'mimes:jpeg,jpg,png',
				'foto4'=>'mimes:jpeg,jpg,png'*/
				
		];
		
		return $rules;
	}
		
}