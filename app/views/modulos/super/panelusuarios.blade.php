@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="centrar-div">
        <h4>Usuarios del sistema</h4>
    </div>
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 general-anuncios">
           
            <a href="{{route('lista.postulantes')}}" class="btn btn-warning btn-md col-xs-12  col-sm-3" role="button">
                <span class="glyphicon glyphicon-exclamation-sign">
                </span>
                <p>Solicitudes <span class="hidden-xs"></span>para admin</p>
            </a>
            
            <a href="{{route('lista.usuarios.bloqueados')}}" class="btn btn-primary btn-md col-xs-12 col-sm-3" role="button">
                <span class="glyphicon glyphicon-eye-open">
                </span>
                <p>Usuarios <span class="hidden-xs"></span>bloqueados</p>
            </a>
            
            

            <a href="{{route('lista.usuarios.desactivados')}}" class="btn btn-info btn-md col-xs-12  col-sm-3" role="button">
                <span class="glyphicon glyphicon-exclamation-sign">
                </span>
                <p>Usuarios <span class="hidden-xs"></span>desactivados</p>
            </a>
             <a href="{{ route('lista.usuarios.activos')}}" class="btn btn-success btn-md col-xs-12 col-sm-3" role="button">
                <span class="glyphicon glyphicon-exclamation-sign">
                </span>
                <p>Usuarios <span class="hidden-xs"></span>activos</p>
            </a>


        </div>   
    </div> 
</div><!--fin contenedor interno-->
@stop