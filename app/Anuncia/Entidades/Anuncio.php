<?php namespace Anuncia\Entidades;
use Carbon\Carbon;
use Jenssegers\Date\Date;

class Anuncio extends \Eloquent{
	protected $table = 'anuncios';
	
	//protected $dates =['publicaciondate','expiradate'];

	public function usuario()
	{
		return $this->belongsTo('Anuncia\Entidades\Usuario');
	}
	
	public function categoria()
	{
		return $this->belongsTo('Anuncia\Entidades\Categoria');
	}
	public function subcategoria()
	{
		return $this->belongsTo('Anuncia\Entidades\Subcategoria');
	}

	public function anunciante(){
		return $this->hasOne('Anuncia\Entidades\Anunciante');
	}



	
	protected $fillable=array(
			//'titulo',
			//'descripcion',
			'seccion_id',
			
			'estado',
			'valor',
			'opcionvalor',

			'categoria_id',
			'subcategoria_id',

			'tipo',
			'pregunta'
			
			

			
	);


	
	public function getPublicaciondateAttribute($value)
	{
		//$valo=new Date($value);
	    return new Date($value);
	    //dd('ver'.$valo);
	}
	public function getExpiradateAttribute($value)
	{
	    return new Date($value);
	}



	public function getEstadoTitleAttribute(){
		if ($this->estado_id==1){
			return 'Publicado';
		}else if ($this->estado_id==2) {
			return 'Creado';
		}else if ($this->estado_id==3) {
			return 'Bloqueado';
		}else if ($this->estado_id==5) {
			return 'Revision';
		}else if ($this->estado_id==6) {
			return 'Denunciado';
		}else if ($this->estado_id==7) {
			return 'Rechazado';
		}						

	}
	public function getSeccionTitleAttribute(){
		if ($this->seccion_id==1){
			return 'Clasificados';
		}else if ($this->seccion_id==2) {
			return 'Servicios';
		}else if ($this->seccion_id==3) {
			return 'Empleos';
		}

	}
	public function getTipoTitleAttribute(){
		if ($this->tipo=="tiempocompleto"){
			return 'Tiempo completo';
		}else if ($this->tipo=="mediotiempo") {
			return 'Medio tiempo';
		}else if ($this->tipo=="temporal") {
			return 'Temporal';
		}else if ($this->tipo=="porhoras") {
			return 'Por horas';
		}				
	}
	public function getPreguntaTitleAttribute(){
		if ($this->pregunta==1){
			return 'Vende';
		}else if ($this->pregunta==2) {
			return 'Alquila';
		}else if ($this->pregunta==3) {
			return 'Desea comprar';
		}else if ($this->pregunta==4) {
			return 'Busca alquilar';
		}else if ($this->pregunta==5) {
			return 'Intercambiar';
		}else if ($this->pregunta==6) {
			return 'Ofrece servicio';
		}else if ($this->pregunta==7) {
			return 'Necesita trabajo';
		}else if ($this->pregunta==8) {
			return 'Ofrece trabajo';
		}else if ($this->pregunta==9) {
			return 'Pasantias';
		}				
	}


	


}