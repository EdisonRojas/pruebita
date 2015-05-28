@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="centrar-div">
        <h4>Postulaciones para administrador</h4>
    </div>
    
    <div class="row">
    	@if (Session::has('status_error'))
			<p class="alert alert-danger">{{Session::get('status_error')}} </p>
   		@endif
   		@if (Session::has('status_ok'))
			<p class="alert alert-success">{{Session::get('status_ok')}} </p>
   		@endif
    	<div class="col-offset-md-1 col-md-11">
    	<?php $i=1  ?>
    	<div class="table-responsive">
	    	<table class="table table-hover">
	    		<thead>
			        <tr>
			            <th>#</th>
			            
			            
			            <th>Nombres</th>
			          	<th>Genero</th>
			          	<th>Correo</th>
			          	<th>Ver</th>
			            <th>Contactar</th>
			           
			           
			            
			        </tr>
			    </thead>
	          
		        <tbody>
		        	 @foreach ($usuarios as $postulante)
			        <tr class="warning">
			            <td>{{ $i++ }}</td>
			           
			           
			            <td>{{ $postulante->usuario->nombres }}</td>
			            <td>{{ $postulante->usuario->genero_title }}</td>
			            <td>{{ $postulante->usuario->correo }}</td>
			            <td> <a href="{{route('ver.postulante',[$postulante->usuario->id])}}" title="" class="btn btn-info btn-xs">Ver usuario</a>	 </td>
			            <td> <a href="" title="" class="btn btn-primary btn-xs">Escribir mensaje</a>	 </td>
			            
			        </tr>
		        
	    			@endforeach          
			</table>
		</div>       
       
        </div>
    </div>
</div><!--fin contenedor interno-->
@stop