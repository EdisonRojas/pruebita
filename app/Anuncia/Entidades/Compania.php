<?php namespace Anuncia\Entidades;




class Compania extends \Eloquent{
	
	/*protected $table = 'companiascelulares';*/
	
	public function usuarios()
    {
        return $this->hasMany('Usuario');
    }
	
}