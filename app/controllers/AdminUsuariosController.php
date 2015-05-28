<?php
use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\UsuarioRepo;

class AdminUsuariosController extends BaseController {
	protected $anuncioRepo;
	protected $usuarioRepo;

	public function __construct(AnuncioRepo $anuncioRepo,
								UsuarioRepo $usuarioRepo)
	{

		$this->usuarioRepo=$usuarioRepo;
		
	}

	public function getUsuariosDesactivados()
	{
		$usuarios=$this->usuarioRepo->usuariosDesactivados();

		return View::make('modulos.administrador.listausuariosdesactivados',compact('usuarios'));
	}

	

}
