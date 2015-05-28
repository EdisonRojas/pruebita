<?php namespace Anuncia\Entidades;




class Subcategoria extends \Eloquent{
	
	protected $table = 'subcategorias';

	public function categoria()
	{
		return $this->belongsTo('Anuncia\Entidades\Categoria');
	}
	public function anuncio()
    {
        return $this->hasMany('Anuncia\Entidades\Anuncio');
    }
}