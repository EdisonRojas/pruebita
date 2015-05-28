@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">		
	<div class="centrar-div">
		<h2>Eliminar mi cuenta</h2>
		
	</div>
	 <div class="row">
	 	
        <div class="col-xs-12 col-sm-offset-4 col-sm-4">
            
            {{ Form::model($usuario,[route('bajacuenta',$usuario->slug), 'method'=>'POST', 'role'=>'form', 'novalidate']) }}	
            	<div class="form-group">
					{{ Form::label('correo', 'Tu correo asociado') }}      
            		<div class="input-group">
               			<span class="input-group-addon success"> <span  class="glyphicon glyphicon-envelope"></span></span>
					
						{{ Form::email('correo', Input::old('correo'),
								[
									'class' => 'form-control',
									'title'=>'Debe introducir su correo',
									'disabled'=>'disabled'
									
									
								])
					}}
					</div>
					
					{{ $errors->first('correo', '<p class="alert alert-danger errores">:message</p>')}}
                </div>


                
				<div class="form-group">
				{{ Form::label('password', 'Introduce tu contraseña') }}     

            		<div class="input-group">
               			<span class="input-group-addon success"> <span  class="icon-key"></span></span>
					
						{{ Form::password('password', 
								[
									'class' => 'form-control',
									'title'=>'Debe introducir su contraseña',
									
									
								])
					}}
					</div>
					{{ $errors->first('password', '<p class="alert alert-danger errores">:message </p>') }}
					@if (Session::has('bajacuenta_error'))
           				<p class="alert alert-danger errores">Contraseña incorrecta </p>
                    
                	@endif
                </div>

                
                <button type="submit" class="btn btn-primary col-xs-12 btn-success boton-registro" data-loading-text="Enviando..." id="boton-envio-registro">
 			 		<i class="glyphicon glyphicon-floppy-disk">
        		</i> Eliminar mi cuenta
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

