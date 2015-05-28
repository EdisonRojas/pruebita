@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">	
	<div class="container-fluid">
		<h2 class="text-center">{{ $mensaje['titulo'] }}</h2>
		<div class="row">
							
				<p class="texto-centrado">{{ $mensaje['contenido_principal'] }}
					@if($mensaje['estado']=='desactivado')
						{{ $correo['correo'] }}	
					@endif
						
				
				</p>
				<div>	
					<p class="texto-justificado">{{ $mensaje['contenido_secundario'] }}
					</p>
					@if($mensaje['estado']=='eliminado')
						{{-- $enlace['enlace'] --}}	


						<a class="btn btn-info" href="{{ URL::route('reactivacioncuenta')  }}">Reactivar mi cuenta</a>
					@endif
				</div>
		</div>
	</div>	
</div>	
	
@stop