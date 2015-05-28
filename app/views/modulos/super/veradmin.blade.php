@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="centrar-div">
        <h4>Administrador</h4>
    </div>
    <div class="col-xs-12 col-sm-offset-2 col-sm-8">
    	<label>Datos de usuario</label>
    	<p>Id: {{ $usuario->id }}</p>
    	<p>Nombre: {{ $usuario->nombres }}</p>
    	
    	<p>Género: {{ $usuario->genero_title }}</p>
    	<p>Correo: {{ $usuario->correo }}</p>
    	<p>Teléfono: {{ $usuario->telefono }}</p>
    	<p>Celular: {{ $usuario->celular }}</p>
    	<p>Usuario desde: {{ $usuario->created_at }}</p>
    	<p>Ingreso por social: {{ $usuario->bandera_social }}</p>
    	<p>Estado: {{ $usuario->estado->estado }}</p>
    	<label>Historial de sus anuncios</label>
    	
    	@if(!$usuario->historial)
    		<p>No hay historial</p>
	   	@else
    		<p>Anuncios bloqueados: {{ $usuario->historial->anunciosbloqueados}}</p>
    	@endif
    </div>
    <div class="col-xs-12 col-sm-offset-2 col-sm-8">

    	<a href="{{route('cancelar.admin',[$usuario->id])}}" title="" class="btn btn-danger col-xs-12">Cancelar administrador</a>
    </div>

</div><!--fin contenedor interno-->
@stop