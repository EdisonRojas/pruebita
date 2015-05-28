@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">	
	<div class="container-fluid">
		<h2 class="text-center">Gracias!</h2>
		<div class="row">
							
				<p class="texto-centrado">{{ $usuario->nombres}} queremos agradecerte por ayudarnos denunciando anuncios que incumplen las normas de uso.
				</p>
				<div>	
					<p class="texto-justificado">Miradita es tu espacio, sin ayuda de todos sería difícil mantenerlo ordenado. 
					</p>
				</div>
		</div>
	</div>	
</div>	
	
@stop