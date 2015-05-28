<?php namespace Anuncia\Entidades;
use Carbon\Carbon;
use Jenssegers\Date\Date;

class Mensaje extends \Eloquent{
	protected $table = 'mensajes';
	
	

	public function usuario()
	{
		return $this->belongsTo('Anuncia\Entidades\Usuario');
	}
	

	public function anunciante(){
		return $this->hasOne('Anuncia\Entidades\Anunciante');
	}
	protected $fillable=array(
			'usuario_id',
			
			'nombre',
			'apellido',
			'correo',
			'asunto',
			
	);

	public function getCreatedAtAttribute($value)
	{
		//$valo=new Date($value);
	    return new Date($value);
	    //dd('ver'.$valo);
	}

	


}