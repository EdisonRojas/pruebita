@extends('layout')
@section('contenido')
	
	<div class="contenedor-interno">
		<div class="row">
			<div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6">
				<a href="{{route('mismensajes')}}" title="" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Regresar a mensajes</a>	
			</div>
			

			<div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6">
				<h5>{{$mensaje->nombre}} {{$mensaje->apellido}}: {{$mensaje->asunto}}</h5>	
			</div>

			<div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6">
				<div class="row linea-inferior">
			      <div class="col-xs-12 col-sm-3">
			          {{ Form::label('remitente','REMITENTE:') }}
			      </div>
			 
			      <div class="col-xs-12 col-sm-7">
			        <p >  
			          {{ $mensaje->nombre }} {{ $mensaje->apellido }} ({{$mensaje->correo}})
			        </p>
			      </div> 
			    </div>
			    <div class="row linea-inferior">
			      <div class="col-xs-12 col-sm-3">
			          {{ Form::label('asunto','ASUNTO:') }}
			      </div>
			 
			      <div class="col-xs-12 col-sm-7">
			        <p >  
			          {{ $mensaje->asunto }}
			        </p>
			      </div> 
			    </div>
			    <div class="row linea-inferior">
			      <div class="col-xs-12 col-sm-3">
			          {{ Form::label('recibido','RECIBIDO:') }}
			      </div>
			 
			      <div class="col-xs-12 col-sm-7">
			        <p >  
			          {{$mensaje->created_at->format('j M Y  H:i a')}}
			        </p>
			      </div> 
			    </div>
			    <div class="row linea-inferior">
			      <div class="col-xs-12 col-sm-3">
			          {{ Form::label('mensaje','MENSAJE:') }}
			      </div>
			    </div>



			</div>
			

			<div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6 cuadro-mensaje">
				
				<p>{{$mensaje->mensaje}}</p>
			</div>
		</div>
	</div>
@stop
