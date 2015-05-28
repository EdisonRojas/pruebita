@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="centrar-div">
        <h4>Anuncios denunciados</h4>
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
			            <th>id</th>
			            <th>Titulo</th>
			            <th>Sección</th>
			            <th>Estado revision</th>
			            <th>Acción</th>
			            <th>Fecha creación</th>
			        </tr>
			    </thead>
	          
		        <tbody>
		        	 @foreach ($anuncios as $anuncio)
			        <tr class="warning">
			            <td>{{ $i++ }}</td>
			            <td>{{ $anuncio->id }}</td>
			            <td>{{ strtoupper(str_limit($anuncio->titulo,20)) }}</td>
			            <td>{{ $anuncio->seccion_title }}</td>
			             <td>{{ $anuncio->estatus_revision}}</td>
			           


			            @if(strcmp ($anuncio->estatus_revision,"libre") == 0) 
			            	<td>  <a href="{{ route('admin.revisaranuncio.denunciado', [$anuncio->seccion_title, $anuncio->id]) }}" title="Revisar">Revisar</a>  </td>
			            
			            @elseif(strcmp ($anuncio->estatus_revision,"ocupado") == 0 & ($anuncio->admin==\Auth::id() ) )
			            	<td>  <a href="{{ route('admin.revisaranuncio.denunciado', [$anuncio->seccion_title, $anuncio->id]) }}" title="Revisar">Continua su revision</a>  </td>
			            @else
			            	<td> Está siendo revisado </td>
			            @endif
			            
			            
			            <td>{{ $anuncio->created_at }}</td>
			        </tr>
		        
	    			@endforeach          
			</table>
		</div>       
        {{ $anuncios->links() }}
        </div>
    </div>
 	

</div><!--fin contenedor interno-->
@stop