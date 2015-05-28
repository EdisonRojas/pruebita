<?php namespace Anuncia\Entidades;
use Carbon\Carbon;
use Jenssegers\Date\Date;

class Respuesta extends \Eloquent{
	protected $table = 'respuestas';
	
	

	public function comentario()
	{
		return $this->belongsTo('Anuncia\Entidades\Comentario');
	}
	public function usuario()
	{
		return $this->belongsTo('Anuncia\Entidades\Usuario');
	}
	
	protected $fillable=array(
			'comentario_id',
					
	);

	public function getCreatedAtAttribute($value)
	{
		//$valo=new Date($value);
	    return new Date($value);
	    //dd('ver'.$valo);
	}

	


}