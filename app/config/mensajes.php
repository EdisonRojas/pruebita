<?php

return array(
		
	
	'ingresar'=> array(
			
		'activado'=>array(
			'estado'=>'activado',
			'titulo'=>'Bienvenido!',
			'contenido_principal'=>'Bienvenido a Clasificados Loja',
			'contenido_secundario'=>'Esperamos que Clasificados Loja te sea de ayuda, para cualquier sugerencia por favor comunicate con nosotros'
		),
			
		'desactivado'=>array(
			'estado'=>'desactivado',
			'titulo'=>'Activa tu cuenta!',
			'contenido_principal'=>'Cuando te registraste, un mensaje fue enviado a tu correo electrónico ',
			'contenido_secundario'=>'Tu cuenta se encuentra actualmente desactivada, habiamos enviado un link de activación
				a tu correo, por favor es un requerimiento activar tu cuenta para utilizar todas las funcionalidades de
				Clasificados Loja, si no ha llegado el correo electrónico revisa en tu carpeta de spam'
		),
						
		'bloqueado'=>array(
			'estado'=>'bloqueado',
			'titulo'=>'Cuenta bloqueda!',
			'contenido_principal'=>'Tu cuenta ha sido suspendida, por infringir las normas de uso del sitio',
			'contenido_secundario'=>'Si crees que es un error puedes comunicarte con nosotros al correo clasificados@dominio.com													. Disculpa los inconvenientes'
		),
		
		'eliminado'=>array(
			'estado'=>'eliminado',
			'titulo'=>'Cuenta eliminada!',
			'contenido_principal'=>'Ya contabas con una cuenta en Clasificados Loja, pero la eliminaste.',
			'contenido_secundario'=>'El correo electrónico que ingresaste ya estaba con anterioridad asociado a una cuenta de usuario en 
				Clasificados Loja, pero la eliminaste, si deseas activar nuevamente tu cuenta, has clic en el botón reactivar cuenta.' 
		)
	),
		
	'registrar'=> array(
		
					
		'desactivado'=>array(
			'estado'=>'desactivado',
			'titulo'=>'Activa tu cuenta!',
			'contenido_principal'=>'El correo con que deseas registrarte ya está en uso, pero la cuenta se encuentra actualmente desactivada',
			'contenido_secundario'=>'Con anterioridad hemos enviado un link de activación
					a tu correo, por favor es un requerimiento activar tu cuenta para utilizar todas las funcionalidades de
					Clasificados Loja, si no ha llegado el correo electrónico revisa en tu carpeta de spam'
		),
		
		'bloqueado'=>array(
			'estado'=>'bloqueado',
			'titulo'=>'Cuenta bloqueda!',
			'contenido_principal'=>'El correo con que deseas registrate se encuentra en uso, pero actualmente la cuenta se encuentra suspendida, por infringir las normas de uso del sitio',
			'contenido_secundario'=>'Si crees que es un error puedes comunicarte con nosotros al correo clasificados@dominio.com. Disculpa los inconvenientes'
		),
		
		'eliminado'=>array(
			'estado'=>'eliminado',
			'titulo'=>'Cuenta eliminada!',
			'contenido_principal'=>'Ya contabas con una cuenta en Clasificados Loja, pero la eliminaste.',
			'contenido_secundario'=>'El correo electrónico que ingresaste ya estaba con anterioridad asociado a una cuenta de usuario en Clasificados Loja,
						pero la eliminaste, si deseas activar nuevamente tu cuenta, has clic en el botón reactivar cuenta.'
		)
	),
	
	'conectar'=> array(

		'bloqueado'=>array(
			'estado'=>'bloqueado',
			'titulo'=>'Cuenta bloqueda!',
			'contenido_principal'=>'La cuenta de correo con que estas registrado en la red social ya se encuentra registrada en el sistema, pero actualmente tu cuenta en Clasificados Loja se encuentra suspendida',
			'contenido_secundario'=>'Si crees que es un error puedes comunicarte con nosotros al correo clasificados@dominio.com. Disculpa los inconvenientes'
		),
		
		'eliminado'=>array(
			'estado'=>'eliminado',
			'titulo'=>'Cuenta eliminada!',
			'contenido_principal'=>'Ya contabas con una cuenta en Clasificados Loja, pero la eliminaste.',
			'contenido_secundario'=>'La cuenta de correo electrónico que usa tu red social ya estaba con anterioridad asociada a una cuenta de usuario en Clasificados Loja,
						pero la eliminaste, si deseas activar nuevamente tu cuenta, has clic en el botón reactivar cuenta.'
		)
	),
		
		
);