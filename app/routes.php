<?php
/*Route::get('/', ['as'=>'main', 'uses'=>'MainController@getMain']);
'/'-->ruta en el navegador
as='main'-->nombre de la ruta, se llama en las vistas o controlador
uses=>MainController@getMain-->nombre del controlador y del metodo que utiliza esa ruta
*/

/*Ruta para llamar al main de la app*/
Route::get('/', ['as'=>'main', 'uses'=>'MainController@getMain']);
Route::get('ver/anuncio/{seccion}/{anuncio}', ['as'=>'veranuncio', 'uses'=>'AnuncioUsuarioController@verAnuncio']);
Route::get('clasificados', ['as'=>'verclasificados', 'uses'=>'GeneralController@verClasificados']);
Route::get('servicios', ['as'=>'verservicios', 'uses'=>'GeneralController@verServicios']);
Route::get('empleos', ['as'=>'verempleos', 'uses'=>'GeneralController@verEmpleos']);
Route::post('mensajes', ['as'=>'enviarmensajeanonimo', 'uses'=>'MensajeController@enviarMensajeAnonimo']);

Route::get('clasificados/categorias', ['as'=>'clasificados.categorias', 'uses'=>'GeneralController@verClasificadosCategorias']);
Route::get('servicios/categorias', ['as'=>'servicios.categorias', 'uses'=>'GeneralController@verServiciosCategorias']);
Route::get('empleos/categorias', ['as'=>'empleos.categorias', 'uses'=>'GeneralController@verEmpleosCategorias']);

Route::get('clasificados/{categoria}', ['as'=>'clasificados.categoria.n', 'uses'=>'BusquedaController@buscarClasificadosCategoriaN']);
Route::get('servicios/{categoria}', ['as'=>'servicios.categoria.n', 'uses'=>'BusquedaController@buscarServiciosCategoriaN']);
Route::get('empleos/{categoria}', ['as'=>'empleos.categoria.n', 'uses'=>'BusquedaController@buscarEmpleosCategoriaN']);


Route::get('clasificados/{categoria}/{subcategoria}', ['as'=>'clasificados.subcategoria.n', 'uses'=>'BusquedaController@buscarClasificadosSubcategoriaN']);
Route::get('servicios/{categoria}/{subcategoria}', ['as'=>'servicios.subcategoria.n', 'uses'=>'BusquedaController@buscarServiciosSubcategoriaN']);
Route::get('empleos/{categoria}/{subcategoria}', ['as'=>'empleos.subcategoria.n', 'uses'=>'BusquedaController@buscarEmpleosSubcategoriaN']);


Route::group(['before'=>'guest'], function(){

/*Rutas para el proceso de registro en la app*/
	Route::get('registro', ['as'=>'registro', 'uses'=>'UsuarioController@getRegistro']);
	Route::post('registro', ['as'=>'registro', 'uses'=>'UsuarioController@postRegistro']);

/*Rutas para el proceso de ingreso en la app*/
	Route::get('ingreso', ['as'=>'ingreso', 'uses'=>'AutenticacionController@getIngreso']);
	Route::post('ingreso', ['as'=>'ingreso', 'uses'=>'AutenticacionController@postIngreso']);

/*Rutas para llamado a ingreso por facebook, google+ y twitter*/
	Route::get('ingresofacebook', ['as'=>'ingresofacebook', 'uses'=>'RegistroSocialController@ingresoFacebook']);
	Route::get('ingresogoogle', ['as'=>'ingresogoogle', 'uses'=>'RegistroSocialController@ingresoGoogle']);
	Route::get('ingresotwitter', ['as'=>'ingresotwitter', 'uses'=>'RegistroSocialController@ingresoTwitter']);

/*Rutas para pedir reactivacion de la cuenta después de haber sido borrada*/
	Route::get('reactivar', ['as'=>'reactivacioncuenta', 'uses'=>'CuentaController@getReactivarCuenta']);
	Route::post('reactivar', ['as'=>'reactivacioncuenta', 'uses'=>'CuentaController@postReactivarCuenta']);

	Route::get('reactivar/nuevopassword/{id}/{random}', ['as'=>'nuevopassword', 'uses'=>'CuentaController@getNuevoPassword']);
	Route::post('reactivar/nuevopassword', ['as'=>'nuevopassword', 'uses'=>'CuentaController@postNuevoPassword']);

/*Rutas para pedir recuperación de password olvidado*/
	Route::get('recuperar/acceso', ['as'=>'password.recuperacion', 'uses'=>'PasswordController@getRecuperacionPassword']);
	Route::post('recuperar/acceso', ['as'=>'password.recuperacion', 'uses'=>'PasswordController@postRecuperacionPassword']);
	Route::get('recuperar/password/{id}/{random}', ['as'=>'password.nuevo', 'uses'=>'PasswordController@getNewPassword']);
	Route::post('recuperar/password', ['as'=>'password.nuevo', 'uses'=>'PasswordController@postNewPassword']);	

/*Ruta para activacion de la cuenta después de registro, registro mediante correo*/
	Route::get('activar/{random}', 'CuentaController@activarPostRegistro');

	/*Ruta para llamar a la vista de anuncio individual*/






});


