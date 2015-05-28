<?php
use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\HistorialRepo;
use Anuncia\Repositorios\UsuarioRepo;

class AdminAnuncioController extends BaseController {
	protected $anuncioRepo;
	protected $historialRepo;
	protected $usuarioRepo;
	public function __construct(AnuncioRepo $anuncioRepo,
								HistorialRepo $historialRepo,
								UsuarioRepo $usuarioRepo)
	{

		$this->anuncioRepo=$anuncioRepo;
		$this->historialRepo=$historialRepo;
		$this->usuarioRepo=$usuarioRepo;
	}

	public function getPublicar()
	{
		$anuncios=$this->anuncioRepo->buscarAnunciosPorPublicar();

		return View::make('modulos.administrador.listasolicitanpublicacion',compact('anuncios'));
	}

	public function getSolicitudesPendientes()
	{
		$anuncios=$this->anuncioRepo->buscarSolicitantesPendientes(\Auth::id());

		return View::make('modulos.administrador.listasolicitantespendientes',compact('anuncios'));
	}

	public function getRevisarAnuncio($seccionanuncio, $idanuncio){

		$anuncio=$this->anuncioRepo->buscar_anuncio_id($idanuncio);
		$admin=\Auth::id();
		$this->notFoundUnLess($anuncio);
		if(strcmp ($anuncio->estatus_revision,"libre") == 0 & $anuncio->estado_id==5 ) {

			$this->anuncioRepo->estatusRevisionOcupado($anuncio, $admin);

			return View::make('modulos.administrador.revisionindividual', compact('anuncio')); 

		}else if (strcmp ($anuncio->estatus_revision,"ocupado") == 0  & ($anuncio->admin==$admin)){

			return View::make('modulos.administrador.revisionindividual', compact('anuncio')); 

		}else if (strcmp ($anuncio->estatus_revision,"ocupado") == 0  & ($anuncio->admin!=$admin)){
			
			return \Redirect::route('admin.publicar')->with('status_error', 'Este anuncio lo está revisando otro administrador.');
		
		}else{
			
			return \Redirect::route('admin.publicar')->with('status_error', 'Ese anuncio no ha solicitado revision.');
		
		}
	}
	public function activarAnuncio($anuncio_id){
		$anuncio= $this->anuncioRepo->buscar_anuncio_id($anuncio_id);

		$this->notFoundUnLess($anuncio);
		
		if($anuncio->admin==\Auth::id()){
			
			if($this->anuncioRepo->activaranuncio($anuncio_id)){
				
				return \Redirect::route('admin.publicar')->with('status_ok', 'El anuncio revisado fue correctamente activado');
			}
				
			\Redirect::route('admin.publicar')->with('status_error', 'No se pudo activar el anuncio');
		
		}else{
			App::abort(404);
		}

	}
	public function rechazarAnuncio($anuncio_id){
		$anuncio= $this->anuncioRepo->buscar_anuncio_id($anuncio_id);

		$this->notFoundUnLess($anuncio);
		
		if($anuncio->admin==\Auth::id()){
			
			if($this->anuncioRepo->rechazaranuncio($anuncio_id)){
				
				return \Redirect::route('admin.publicar')->with('status_ok', 'El anuncio fue rechazado correctamente');
			}
				
			\Redirect::route('admin.publicar')->with('status_error', 'Hubo problemas al momento de rechazar el anuncio. Volver a revisar');
		
		}else{
			App::abort(404);
		}

	}
	public function bloquearAnuncio($anuncio_id){

		$anuncio= $this->anuncioRepo->buscar_anuncio_id($anuncio_id);
		$this->notFoundUnLess($anuncio);


		



		/*Solo se pueden bloquear anuncios activos o denunciados*/
		if($anuncio->estado_id==1 | $anuncio->estado_id==6){
			if($this->anuncioRepo->bloquearanuncio($anuncio_id, \Auth::id())){
				$admin=array('nombres'=>\Auth::user()->nombres);

				$historialDenunciado= $this->historialRepo->nuevoHistorial($anuncio->usuario_id);
				$historialDenunciado->anunciosbloqueados++;
				$this->historialRepo->save($historialDenunciado);

				/*bloqueo de usuario */
				if($historialDenunciado->anunciosbloqueados >= 3 ){
					$this->usuarioRepo->bloquearUsuario($historialDenunciado->usuario_id);
					//dd('llegandoo');
				}

				/**/


				return \View::make('mensajes.bloqueadocorrectamente', compact('admin'));	
			}
			return \Redirect::back()->with('error_bloqueado','Hubo un error, el anuncio no pudo ser bloqueado');
		}else{
			App::abort(404);
		}

		
	}

}
