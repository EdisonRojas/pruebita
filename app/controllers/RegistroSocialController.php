<?php
use Anuncia\Repositorios\RegistroSocialRepo;
use Anuncia\Managers\RegistroSocialManager;
use Anuncia\Managers\RegistroTwitterManager;

use Anuncia\Asistentes\Mensajero;
use Anuncia\Asistentes\Consejero;

class RegistroSocialController extends \BaseController{
	
	protected $registroSocialRepo;
	
	public function __construct(RegistroSocialRepo $registroSocialRepo)
	{
		$this->registroSocialRepo=$registroSocialRepo;
	}
	
	public function ingresoFacebook(){
			$code = \Input::get( 'code' );
			$fb = \OAuth::consumer( 'Facebook' );
			
			if ( !empty( $code ) ) {
					
				$token = $fb->requestAccessToken( $code );
				$result = json_decode( $fb->request( '/me' ), true );
				
				/*obtener el correo de facebook, para conocer estado de usuario en la app*/
				$correoCadena=$result['email'];
			
				/*comprobar si el usuario está activado, desactivado, bloqueado o eliminado*/
				$mensaje=$this->comprobarEstado($correoCadena);
				/*convertir la cadena correoCadena en array, para enviar  a la vista*/
				$correo=array('correo'=>$correoCadena);

				/*Regresa vacio si el estado de usuario es activado o desactivado*/
				/*Si el usuario está bloqueado o eliminado no puede seguir con el proceso conectarse*/
				if(empty($mensaje)){

					$data=array('nombres'=>$result['name'],'correo'=>$result['email'],'genero'=>$result['gender']);


					/*Crear nuevo usuario con las credenciales traidas de facebook*/
					$usuario=$this->registroSocialRepo->newUsuario($data);
					$manager= new RegistroSocialManager($usuario, $data);
					/*manager valida y guarda el nuevo usuario*/	
					if($manager->save()){
					
					}else{
					/*Si no valida, no guarda y quiere decir que el user ya existe*/	
					/*Cargamos el usuario dsde la BD de la app*/
						$usuario=$this->registroSocialRepo->buscarUsuario($data['correo']);
						if($usuario->bandera_social==false){
							$this->registroSocialRepo->activarBanderaSocial($usuario);
						}
						if($usuario->estado->estado=='desactivado'){
							$this->registroSocialRepo->activarUsuario($usuario);
						}
					}
					/*Creamos una sesion de usuario*/
					\Auth::login($usuario);
					/*Redireccionamos a la app*/
					return \Redirect::to('/')->with('ingreso_social', 'facebook');
				}else{
					return \View::make('mensajes.mensajeestadocuenta', compact('mensaje','correo'));
				}	

				// if not ask for permission first
			}else {
				// get fb authorization
				$url = $fb->getAuthorizationUri();
		
				// return to facebook login url
				return \Redirect::to( (string)$url );
			}
	}/*Fin ingresofacebook*/
	
