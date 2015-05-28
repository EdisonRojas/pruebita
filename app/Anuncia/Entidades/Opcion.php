<?php namespace Anuncia\Entidades;

class Opcion extends \Eloquent{
	
	protected $table = 'opciones';
	public function seccion()
	{
		return $this->belongsTo('Anuncia\Entidades\Seccion');
	}
	
	
}