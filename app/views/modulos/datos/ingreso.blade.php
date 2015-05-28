@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">
	@if (Session::has('salir_correcto'))
           			<p class="alert alert-success">Has cerrado sesión correctamente, esperamos regreses pronto y recuerda estamos para servirte</p>
    @endif
    @if (Session::has('cuentaactiva_mensaje'))
           			<p class="alert alert-success">Tu cuenta se ha activado correctamente, ingresa con tu correo y contraseña</p>
    @endif		
	<div class="centrar-div espacio-inferior-mediano">
		<h2>Inicia sesión</h2>
	</div>
	 <div class="row">
	 	
        <div class="col-xs-12 col-sm-offset-2 col-sm-4">
             
            {{ Form::open(['route'=>'ingreso', 'method'=>'POST', 'role'=>'form', 'novalidate']) }}	
            	<p class="subtitulo">Con tu correo electrónico</p>
				  			
				<div class="form-group">
        			
        			{{ Form::label('correo', 'Tu correo') }} 
					<div class="input-group" data-validate="email">
						{{ Form::email('correo', Input::old('correo'),
								[
									'class' => 'form-control',
									'id'=>'validate-email',
									'title'=>'Debe introducir su correo',
									'placeholder' => 'edroleal@dominio.com', 
									'required' => 'required'
								])
						}}
						<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
					</div>
					{{ $errors->first('correo', '<p class="alert alert-danger errores">:message</p>')}}
				</div>
    			
        		<div class="form-group">
        			{{ Form::label('password', 'Contraseña') }} 
					<div class="input-group" data-validate="length" data-length="5">
						{{ Form::password('password', 
								[
									'class' => 'form-control',
									'id'=>'validate-length',
									'title'=>'Debe introducir su contraseña',
									'placeholder' => 'minimo 6 caracteres',
									'required' => 'required'
								])
						}}
						<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
					</div>
					{{ $errors->first('password', '<p class="alert alert-danger errores">:message </p>') }}
				</div>
				@if (Session::has('login_error'))
           			<p class="alert alert-danger errores">Contraseña incorrecta </p>
                    
                @endif
                @if (Session::has('no_existe_usuario_error'))
           			<p class="alert alert-danger errores">No existe usuario registrado con ese correo</p>
                    
                @endif
				 

				           
                {{-- Form::button('Registrarse', array('type' => 'submit', 'class' => 'btn col-xs-12 btn-success', 'data-loading-text'=>'Loading..s', 'id'=>'myButton')) --}}
                
                <button type="submit" class="btn btn-primary col-xs-12 btn-success boton-registro" data-loading-text="Enviando..." >
 			 		Ingresar
				</button>

				<div class="col-xs-12">
               		<p class="text-center">¿No tienes cuenta? <a href="{{ route('registro') }}" class="enlace">Registrate ahora</a></p>
               		<p class="text-center"><a href="{{ route('password.recuperacion') }}" class="enlace">¿Has olvidado tu contraseña?</a></p>
            	</div>
				
            {{ Form::close() }}
        </div>
        
         
        <!--contenedor para social registro-->
        <div class="col-xs-12 col-sm-offset-1 col-sm-4">
        	<p class="subtitulo">Con una red social</p>
        	
        		@include('modulos.datos.segmentos.botonesregistrosocial')	
        	
        	
        </div>
    </div>

</div><!--fin contenedor-interno-->
@stop

