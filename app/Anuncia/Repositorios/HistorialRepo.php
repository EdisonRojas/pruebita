<?php namespace Anuncia\Repositorios;
use Anuncia\Entidades\Historial;

class HistorialRepo extends BaseRepo{
	
	public function getModel()
	{
		return new Historial;	
	}
	
	public function nuevoHistorial($usuario_id){

		$historial=$this->buscarHistorial($usuario_id);

		if(!empty($historial)){
			return $historial;	
		}else{
			$historial=new Historial();
			$historial->usuario_id=$usuario_id;
			return $historial;
		}
	}

	public function save($historia){
		$historia->save();
	}

	public function buscarHistorial($usuario_id){

		return Historial::where('usuario_id','=', $usuario_id)->first();
	}
	public function contarAnunciosBloqueados($historial){
		//dd($historial);
		
	}
}
