<?php
use Anuncia\Entidades\Compania;


use Anuncia\Managers\ModificarDatosManager;
use Anuncia\Managers\ModificarCuentaManager;
use Anuncia\Managers\FotoManager;
use Anuncia\Repositorios\UsuarioRepo;

class PerfilController extends BaseController {
	protected $usuarioRepo;
	
	public function __construct(UsuarioRepo $usuarioRepo)
	{
		$this->usuarioRepo=$usuarioRepo;
	}

	public function getPerfil($slug)
	{
		$usuario= \Auth::user();
		return View::make('modulos.datos.perfil', compact('usuario'));
	}
	public function getEditarDatos($slug){

		$usuario= \Auth::user();
		$companias=Compania::orderBy('nombre','asc')->get()->lists('nombre','id');
		return \View::make('modulos.datos.editardatos', compact('usuario', 'companias'));
	}
	public function postEditarDatos($slug){

		$usuario=\Auth::user();

		$nuevoNombre=\Input::only('nombres');

		/*Comparar si el nombre ha cambiado, solo se puede cambiar una vez en el sistema*/
		/*Input devuelve un array, hay que obtener la cadena*/
		if(strcmp ($usuario->nombres, $nuevoNombre['nombres']) != 0){
			$usuario->cambio=true;
		}

		$manager= new ModificarDatosManager($usuario, \Input::all());
		if($manager->save())
		{
			
			return \Redirect::route('perfil',[$usuario->slug ])->with('cambio_correcto', 'Tu información general se ha modificado correctamente');
		}
		
		return \Redirect::back()->withInput()->withErrors($manager->getErrores());
	}
	
	public function getEdicionCuenta($slug){
		$usuario= \Auth::user();
		/*Verificar si la cuenta se ha registrado alguna ocasion con redes  sociales
		, si es así no puede modificar el correo por estar asociadao a una red*/
		if($usuario->bandera_social){
			return \View::make('modulos.datos.editarcuentasocial', compact('usuario'));
		}
		return \View::make('modulos.datos.editarcuenta', compact('usuario'));


		
	}
	public function postEdicionCuenta($slug){


		$usuario=\Auth::user();
		
		$correoNuevo = \Input::only('correo');
		/*actualcorreo es input oculto*/
		$correo=Input::get('actualcorreo');

		$password = Input::get('password');

		if (\Auth::validate(['correo' => $correo, 'password' => $password])){
			/*$usuario=\Auth::user();*/

			$manager= new ModificarCuentaManager($usuario, \Input::all());
			if($manager->save())
			{
				return \Redirect::route('perfil',[$usuario->slug ])->with('cambio_correcto', 'Tu correo ha sido modificado correctamente');
			}
			return \Redirect::back()->withInput()->withErrors($manager->getErrores());
		}
		return \Redirect::back()->with('password_error', 1);
	}
	
	public function getEditarFoto($slug){
		$usuario=\Auth::user();
		return \View::make('modulos.datos.editarfoto', compact('usuario'))->with('scriptfoto', 1);
	}

