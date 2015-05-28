<?php
use Anuncia\Repositorios\AnuncioRepo;
use Anuncia\Repositorios\CategoriaRepo;
use Anuncia\Repositorios\SubcategoriaRepo;
class BusquedaController extends BaseController {
	protected $anuncioRepo;
	protected $categoriaRepo;
	protected $subcategoriaRepo;
	public function __construct(AnuncioRepo $anuncioRepo,
								CategoriaRepo $categoriaRepo,
								SubcategoriaRepo $subcategoriaRepo)
	{
		$this->anuncioRepo=$anuncioRepo;
		$this->categoriaRepo=$categoriaRepo;
		$this->subcategoriaRepo=$subcategoriaRepo;
	}
	/*Ver anuncios clasificados */
	public function buscarClasificadosCategoriaN($categoria_id)
	{
		$anuncios=$this->anuncioRepo->clasificados_categorian($categoria_id);
		$categoria=$this->categoriaRepo->buscarCategoria($categoria_id);

		if($categoria->seccion_id==1){
			return View::make('modulos.anuncios.buscar.porcategorias.clasificadoscategorian', compact('anuncios','categoria'));	
		}else{
			App::abort(404);
		}

		
	}
	public function buscarServiciosCategoriaN($categoria_id)
	{
		$anuncios=$this->anuncioRepo->servicios_categorian($categoria_id);
		$categoria=$this->categoriaRepo->buscarCategoria($categoria_id);

		if($categoria->seccion_id==2){
			return View::make('modulos.anuncios.buscar.porcategorias.servicioscategorian', compact('anuncios','categoria'));	
		}else{
			App::abort(404);
		}

		
	}
	public function buscarEmpleosCategoriaN($categoria_id)
	{
		$anuncios=$this->anuncioRepo->empleos_categorian($categoria_id);
		
		$categoria=$this->categoriaRepo->buscarCategoria($categoria_id);

		if($categoria->seccion_id==3){
			return View::make('modulos.anuncios.buscar.porcategorias.empleoscategorian', compact('anuncios','categoria'));	
		}else{
			App::abort(404);
		}

		
	}
	public function buscarClasificadosSubcategoriaN($categoria_id, $subcategoria_id)
	{
		
		$anuncios=$this->anuncioRepo->anuncio_subcategorian($subcategoria_id);
		$subcategoria=$this->subcategoriaRepo->buscarSubcategoria($subcategoria_id);
		$categoria=$this->categoriaRepo->buscarCategoria($categoria_id);

		$this->notFoundUnLess($subcategoria);
		$this->notFoundUnLess($categoria);

		if($categoria->seccion_id==1 & $subcategoria->categoria_id==$categoria->id ){
			return View::make('modulos.anuncios.buscar.porsubcategorias.clasificadossubcategorian', compact('anuncios','subcategoria', 'categoria'));	
		}else{
			App::abort(404);
		}

		
	}
	public function buscarServiciosSubcategoriaN($categoria_id, $subcategoria_id)
	{
		
		$anuncios=$this->anuncioRepo->anuncio_subcategorian($subcategoria_id);
		$subcategoria=$this->subcategoriaRepo->buscarSubcategoria($subcategoria_id);
		$categoria=$this->categoriaRepo->buscarCategoria($categoria_id);

		$this->notFoundUnLess($subcategoria);
		$this->notFoundUnLess($categoria);

		if($categoria->seccion_id==2 & $subcategoria->categoria_id==$categoria->id ){
			return View::make('modulos.anuncios.buscar.porsubcategorias.serviciossubcategorian', compact('anuncios','subcategoria', 'categoria'));	
		}else{
			App::abort(404);
		}

		
	}
	public function buscarEmpleosSubcategoriaN($categoria_id, $subcategoria_id)
	{
		
		$anuncios=$this->anuncioRepo->anuncio_subcategorian($subcategoria_id);
		$subcategoria=$this->subcategoriaRepo->buscarSubcategoria($subcategoria_id);
		$categoria=$this->categoriaRepo->buscarCategoria($categoria_id);

		$this->notFoundUnLess($subcategoria);
		$this->notFoundUnLess($categoria);


		if($categoria->seccion_id==3 & $subcategoria->categoria_id==$categoria->id ){
			return View::make('modulos.anuncios.buscar.porsubcategorias.empleossubcategorian', compact('anuncios','subcategoria', 'categoria'));	
		}else{
			App::abort(404);
		}
	}
}
