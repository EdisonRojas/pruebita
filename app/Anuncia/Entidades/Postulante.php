<?php namespace Anuncia\Entidades;


class Postulante extends \Eloquent{
	
	public function usuario(){
        return $this->belongsTo('Anuncia\Entidades\Usuario');
    }
	protected $table = 'postulantes';
	protected $fillable=array(
			//'usuario_id',
			//'correo',
			//'celular',
			//'telefono',
			//'tipopersona',

	);
	
	
	
}