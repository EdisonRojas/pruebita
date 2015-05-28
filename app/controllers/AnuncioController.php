<?php
use Illuminate\Support\Facades\Redirect;
use Anuncia\Entidades\Seccion;
use Anuncia\Entidades\Categoria;
use Anuncia\Entidades\Subcategoria;
use Anuncia\Entidades\Opcion;
use Anuncia\Entidades\Anuncio;

use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\AnuncianteRepo;
use Anuncia\Repositorios\SeccionRepo;
use Anuncia\Repositorios\CategoriaRepo;
use Anuncia\Repositorios\SubcategoriaRepo;
use Anuncia\Repositorios\OpcionRepo;

//use Anuncia\Managers\AnuncioManager;
use Anuncia\Managers\ClasificadoManager;
use Anuncia\Managers\ServicioManager;
use Anuncia\Managers\EmpleoManager;
use Anuncia\Managers\AnuncianteManager;

class AnuncioController extends BaseController {
	protected $anuncioRepo;
	protected $anuncianteRepo;
	protected $seccionRepo;
	protected $categoriaRepo;
	protected $subcategoriaRepo;
	protected $opcionRepo;

	
	public function __construct(AnuncioRepo $anuncioRepo, 
								AnuncianteRepo $anuncianteRepo,
								SeccionRepo $seccionRepo,
								CategoriaRepo $categoriaRepo,
								SubcategoriaRepo $subcategoriaRepo,
								OpcionRepo $opcionRepo)
	{

		$this->anuncioRepo=$anuncioRepo;
		$this->anuncianteRepo=$anuncianteRepo;
		$this->seccionRepo=$seccionRepo;
		$this->categoriaRepo=$categoriaRepo;
		$this->subcategoriaRepo=$subcategoriaRepo;
		$this->opcionRepo=$opcionRepo;
	}




