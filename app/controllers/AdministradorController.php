<?php
use Anuncia\Repositorios\UsuarioRepo;

class AdministradorController extends BaseController {
	protected $usuarioRepo;

	public function __construct(UsuarioRepo $usuarioRepo)
	{

		$this->usuarioRepo=$usuarioRepo;
		
	}
	
	public function getGeneral()
	{
		return View::make('modulos.administrador.general');
	}
	public function activarPanel(){
		$usuario= \Auth::user();
		if(\Auth::user()->nav_avanzada==false){
			$usuario->nav_avanzada=true;
			$usuario->save();
			//return Redirect::back();
			return \Redirect::route('administracion');
		}
	}
	public function desactivarPanel(){
		$usuario= \Auth::user();
		if(\Auth::user()->nav_avanzada==true){
			$usuario->nav_avanzada=false;
			$usuario->save();
			return \Redirect::route('main');
			//return Redirect::back();
		}
	}

	public function getPendientes()
	{
		return View::make('modulos.administrador.tareaspendientes');
	}
	
	
	public function cargarAdministradores(){
		$usuarios=$this->usuarioRepo->buscarAdministradores();
		return View::make('modulos.administrador.listaadmins', compact('usuarios'));
	}




	

}
