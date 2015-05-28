<?php namespace Anuncia\Entidades;
use Carbon\Carbon;
use Jenssegers\Date\Date;

class Denuncia extends \Eloquent{
	protected $table = 'denuncias';
	
	

	public function usuario()
	{
		return $this->belongsTo('Anuncia\Entidades\Usuario');
	}

	

	protected $fillable=array(

			'denunciado_id',
			'motivo',
			'identificativo',

	);

	public function getCreatedAtAttribute($value)
	{
	    return new Date($value);
	}

	


}