<?php
use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\AnuncianteRepo;
use Anuncia\Repositorios\OpcionRepo;
use Anuncia\Repositorios\ComentarioRepo;

use Anuncia\Managers\ClasificadoManager;
use Anuncia\Managers\ServicioManager;
use Anuncia\Managers\EmpleoManager;
use Anuncia\Managers\AnuncianteManager;
use Anuncia\Managers\ComentarioManager;

class AnuncioUsuarioController extends BaseController {
	protected $anuncioRepo;
	protected $anuncianteRepo;
	protected $comentarioRepo;

	public function __construct(AnuncioRepo $anuncioRepo,
								AnuncianteRepo $anuncianteRepo,
								OpcionRepo $opcionRepo,
								ComentarioRepo $comentarioRepo)
	{
		$this->anuncioRepo=$anuncioRepo;
		$this->anuncianteRepo=$anuncianteRepo;
		$this->opcionRepo=$opcionRepo;
		$this->comentarioRepo=$comentarioRepo;
	}

	public function mostrarmisanuncios(){
		$usuario_id=\Auth::id();
		
		$anuncios=$this->anuncioRepo->buscar_anuncios_usuario($usuario_id);
		return \View::make('modulos.anuncios.misanuncios', compact('anuncios'));
	}
	public function verAnuncio($seccion, $anuncio_id){

		$anuncio= $this->anuncioRepo->buscar_anuncio_id($anuncio_id);
		$this->notFoundUnLess($anuncio);

		$comentarios=$this->comentarioRepo->cargarComentarios($anuncio->id);
		/*Si el anuncio está activo, puede visualziarlo cualquier usuario*/
		if($anuncio->estado_id==1){
			
			
			if($anuncio->seccion_id==1){
				return \View::make('modulos.anuncios.ver.clasificado', compact('anuncio', 'comentarios'));
			}else if($anuncio->seccion_id==2){
				return \View::make('modulos.anuncios.ver.servicio', compact('anuncio', 'comentarios'));
			}else if($anuncio->seccion_id==3){
				return \View::make('modulos.anuncios.ver.empleo', compact('anuncio', 'comentarios'));
			}
			/*Si estado del anuncio es distinto de activo solo puede visualizarlo su dueño, pero nadie mas
			así utilice la url para compartirla*/
		}else if($anuncio->estado_id!=1 & \Auth::id()==$anuncio->usuario_id){
			if($anuncio->seccion_id==1){
				return \View::make('modulos.anuncios.ver.clasificado', compact('anuncio', 'comentarios'));
			}else if($anuncio->seccion_id==2){
				return \View::make('modulos.anuncios.ver.servicio', compact('anuncio', 'comentarios'));
			}else if($anuncio->seccion_id==3){
				return \View::make('modulos.anuncios.ver.empleo', compact('anuncio', 'comentarios'));
			}
		}else{
			App::abort(404);
		}
	}

	public function getSolicitudPublicar($anuncio_id)
	{
		
		$idanuncio=array('anuncio_id'=>$anuncio_id);
		$usuario=\Auth::user();
		return View::make('modulos.anuncios.solicitarpublicar', compact('usuario','idanuncio'));
	}

	public function publicaranuncio($anuncio_id){

		
		$anuncio= $this->anuncioRepo->buscar_anuncio_id($anuncio_id);

		$this->notFoundUnLess($anuncio);
		
		if($anuncio->usuario_id==\Auth::id()){
			
			if($this->anuncioRepo->publicaranuncio($anuncio_id)){
				
				return \Redirect::route('misanuncios')->with('status_ok', 'Solicitud para publicación enviada correctamente');
			}
				
			\Redirect::route('misanuncios')->with('status_error', 'No se pudo enviar la solicitud');
		
		}else{
			App::abort(404);
		}

	}
	public function borraranuncio($anuncio_id){


		$anuncio= $this->anuncioRepo->buscar_anuncio_id($anuncio_id);

		$this->notFoundUnLess($anuncio);
		
		if($anuncio->usuario_id==\Auth::id()){
			if($this->es_borrable($anuncio)){
				if($this->eliminaranunciante($anuncio_id)){
					if($this->anuncioRepo->borraranuncio($anuncio_id)){
						$this->eliminarDir(public_path().'/uploads/'.$anuncio_id);
						return \Redirect::route('misanuncios')->with('status_ok', 'Anuncio eliminado correctamente');
					}
					
					return \Redirect::route('misanuncios')->with('status_error', 'No se pudo eliminar el anunciante de este anuncio ni el anuncio');	
				}
				return \Redirect::route('misanuncios')->with('status_error', 'No se pudo eliminar el anuncio');
			}
			return \Redirect::route('misanuncios')->with('status_error', 'No se pudo eliminar el anuncio por el estado que posee');
		}else{
			App::abort(404);
		}
	}

