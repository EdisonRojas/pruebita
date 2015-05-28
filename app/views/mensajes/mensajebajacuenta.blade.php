@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">	
	<div class="container-fluid">
		<h2 class="text-center">Cuenta eliminada</h2>
		<div class="row">
							
				<p class="texto-centrado">{{ $usuario->nombres}} tu cuenta ha sido dada de baja correctamente.
						
				
				</p>
				<div>	
					<p class="texto-justificado">Recuerda que si en algún momento deseas regresar, puedes volver a utilizar tu correo electrónico {{ $usuario->correo }}
					</p>
				</div>
		</div>
	</div>	
</div>	
	
@stop