	public function postEditarFoto($slug){
		$usuario_id=\Auth::user()->id;
		//$usuario=Usuario::find(\Auth::user()->id);
		//dd($usuario);
		$usuario=$this->usuarioRepo->buscarUsuario($usuario_id);

		$manager= new FotoManager($usuario, \Input::all());	
		/*Si existe foto cargada se realiza el proceso*/
		if (\Input::hasFile('fotoperfil')){
			
			if($manager->isValid()){

				/*ruta del directorio donde se guardará la foto de perfil*/
				$ruta=public_path().'/profile/';

				/*Si no existe el directorio, se crea con los corresondientes permisos*/
				if(!is_dir($ruta)){
					mkdir($ruta, 0777, true);
				}
				
				/*Obtener datos del archivo subido temporalmente al servidor*/
				$foto=\Input::file('fotoperfil');
				
				/*El nombre de la foto estará dado por el id de usuario*/
				$nombre=$usuario->id;
				

				/*asignar al nombre y la respectiva extension (jpg, jpeg, gif, png)*/
				//$nombreFinal=$nombre.'.'.$foto->guessExtension();voy a comentar pa ver q pasa
				$nombreFinal=$nombre.'.'.$foto->getClientOriginalExtension();
				
				$usuario->foto='/profile/'.'prof_'.$nombreFinal;

				/*guess devuelve jpeg*/
				$extension=$foto->guessExtension();

				/*devulve jpg*/
				$extension2=$foto->getClientOriginalExtension();

				

				$minFoto = 'prof_'.$nombreFinal;
				/*guardamos la ruta en la bd*/
				if($manager->save()){
					
					/*Subir la foto al servidor */
					if($foto->move($ruta, $nombreFinal)){
						/*si funciona siiiii*/
						$this->resizeImagen($ruta, $nombreFinal, 500, 500, $minFoto, $extension2);
						//unlink($ruta.$nombreFinal);
						/*fin si funciona*/


						/////*Modificando foto subida, redimensionar*/
						//$imagenSubida=$ruta.$nombreFinal;
					    //$intImagen= \Image::make($imagenSubida)->resize(200, 200);
						
						/*Guardar imagen redimensionada, modifico en el servidor la foto ya subida anteriormente*/
						//if($intImagen->save($imagenSubida)){
						///dd('si gurade resizada');
						//}else{
						///	dd('NNOOOi gurade resizada');
						//}
						/*Obligo a redimensionar*/
						$imagenSubida=$ruta.$minFoto;
						$intImagen= \Image::make($imagenSubida)->resize(400, 400);
						$intImagen->save($imagenSubida);
						/*fin obligar*/	


						return \Redirect::route('perfil',[$usuario->slug ]);


					}
					dd('no subio');
					return \Redirect::back()->with('error_subir_foto', 1);
				}else{
					dd('nooo guardo');	
					return \Redirect::back()->with('error_guardar_foto', 1);
				}
				
			}
				dd('nooo valido');
				return \Redirect::back()->withInput()->withErrors($manager->getErrores());
			

		}
		dd('no hay file');
		return \Redirect::route('perfil',[$usuario->slug ]);
	}

	public function resizeImagen($ruta, $nombre, $alto, $ancho, $nombreN, $extension){
   		$rutaImagenOriginal = $ruta.$nombre;
   		

    	if($extension == 'GIF' || $extension == 'gif'){
    		//dd('llego a gif');
    		$img_original = imagecreatefromgif($rutaImagenOriginal);
    	}
    	if($extension == 'jpg' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'JPEG'){
    		//dd('llego a jpg');
    		$img_original = imagecreatefromjpeg($rutaImagenOriginal);
    	}
    	if($extension == 'png' || $extension == 'PNG'){
    		//dd('llego a png');
    		$img_original = imagecreatefrompng($rutaImagenOriginal);
    	}


    	$max_ancho = $ancho;
    	$max_alto = $alto;
    	list($ancho,$alto)=getimagesize($rutaImagenOriginal);
    	$x_ratio = $max_ancho / $ancho;
    	$y_ratio = $max_alto / $alto;
    	if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){//Si ancho 
  			$ancho_final = $ancho;
			$alto_final = $alto;
		} elseif (($x_ratio * $alto) < $max_alto){
			$alto_final = ceil($x_ratio * $alto);
			$ancho_final = $max_ancho;
		} else{
			$ancho_final = ceil($y_ratio * $ancho);
			$alto_final = $max_alto;
		}

    	$tmp=imagecreatetruecolor($ancho_final,$alto_final);
    		/*mio*/
    		$black = imagecolorallocate($tmp, 255, 255, 255);
    		// Make the background transparent
			//imagecolortransparent($tmp, $black);
			imagefill($tmp, 0, 0, $black);

    		imagecopyresampled($tmp, $img_original, 0, 0, 0, 0, $ancho_final, $alto_final,$ancho,$alto);
    		
    		if($extension == 'jpg' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'JPEG'){
    			$calidad=70;
    			imagejpeg($tmp,$ruta.$nombreN,$calidad);
    		}else if($extension == 'png' || $extension == 'PNG'){
    			imagepng($tmp,$ruta.$nombreN);
    		}



    		imagedestroy($img_original);
    }
}

