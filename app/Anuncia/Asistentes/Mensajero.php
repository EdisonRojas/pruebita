<?php namespace Anuncia\Asistentes;

class Mensajero{
	
	protected $estado;
	protected $accion;
	protected $mensajes;
	protected $archivo='mensajes.';
	
	public function __construct($consejo){
		$this->estado=$consejo['estado'];
		$this->accion=$consejo['accion'];
	} 
	
	public function getMensaje(){
		$this->mensajes= \Config::get($this->archivo.$this->accion.'.'.$this->estado);
		
		return $this->mensajes;
	}
	
	
}
