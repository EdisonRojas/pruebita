@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">		
	<div class="centrar-div">
		<h2>Eliminar mi cuenta social</h2>
		
	</div>
	 <div class="row">
	 	
        <div class="col-xs-12 col-sm-offset-4 col-sm-4">
            <p class="alert alert-info">Hola {{ $usuario->nombres}}, si realmente desea eliminar su cuenta, presione el botón Eliminar cuenta.</p>
            
            {{ Form::model($usuario,['route'=>'bajacuentasocial', 'method'=>'POST', 'role'=>'form', 'novalidate']) }}	
            	<div class="form-group">
					{{ Form::label('correo', 'Tu correo asociado es') }}      
            		<div class="input-group">
               			<span class="input-group-addon success"> <span  class="glyphicon glyphicon-envelope"></span></span>
					
						{{ Form::email('correo', Input::old('correo'),
								[
									'class' => 'form-control',
									'title'=>'Debe introducir su correo',
									
									
									
								])
					}}
					</div>
					 @if (Session::has('correosdistintos_error'))
           				<p class="alert alert-danger errores">Por favor no modifiques tu correo asociado. Gracias</p>
                	@endif
					
					{{ $errors->first('correo', '<p class="alert alert-danger errores">:message</p>')}}
                </div>
                
                <button type="submit" class="btn btn-primary col-xs-12 btn-success boton-registro" data-loading-text="Enviando..." id="boton-envio-registro">
 			 		<i class="glyphicon glyphicon-floppy-disk">
        		</i> Eliminar cuenta
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

