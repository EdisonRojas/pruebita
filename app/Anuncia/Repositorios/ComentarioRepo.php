<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Comentario;
use Carbon\Carbon;
use Jenssegers\Date\Date;


class ComentarioRepo extends BaseRepo{
	
	public function getModel()
	{
		return new Comentario;	
	}
	public function newComentario($usuario_id){
		$comentario=new Comentario();
		/*Anuncio inicia con 2, anuncio creado pero aun no ha sido revisado por un admin*/
		$comentario->usuario_id=$usuario_id;
		
		return $comentario;
	}
	public function cargarComentarios($anuncio_id){

		return Comentario::where('anuncio_id','=', $anuncio_id)->get();//->paginate(12);
	}
}
