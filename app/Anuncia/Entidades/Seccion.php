<?php namespace Anuncia\Entidades;

class Seccion extends \Eloquent{
	
	protected $table = 'secciones';
	
	public function categorias()
    {
        return $this->hasMany('Categoria');
    }
  /*  public function opciones()
    {
    	return $this->hasMany('Opcion');
    }*/
}