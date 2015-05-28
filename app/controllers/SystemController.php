<?php
use Anuncia\Repositorios\AnuncioRepo;

class SystemController extends BaseController {


	protected $anuncioRepo;

	public function __construct(AnuncioRepo $anuncioRepo)
	{

		$this->anuncioRepo=$anuncioRepo;
	
	}

	public function anunciosExpiran(){
		$anuncios= $this->anuncioRepo->anunciosExpiran();
		return View::make('modulos.super.anunciosexpiran', compact('anuncios'));
	}

	public function desactivarAnunciosExpiran(){

		$anuncios= $this->anuncioRepo->anunciosExpiran();

		if(!empty($anuncios)){
			if($this->anuncioRepo->desactivarExpirados($anuncios)){
				return \Redirect::route('super.anuncios')->with('status_ok', 'Anuncios expirados fueron desactivados correctamente');
			}else{
				return \Redirect::route('super.anuncios')->with('status_error', 'Hubo problemas al desactivar expirados');
			}


			

		}
		
	}
}
