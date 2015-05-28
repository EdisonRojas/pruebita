@extends('layout')
@section('contenido')
	@parent
	<div class="contenedor-interno">		
		<h4>Mensajes de entrada</h4>

		@if(Session::has('estatus_ok'))
			<p class="alert alert-success">{{Session::get('estatus_ok')}}</p>
		@endif
		@if(Session::has('estatus_error'))
			<p class="alert alert-danger">{{Session::get('estatus_error')}}</p>
		@endif

		<div class="table-responsive">	
			<table class="table table-condensed">
			    <thead>
			        <tr>
			            <th colspan="5"></th>
			          
			        </tr>
			    </thead>
			    <tbody>
			    	 @foreach ($mensajes as $mensaje)
			       
			        <tr class="mensaje-{{$mensaje->estatus_visto}}">

				            <td><input type="checkbox" id="checkanuncio" value="{{$mensaje->id}}"></td>
				            <td > {{$mensaje->nombre}} {{$mensaje->apellido}} </td>
				            <td> <a href="{{route('leermensaje', [$mensaje->id])}}" title="">{{$mensaje->asunto}} </a></td>
				            <td> {{$mensaje->created_at->format('j M Y H:i a')}} </td>
			            	<td>
			            		<a href="{{route('leermensaje', [$mensaje->id])}}" title="ver" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>
			            		<a href="{{route('eliminarmensaje', [$mensaje->id])}}" title="eliminar" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a>  
		 	             	 </td>
			        </tr>

		         	@endforeach
		    	</tbody>
			</table>
		</div>	
	</div>
@stop
