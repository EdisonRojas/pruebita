<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Postulante;

class PostulanteRepo extends BaseRepo{

	public function getModel()
	{
		return new Postulante;	
	}
	
	public function nuevoPostulante($usuario_id){
		$postulante=new Postulante();
		$postulante->usuario_id=$usuario_id;
		
		return $postulante;
	}


	public function save($postulante){
		$postulante->save();
	}

	public function buscarPostulante($usuario_id){
		return Postulante::where('usuario_id','=', $usuario_id)->first();
	}	

	public function postulantes(){
		return Postulante::all();
	}

	public function borrarPostulante($usuario_id){
		
		$postulante=$this->buscarPostulante($usuario_id);
		$postulante->delete();
	}
}