	public function es_borrable($anuncio){
		if($anuncio->estado_id==1 | $anuncio->estado_id==2 | $anuncio->estado_id==5 | $anuncio->estado_id==7){
			return true;
		}

		return false;
	}

	public function desactivaranuncio($anuncio_id){
		$anuncio= $this->anuncioRepo->buscar_anuncio_id($anuncio_id);

		$this->notFoundUnLess($anuncio);
		
		if($anuncio->usuario_id==\Auth::id()){
			
			if($this->anuncioRepo->desactivaranuncio($anuncio_id)){
				
				return \Redirect::route('misanuncios')->with('status_ok', 'Anuncio desactivado correctamente');
			}
				
			\Redirect::route('misanuncios')->with('status_error', 'No se pudo desactivar el anuncio');
		
		}else{
			App::abort(404);
		}
	}

	public function es_editable($anuncio){
		if($anuncio->estado_id==1 | $anuncio->estado_id==2 | $anuncio->estado_id==5 | $anuncio->estado_id==7){
			return true;
		}

		return false;
	}

	public function getEditarAnuncio($anuncio_id){
		
		$anuncio= $this->anuncioRepo->buscar_anuncio_id($anuncio_id);

		$this->notFoundUnLess($anuncio);
		
		$opcion= $this->opcionRepo->buscarOpcion($anuncio->pregunta);

		if($this->es_editable($anuncio)){
			if( strcmp ($anuncio->estatus_revision,"ocupado") == 0 ){
				return \Redirect::route('misanuncios')->with('status_error', 'Tu anuncio está siendo revisado en este momento, no puedes editarlo');
			}

			if($anuncio->usuario_id==\Auth::id()){
				$anunciante=$this->anuncianteRepo->buscar_anunciante_id($anuncio->anunciante->id);

				
				if($anuncio->seccion_id==1){
					return \View::make('modulos.anuncios.editar.clasificado', compact('anuncio','anunciante','opcion'));	
				}else if($anuncio->seccion_id==2){
					return \View::make('modulos.anuncios.editar.servicio', compact('anuncio','anunciante','opcion'));	
				}else if($anuncio->seccion_id==3){
					return \View::make('modulos.anuncios.editar.empleo', compact('anuncio','anunciante','opcion'));
				}
			}else{
				App::abort(404);
			}
		}else{
			return \Redirect::route('misanuncios')->with('status_error', 'Tu anuncio no puede ser editado, por el estado que posee');
		}

	}

