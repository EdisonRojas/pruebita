<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Denuncia;

class DenunciaRepo extends BaseRepo{
	
	public function getModel()
	{
		return new Denuncia;	
	}
	
	public function nuevaDenuncia($denunciante_id){
		$denuncia=new Denuncia();
		$denuncia->denunciante_id=$denunciante_id;
		return $denuncia;
	}

	public function buscarDenunciaId($anuncio_id){

		return Denuncia::where('identificativo','=', $anuncio_id)->where('tipodedenuncia','=', "anuncio")->first();
		//dd($mens);

	}
	public function eliminarDenunciaId($anuncio_id){
		
		$denuncia=$this->buscarDenunciaId($anuncio_id);
		$denuncia->delete();
		return true;
	}
}
