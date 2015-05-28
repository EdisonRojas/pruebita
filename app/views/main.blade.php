@extends('layout')
@section('contenido')
	@parent
	<div class="contenedor-interno">		
		@if (Session::has('login_correcto'))
            <p class="alert alert-success">Bienvenido, esperamos poder ser de ayuda,  para cualquier sugerencia puede comunicarse con nosotros</p>
        @endif
	<h2>Bienvenido a Clasificados Loja</h2>
	
	<h5>--Bienvenido usuario--</h5>
	
	
	
       
</div>
@stop
