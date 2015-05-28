<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Usuario;

class RegistroSocialRepo extends BaseRepo{
	public function getModel()
	{
		return new Usuario;	
	}
	
	public function newUsuario($data){
		/*Crear un usuario para salvarlo en la base de datos 
		pero se obtienen los valores desde sociallogin*/
		$user=new Usuario();
		

		/*Codigos de Roles disponibles en la app*/
		# usuario=1
		# administrador=2
		$user->rol_id=1;

		/*Codigos de companias de celulares disponibles en la app*/
		#ninguna=1
		#movistar=2
		#claro=3
		#cnt=4
		$user->compania_id=1;

		/*Codigos de los estados que puede tener una cuenta en la app*/
		#activado=1
		#desactivado=2
		#bloqueado=3
		#eliminado=4
		/*Como el registro o login es con social login, es una cuenta real y no necesitamos
		link de verificación se establece directamente su estado como activo*/
		$user->estado_id=1;

		/*En caso de que el nombre de usuario tenga caracteres especiales(como ñ, tildes)
		el slug nos permitirá tener un nombre corto y limpio para ulrs amigables*/
		$user->slug=\Str::slug($data['nombres']);

		/*El nombre de usuario solo puede cambiarse una vez en la app,
		esto para evitar cuentas con nombres falsos y con constantes cambios de nombre (estafas)*/
		# cambio= false (nunca ha cambiado de nombre el usuario)
		# cambio=true (su nombre de usuario ha sido cambiado alguna vez)
		$user->cambio=false;

		/*La bandera social nos indica si su registro ue con una red social*/
		$user->bandera_social=true;
		

		$user->nav_avanzada=false;
		/*retornar el usuario creado*/
		return $user;
	}
	/*Metodo para buscar usuarios en el sistema mediante su correo*/

	public function buscarUsuario($correo){
		return Usuario::where('correo', $correo)->first();
	}
	
	public function buscarIdTwitterUsuario($twitter_id){
		return Usuario::where('twitter_id', $twitter_id)->first();	
	}
	/*	Metodo para cambiar estado de un usuario en BD de la app
		activar usuario */
	public function activarBanderaSocial($usuario){
		$usuario->bandera_social=true;
		$usuario->save();
	}
	public function activarUsuario($usuario){
		#activado=1
		$usuario->estado_id=1;
		
		$usuario->save();
	}
	
	
}
