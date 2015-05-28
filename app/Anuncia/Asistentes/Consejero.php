<?php namespace Anuncia\Asistentes;
use Anuncia\Entidades\Usuario;
use Anuncia\Repositorios\UsuarioRepo;

class Consejero{
	protected $accion;
	protected $correo;
	protected $estado;
	protected $data;
	protected $usuarioRepo;
	
	public function __construct($correo, $accion){
		$this->correo=$correo;
		$this->accion=$accion;
		$this->usuarioRepo=new UsuarioRepo;
	}
	public function getConsejo(){
		if($this->existeUsuario()){
			$this->data = array(
				'estado'=>$this->estado,	
				'accion'=>$this->accion	
			);
		}
		return $this->data;
	}
	
	public function existeUsuario(){
		$this->estado=$this->usuarioRepo->getEstado($this->correo);
		if(!empty($this->estado)){
			return true;		
		}
		return false;
	}
}