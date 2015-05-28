<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Anunciante;

class AnuncianteRepo extends BaseRepo{
	
	public function getModel()
	{
		return new Anunciante;	
	}
	
	public function  nuevoAnunciante(){
		$anunciante=new Anunciante();
		
		return $anunciante;
	}
	
	public function borraranuncianteanuncio($anuncio_id){
		
		$anunciante=Anunciante::whereAnuncio_id($anuncio_id)->first();
		
		if(!empty($anunciante)){
			if($anunciante->delete()) {
				return true;
			}
		}
	}
	public function buscar_anunciante_id($anunciante_id){

		
		return Anunciante::find($anunciante_id);
	}
	
	
	
}
