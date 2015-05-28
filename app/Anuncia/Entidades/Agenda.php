<?php namespace Anuncia\Entidades;

class Agenda extends \Eloquent{
	protected $table = 'agendas';
	
	

	public function usuario()
	{
		return $this->belongsTo('Anuncia\Entidades\Usuario');
	}
	

	protected $fillable=array(
		//	'usuario_id',
			
		//	'nombre',
		//	'apellido',
	//		'correo',
	//		'asunto',
			
	);
}