	public function editarClasificado(){
		$anuncio= $this->anuncioRepo->buscar_anuncio_id(\Input::only('anuncio')['anuncio']);
		$anunciante=$anuncio->anunciante;
		
		$manageranunciante= new AnuncianteManager($anunciante, \Input::all());
		$manageranuncio= new ClasificadoManager($anuncio, \Input::all());

		if($manageranuncio->isValid()){
			
			if($manageranunciante->isValid()){
				/*Usar purifier para evitar ataques xss*/
				$titulolimpio= Purifier::clean(\Input::get('titulo'));
				$descripcionlimpia= Purifier::clean(\Input::get('descripcion'));
				
				$anuncio->descripcion=$descripcionlimpia;
				$anuncio->titulo=$titulolimpio;
				/*Se cambia estado de rechazado a desactivado para que el anuncio pueda ser enviado nuevamente con solicitud de publciacion*/
				if($anuncio->estado_id==7){
					$anuncio->estado_id=2;
				}
	
				$manageranuncio->save();
				/*ruta del directorio pincipal donde se guardarán las fotos subidas por usuarios sobre sus anuncios*/
				$directorio=public_path().'/uploads/';
				$carpetaanuncio=$directorio.$anuncio->id.'/';
				if (\Input::hasFile('foto1')){	
					/*Obtener datos del archivo subido temporalmente al servidor*/
					$fotosubida=\Input::file('foto1');
					$extension=$fotosubida->getClientOriginalExtension();
					$numfoto=1;
					$this->subirfoto($carpetaanuncio, $fotosubida, $numfoto);
					$anuncio->foto1='/uploads/'.$anuncio->id.'/'.'mir_foto1'.'.'.$fotosubida->getClientOriginalExtension();

					/*resize imagen para miniatura*/
					$imagenMiniatura= $carpetaanuncio.'miniaturita'.'.'.$extension;
					$intImagen= \Image::make($imagenMiniatura)->resize(120, 120);
					/*ancho los define de acuerdo a la imagen original y el alto de 120*/
					/*$intImagen->resize(null, 120, function ($constraint) {
				    	$constraint->aspectRatio();
					});*/
					$intImagen->save($imagenMiniatura);
					$anuncio->imagen='/uploads/'.$anuncio->id.'/'.'miniaturita'.'.'.$extension;
				}
				if (\Input::hasFile('foto2')){	
					$fotosubida=\Input::file('foto2');
					$numfoto=2;
					$this->subirfoto($carpetaanuncio, $fotosubida, $numfoto);
					$anuncio->foto2='/uploads/'.$anuncio->id.'/'.'mir_foto2'.'.'.$fotosubida->getClientOriginalExtension();
				}
				if (\Input::hasFile('foto3')){	
					$fotosubida=\Input::file('foto3');
					$numfoto=3;
					$this->subirfoto($carpetaanuncio, $fotosubida, $numfoto);
					$anuncio->foto3='/uploads/'.$anuncio->id.'/'.'mir_foto3'.'.'.$fotosubida->getClientOriginalExtension();
				}
				if (\Input::hasFile('foto4')){	
					$fotosubida=\Input::file('foto4');
					$numfoto=4;
					$this->subirfoto($carpetaanuncio, $fotosubida, $numfoto);
					$anuncio->foto4='/uploads/'.$anuncio->id.'/'.'mir_foto4'.'.'.$fotosubida->getClientOriginalExtension();
				}
				if($manageranuncio->simpleSave()){
					/*vincular anuncio con anunciante*/	
					//$anunciante->anuncio_id=$anuncio->id;
					$manageranunciante->save();
					return \Redirect::route('misanuncios')->with('status_ok','Su anuncio fue editado correctamente'); 
				}
			}else{
				
					return Redirect::back()->withInput()->withErrors($manageranunciante->getErrores());	
			}
		}else{
			
			return Redirect::back()->withInput()->withErrors($manageranuncio->getErrores());
		}
	}

