<?php namespace Anuncia\Entidades;
use Carbon\Carbon;
use Jenssegers\Date\Date;

class Comentario extends \Eloquent{
	protected $table = 'comentarios';
	
	

	public function usuario()
	{
		return $this->belongsTo('Anuncia\Entidades\Usuario');
	}


	public function respuestas()
    {
        return $this->hasMany('Anuncia\Entidades\Respuesta');
    }
	
	protected $fillable=array(
			'anuncio_id',
					
	);

	public function getCreatedAtAttribute($value)
	{
		//$valo=new Date($value);
	    return new Date($value);
	    //dd('ver'.$valo);
	}

	


}