<?php
use Anuncia\Managers\DenunciaManager;

use Anuncia\Repositorios\DenunciaRepo;
use Anuncia\Repositorios\AnuncioRepo;

class DenunciaController extends BaseController {
	protected $denunciaRepo;
	protected $anuncioRepo;

	public function __construct(DenunciaRepo $denunciaRepo,
								AnuncioRepo $anuncioRepo )
	{
		$this->denunciaRepo=$denunciaRepo;
		$this->anuncioRepo=$anuncioRepo;
	}

	public function denunciarAnuncio()
	{
		$denunciante_id=\Auth::id();
		$denuncia=$this->denunciaRepo->nuevaDenuncia($denunciante_id);
		$manager= new DenunciaManager($denuncia, \Input::all());
			if($manager->isValid())
			{
				$denuncialimpia= Purifier::clean(\Input::get('denuncia'));
				$denuncia->motivo=$denuncialimpia;
				$denuncia->tipodedenuncia="anuncio";
				$manager->save();
				$this->anuncioRepo->denunciaranuncio(\Input::get('identificativo'));
				$usuario=\Auth::user();
				return \View::make('mensajes.denunciaanuncio', compact('usuario'));
			}
				
			return \Redirect::back()->with('denuncia_error','Tu denuncia no pudo ser enviada');
	}

	
}
