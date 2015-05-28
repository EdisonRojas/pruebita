<?php
use Anuncia\Asistentes\Mensajero;
use Anuncia\Asistentes\Consejero;
use Anuncia\Repositorios\UsuarioRepo;

class AutenticacionController extends BaseController {
	
	public function getIngreso(){
		return \View::make('modulos.datos.ingreso');
	}
	
	public function postIngreso(){
		$correo= \Input::only('correo');
		$mensaje=$this->comprobarUsuario($correo);
		if(!empty($mensaje)){
			if($mensaje['estado']=='activado'){
				$data = \Input::only('correo', 'password');
				if (\Auth::attempt($data))
				{
					$usuario=\Auth::user();
					$estado=$usuario->estado->estado;
						
					if(\Auth::check() and $usuario->estado->estado=='activado'){
						
						return \Redirect::to('/')->with('login_correcto', 1);
					}
				}
				return \Redirect::back()->with('login_error', 1);
			}else{
				
				return \View::make('mensajes.mensajeestadocuenta', compact('mensaje','correo'));
			}	
			
		}else{
			return \Redirect::back()->with('no_existe_usuario_error', 1);
		}
	}
	public function salir() 
	{
		// Cerrar la sesión
		\Auth::logout();
		// Volvemos al login y mostramos un mensaje indicando que se cerró la sesión
		return \Redirect::to('ingreso')->with('salir_correcto', 1);
	}

	public function comprobarUsuario($correo){
		$accion='ingresar';
		$consejero= new Consejero($correo,$accion);
		$consejo= $consejero->getConsejo();
	
		if(!empty($consejo)){
			$mensajerouser=new Mensajero($consejo);
			$mensaje=$mensajerouser->getMensaje();
			return $mensaje;
		}
	}
}