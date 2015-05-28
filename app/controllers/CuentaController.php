<?php

use Anuncia\Entidades\Usuario;
use Anuncia\Managers\BajaCuentaManager;
use Anuncia\Managers\ModificarCuentaManager;
use Anuncia\Managers\CorreoSimpleManager;
use Anuncia\Managers\EditarPasswordManager;
use Anuncia\Asistentes\Cartero;

use Anuncia\Repositorios\UsuarioRepo;
use Anuncia\Repositorios\PostulanteRepo;
//use Anuncia\Asistentes\Cartero;

class CuentaController extends \BaseController{
	#objeto que hara consultas a la entidad Usuario
	protected $usuarioRepo;
	protected $postulanteRepo;
	
	/*Constructor para asignar el repositorio que manipulará la entidad Usuario */
	public function __construct(UsuarioRepo $usuarioRepo,
								PostulanteRepo $postulanteRepo)
	{
		$this->usuarioRepo=$usuarioRepo;
		$this->postulanteRepo=$postulanteRepo;
	}

	public function getBajarCuenta($slug){
		$usuario= \Auth::user();
		/*Verificar si la cuenta posee password, entonces si puede ser dada de baja,
		caso contrario esta registrado con redes sociales y nunca asigno un password*/
		if(!empty($usuario->password)){
			return \View::make('modulos.datos.bajacuenta', compact('usuario'));
		}
		return \View::make('modulos.datos.bajacuentasocial', compact('usuario'));
	} 
	public function postBajarCuenta($slug){
		//$data = \Input::only('password');
		
		$usuario=\Auth::user();
		$data = \Input::only('password');
		
		if (\Auth::validate($data))
		{
			
			$manager= new BajaCuentaManager($usuario, \Input::all());
			/*Asignar estado 4 (eliminado) al usuario*/
			$usuario->estado_id=4;

			if($manager->save())
			{
				\Auth::logout();
				return \View::make('mensajes.mensajebajacuenta', compact('usuario'));
			}
			return \Redirect::back()->withInput()->withErrors($manager->getErrores());
		}
		
		return \Redirect::back()->with('bajacuenta_error', 1);
	}
	public function postBajarCuentaSocial(){
		
		$usuario=\Auth::user();
		$correo=$usuario->correo;
		$correoVista=\Input::only('correo');
		/*strcmp para verificar si dos cadenas son iguales, el correo de usuario logueado 
		y el correo en la vista*/
		if(strcmp ($correo, $correoVista['correo']) == 0){
			/*Se utiliza ModificarCuentaManager, ya que solo valida un correo y 
			no importa que sea el mismo, se puede utilizar
			para verificar con simplemente si existe el correo*/
			
			$manager= new ModificarCuentaManager($usuario, \Input::all());
			$usuario->estado_id=4;
			if($manager->save()){		
				\Auth::logout();
				return \View::make('mensajes.mensajebajacuenta', compact('usuario'));
			}
			return \Redirect::back()->withInput()->withErrors($manager->getErrores());
		}else{
			return \Redirect::back()->with('correosdistintos_error', 1);
		}
		
		
	}
	function activarPostRegistro($random){
		//Usuario::where('random','=', $random)->update(array('estado_id'=>1));
		$usuario=Usuario::whereRandom($random)->first();
		if(!empty($usuario)){
			$usuario->update(array('estado_id'=>1));
			return \Redirect::to('ingreso')->with('cuentaactiva_mensaje',1);
		}else {
			dd('Error con la activacion revisar activar CuentaController');
		}
		
	}

	public function getReactivarCuenta(){

		return \View::make('modulos.datos.reactivar', compact('usuario'));
	}

	public function postReactivarCuenta(){
		$correo=\Input::only('correo');
		$existe_usuario=$this->usuarioRepo->existeUsuario($correo);

		//dd($existe_usuario);
		if($existe_usuario){
			$estado=$this->usuarioRepo->getEstado($correo);
			if(strcmp ($estado, "eliminado" ) == 0){
				$usuario=$this->usuarioRepo->buscarUsuarioCorreo($correo);
				$manager= new CorreoSimpleManager($usuario, \Input::all());

				if ($manager->isValid()) {

					$usuario->random=uniqid();
					$manager->save();
					$cartero=new Cartero();
					$cartero->cartaReactivacion($usuario);
					return \View::make('mensajes.usuarioencontradoreactivacion', compact('usuario'));
				}
				return \Redirect::back()->withInput()->withErrors($manager->getErrores());
			}
			return \Redirect::back()->with('cuentaestadonoeliminada_info', $estado);	

		}
		
		return \Redirect::back()->with('noexisteusuario_error', 1);
		//

	}
	public function getNuevoPassword($id, $random){
		
		$usuario=$this->usuarioRepo->buscarUsuarioRandomId($id, $random);

		if(!empty($usuario)){
			return \View::make('modulos.datos.reactivarypassword', compact('usuario'));
		}
		return \View::make('mensajes.errorreactivacion');
	}

	public function postNuevoPassword(){
		$usuario=$this->usuarioRepo->buscarUsuarioCorreo(\Input::only('correo'));
		$usuario->random=uniqid();
		$usuario->estado_id=1;
		$usuario->bandera_social=false;
		$manager= new EditarPasswordManager($usuario, \Input::all());

		if($manager->save()){
			return \View::make('mensajes.correctarecuperación', compact('usuario'));
		}
		return \Redirect::back()->withInput()->withErrors($manager->getErrores());
	}

	public function postularAdministrador(){
		$usuario_id= \Auth::id();

		$postulante= $this->postulanteRepo->buscarPostulante($usuario_id);

		if(!empty($postulante)){
			$this->postulanteRepo->save($postulante);
		}else{
			$postulante=$this->postulanteRepo->nuevoPostulante($usuario_id);
			$this->postulanteRepo->save($postulante);
		}
		return \View::make('mensajes.postulacion');
	}
	
}