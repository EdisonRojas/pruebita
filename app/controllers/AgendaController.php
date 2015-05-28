<?php
use Anuncia\Repositorios\AgendaRepo;
use Anuncia\Repositorios\AnuncianteRepo;

class AgendaController extends BaseController {

	protected $agendaRepo;
	protected $anuncianteRepo;
	public function __construct(AgendaRepo $agendaRepo,
								AnuncianteRepo $anuncianteRepo)
	{
		$this->agendaRepo=$agendaRepo;
		$this->anuncianteRepo=$anuncianteRepo;
	}

	public function verAgenda()
	{
		$usuario_id= \Auth::id();
		$agenda=$this->agendaRepo->cargarAgenda($usuario_id);
		return \View::make('modulos.datos.miagenda', compact('agenda'));
	}

	public function agendar($anunciante_id){
		
		$anunciante=$this->anuncianteRepo->buscar_anunciante_id($anunciante_id);
		$this->notFoundUnLess($anunciante);

		//dd($anunciante);
		$agenda= $this->agendaRepo->nuevaAgenda(\Auth::id());

		$agenda->nombre=$anunciante->anunciante;
		$agenda->celular=$anunciante->celular;
		$agenda->telefono=$anunciante->telefono;
		$agenda->correo=$anunciante->correo;
		if($this->agendaRepo->save($agenda)){
			return \Redirect::back()->with('agendar_ok','Anunciante agendado correctamente');
		}
		return \Redirect::back()->withInput()->withErrors($manager->getErrores())->with('agendar_error','Hubo un problema, no se pudo agendar anunciante');
	} 

	public function eliminarContacto($contacto_id){
		$contacto=$this->agendaRepo->buscar_contacto_id($contacto_id);
		$this->notFoundUnLess($contacto);

		if($contacto->usuario_id==\Auth::id()){
			if($this->agendaRepo->eliminar_contacto($contacto)){
				return \Redirect::back()->with('agendar_ok','Contacto eliminado correctametne');
			}
			return \Redirect::back()->with('agendar_error','Contacto no pudo ser eliminado');
		}else{
			App::abort(404);
		}	
	}




}
