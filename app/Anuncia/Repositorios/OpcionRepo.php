<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Opcion;

class OpcionRepo extends BaseRepo{
	
	public function getModel()
	{
		return new Opcion;	
	}
	
	public function buscarOpcion($id){
		$opcion= Opcion::find($id);
		return $opcion;
	}

	
}
