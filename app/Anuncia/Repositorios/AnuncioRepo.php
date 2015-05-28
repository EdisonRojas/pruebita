<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Anuncio;
use Carbon\Carbon;
use Jenssegers\Date\Date;


class AnuncioRepo extends BaseRepo{
	
	public function getModel()
	{
		return new Anuncio;	
	}
	public function newAnuncio($usuario_id){
		$anuncio=new Anuncio();
		/*Anuncio inicia con 2, anuncio creado pero aun no ha sido revisado por un admin*/
		$anuncio->estado_id=2;
		$anuncio->estatus_revision="libre";
		$anuncio->usuario_id=$usuario_id;
		return $anuncio;
	}
	
	/*Buscar anuncios que pertenecen a un usuario, busqueda mediante id de user*/
	public function buscar_anuncios_usuario($usuario_id){
		
		//return Anuncio::where('usuario_id','=', $usuario_id)->orderBy('created_at', 'desc')->paginate(6);
		/*si funciona traer a todos los anuncios de ese usuario y de seccion_id en descendente*/
		//return Anuncio::where('usuario_id','=', $usuario_id)->where('seccion_id','=', 1)->orderBy('created_at', 'desc')->paginate(6);
		return Anuncio::where('usuario_id','=', $usuario_id)->orderBy('created_at', 'desc')->paginate(6);
	}
	public function buscar_anuncios_clasificados(){
		return Anuncio::where('seccion_id','=', 1)->where('estado_id','=', 1)->orderBy('publicaciondate', 'desc')->paginate(6);
	}
	public function buscar_anuncios_servicios(){
		return Anuncio::where('seccion_id','=', 2)->where('estado_id','=', 1)->orderBy('publicaciondate', 'desc')->paginate(6);
	}
	public function buscar_anuncios_empleos(){
		return Anuncio::where('seccion_id','=', 3)->where('estado_id','=', 1)->orderBy('publicaciondate', 'desc')->paginate(6);
	}

	public function buscar_anuncio_id($anuncio_id){

		//return Anuncio::where('anuncio_id','=', $anuncio_id)->get();
		return Anuncio::find($anuncio_id);
	}
	public function borraranuncio($id){
		
		$anuncio=Anuncio::find($id);

		if($anuncio->delete()) {
			return true;
		}
	}
	public function desactivaranuncio($anuncio_id){
		$anuncio=Anuncio::find($anuncio_id);
		$anuncio->estado_id=2;
		$anuncio->publicaciondate="";
		$anuncio->expiradate="";
		if($anuncio->save()) {
			return true;
		}

	}
	
	public function publicaranuncio($anuncio_id){
		$anuncio=Anuncio::find($anuncio_id);
		$anuncio->estado_id=5;

		if($anuncio->save()) {
			return true;
		}

	}
	public function activaranuncio($anuncio_id){
		$anuncio=Anuncio::find($anuncio_id);
		/*estdo 1 equivalente a activado*/
		$anuncio->estado_id=1;
		$anuncio->estatus_revision="libre";
		$anuncio->admin=0;
		/*Crear una nueva fecha*/
		
		/*establecer fecha de publicacion*/
		$anuncio->publicaciondate=Date::now();
		/*establecer fecha que expira anuncio (se + 2 semanas)*/
		if($anuncio->seccion_id==3){
			$anuncio->expiradate=Date::now()->addYear();
		}else{
			$anuncio->expiradate=Date::now()->addWeeks(2);
		}
			
		if($anuncio->save()) {
			return true;
		}

	}
	public function rechazaranuncio($anuncio_id){
		$anuncio=Anuncio::find($anuncio_id);
		/*estdo 7 equivalente a rechazado*/
		$anuncio->estado_id=7;
		$anuncio->estatus_revision="libre";
		$anuncio->admin=0;
		if($anuncio->save()) {
			return true;
		}

	}

	public function bloquearanuncio($anuncio_id, $admin){
		$anuncio=Anuncio::find($anuncio_id);
		/*estdo 3 equivalente a bloqueado*/
		$anuncio->estado_id=3;
		$anuncio->estatus_revision="libre";
		$anuncio->admin=$admin;
		if($anuncio->save()) {
			return true;
		}

	}

