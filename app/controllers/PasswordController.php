<?php
use Anuncia\Managers\EditarPasswordManager;
use Anuncia\Managers\CorreoSimpleManager;
use Anuncia\Repositorios\UsuarioRepo;
use Anuncia\Asistentes\Cartero;
class PasswordController extends BaseController {
	
	#objeto que hara consultas a la entidad Usuario
	protected $usuarioRepo;
	
	/*Constructor para asignar el repositorio que manipulará la entidad Usuario */
	public function __construct(UsuarioRepo $usuarioRepo)
	{
		$this->usuarioRepo=$usuarioRepo;
	}

	public function getCambiarPassword(){
		$usuario= \Auth::user();
		
		if(!empty($usuario->password)){
			return \View::make('modulos.datos.cambiarpassword', compact('usuario'));	
		}
		//return \View::make('modulos.datos.fijarpasssword', compact('usuario'));
		//return \Redirect::to('password/fijar');
		//return \Redirect::route('perfil',[$usuario->slug ]);
		return \Redirect::route('fijarpassword');
	}
	public function postCambiarPassword(){
		$usuario=\Auth::user();
		$password = Input::get('actualpassword');
		if (\Auth::validate(['password' => $password])){
			$manager= new EditarPasswordManager($usuario, \Input::all());

			if($manager->save()){
				return \Redirect::route('perfil',[$usuario->slug ])->with('cambio_password', 'Tu password ha sido modificado correctamente');
			}
			return \Redirect::back()->withInput()->withErrors($manager->getErrores());	
		}
		return \Redirect::back()->with('password_error', 1);
	}

	public function getFijarPassword(){
		return \View::make('modulos.datos.fijarpassword', compact('usuario'));
	}

	public function postFijarPassword(){
		$usuario=\Auth::user();
		$manager= new EditarPasswordManager($usuario, \Input::all());

		if($manager->save()){
			return \Redirect::route('perfil',[$usuario->slug ])->with('cambio_password', 'Tu Contraseña ha sido establecida correctamente, ahora también puedes ingresar con tu correo y contraseña o con tu red social de preferencia');
		}
		return \Redirect::back()->withInput()->withErrors($manager->getErrores());	
	}
	/*Medoto para llamar a la vista que busca el usuario por correo*/
	public function getRecuperacionPassword(){
		return \View::make('modulos.datos.recuperacionpassword', compact('usuario'));
	}
	public function postRecuperacionPassword(){
		$correo=\Input::only('correo');
		$existe_usuario=$this->usuarioRepo->existeUsuario($correo);

		if($existe_usuario){
			$estado=$this->usuarioRepo->getEstado($correo);
			if(strcmp ($estado, "activado" ) == 0){

				$usuario=$this->usuarioRepo->buscarUsuarioCorreo($correo);
				$manager= new CorreoSimpleManager($usuario, \Input::all());

				if ($manager->isValid()) {

					$usuario->random=uniqid();
					$manager->save();
					$cartero=new Cartero();
					$cartero->cartaRecuperacionPassword($usuario);
					return \View::make('mensajes.usuarioencontradorecuperacion', compact('usuario'));
				}
				return \Redirect::back()->withInput()->withErrors($manager->getErrores());
			}
			return \Redirect::back()->with('cuentanoactivada_error', $estado);	
		}
		return \Redirect::back()->with('noexisteusuario_error', 1);



	}

	public function getNewPassword($id, $random){
		$usuario=$this->usuarioRepo->buscarUsuarioRandomId($id, $random);

		if(!empty($usuario)){
			return \View::make('modulos.datos.recuperacionnewpassword', compact('usuario'));
		}
		return \View::make('mensajes.errorrecuperacion');



	}
	public function postNewPassword(){
		$usuario=$this->usuarioRepo->buscarUsuarioCorreo(\Input::only('correo'));
		$usuario->random=uniqid();
		//$usuario->estado_id=1;
		$usuario->bandera_social=false;
		$manager= new EditarPasswordManager($usuario, \Input::all());

		if($manager->save()){
			return \View::make('mensajes.correctarecuperación', compact('usuario'));
		}
		return \Redirect::back()->withInput()->withErrors($manager->getErrores());
	}
}
