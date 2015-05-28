@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">	
	
		
	<div class="container">
		<h3 class="text-center">Tu anuncio fue creado correctamente</h3>
		<h2 class="text-center">Ahora publícalo!!</h2>

        	<div class="form-group">
		<div class="row">


				<div class="col-xs-12 col-sm-offset-1 col-sm-9">	
					<p class="parrafo-mensaje">{{ $usuario->nombres}} tu anuncio fue creado correctamente, pero aún no se encuentra publicado.</p>

					<p class="parrafo-mensaje"> Para que tu anuncio pueda ser visualizado por los demás usuarios solicita publicar tu anuncio, después de eso tu anuncio será revisado por un administrador de miradita y verificará que cumple con las <a href="#" >normas de uso</a>.
					</p>
					<p class="alert alert-info">Considera que no es obligatorio publicar ahora, si aún debes modificar el anuncio, puedes publicar después buscando en Tus anuncios</p>
					
				</div>			
				
				
					
				<a href="{{ route('publicaranuncio', $idanuncio['anuncio_id']) }}" class="btn btn-publicacion col-xs-12 col-sm-offset-4 col-sm-4" title="">Deseo publicar
				</a>
			

		

				<a href="{{ route('misanuncios') }}" class="btn btn-primary btn-salir col-xs-12 col-sm-offset-4 col-sm-4">
        			Ir a Mis anuncios
      			</a>
				
				
		</div>
	</div>	
</div>	
	
@stop