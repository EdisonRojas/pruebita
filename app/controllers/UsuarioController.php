<?php

use Anuncia\Repositorios\UsuarioRepo;
use Anuncia\Managers\RegistroManager;
use Anuncia\Managers\CorreoTwitterManager;

use Anuncia\Asistentes\Mensajero;
use Anuncia\Asistentes\Consejero;
use Anuncia\Asistentes\Cartero;

class UsuarioController extends BaseController {
	
	#objeto que hara consultas a la entidad Usuario
	protected $usuarioRepo;
	
	/*Constructor para asignar el repositorio que manipulará la entidad Usuario */
	public function __construct(UsuarioRepo $usuarioRepo)
	{
		$this->usuarioRepo=$usuarioRepo;
	}
	/*Metodo para llamar a la vista de registro */
	public function getRegistro()
	{
		return View::make('modulos.datos.registro');
	}
	/*Metodo para registro de usuario registro */
	public function postRegistro()
	{
		$correo=\Input::only('correo');

		$mensaje=$this->comprobarEstado($correo);
		if(empty($mensaje)){
			try{
				$nombres=\Input::only('nombres');
				$usuario=$this->usuarioRepo->newUsuario($nombres);
				$manager= new RegistroManager($usuario, \Input::all());
				/***/
				//Aqui crear cartero
				$cartero=new Cartero();
				/**/
				\DB::beginTransaction();

				if($manager->save())
				{
					/***/
					$cartero->cartaRegistro($usuario);
					//Aqui llamamos al metodo de cartero enviar correo
					/**/

					\DB::commit();
					return \View::make('mensajes.usuarioregistrado', compact('usuario'));
				}
				return Redirect::back()->withInput()->withErrors($manager->getErrores());
			}catch(\Exception $ex){
				\DB::rollback();
				\Session::flash('error_de_registro_servidor',1);
				return Redirect::back();
			}	
		}else{
			

			return \View::make('mensajes.mensajeestadocuenta', compact('mensaje','correo'));
		}	
	}

	/*Metodo para comprobar si el correo se encuentra asociado a una cuenta y que estado tiene*/
	public function comprobarEstado($correo)
	{
		$accion='registrar';
		$consejero= new Consejero($correo,$accion);
		$consejo= $consejero->getConsejo();

		if(!empty($consejo)){
			$mensajerouser=new Mensajero($consejo);
			$mensaje=$mensajerouser->getMensaje();
			return $mensaje;
		}
	}

	public function getCompletarTwitter()
	{

		return \View::make('modulos.datos.completarcorreotwitter');
	}
	
	public function postCompletarTwitter()
	{

		$usuario= \Auth::user();
		$manager= new CorreoTwitterManager($usuario, \Input::all());
		if($manager->save())
		{
			return \Redirect::to('/');
			//return \View::make('inicio', compact('usuario'));
		}
		return Redirect::back()->withInput()->withErrors($manager->getErrores());
		
		
	}
}
