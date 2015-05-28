<?php
use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\CategoriaRepo;
class GeneralController extends BaseController {
	protected $anuncioRepo;
	protected $categoriaRepo;
	public function __construct(AnuncioRepo $anuncioRepo,
								CategoriaRepo $categoriaRepo)
	{
		$this->anuncioRepo=$anuncioRepo;
		$this->categoriaRepo=$categoriaRepo;
	}

	public function verClasificados()
	{
		$anuncios=$this->anuncioRepo->buscar_anuncios_clasificados();
		return View::make('modulos.anuncios.clasificados', compact('anuncios'));
	}
	public function verServicios()
	{
		$anuncios=$this->anuncioRepo->buscar_anuncios_servicios();
		return View::make('modulos.anuncios.servicios', compact('anuncios'));
	}
	public function verEmpleos()
	{
		$anuncios=$this->anuncioRepo->buscar_anuncios_empleos();
		return View::make('modulos.anuncios.empleos', compact('anuncios'));
	}

	public function verClasificadosCategorias()
	{
		$categorias=$this->categoriaRepo->buscar_categorias_clasificados();
		return View::make('modulos.anuncios.ver.porcategorias.categoriasclasificados', compact('categorias'));
	}
	public function verServiciosCategorias()
	{
		$categorias=$this->categoriaRepo->buscar_categorias_servicios();
		return View::make('modulos.anuncios.ver.porcategorias.categoriasservicios', compact('categorias'));
	}
	public function verEmpleosCategorias()
	{
		$categorias=$this->categoriaRepo->buscar_categorias_empleos();
		return View::make('modulos.anuncios.ver.porcategorias.categoriasempleos', compact('categorias'));
	}
	
	/*Ver anuncios clasificados */
	public function clasificadosCategoriaN($categoria_id)
	{
		$anuncios=$this->anuncioRepo->clasificados_categorian($categoria_id);
		$categoria=$this->categoriaRepo->buscarCategoria($categoria_id);

		if($categoria->seccion_id==1){
			return View::make('modulos.anuncios.ver.porcategorias.clasificadoscategorian', compact('anuncios','categoria'));	
		}else{
			App::abort(404);
		}

		
	}
	public function serviciosCategoriaN($categoria_id)
	{
		$anuncios=$this->anuncioRepo->servicios_categorian($categoria_id);
		$categoria=$this->categoriaRepo->buscarCategoria($categoria_id);

		if($categoria->seccion_id==2){
			return View::make('modulos.anuncios.ver.porcategorias.servicioscategorian', compact('anuncios','categoria'));	
		}else{
			App::abort(404);
		}

		
	}
	public function empleosCategoriaN($categoria_id)
	{
		$anuncios=$this->anuncioRepo->empleos_categorian($categoria_id);
		$categoria=$this->categoriaRepo->buscarCategoria($categoria_id);

		if($categoria->seccion_id==3){
			return View::make('modulos.anuncios.ver.porcategorias.empleoscategorian', compact('anuncios','categoria'));	
		}else{
			App::abort(404);
		}

		
	}


}
