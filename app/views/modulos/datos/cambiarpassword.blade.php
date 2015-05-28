@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">		
	<div class="centrar-div">
		<h2>Cambiar password</h2>
		
	</div>
	 <div class="row">
	 	
        <div class="col-xs-12 col-sm-offset-4 col-sm-4">
            
            {{ Form::open(['route'=>'cambiarpassword', 'method'=>'POST', 'role'=>'form', 'novalidate']) }}	            	                
				<div class="form-group">
        			{{ Form::label('actualpassword', 'Actual contraseña') }} 
					<div class="input-group" data-validate="length" data-length="5">
						{{ Form::password('actualpassword', 
								[
									'class' => 'form-control',
									'id'=>'validate-length',
									'title'=>'Debe introducir su contraseña actual',
									'placeholder' => 'Su contraseña actual',
									'required' => 'required'
								])
						}}
						<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
					</div>
					

					@if (Session::has('password_error'))
           				<p class="alert alert-danger errores">Contraseña incorrecta </p>
                    
                	@endif
				</div>

				<div class="form-group">
        			{{ Form::label('password', 'Nueva contraseña') }} 
					<div class="input-group" data-validate="length" data-length="5">
						{{ Form::password('password', 
								[
									'class' => 'form-control',
									'id'=>'validate-length',
									'title'=>'Contraseña nueva',
									'placeholder' => 'Contraseña nueva',
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
									'placeholder' => 'Repita contraseña nueva', 
									'required' => 'required'
								])
						}}
						<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
					</div>

				</div>
                
                <button type="submit" class="btn btn-primary col-xs-12 btn-success boton-registro" data-loading-text="Enviando..." id="boton-envio-registro">
 			 		<i class="glyphicon glyphicon-floppy-disk">
        		</i> Guardar
				</button>
               
                <a href="{{ URL::previous() }}" class="btn btn-danger col-xs-12 boton-registro">
        		<i class="glyphicon glyphicon-remove-circle">
        		</i>
        			Cancelar
      			</a>
           
                
				
				
				
            {{ Form::close() }}
        </div>
    </div>

</div><!--fin contenedor-interno-->
@stop

