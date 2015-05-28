<?php
use Anuncia\Repositorios\UsuarioRepo;
use Anuncia\Repositorios\PostulanteRepo;


class SuperUsuariosController extends BaseController {
		protected $usuarioRepo;
		protected $postulanteRepo;


	public function __construct(UsuarioRepo $usuarioRepo,
								PostulanteRepo $postulanteRepo)
	{

		$this->postulanteRepo=$postulanteRepo;
		$this->usuarioRepo=$usuarioRepo;
		
	}
	
	public function panelUsuarios()
	{
		return View::make('modulos.super.panelusuarios');
	}
	

	public function usuariosActivos(){
		
		$usuarios=$this->usuarioRepo->usuariosActivos();

		return View::make('modulos.super.listausuariosactivos', compact('usuarios'));
	}	

	public function usuariosDesactivados(){
		$usuarios=$this->usuarioRepo->usuariosDesactivados();
		return View::make('modulos.super.listausuariosdesactivados', compact('usuarios'));
	}
	public function usuariosBloqueados(){
		$usuarios=$this->usuarioRepo->usuariosBloqueados();
		return View::make('modulos.super.listausuariosbloqueados', compact('usuarios'));
	}	
	public function usuariosPostulantes(){
		$usuarios=$this->postulanteRepo->postulantes();
		//dd($usuarios);
		return View::make('modulos.super.listapostulantes', compact('usuarios'));
	}
	public  function verPostulante($id){
		$usuario=$this->usuarioRepo->buscarUsuario($id);
		return View::make('modulos.super.verpostulante', compact('usuario'));
	}

	public  function promover_a_administrador($id){
		if(Auth::user()->rol_id==3){
			if($this->usuarioRepo->promoverAdministrador($id)){
				$this->postulanteRepo->borrarPostulante($id);
				return \Redirect::route('lista.postulantes')->with('status_ok', 'Usuario promovido a administrador correctamente');
			}
			return \Redirect::route('lista.postulantes')->with('status_error', 'Hubo problemas al promover usuario a administrador');
		}	
		
		//return View::make('modulos.super.verpostulante', compact('usuario'));
	}
	public function usuariosAdministradores(){
		$usuarios=$this->usuarioRepo->buscarAdministradores();
		return View::make('modulos.super.listaadmins', compact('usuarios'));
	}
	public  function verAdmin($id){
		$usuario=$this->usuarioRepo->buscarUsuario($id);
		return View::make('modulos.super.veradmin', compact('usuario'));
	}
	public  function cancelar_administrador($id){


		if(Auth::user()->rol_id==3){
			if($this->usuarioRepo->cancelarAdministrador($id)){
				//$this->postulanteRepo->borrarPostulante($id);
				return \Redirect::route('lista.admins')->with('status_ok', 'Administrador dado de baja correctamente');
			}
			return \Redirect::route('lista.admins')->with('status_error', 'Administrador no pudo ser dado de baja');
		}	
		
		//return View::make('modulos.super.verpostulante', compact('usuario'));
	}


}
