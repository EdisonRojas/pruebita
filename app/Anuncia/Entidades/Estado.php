<?php namespace Anuncia\Entidades;

class Estado extends \Eloquent{
	
	public function usuarios()
    {
        return $this->hasMany('Usuario');
    }
	
}