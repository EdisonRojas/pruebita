<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Subcategoria;

class SubcategoriaRepo extends BaseRepo{
	
	public function getModel()
	{
		return new Subcategoria;	
	}
	
	public function buscarSubcategoria($id){
		$subcategoria= Subcategoria::find($id);
		return $subcategoria;
	}

	
}
