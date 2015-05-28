<?php namespace Anuncia\Repositorios;

use Anuncia\Entidades\Usuario;

class UsuarioRepo extends BaseRepo{
	
	public function getModel()
	{
		return new Usuario;	
	}
	
	public function newUsuario($nombres){
		
		$user=new Usuario();
		$user->rol_id=1;
		$user->compania_id=1;
		$user->estado_id=2;
		$user->random=uniqid();
		$user->nav_avanzada=false;
		$user->slug=\Str::slug($nombres['nombres']);
		$user->cambio=false;
		$user->bandera_social=false;
		
		return $user;
	}

	public function usuarioAnonimo(){
		$user= new Usuario();
		return $user;
	}
	
	public function buscarUsuario($id){
		$user= Usuario::find($id);
		return $user;
	}
	
	
	public function buscarUsuarioCorreo($correo){
		$user= Usuario::whereCorreo($correo)->first();
		return $user;
	}
	public function existeUsuario($correo){
		$user= Usuario::whereCorreo($correo)->first();
		if(!empty($user)){
			return true;
		}
		return false;
	}

	public function buscarUsuarioTwitter_id($twitter_id){
		$user= Usuario::whereTwitter_id($twitter_id)->first();
		
		return $user;
	}

	public function buscarUsuarioRandomId($id, $random){

		$usuario=Usuario::whereRandom($random)->first();
		if(!empty($usuario)){
			if($id==$usuario->id){
				return $usuario;		
			}	
			return null;
		}
		return null;
	}
	
	public function usuariosActivos(){
		return Usuario::where('estado_id','=', 1)->where('rol_id','=', 1)->paginate(6);
	}
	public function usuariosDesactivados(){
		return Usuario::where('estado_id','=', 2)->where('rol_id','=', 1)->paginate(6);
	}
	public function usuariosBloqueados(){
		return Usuario::where('estado_id','=',3)->where('rol_id','=', 1)->paginate(6);
	}


	public function buscarAdministradores(){
		return Usuario::where('rol_id','=', 2)->get();
	}


	public function getEstado($correo){
		$usuario= Usuario::whereCorreo($correo)->first();
		$estado="";
		if(!empty($usuario)){
			$estado= Usuario::whereCorreo($correo)->first()->estado->estado;
			
		}
		return $estado;
	}

	public function actualizarmsm($usuario_id, $cantidadmsm){
		$usuario=Usuario::find($usuario_id);
		$usuario->msm= $cantidadmsm;
		
		$usuario->save();
		return true;
	}
	public function addmsm($usuario_id){
		$usuario=Usuario::find($usuario_id)->first();
		//dd($usuario);
		$usuario->msm= $usuario->msm+1;
		$usuario->save();
		return true;
	}

	public function promoverAdministrador($usuario_id){
		$usuario=Usuario::find($usuario_id);
		$usuario->rol_id=2;

		$usuario->save();

		return true;

	}
	public function cancelarAdministrador($usuario_id){
		$usuario=Usuario::find($usuario_id);
		$usuario->rol_id=1;
		$usuario->nav_avanzada=false;
		$usuario->save();

		return true;

	}
	public function bloquearUsuario($usuario_id){
		$usuario=Usuario::find($usuario_id);
		$usuario->estado_id=3;
		
		$usuario->save();

		return true;

	}

}
