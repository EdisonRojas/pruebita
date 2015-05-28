@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="centrar-div">
        <h4>Usuarios desactivados</h4>
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
			          
			            <th>Correo</th>
			             <th>Accción</th>
			            <th>Fecha de registro</th>
			        </tr>
			    </thead>
	          
		        <tbody>
		        	 @foreach ($usuarios as $usuario)
			        <tr class="warning">
			            <td>{{ $i++ }}</td>
			           
			            <td>{{ strtoupper($usuario->nombres) }}</td>
			            <td>{{ $usuario->correo }}</td>
			            <td> <a href="" title="">Activar</a></td>
			            <td>{{ $usuario->created_at }}</td>
			        </tr>
		        
	    			@endforeach          
			</table>
		</div>       
        {{ $usuarios->links() }}
        </div>
    </div>
</div><!--fin contenedor interno-->
@stop