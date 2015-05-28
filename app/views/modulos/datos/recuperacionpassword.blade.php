@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">		
	<div class="centrar-div">
		<h2>Recuperar contraseña</h2>
		
	</div>
	 <div class="row">
	 	
        <div class="col-xs-12 col-sm-offset-4 col-sm-4">
            <p class="alert alert-info">Ingresa tu correo, para recuperar tu acceso.</p>
            
            {{ Form::open(['route'=>'password.recuperacion', 'method'=>'POST', 'role'=>'form', 'novalidate']) }}	
            	<div class="form-group">
					{{ Form::label('correo', 'Tu correo') }}      
            		<div class="input-group" data-validate="email">
               			
					
						{{ Form::email('correo', Input::old('correo'),
								[
									'class' => 'form-control',
									'title'=>'Debe introducir su correo',
									'required' => 'required',
									'placeholder' => 'Correo de la cuenta', 
								])
						}}
						<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
					</div>
					@if (Session::has('noexisteusuario_error'))
           				<p class="alert alert-danger errores">El correo ingresado no se encuentra asociado a ninguna cuenta, por favor revisa si es correcto</p>
                	@endif
					
					@if (Session::has('cuentanoactivada_error'))
						@if(Session::get('cuentanoactivada_error')=="eliminado")
							<p class="alert alert-danger">No existe cuenta asociada a este correo electrónico.</p>
						@elseif(Session::get('cuentanoactivada_error')=="bloqueado")
							<p class="alert alert-danger">Tu cuenta en miradita se encuentra suspendida, para mayor información, comunicate con nosotros.</p>
						@else
							<p class="alert alert-danger">Tu cuenta en miradita se encuentra desactivada, lo sentimos mucho pero no puedes continuar con el proceso de recuperación de contraseña.</p>
						@endif
                	@endif
					{{ $errors->first('correo', '<p class="alert alert-danger errores">:message</p>')}}
                </div>
                
                
                <button type="submit" class="boton-registro btn btn-success col-xs-12" data-loading-text="Buscando...." id="boton-recuperar"><i class="glyphicon glyphicon-search">
        		</i> 
 			 		Buscar
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

