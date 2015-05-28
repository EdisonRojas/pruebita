<?php namespace Anuncia\Entidades;


class Anunciante extends \Eloquent{
	
	public function anuncio(){
        return $this->belongsTo('Anuncia\Entidades\Anuncio');
    }
	protected $table = 'anunciantes';
	protected $fillable=array(
			'anunciante',
			'correo',
			'celular',
			'telefono',
			'tipopersona',

	);
	
	
	
}