	public function reactivaranuncio($anuncio_id){
		$anuncio=Anuncio::find($anuncio_id);
		/*estdo 1 equivalente a activado*/
		$anuncio->estado_id=1;
		$anuncio->estatus_revision="libre";
		$anuncio->admin=0;
		if($anuncio->save()) {
			return true;
		}
	}



	public function buscarAnunciosPorPublicar(){
		/*estado 5 equivalente a revision, que son los anuncios que solicitaron ser publicados*/
		$estadoanuncio=5;
		return Anuncio::where('estado_id','=', 5)->paginate(4);
	}

	public function buscarSolicitantesPendientes($usuario_id){
		/*estado 5 equivalente a revision, que son los anuncios que solicitaron ser publicados*/
		$estadoanuncio=5;
		return Anuncio::where('estado_id','=', 5)->where('admin','=', $usuario_id)->paginate(4);
	}

	public function buscarAnunciosDenunciados(){
		/*estado 6 equivalente a denunciado,*/
		$estadoanuncio=6;
		return Anuncio::where('estado_id','=', 6)->paginate(4);
	}
	public function buscarDenunciadosPendientes($usuario_id){
		/*estado 6 equivalente a denunciado,*/
		$estadoanuncio=6;
		return Anuncio::where('estado_id','=', 6)->where('admin','=', $usuario_id)->paginate(4);
	}

	public function estatusRevisionOcupado($anuncio, $admin){
		//$anuncio=$this->buscar_anuncio_id($anuncio_id);

		$anuncio->estatus_revision="ocupado";
		$anuncio->admin=$admin;
		$anuncio->save();
	}
	public function denunciaranuncio($anuncio_id){
		$anuncio=Anuncio::find($anuncio_id);
		$anuncio->estado_id=6;
		//$anuncio->publicaciondate="";
		//$anuncio->expiradate="";
		if($anuncio->save()) {
			return true;
		}

	}
	/*Retorna anuncios clasificados activos y de categoria n..donde n="categoria seleccionada por el usuario"*/
	public function clasificados_categorian($categoria_id){
		return Anuncio::where('seccion_id','=', 1)->where('estado_id','=', 1)->where('categoria_id','=',$categoria_id)->orderBy('publicaciondate', 'desc')->paginate(6);
	}

	/*Retorna anuncios de servicios activos y de categoria n..donde n="categoria seleccionada por el usuario"*/
	public function servicios_categorian($categoria_id){
		return Anuncio::where('seccion_id','=', 2)->where('estado_id','=', 1)->where('categoria_id','=',$categoria_id)->orderBy('publicaciondate', 'desc')->paginate(6);
	}

	/*Retorna anuncios de empleos activos y de categoria n..donde n="categoria seleccionada por el usuario"*/
	public function empleos_categorian($categoria_id){
		return Anuncio::where('seccion_id','=', 3)->where('estado_id','=', 1)->where('categoria_id','=',$categoria_id)->orderBy('publicaciondate', 'desc')->paginate(6);
	}
	
	/*Retorna anuncios clasificados activos y de subcategoria n..donde n="subcategoria seleccionada por el usuario"*/
	public function anuncio_subcategorian($subcategoria_id){
		return Anuncio::where('estado_id','=', 1)->where('subcategoria_id','=',$subcategoria_id)->orderBy('publicaciondate', 'desc')->paginate(6);
	}
	
	public function anunciosExpiran(){
		/*establecer fecha de publicacion*/
		$fechahoy =Carbon::now()->toDateString();
		//dd($fechahoy);
		$anuncios= Anuncio::where('expiradate','<', $fechahoy)->where('estado_id','=',1)->get();

		
		
		if(empty($anuncios)){
			$madre="si";
			break;
		}else{
			$madre="no";
			
			
		}
		
		return $anuncios;
		//dd($fecha->day . " ". $fecha->month);
		/*establecer fecha que expira anuncio (se + 2 semanas)*/
		
			//$anuncio->expiradate=Date::now()->addYear();
		
			

	}	
	public function desactivarExpirados($anuncios){
		foreach ($anuncios as $anuncio) {
			$anuncio->estado_id=2;
			$anuncio->save();

		}
		return true;
	}

}
