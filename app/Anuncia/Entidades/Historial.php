<?php namespace Anuncia\Entidades;
use Carbon\Carbon;
use Jenssegers\Date\Date;

class Historial extends \Eloquent{
	protected $table = 'historiales';
	
	/*protected $fillable=array(
			'usuario_id',
			
			'nombre',
			'apellido',
			'correo',
			'asunto',
			
	);*/

	public function getCreatedAtAttribute($value)
	{
		
	    return new Date($value);
	    
	}
	public function usuario(){
        return $this->belongsTo('Anuncia\Entidades\Usuario');
    }
	


}