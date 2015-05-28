@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">	
	<div class="container-fluid">
		<h2 class="text-center">Revisa tu correo electrónico</h2>
		<div class="row">
							
				<p class="texto-centrado">{{ $usuario->nombres}} hemos encontrado una cuenta en miradita 
					asociada a ese correo electrónico , te hemos enviado un correo a {{$usuario->correo}} por favor revisa tu bandeja de entrada y sigue lo pasos para cumplir con exito la recuperación de tu contraseña.
				</p>
				<div>	
					<p class="texto-justificado">Cualquier sugerencia no dudes en comunicarte con nosotros, saludos.
					</p>
				</div>
		</div>
	</div>	
</div>	
	
@stop