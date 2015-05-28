@extends('layout')
@section('contenido')

<div class="contenedor-interno">		
	
			
	<div class="centrar-div espacio-inferior-mediano">
		<h2>Bienvenido a clasificados Loja</h2>
	</div>
	<div class="row">
		<div class="col-xs-offset-1 col-sm-offset-1 espacio-izquierda">
			<p>Has ingresado correctamente con twitter, por favor solo necesitamos nos facilites un correo electrónico para enviarte las notificaciones del sistema. 
			</p>
			<p>
				Considera que en Miradita Loja tu correo no se publica.
			</p>	
		</div>
		
        <div class="col-xs-12 col-sm-offset-2 col-sm-4">
            
        	{{ Form::open(['route'=>'correotwitter', 'method'=>'POST', 'role'=>'form', 'novalidate']) }}	
        	<div class="form-group">
        			
        			{{ Form::label('correo', 'Tu correo') }} 
					<div class="input-group" data-validate="email">
						{{ Form::email('correo', Input::old('correo'),
								[
									'class' => 'form-control',
									'id'=>'validate-email',
									'title'=>'Debe introducir su correo',
									'placeholder' => 'edroleal@dominio.comff', 
									'required' => 'required'
								])
						}}
						<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
					</div>
					{{ $errors->first('correo', '<p class="alert alert-danger errores">:message</p>')}}
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


			<button type="submit" class="btn btn-primary col-xs-12 btn-success boton-registro" data-loading-text="Enviando..." id="boton-envio-registro">
 			 		Enviar
			</button>
			

            {{ Form::close() }}

		</div>
	</div>
	
       
</div>
@stop
