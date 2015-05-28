@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">	
	<div class="container-fluid">
		<h2 class="text-center">Felicitaciones tu cuenta se encuentra lista para ser usada</h2>
		<div class="row">
							
				<p class="texto-centrado">{{ $usuario->nombres}} ahora puedes ingresar con tu correo
				 {{$usuario->correo}} y el nuevo password establecido, recuerda que también puedes hacerlo con tu red social favorita.
						
				
				</p>
				<div>	
					<p class="texto-justificado">Cualquier sugerencia no dudes en comunicarte con nosotros, saludos.
					</p>
				</div>
		</div>
	</div>	
</div>	
	
@stop