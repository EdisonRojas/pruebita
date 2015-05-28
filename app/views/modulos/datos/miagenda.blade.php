@extends('layout')
@section('contenido')
	@parent
	<div class="contenedor-interno">		
		<h4>Agenda de contactos</h4>
		@if(Session::has('agendar_ok'))
			<p class="alert alert-success">{{Session::get('agendar_ok')}}</p>

		@endif
		@if(Session::has('agendar_error'))
			<p class="alert alert-success">{{Session::get('agendar_error')}}</p>

		@endif
		<div class="table-responsive">	
			<table class="table table-condensed">
			    <thead>
			        <tr>
			            <th>Contacto</th>
			            <th>Celular</th>
			            <th>Teléfono</th>
			            <th>Correo</th>
			            <th>Añadido</th>
			            <th>Acción</th>
			          
			        </tr>
			    </thead>
			    <tbody>
			    	 @foreach ($agenda as $contacto)
			       
			        <tr>

				            
				            <td > {{$contacto->nombre}}</td>
				            <td> {{$contacto->celular}} </a></td>
				            <td> {{$contacto->telefono}} </a></td>
				            <td> {{$contacto->correo}} </a></td>
				            <td> {{$contacto->created_at->format('j M Y H:i a')}} </td>
				            <td> <a href="{{route('eliminarcontacto', [$contacto->id])}}" title="eliminar" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a></td>

			            	
			        </tr>

		         	@endforeach
		    	</tbody>
			</table>
		</div>	
	
	
	
       
</div>
@stop
