<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Mensaje;

class MensajeRepo extends BaseRepo{
	
	public function getModel()
	{
		return new Mensaje;	
	}
	
	public function nuevoMensaje($usuario_id){
		$mensaje=new Mensaje();
		$mensaje->usuario_id=$usuario_id['usuario_id'];
		$mensaje->estatus_visto="noleido";

		return $mensaje;
	}

	public function cargarMensajes($usuario_id){
		return Mensaje::where('usuario_id','=', $usuario_id)->orderBy('created_at', 'desc')->paginate(6);
	}
	public function numeroMensajesNuevos($usuario_id){
		return Mensaje::where('usuario_id','=', $usuario_id)->where('estatus_visto','=', false)->count();
	}
	
	public function buscar_mensaje($mensaje_id){
		return Mensaje::find($mensaje_id);
	}

	public function mensajeleido($mensaje_id){
		
		$mensaje=$this->buscar_mensaje($mensaje_id);
		$mensaje->estatus_visto="leido";
		$mensaje->save();
		return true;
	}
	public function eliminar_mensaje($mensaje){
		$mensaje->delete();
		return true;
	}

}
