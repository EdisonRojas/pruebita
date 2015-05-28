<?php
use Anuncia\Repositorios\ComentarioRepo;
use Anuncia\Repositorios\RespuestaRepo;
use Anuncia\Managers\ComentarioManager;
use Anuncia\Managers\RespuestaManager;

class ComentarioController extends BaseController {
	
	protected $comentarioRepo;
	protected $respuestaRepo;

	public function __construct(ComentarioRepo $comentarioRepo,
								RespuestaRepo $respuestaRepo)
	{

		$this->comentarioRepo=$comentarioRepo;
		$this->respuestaRepo=$respuestaRepo;
		
	}
	public function comenta()
	{
		$usuario_id=\Auth::id();
		$comentario=$this->comentarioRepo->newComentario($usuario_id);
		
		if(\Auth::user()->foto==""){
			//$foto= "http://miraditaloja.com/profile/prof_2.jpg";
			$foto="http://miraditaloja.com/assets/images/user2.jpg";
		}else{
			//<img src="http://miraditaloja.com/assets/images/user2.jpg" class="img-circle img-comentario" alt="">
			$foto="http://miraditaloja.com".\Auth::user()->foto;

		}
		$nombres=\Auth::user()->nombres;

		$manager= new ComentarioManager($comentario, \Input::all());
		
		if($manager->isValid()){
			$comentariolimpio= Purifier::clean(\Input::get('comentario'));
			$comentario->comentario=$comentariolimpio;
			if($manager->save()){
				//return Redirect::back();
				$fecha=$comentario->created_at->format('j/m/Y H:i a');
				return Response::json([
					'success'=>true,
					'comentario'=> $comentariolimpio,
					'foto'=>$foto,
					'nombres'=>$nombres,
					'fecha'=>$fecha
					]);


			}else{
				
			}
		}else{
			if(Request::ajax()){
				return Response::json([
					'success'=>false,
					'errors'=> $manager->getErrores()->toArray()
					]);
			}else{
				//dd($mensaje);
				//return Redirect::back()->withInput()->withErrors($validator);	
					return Redirect::back()->withInput()->withErrors($manager->getErrores());
			}
		}
	}

	public function respuesta(){
		//dd(\Input::all());
		$usuario_id=\Auth::id();
		$respuesta=$this->respuestaRepo->newRespuesta($usuario_id);
		if(\Auth::user()->foto==""){
			//$foto= "http://miraditaloja.com/profile/prof_2.jpg";
			$foto="http://miraditaloja.com/assets/images/user2.jpg";
		}else{
			//<img src="http://miraditaloja.com/assets/images/user2.jpg" class="img-circle img-comentario" alt="">
			$foto="http://miraditaloja.com".\Auth::user()->foto;

		}

		$nombres=\Auth::user()->nombres;
		$manager= new RespuestaManager($respuesta, \Input::all());

		if($manager->isValid()){	
			$respuestalimpia= Purifier::clean(\Input::get('respuesta'));
			$respuesta->respuesta=$respuestalimpia;
			if($manager->save()){
				$fecha=$respuesta->created_at->format('j/m/Y H:i a');
				return Response::json([
					'success'=>true,
					'respuesta'=> $respuestalimpia,
					'foto'=>$foto,
					'nombres'=>$nombres,
					'fecha'=>$fecha
					]);


			}
		}else{
			if(Request::ajax()){
				return Response::json([
					'success'=>false,
					'errors'=> $manager->getErrores()->toArray()
					]);
			}else{
				//dd($mensaje);
				//return Redirect::back()->withInput()->withErrors($validator);	
					return Redirect::back()->withInput()->withErrors($manager->getErrores());
			}
		
		}

	}

	


}
