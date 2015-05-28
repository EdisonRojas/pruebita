@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">	
	<div class="container-fluid">
		<p class="text-center subtitulo">Anuncio bloqueado!</p>
		<div class="row">
							
				<p class="texto-centrado alert alert-info">{{ $admin['nombres']}} muy buen trabajo, has bloqueado correctamente el anuncio.
				</p>
				<div>	
					<p class="texto-justificado">Recuerda Miradita es tu web, sin tu ayuda como administrador, sería imposible mantener este espacio. Gracias!! 
					</p>
				</div>
		</div>
	</div>	
</div>	
	
@stop