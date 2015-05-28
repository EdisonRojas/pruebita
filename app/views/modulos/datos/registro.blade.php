@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">		
	<div class="centrar-div espacio-inferior-mediano">
		<h2>Registrate</h2>
	</div>
	 <div class="row">
	 	@if (Session::has('error_de_registro_servidor'))
           	<p class="alert alert-danger errores">Hubo un error inténtalo nuevamente, si el problema persiste, comunicate con nosotros. </p>
                    
        @endif
        <div class="col-xs-12 col-sm-offset-2 col-sm-4">
            
            {{ Form::open(['route'=>'registro', 'method'=>'POST', 'role'=>'form', 'novalidate']) }}	
            	<p class="subtitulo">Con tu correo electrónico</p>
								
				<div class="form-group">
					{{ Form::label('nombres','Nombre y apellido') }}
					<div class="input-group">
						{{ Form::text('nombres',Input::old('nombres'),
								[
									'class' => 'form-control',
									'id'=>'validate-text',
									'title'=>'Debe introducir su nombre y apellido',
									'placeholder' => 'Ejm: Edro Leal', 
									'required' => 'required'
								])

						}}
						<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
					</div>
					{{ $errors->first('nombres', '<p class="alert alert-danger errores">:message </p>') }}
				</div>
    			
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

				<div class="form-group">
        			
        			{{ Form::label('password_confirmation', 'Repite contraseña') }} 
					
					<div class="input-group" data-validate="length" data-length="5">
						
						{{ Form::password('password_confirmation', 
								[
									'class' => 'form-control',
									'id'=>'validate-length',
									'placeholder' => 'Contraseña', 
									'required' => 'required'
								])
						}}
						<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
					</div>

				</div>
				

                <div class="form-group">
                	{{ Form::label('genero', 'Género') }} 
            		
					<div class="input-group">
                        <select class="form-control" name="genero" id="validate-select" placeholder="Validate Select" required>
                            <option value="">Selecciona una opcion</option>
                            <option value="male">Hombre</option>
                            <option value="fema">Mujer</option>
                        </select>
                       
						<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
					</div>
				</div>
            	
               
                {{-- Form::button('Registrarse', array('type' => 'submit', 'class' => 'btn col-xs-12 btn-success', 'data-loading-text'=>'Loading..s', 'id'=>'myButton')) --}}
                
                <button type="submit" class="boton-registro btn btn-primary col-xs-12" data-loading-text="enviando...." id="boton-registro">
 			 		Registrarse
				</button>
				
            {{ Form::close() }}
        </div>
        
         
        <!--contenedor para social registro-->
        <div class="col-xs-12 col-sm-offset-1 col-sm-4">
        	<p class="subtitulo">Con una red social</p>
        	
        		@include('modulos.datos.segmentos.botonesregistrosocial')	
        	
        	
        </div>
    </div><!--fin row-->

</div><!--fin contenedor-interno-->
@stop

