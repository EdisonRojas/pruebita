<?php
use Anuncia\Managers\MensajeManager;

use Anuncia\Repositorios\MensajeRepo;
use Anuncia\Repositorios\UsuarioRepo;

class MensajeController extends BaseController {

	protected $mensajeRepo;
	protected $usuarioRepo;
	public function __construct(MensajeRepo $mensajeRepo,
								UsuarioRepo $usuarioRepo)
	{
		$this->mensajeRepo=$mensajeRepo;
		$this->usuarioRepo=$usuarioRepo;
	}



	public function enviarMensajeAnonimo()
	{
		$usuario_id=\Input::only('usuario_id');
		$mensaje=$this->mensajeRepo->nuevoMensaje($usuario_id);
		$manager= new MensajeManager($mensaje, \Input::all());

			if($manager->isValid())
			{
				$mensajelimpio= Purifier::clean(\Input::get('mensaje'));
				$mensaje->mensaje=$mensajelimpio;
				
	
				if($this->usuarioRepo->addmsm($usuario_id))	{
					$manager->save();	
				}
				return \Redirect::back()->with('estatus_ok','Tu mensaje ha sido enviado correctamente al anunciante');
			}
				
			return \Redirect::back()->withInput()->withErrors($manager->getErrores())->with('estatus_error','Tu mensaje no pudos ser enviado por los siguiente motivos');
		
	}

	public function verMensajes(){
		$usuario_id= \Auth::id();
		$mensajes=$this->mensajeRepo->cargarMensajes($usuario_id);
		return \View::make('modulos.mensajes.mismensajes', compact('mensajes'));
	}

	public function leerMensaje($mensaje_id){
		
		$mensaje=$this->mensajeRepo->buscar_mensaje($mensaje_id);
		$this->notFoundUnLess($mensaje);
		if($mensaje->usuario_id==\Auth::id()){

			if($this->mensajeRepo->mensajeleido($mensaje_id)){

				$mensajesnoleidos= $this->mensajeRepo->numeroMensajesNuevos(\Auth::id());
				$this->usuarioRepo->actualizarmsm(\Auth::id(), $mensajesnoleidos);

				return \View::make('modulos.mensajes.leermensaje', compact('mensaje'));

			}
		}else{
			App::abort(404);
		}

		

			
	}
	public function eliminarMensaje($mensaje_id){
		$mensaje=$this->mensajeRepo->buscar_mensaje($mensaje_id);
		$this->notFoundUnLess($mensaje);

		if($mensaje->usuario_id==\Auth::id()){
			if($this->mensajeRepo->eliminar_mensaje($mensaje)){
				return \Redirect::back()->with('estatus_ok','Tu mensaje ha sido eliminado');
			}
			return \Redirect::back()->with('estatus_error','Tu mensaje no ha podido ser eliminado');
		}else{
			App::abort(404);
		}	
	}
}
