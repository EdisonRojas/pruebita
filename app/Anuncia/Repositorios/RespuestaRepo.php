<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Respuesta;
use Carbon\Carbon;
use Jenssegers\Date\Date;


class RespuestaRepo extends BaseRepo{
	
	public function getModel()
	{
		return new Respuesta;	
	}
	public function newRespuesta($usuario_id){
		$respuesta=new Respuesta();
		
		$respuesta->usuario_id=$usuario_id;
		
		return $respuesta;
	}
	/*public function cargarComentarios($anuncio_id){

		return Comentario::where('anuncio_id','=', $anuncio_id)->get();//->paginate(12);
	}*/
}