	public function ingresoGoogle()
	{
		
		$code = \Input::get( 'code' );
		$googleService = \OAuth::consumer( 'Google' );
	
		if ( !empty( $code ) ) {
	
			$token = $googleService->requestAccessToken( $code );
			$result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );
			
			/*obtener el correo de google+, para conocer estado de usuario en la app*/
			$correoCadena=$result['email'];
			
			/*comprobar si el usuario está activado, desactivado, bloqueado o eliminado*/
			$mensaje=$this->comprobarEstado($correoCadena);
			/*convertir la cadena correoCadena en array, para enviar  a la vista*/
			$correo=array('correo'=>$correoCadena);

			/*Regresa vacio si el estado de usuario es activado o desactivado*/
			/*Si el usuario está bloqueado o eliminado no puede seguir con el proceso conectarse*/
			if(empty($mensaje)){
				//almacenar nuevo usuario o ingresar si el usuario existe
				if(!empty($result['gender'])){
					$data=array('nombres'=>$result['name'],'correo'=>$result['email'],'genero'=>$result['gender']);	
				}else{
					$data=array('nombres'=>$result['name'],'correo'=>$result['email']);
				}
				$usuario=$this->registroSocialRepo->newUsuario($data);
				$manager= new RegistroSocialManager($usuario, $data);
				
				if($manager->save()){
	
				}else{
					
					$usuario=$this->registroSocialRepo->buscarUsuario($data['correo']);
				
					if($usuario->bandera_social==false){
						$this->registroSocialRepo->activarBanderaSocial($usuario);
					}
					if($usuario->estado->estado=='desactivado'){
						$this->registroSocialRepo->activarUsuario($usuario);
					}
				}
				\Auth::login($usuario);
				
				return \Redirect::to('/')->with('ingreso_social', 'google');
			}else{
				return \View::make('mensajes.mensajeestadocuenta', compact('mensaje','correo'));
			}	
			// if not ask for permission first
		}else {

			// get googleService authorization
			$url = $googleService->getAuthorizationUri();
			// return to google login url
			return \Redirect::to( (string)$url );
		}
	}/*fin ingresotwitter*/
	
	public function ingresoTwitter(){
		// Obtener datos de entrada
		$token = \Input::get( 'oauth_token' );
		$verify = \Input::get( 'oauth_verifier' );
		
		// Obtener servicio de twitter
		$tw = \OAuth::consumer( 'Twitter' );
		
		// Verificar si el codigo es valido
		// Si se proporciona un código, obtener datos de usuario y abrir una sesión
 
		if ( !empty( $token ) && !empty( $verify ) ) {
		
			// Petición de devolución de llamada de Twitter, para obtener el token
			$token = $tw->requestAccessToken( $token, $verify );
		
			// Enviar una solicitud
			$result = json_decode( $tw->request( 'account/verify_credentials.json' ), true );
			
			// Registrar nuevo usuario o ingresar si el usuario existe
			// Obtener datos de la api de twitter
			$data=array('nombres'=>$result['name'],'twitter_id'=>$result['id']);
			// Creando el usuario para almacenar en la bd	
			$usuario=$this->registroSocialRepo->newUsuario($data);
			// Valida usuario
			$manager= new RegistroTwitterManager($usuario, $data);
			// Guarda usuario en la bd
			if($manager->save()){
			
			}else{
				// Busca usuario en la bd y lo devuelve para ingreso 
				//$usuario = Usuario::where('twitter_id', $data['twitter_id'])->first();
				$usuario=$this->registroSocialRepo->buscarIdTwitterUsuario($data['twitter_id']);
				if(($usuario->estado->estado=='eliminado')){
					return \View::make('mensajes.cuentatwittereliminada', compact('mensaje','correo'));
				}
				if(($usuario->estado->estado=='bloqueado')){
					return \View::make('mensajes.cuentatwitterbloqueada', compact('mensaje','correo'));
				}

				if($usuario->estado->estado=='desactivado'){
					$this->registroSocialRepo->activarUsuario($usuario);
				}
			}
			// Ingreso al sistema y se crea una session de usuario
			
			\Auth::login($usuario);
			if(empty($usuario->correo)){
				// Redireccionamos para solicitar correo y genero
				
				return \Redirect::to('correotwitter');
				//return \Redirect::to(route('correotwitter',$usuario->twitter_id));
				
			}
			
			
			return \Redirect::to('/')->with('ingreso_social', 'twitter');
		}
		// Si no pregunta por los permisos primero
		else 
		{
			// Obtener solicitud de token
			$reqToken = $tw->requestRequestToken();
			// Obtener autorización Uri enviaando el token de solicitud
			$url = $tw->getAuthorizationUri(array('oauth_token' => $reqToken->getRequestToken()));
		
			// Redireccionar a url de twitter login
			return \Redirect::to( (string)$url );
		}
	}


	public function comprobarEstado($correo)
	{
		$accion='conectar';
		$consejero= new Consejero($correo,$accion);
		$consejo= $consejero->getConsejo();

		if(!empty($consejo)){
			$mensajerouser=new Mensajero($consejo);
			$mensaje=$mensajerouser->getMensaje();
			return $mensaje;
		}
	}
	
}