Route::group(['before'=>'auth'], function(){
/*Rutas para el proceso de salir en la app*/
	Route::get('salir', ['as'=>'salir', 'uses'=>'AutenticacionController@salir']);
/*Rutas para darse de baja en la app*/
	Route::get('eliminarmicuenta/{slug}', ['as'=>'bajacuenta', 'uses'=>'CuentaController@getBajarCuenta']);
	Route::post('eliminarmicuenta/{slug}', ['as'=>'bajacuenta', 'uses'=>'CuentaController@postBajarCuenta']);

	Route::post('bajacuenta', ['as'=>'bajacuentasocial', 'uses'=>'CuentaController@postBajarCuentaSocial']);
/*Rutas para llamado a completar el registro por twitter*/
	Route::get('correotwitter', ['as'=>'correotwitter', 'uses'=>'UsuarioController@getCompletarTwitter']);
	Route::post('correotwitter', ['as'=>'correotwitter', 'uses'=>'UsuarioController@postCompletarTwitter']);

/*Rutas para llamado y uso del perfil de usuario*/
	Route::get('perfil/{slug}', ['as'=>'perfil', 'uses'=>'PerfilController@getPerfil']);

/*Rutas para llamado a edicion de datos generales en perfil*/
	Route::get('perfil/{slug}/editar-datos', ['as'=>'ediciondatos', 'uses'=>'PerfilController@getEditarDatos']);
	Route::post('perfil/{slug}/editar-datos', ['as'=>'ediciondatos', 'uses'=>'PerfilController@postEditarDatos']);

/*Ruta para cambiar la imagen de perfil*/
	Route::get('perfil/{slug}/editar-foto', ['as'=>'edicionfoto', 'uses'=>'PerfilController@getEditarFoto']);
	Route::post('perfil/{slug}/editar-foto', ['as'=>'edicionfoto', 'uses'=>'PerfilController@postEditarFoto']);

/*Rutas para llamado a edicion de datos de la cuenta en perfil (User logueado)*/
	Route::get('perfil/{slug}/editar-cuenta', ['as'=>'edicioncuenta', 'uses'=>'PerfilController@getEdicionCuenta']);
	Route::post('perfil/{slug}/editar-cuenta', ['as'=>'edicioncuenta', 'uses'=>'PerfilController@postEdicionCuenta']);

/*Rutas para llamado a cambiar contraseña de la cuenta (User logueado) y si no posee llamado a fijar contraseña*/
	Route::get('password/cambiar', ['as'=>'cambiarpassword', 'uses'=>'PasswordController@getCambiarPassword']);
	Route::post('password/cambiar', ['as'=>'cambiarpassword', 'uses'=>'PasswordController@postCambiarPassword']);

	Route::get('password/fijar', ['as'=>'fijarpassword', 'uses'=>'PasswordController@getFijarPassword']);
	Route::post('password/fijar', ['as'=>'fijarpassword', 'uses'=>'PasswordController@postFijarPassword']);

	/*Rutas para crear un anuncio*/
	
	Route::get('crear/anuncio', ['as'=>'pasouno', 'uses'=>'AnuncioController@getPasoUno']);
	Route::post('crear/anuncio', ['as'=>'pasouno', 'uses'=>'AnuncioController@postPasoUno']);
	//*Rutas llamadas mediante ajax para rellenar los selects de categorias, subcategorias y preguntas en crear anuncio*/
	Route::post('crear/categorias', ['as'=>'categorias', 'uses'=>'AnuncioController@categorias']);
	Route::post('crear/subcategorias', ['as'=>'subcategorias', 'uses'=>'AnuncioController@subcategorias']);
	Route::post('crear/opcion', ['as'=>'opcion', 'uses'=>'AnuncioController@opcion']);


	Route::get('crear/anuncio/{seccion}/{categoria}/{subcategoria}/{opcion}', ['as'=>'crearanuncio', 'uses'=>'AnuncioController@getCrearAnuncio']);

	Route::post('clasificadocreado', ['as'=>'clasificadocreado', 'uses'=>'AnuncioController@postClasificado']);
	Route::post('serviciocreado', ['as'=>'serviciocreado', 'uses'=>'AnuncioController@postServicio']);
	Route::post('empleocreado', ['as'=>'empleocreado', 'uses'=>'AnuncioController@postEmpleo']);

	Route::get('anuncio/editar/{anuncio}', ['as'=>'editaranuncio', 'uses'=>'AnuncioUsuarioController@getEditarAnuncio']);
	Route::put('anuncio/editar/clasificado', ['as'=>'editarclasificado', 'uses'=>'AnuncioUsuarioController@editarClasificado']);
	Route::put('anuncio/editar/servicio', ['as'=>'editarservicio', 'uses'=>'AnuncioUsuarioController@editarServicio']);
	Route::put('anuncio/editar/empleo', ['as'=>'editarempleo', 'uses'=>'AnuncioUsuarioController@editarEmpleo']);



	/*Ruta para mostrar mensaje después de crear anuncio*/
	Route::get('anuncio/solicitud/publicar/{anuncio_id}', ['as'=>'publicar', 'uses'=>'AnuncioUsuarioController@getSolicitudPublicar']);
	
	/*Ruta para llamar a mis anuncios*/	
	Route::get('misanuncios', ['as'=>'misanuncios', 'uses'=>'AnuncioUsuarioController@mostrarmisanuncios']);

	Route::get('anuncio/borrar/{anuncio}', ['as'=>'borraranuncio', 'uses'=>'AnuncioUsuarioController@borraranuncio']);
	Route::get('anuncio/desactivar/{anuncio}', ['as'=>'desactivaranuncio', 'uses'=>'AnuncioUsuarioController@desactivaranuncio']);
	Route::get('anuncio/publicar/{anuncio}', ['as'=>'publicaranuncio', 'uses'=>'AnuncioUsuarioController@publicaranuncio']);


	/*Rutas para visualizar los mensajes dentro de la app*/
	Route::get('ver/mensajes', ['as'=>'mismensajes', 'uses'=>'MensajeController@verMensajes']);
	Route::get('leer/mensaje/{id}', ['as'=>'leermensaje', 'uses'=>'MensajeController@leerMensaje']);
	Route::get('eliminar/mensaje/{id}', ['as'=>'eliminarmensaje', 'uses'=>'MensajeController@eliminarMensaje']);
	//Route::post('ingreso', ['as'=>'ingreso', 'uses'=>'AutenticacionController@postIngreso']);
	
	Route::get('ver/agenda', ['as'=>'miagenda', 'uses'=>'AgendaController@verAgenda']);
	Route::get('agendar/{anunciante_id}', ['as'=>'agendar', 'uses'=>'AgendaController@agendar']);
	Route::get('eliminar/contacto/{contacto_id}', ['as'=>'eliminarcontacto', 'uses'=>'AgendaController@eliminarContacto']);

	/*Ruta para denunciar un anuncio*/
	Route::post('anuncio/denunciar', ['as'=>'denunciaranuncio', 'uses'=>'DenunciaController@denunciarAnuncio']);

	/*Ruta para crear comentario*/
	Route::post('ver/anuncio/{seccion}/{anuncio}/comentario', ['as'=>'comentario', 'uses'=>'ComentarioController@comenta']);
	Route::post('ver/anuncio/{seccion}/{anuncio}/respuesta', ['as'=>'respuesta', 'uses'=>'ComentarioController@respuesta']);

	/*ruta para postular como administrador en miradita*/
	Route::get('perfil/postular/administrador',['as'=>'postular', 'uses'=>'CuentaController@postularAdministrador']);

//admin rutas
	Route::group(['before'=>'is_admin'], function(){

	Route::get('paneladministrador/activar', ['as'=>'activarpanel', 'uses'=>'AdministradorController@activarPanel']);
	Route::get('paneladministrador/desactivar', ['as'=>'desactivarpanel', 'uses'=>'AdministradorController@desactivarPanel']);
	
	Route::get('administracion',['as'=>'administracion', 'uses'=>'AdministradorController@getGeneral']);
	Route::get('admin/tareas',['as'=>'admin.pendientes', 'uses'=>'AdministradorController@getPendientes']);

	/*Ruta para presentar la tabla con anuncios que necesitan revision para ser publicados*/
	Route::get('admin/anuncios/solicitantes',['as'=>'admin.publicar', 'uses'=>'AdminAnuncioController@getPublicar']);
	/*Ruta para presentar la tabla con anuncios denunciados que necesitan revision*/
	Route::get('admin/anuncios/denunciados',['as'=>'admin.revisar.denuncias', 'uses'=>'AdminDenunciaController@cargarDenunciados']);

	/*Ruta para presentar la tabla con anuncios(por ser publicados) que está revisando el admin */
	Route::get('admin/anuncios/solicitantes/pendientes',['as'=>'admin.solicitudes.pendientes', 'uses'=>'AdminAnuncioController@getSolicitudesPendientes']);
	/*Ruta para presentar la tabla con anuncios denunciados pendientes que está revisisando el admin*/
	Route::get('admin/anuncios/denunciados/pendientes',['as'=>'admin.denunciados.pendientes', 'uses'=>'AdminDenunciaController@cargarDenunciadosPendientes']);

	Route::get('admin/usuarios/desactivados',['as'=>'admin.usuarios.desactivados', 'uses'=>'AdminUsuariosController@getUsuariosDesactivados']);

	/*lista de administrdaores del sistema miradita*/
	Route::get('admin/equipo/',['as'=>'lista.administradores', 'uses'=>'AdministradorController@cargarAdministradores']);

	/*Ruta para llamar a la vista individual de anuncio por revisar*/
	Route::get('revisar/anuncio/{seccion}/{anuncio}', ['as'=>'admin.revisar', 'uses'=>'AdminAnuncioController@getRevisarAnuncio']);
	Route::get('revisar/denunciado/{seccion}/{anuncio}', ['as'=>'admin.revisaranuncio.denunciado', 'uses'=>'AdminDenunciaController@getRevisarAnuncioDenunciado']);
	
	/*Ruta para revision de anuncio denunciado, si la denuncia es verdadera se bloquea el anuncio, caso contrario se rechaza la denuncia*/
	Route::post('denuncia/aprobar', ['as'=>'aprobardenuncia', 'uses'=>'AdminDenunciaController@aprobarDenuncia']);
	Route::post('denuncia/rechazar', ['as'=>'rechazardenuncia', 'uses'=>'AdminDenunciaController@rechazarDenuncia']);

	/*Rutas para activar o rechazar un anuncio que solicitó ser publicado*/
	Route::get('anuncio/activar/{anuncio}', ['as'=>'admin.activaranuncio', 'uses'=>'AdminAnuncioController@activarAnuncio']);
	Route::get('anuncio/rechazar/{anuncio}', ['as'=>'admin.rechazaranuncio', 'uses'=>'AdminAnuncioController@rechazarAnuncio']);
		
	/*ruta para bloquear anuncio por parte del admin*/
	Route::get('anuncio/bloquear/{anuncio}', ['as'=>'admin.bloquearanuncio', 'uses'=>'AdminAnuncioController@bloquearAnuncio']);
	

		
		//********super rutas******
		Route::group(['before'=>'is_super'], function(){
			Route::get('admin/super/usuarios',['as'=>'super.usuarios', 'uses'=>'SuperUsuariosController@panelUsuarios']);
			Route::get('admin/super/anuncios',['as'=>'super.anuncios', 'uses'=>'SystemController@anunciosExpiran']);

			/*lista de usuarios activos*/
			Route::get('admin/super/usuarios/activos/',['as'=>'lista.usuarios.activos', 'uses'=>'SuperUsuariosController@usuariosActivos']);
			Route::get('admin/super/usuarios/desactivados/',['as'=>'lista.usuarios.desactivados', 'uses'=>'SuperUsuariosController@usuariosDesactivados']);
			Route::get('admin/super/usuarios/bloqueados/',['as'=>'lista.usuarios.bloqueados', 'uses'=>'SuperUsuariosController@usuariosBloqueados']);
			Route::get('admin/super/postulantes/',['as'=>'lista.postulantes', 'uses'=>'SuperUsuariosController@usuariosPostulantes']);
			Route::get('admin/super/administradores/',['as'=>'lista.admins', 'uses'=>'SuperUsuariosController@usuariosAdministradores']);


			Route::get('admin/super/desactiva/anuncios',['as'=>'desactivar.anuncios.expirados', 'uses'=>'SystemController@desactivarAnunciosExpiran']);

			Route::get('admin/super/verpostulante/{id}',['as'=>'ver.postulante', 'uses'=>'SuperUsuariosController@verPostulante']);
			Route::get('admin/super/promover/{id}',['as'=>'promover.admin', 'uses'=>'SuperUsuariosController@promover_a_administrador']);
			Route::get('admin/super/veradmin/{id}',['as'=>'ver.admin', 'uses'=>'SuperUsuariosController@verAdmin']);
			Route::get('admin/super/cancelaradmin/{id}',['as'=>'cancelar.admin', 'uses'=>'SuperUsuariosController@cancelar_administrador']);
		});	
	});
	

});



/*Ruta para presentar error 404 page no found*/
App::missing(function($exception){
	return Response::view('errores.error404', array(), 404);
});




