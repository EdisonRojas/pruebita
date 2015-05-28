@extends('layout')
@section('scripts')
        <script src="{{ asset('assets/js/inputsfile.js') }}"></script>
@stop

@section('contenido')
	
<div class="contenedor-interno">		
	<div class="centrar-div espacio-inferior-mediano">
		<h2>Foto de perfil </h2>
		
	</div>
	<div class="row">
		
        	<div class="col-xs-12 col-sm-offset-4 col-sm-5 col-md-4 caja-sombra">

        		{{ Form::open([route('edicionfoto',$usuario->slug), 'method'=>'POST', 'files' => true, 'role'=>'form', 'novalidate']) }}	
        		<input id="foto-perfil" name="fotoperfil" type="file"/>
        		
        		{{ $errors->first('nombres', '<p class="alert alert-danger errores">:message </p>')}}
                @if (Session::has('error_subir_foto'))
                        <p class="alert alert-danger errores"> Lo sentimos mucho, pero no hemos podido subir tu foto, inténtalo más tarde </p>
                    
                @endif
                @if (Session::has('error_guardar_foto'))
                        <p class="alert alert-danger errores"> Lo sentimos mucho, pero no hemos podido guardar tu foto. </p>
                    
                @endif
    		</div>
    		<div class="col-xs-12 col-sm-offset-4 col-sm-5 col-md-4">
    			<button type="submit" class="btn btn-primary btn-md col-xs-12 btn-success btn-new-foto-perfil" data-loading-text="Enviando..." ><i class="glyphicon glyphicon-floppy-disk">
        		</i> 
 			 		Guardar
				</button>
				<a href="{{ URL::previous() }}" class="btn btn-danger col-xs-12 btn-espacio-superior">
        			<i class="glyphicon glyphicon-remove-circle">
        			</i>
        			Cancelar
      			</a>
    		</div>

			{{ Form::hidden('actualfoto', $usuario->foto) }} 
		{{ Form::close() }}

	</div>
	
	
</div><!--fin contenedor-interno-->
@stop