	public function editarServicio(){
		$anuncio= $this->anuncioRepo->buscar_anuncio_id(\Input::only('anuncio')['anuncio']);
		$anunciante=$anuncio->anunciante;
		
		$manageranunciante= new AnuncianteManager($anunciante, \Input::all());
		$manageranuncio= new ServicioManager($anuncio, \Input::all());
		if($manageranuncio->isValid()){
			if($manageranunciante->isValid()){
					/*Guardar el anuncio con los datos ingresados*/
				$titulolimpio= Purifier::clean(\Input::get('titulo'));
				$descripcionlimpia= Purifier::clean(\Input::get('descripcion'));

				$anuncio->descripcion=$descripcionlimpia;
				$anuncio->titulo=$titulolimpio;

				if($anuncio->estado_id==7){
					$anuncio->estado_id=2;
				}
				$manageranuncio->save();

				/*ruta del directorio pincipal donde se guardarán las fotos subidas por usuarios sobre sus anuncios*/
				$directorio=public_path().'/uploads/';

				$carpetaanuncio=$directorio.$anuncio->id.'/';
				if (\Input::hasFile('foto1')){	
					/*Obtener datos del archivo subido temporalmente al servidor*/
					$fotosubida=\Input::file('foto1');
					$extension=$fotosubida->getClientOriginalExtension();
					$numfoto=1;
					$this->subirfoto($carpetaanuncio, $fotosubida, $numfoto);
					$anuncio->foto1='/uploads/'.$anuncio->id.'/'.'mir_foto1'.'.'.$fotosubida->getClientOriginalExtension();

					/*resize imagen para miniatura*/
					$imagenMiniatura= $carpetaanuncio.'miniaturita'.'.'.$extension;
					$intImagen= \Image::make($imagenMiniatura)->resize(120, 120);
					/*ancho los define de acuerdo a la imagen original y el alto de 120*/
					/*$intImagen->resize(null, 120, function ($constraint) {
				    	$constraint->aspectRatio();
					});*/
					$intImagen->save($imagenMiniatura);
					$anuncio->imagen='/uploads/'.$anuncio->id.'/'.'miniaturita'.'.'.$extension;
				}
				
				
				if($manageranuncio->simpleSave()){
					/*vincular anuncio con anunciante*/	
					/*$anunciante->anuncio_id=$anuncio->id;*/
					$manageranunciante->save();
					return \Redirect::route('misanuncios')->with('status_ok','Su anuncio fue editado correctamente'); 
				}
		}else{
				//dd($manageranunciante->getErrores());
				return Redirect::back()->withInput()->withErrors($manageranunciante->getErrores());	
			}
		}else{
			//dd($manageranuncio->getErrores());
			return Redirect::back()->withInput()->withErrors($manageranuncio->getErrores());
		}




	}
	public function editarEmpleo(){
		$anuncio= $this->anuncioRepo->buscar_anuncio_id(\Input::only('anuncio')['anuncio']);
		$anunciante=$anuncio->anunciante;
		
		$manageranunciante= new AnuncianteManager($anunciante, \Input::all());
		$manageranuncio= new EmpleoManager($anuncio, \Input::all());

		if($manageranuncio->isValid()){
			if($manageranunciante->isValid()){
			/*Guardar el anuncio con los datos ingresados*/

				$titulolimpio= Purifier::clean(\Input::get('titulo'));
				$descripcionlimpia= Purifier::clean(\Input::get('descripcion'));

				$anuncio->descripcion=$descripcionlimpia;
				$anuncio->titulo=$titulolimpio;

				if($manageranuncio->simpleSave()){
					$manageranunciante->save();
					return \Redirect::route('misanuncios')->with('status_ok','Su anuncio fue editado correctamente'); 
				}
			}else{
				return Redirect::back()->withInput()->withErrors($manageranunciante->getErrores());	
			}
		}else{
			return Redirect::back()->withInput()->withErrors($manageranuncio->getErrores());
		}	
	}

	public function eliminaranunciante($anunciante_id){
		
		if($this->anuncianteRepo->borraranuncianteanuncio($anunciante_id)){
			return true;
		}
		return false;

	}

	public function eliminarDir($carpeta){
		if(is_dir($carpeta)){
			foreach (glob($carpeta . "/*") as $archivos_carpeta){
				unlink($archivos_carpeta);
			} 
			rmdir($carpeta);
		}
	}


	public function subirfoto($carpetaanuncio, $fotosubida, $numfoto){
		/*ruta del directorio pincipal donde se guardarán las fotos subidas por usuarios sobre sus anuncios*/
		# $directorio=public_path().'/uploads/';
		/*Si no existe el directorio donde se guardarán las fotos, se crea con los corresondientes permisos*/
		if(!is_dir($carpetaanuncio)){
			mkdir($carpetaanuncio, 0777, true);
		}

		/*Asignar el nombre de la foto*/
		if($numfoto==1){
			$nombrefoto='mir_foto1';
		}else if($numfoto==2){
			$nombrefoto='mir_foto2';
		}else if($numfoto==3){
			$nombrefoto='mir_foto3';
		}else if($numfoto==4){
			$nombrefoto='mir_foto4';
		}
		/*asignar al nombrefinal que se gardará en bd y la respectiva extension (jpg, jpeg, gif, png)*/
		$nombreFinal=$nombrefoto.'.'.$fotosubida->getClientOriginalExtension();
		/*nombre para la copia de foto1 que servirá como miniatura*/
		$miniatura='miniaturita'.'.'.$fotosubida->getClientOriginalExtension();

		$fotosubida->move($carpetaanuncio, $nombreFinal);
		/*realizar copia solo de foto1 para converirla en miniatura*/
		if($numfoto==1){
			copy ($carpetaanuncio.$nombreFinal, $carpetaanuncio.$miniatura);
		}

		$intImagen= \Image::make($carpetaanuncio.$nombreFinal)->resize(750, 750);
				
		$intImagen->save($carpetaanuncio.$nombreFinal);
	}
}
