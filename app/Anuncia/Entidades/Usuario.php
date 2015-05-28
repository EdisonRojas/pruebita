<?php namespace Anuncia\Entidades;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends \Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuarios';

	protected  $fillable=array(
			'nombres',
			'correo',
			'genero',
			'password',
			'twitter_id',
			'compania_id',
			'telefono',
			'celular',
			'estado_id',
			'foto',
	);


	public function comentarios()
    {
        return $this->hasMany('Anuncia\Entidades\Comentario');
    }
    public function respuesta()
    {
        return $this->hasMany('Anuncia\Entidades\Respuesta');
    }

	public function setPasswordAttribute($value)
	{
		if ( ! empty ($value))
		{
			$this->attributes['password'] = \Hash::make($value);
		}
	}
	public function getGeneroTitleAttribute(){
		if ($this->genero=='male'){
			return 'Hombre';
		}else {
			return 'Mujer';
		}
	}
	public function getRolTitleAttribute(){
		if ($this->rol_id==1){
			return 'usuario';
		}else if  ($this->rol_id==2){
			return 'administrador';
		}
	}

	public function postulante(){
		return $this->hasOne('Anuncia\Entidades\Postulante');
	}
	public function historial(){
		//dd('miecoles');
		return $this->hasOne('Anuncia\Entidades\Historial');
	}
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function estado()
	{
		return $this->belongsTo('Anuncia\Entidades\Estado');
	}
	public function compania()
	{
		return $this->belongsTo('Anuncia\Entidades\Compania');
	}
}
