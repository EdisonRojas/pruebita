@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="centrar-div">
        <h4>Revisiones que tienes pendiente</h4>
    </div>
    
    <div class="row">
        <div class="col-xs-12 col-sm-6 general-anuncios">
            <p class="subtitulos-caja">ANUNCIOS</p>
            <a href="{{route('admin.solicitudes.pendientes')}}" class="btn btn-warning btn-md col-xs-12 col-sm-5" role="button">
                <span class="glyphicon glyphicon-eye-open">
                </span>
                <p>Anuncios que <span class="hidden-xs"></span>estás revisando</p>
            </a>
            
            <a href="{{route('admin.denunciados.pendientes')}}" class="btn btn-danger btn-md col-xs-12 col-sm-offset-1 col-sm-5" role="button">
                <span class="glyphicon glyphicon-exclamation-sign">
                </span>
                <p>Denunciados que <span class="hidden-xs"></span>estás revisando</p>
            </a>
        </div>   
    </div> 
</div><!--fin contenedor interno-->
@stop