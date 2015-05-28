@extends('layout')
@section('contenido')
	
<div class="contenedor-interno">		
	<div class="centrar-div">
		<h2>Editar datos</h2>
	</div>
	 <div class="row">
	 	
	 	
        <div class="col-xs-12 col-sm-offset-4 col-sm-4">
            
            {{ Form::model($usuario,['route'=>'ediciondatos', 'method'=>'POST', 'role'=>'form', 'novalidate']) }}	
				<div class="form-group">

					@if($usuario->cambio==false)

						{{ Form::label('nombres','Nombre y apellido') }}
						<div class="input-group">
							<span class="input-group-addon success"><span class="glyphicon glyphicon-user"></span></span>
							{{Form::text('nombres',Input::old('nombres'),
								[
									'class' => 'form-control',
									'title'=>'Debe introducir su nombre y apellido',
								])

							}}
						</div>
						<p class="alert alert-info">Tus nombres pueden modificarse una sola vez</p>
						{{ $errors->first('nombres', '<p class="alert alert-danger errores">:message </p>')}}
					@else
						<div class="centrar-div">
							<h3 class="mayusculas">{{$usuario->nombres}}</h3>
						</div>

						
					@endif
					
				</div>

				<div class="form-group">
                	{{ Form::label('genero', 'Género') }} 
            		
					<div class="input-group">

						@if($usuario->genero=='male')
                        	<span class="input-group-addon success"><span class="icon-user-2"></span></span>
                        @else
                        	<span class="input-group-addon success"><span class="icon-user"></span></span>
                        @endif
                        
                        {{ Form::select('genero', array('male'=>'Masculino', 'fema'=>'Femenino'), $usuario->genero, array('class'=>'input form-control')) }}
                	</div>

				</div>


				<div class="form-group">
					{{ Form::label('telefono', 'Teléfono') }}      
            		<div class="input-group">
               			<span class="input-group-addon success"> <span  class="icon-phone"></span></span>
					
						{{ Form::text('telefono', Input::old('telefono'),
									[
										'class' => 'form-control',
										'title'=>'Debe introducir su teléfono',
										'placeholder'=>'Ejem: 072 547750'
									])
						}}
					</div>
					{{ $errors->first('telefono', '<p class="alert alert-danger errores">:message</p>')}}
                </div>

				<div class="form-group">
				{{ Form::label('celular', 'Celular') }}      
            		<div class="input-group">
               			<span class="input-group-addon success"> <span  class="glyphicon glyphicon-phone"></span></span>
					
						{{ Form::text('celular', Input::old('celular'),
									[
										'class' => 'form-control',
										'title'=>'Debe introducir su celular',
										'placeholder'=>'Ejem: 09 6967 2916'
									])
						}}
					</div>
					{{ $errors->first('celular', '<p class="alert alert-danger errores">:message</p>')}}
                </div>

                <div class="form-group">
                	{{ Form::label('compania_id', 'Compania celular') }} 
            		
					<div class="input-group">
						
                        <span class="input-group-addon success"><span class="glyphicon glyphicon-pushpin"></span></span>
                        {{ Form::select('compania_id', $companias, $usuario->compania->id, array('class'=>'input form-control')) }}
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

