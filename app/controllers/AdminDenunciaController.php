<?php
use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\CategoriaRepo;
use Anuncia\Repositorios\SubcategoriaRepo;
use Anuncia\Repositorios\DenunciaRepo;
use Anuncia\Repositorios\HistorialRepo;
use Anuncia\Repositorios\UsuarioRepo;



class AdminDenunciaController extends BaseController {
	protected $anuncioRepo;
	protected $categoriaRepo;
	protected $subcategoriaRepo;
	protected $denunciaRepo;
	protected $historialRepo;
	protected $usuarioRepo;

	public function __construct(AnuncioRepo $anuncioRepo,
								CategoriaRepo $categoriaRepo,
								SubcategoriaRepo $subcategoriaRepo,
								DenunciaRepo $denunciaRepo,
								HistorialRepo $historialRepo,
								UsuarioRepo $usuarioRepo)
	{

		$this->anuncioRepo=$anuncioRepo;
		$this->categoriaRepo=$categoriaRepo;
		$this->subcategoriaRepo=$subcategoriaRepo;
		$this->denunciaRepo=$denunciaRepo;
		$this->historialRepo=$historialRepo;
		$this->usuarioRepo=$usuarioRepo;
	}

	public function cargarDenunciados()
	{
		$anuncios=$this->anuncioRepo->buscarAnunciosDenunciados();

		return View::make('modulos.administrador.anunciosdenunciados',compact('anuncios'));
	}
	public function cargarDenunciadosPendientes()
	{
		$anuncios=$this->anuncioRepo->buscarDenunciadosPendientes(\Auth::id());

		return View::make('modulos.administrador.listadenunciadospendientes',compact('anuncios'));
	}
	public function getRevisarAnuncioDenunciado($seccionanuncio, $idanuncio){

		$anuncio=$this->anuncioRepo->buscar_anuncio_id($idanuncio);
		$admin=\Auth::id();

		$this->notFoundUnLess($anuncio);
		/*obtener la categoria y subcategoria del anuncio*/
		$categoria=$this->categoriaRepo->buscarCategoria($anuncio->categoria);
		$subcategoria=$this->subcategoriaRepo->buscarSubcategoria($anuncio->subcategoria);
		$anunciodenunciado=$this->denunciaRepo->buscarDenunciaId($anuncio->id);

		if(strcmp ($anuncio->estatus_revision,"libre") == 0 & $anuncio->estado_id==6 ) {
			$this->anuncioRepo->estatusRevisionOcupado($anuncio, $admin);
			return View::make('modulos.administrador.revisionindividual', compact(  'anuncio', 
																					'categoria', 
																					'subcategoria', 
																					'anunciodenunciado'
																					)
			); 
		}else if (strcmp ($anuncio->estatus_revision,"ocupado") == 0  & ($anuncio->admin==$admin)){

			return View::make('modulos.administrador.revisionindividual', compact(	'anuncio', 
																					'categoria', 
																					'subcategoria',
																					'anunciodenunciado')
			); 
		}else if (strcmp ($anuncio->estatus_revision,"ocupado") == 0  & ($anuncio->admin!=$admin)){
			
			return \Redirect::route('admin.revisar.denuncias')->with('status_error', 'Este anuncio lo está revisando otro administrador.');
		}else{
			
			return \Redirect::route('admin.revisar.denuncias')->with('status_error', 'Ese anuncio no ha sido denunciado.');
		}
	}

	public function aprobarDenuncia(){
		$historialDenunciado= $this->historialRepo->nuevoHistorial(\Input::get('denunciado_id'));
		$historialDenunciado->anunciosbloqueados++;
		$this->historialRepo->save($historialDenunciado);

		$historialDenunciante= $this->historialRepo->nuevoHistorial(\Input::get('denunciante_id'));
		$historialDenunciante->denunciasverdaderas++;
		$this->historialRepo->save($historialDenunciante);		

		


		$admin=\Auth::id();
		$anuncio_id=\Input::get('anuncio_id');

		if($anuncio=$this->anuncioRepo->bloquearanuncio($anuncio_id , $admin )){


			$this->denunciaRepo->eliminarDenunciaId($anuncio_id);

			/*bloqueo de usuario */
			if($historialDenunciado->anunciosbloqueados >= 3 ){
				$this->usuarioRepo->bloquearUsuario($historialDenunciado->usuario_id);
				//dd('llegandoo');
			}

			/**/

			return \Redirect::route('admin.revisar.denuncias')->with('status_ok', 'Anuncio revisado y bloqueado correctamente');
		}
	}

	public function rechazarDenuncia(){
		$historialDenunciante= $this->historialRepo->nuevoHistorial(\Input::get('denunciante_id'));
		$historialDenunciante->denunciasfalsas++;
		$this->historialRepo->save($historialDenunciante);

		$admin=\Auth::id();
		$anuncio_id=\Input::get('anuncio_id');

		if($anuncio=$this->anuncioRepo->reactivaranuncio($anuncio_id)){

			$this->denunciaRepo->eliminarDenunciaId($anuncio_id);

			if($historialDenunciante->denunciasfalsas >= 10 ){
				$this->usuarioRepo->bloquearUsuario($historialDenunciante->usuario_id);
				//dd('llegandoo');
			}
			return \Redirect::route('admin.revisar.denuncias')->with('status_ok', 'Anuncio revisado y activado correctamente');
		}
	}
}