	/*Método para presentar la vista de crear anucncio*/
	public function getPasoUno()
	{
		return View::make('modulos.anuncios.crear.primerpaso');
	}
	public function postPasoUno()
	{
		$seccion_id=\Input::only('seccion_id')['seccion_id'];
		$categoria=\Input::only('categoria')['categoria'];
		$subcategoria=\Input::only('subcategoria')['subcategoria'];
		$opcion=\Input::only('opcion')['opcion'];
		$seccion=$this->seccionRepo->buscarNombreSeccion($seccion_id);

		return \Redirect::route('crearanuncio',[strtolower ($seccion->seccion), $categoria, $subcategoria, $opcion]);
		
		
	}
	public function getCrearAnuncio($cabecera_seccion, $cabecera_categoria, $cabecera_subcategoria, $cabecera_opcion){
		
		$categoria=$this->categoriaRepo->buscarCategoria($cabecera_categoria);
		$subcategoria=$this->subcategoriaRepo->buscarSubcategoria($cabecera_subcategoria);
		$opcion= $this->opcionRepo->buscarOpcion($cabecera_opcion);

		$this->notFoundUnLess($categoria);
		$this->notFoundUnLess($subcategoria);
		$this->notFoundUnLess($opcion);
		

		if(strcmp ($cabecera_seccion, "clasificados") == 0){
			if($categoria->seccion_id==1 & $subcategoria->categoria_id==$categoria->id & $opcion->seccion_id==1){
				return View::make('modulos.anuncios.crear.clasificado', compact('categoria','subcategoria', 'opcion'));
			}else{
				App::abort(404);
			}
		}else if(strcmp ($cabecera_seccion, "servicios") ==0){
			if($categoria->seccion_id==2 & $subcategoria->categoria_id==$categoria->id & $opcion->seccion_id==2){
				return View::make('modulos.anuncios.crear.servicio', compact('categoria','subcategoria', 'opcion'));
			}else{
				App::abort(404);
			}
		}else if(strcmp ($cabecera_seccion, "empleos") == 0){
			if($categoria->seccion_id==3 & $subcategoria->categoria_id==$categoria->id & $opcion->seccion_id==3){
				return View::make('modulos.anuncios.crear.empleo', compact('categoria','subcategoria', 'opcion'));
			}else{
				App::abort(404);
			}
		}
		App::abort(404);
	}

	
	public function postClasificado(){

		
		$usuario_id=\Auth::id();
		$anunciante=$this->anuncianteRepo->nuevoAnunciante();
		$manageranunciante= new AnuncianteManager($anunciante, \Input::all());
		$anuncio=$this->anuncioRepo->newAnuncio($usuario_id);
		$manageranuncio= new ClasificadoManager($anuncio, \Input::all());


		if($manageranuncio->isValid()){

			if($manageranunciante->isValid()){

			/*Guardar el anuncio con los datos ingresados*/
			$titulolimpio= Purifier::clean(\Input::get('titulo'));
			$descripcionlimpia= Purifier::clean(\Input::get('descripcion'));
			
			$anuncio->descripcion=$descripcionlimpia;
			$anuncio->titulo=$titulolimpio;

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
					/*$intImagen->resize(120, 120, function ($constraint) {
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
					$anunciante->anuncio_id=$anuncio->id;
					$manageranunciante->save();
					return \Redirect::route('publicar',[$anuncio->id ]); 

				}
			}else{
				
				return Redirect::back()->withInput()->withErrors($manageranunciante->getErrores());	
			}
		}else{
			
			return Redirect::back()->withInput()->withErrors($manageranuncio->getErrores());
		}
	}

	

	public function postServicio(){
		$usuario_id=\Auth::id();
		$anunciante=$this->anuncianteRepo->nuevoAnunciante();
		$manageranunciante= new AnuncianteManager($anunciante, \Input::all());
		$anuncio=$this->anuncioRepo->newAnuncio($usuario_id);
		$manageranuncio= new ServicioManager($anuncio, \Input::all());
		if($manageranuncio->isValid()){
			if($manageranunciante->isValid()){
			/*Guardar el anuncio con los datos ingresados*/
			$titulolimpio= Purifier::clean(\Input::get('titulo'));
			$descripcionlimpia= Purifier::clean(\Input::get('descripcion'));

			$anuncio->descripcion=$descripcionlimpia;
			$anuncio->titulo=$titulolimpio;


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
					/*$intImagen->resize(120, 120, function ($constraint) {
				    	$constraint->aspectRatio();
					});*/
					$intImagen->save($imagenMiniatura);
					$anuncio->imagen='/uploads/'.$anuncio->id.'/'.'miniaturita'.'.'.$extension;
				}
				
				
				if($manageranuncio->simpleSave()){
					/*vincular anuncio con anunciante*/	
					$anunciante->anuncio_id=$anuncio->id;
					$manageranunciante->save();
					return \Redirect::route('publicar',[$anuncio->id ]); 
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
	public function postEmpleo(){
		$usuario_id=\Auth::id();
		$anunciante=$this->anuncianteRepo->nuevoAnunciante();
		$manageranunciante= new AnuncianteManager($anunciante, \Input::all());
		$anuncio=$this->anuncioRepo->newAnuncio($usuario_id);
		$manageranuncio= new EmpleoManager($anuncio, \Input::all());
		if($manageranuncio->isValid()){
			if($manageranunciante->isValid()){
			/*Guardar el anuncio con los datos ingresados*/

			$titulolimpio= Purifier::clean(\Input::get('titulo'));
			$descripcionlimpia= Purifier::clean(\Input::get('descripcion'));

			$anuncio->descripcion=$descripcionlimpia;
			$anuncio->titulo=$titulolimpio;

			$manageranuncio->save();
			/*vincular anuncio con anunciante*/			
			$anunciante->anuncio_id=$anuncio->id;
			$manageranunciante->save();
			return \Redirect::route('publicar',[$anuncio->id ]); 
				
			}else{
				return Redirect::back()->withInput()->withErrors($manageranunciante->getErrores());	
			}
		}else{
			return Redirect::back()->withInput()->withErrors($manageranuncio->getErrores());
		}	
	}

	/*metodo para subir fotos al servidor*/
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


	/*Cargar las categorias en crear anuncio mediante ajax*/
	public function categorias(){
		//if(Request::ajax()){
  	  	$seccion_id = e(\Input::get('seccion2'));
  	  	
		return Categoria::where('seccion_id','=', $seccion_id)->get();
  		//}
	}
	/*Cargar las subcategorias en crear anuncio mediante ajax*/
	public function subcategorias(){
		//if(Request::ajax()){
		$categoria_id = e(\Input::get('categoria'));
		//$seccion_id = \Input::get('seccion');
		return Subcategoria::where('categoria_id','=', $categoria_id)->get();
		//}
	}
	/*Cargar las preguntas ¿qué deseaa hacer? en crear anuncio, proceso mediante ajax*/
	public function opcion(){
		$seccion_id =e(\Input::get('seccion'));
		//dd($seccion_id );
		return Opcion::where('seccion_id','=', $seccion_id)->get();
	}

}
