<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Agenda;

class AgendaRepo extends BaseRepo{
	
	public function getModel()
	{
		return new Agenda;	
	}
	
	public function nuevaAgenda($usuario_id){
		$agenda=new Agenda();
		$agenda->usuario_id=$usuario_id;
		return $agenda;
	}

	public function cargarAgenda($usuario_id){
		return Agenda::where('usuario_id','=', $usuario_id)->orderBy('created_at', 'desc')->paginate(6);
	}

	public function save($agenda){


		if($agenda->save()){
			return true;
		}
		return false;
	}
	public function buscar_contacto_id($contacto_id){

		
		return Agenda::find($contacto_id);
	}

	public function eliminar_contacto($contacto){
		$contacto->delete();
		return true;
	}
}
