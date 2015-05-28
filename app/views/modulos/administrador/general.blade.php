@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="centrar-div">
        <h2>Bienvenido administrador</h2>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-bookmark"></span> 
                            Vista general de administrador
                    </h3>
                </div>
                
                <div class="panel-body raya">
                    <div class="row">
   
                        <div class="col-xs-12 col-sm-6 general-anuncios">
                            <p class="subtitulos-caja">ANUNCIOS</p>
                            <a href="{{route('admin.publicar')}}" class="btn btn-warning btn-md col-xs-12 col-sm-5" role="button">
                                <span class="glyphicon glyphicon-eye-open">
                                </span>
                                <p>Esperando  <span class="hidden-xs"></span>revisión</p>
                                
                                
                            </a>
                            <a href="{{route('admin.revisar.denuncias')}}" class="btn btn-danger btn-md col-xs-12 col-sm-offset-1 col-sm-5" role="button">
                                 <span class="glyphicon glyphicon-exclamation-sign">
                                </span>
                                <p>Anuncios  <span class="hidden-xs"></span>denunciados</p>
                               
                                
                            </a>
                            
                            
                        </div>
                        <div class="col-xs-12 col-sm-6 general-usuarios">
                            <p class="subtitulos-caja">USUARIOS</p>
                            <a href="{{route('admin.usuarios.desactivados')}}" class="btn btn-primary btn-md col-xs-12 col-sm-offset-4 col-sm-5" role="button">
                                <span class="icon-confused"></span> 
                                <p>Usuarios  <span class="hidden-xs"></span>desactivados</p>
                                
                                
                            </a>
                        </div>

                        <div class="col-xs-12 col-sm-6 general-usuarios">
                            <p class="subtitulos-caja">MENSAJES</p>
                            <a href="{{route('mismensajes')}}" class="btn btn-success btn-md col-xs-12 col-sm-offset-4 col-sm-5" role="button">
                                <span class="icon-mail"></span> 
                                <p>Bandeja de  <span class="hidden-xs"></span>entrada</p>
                                
                                
                            </a>
                            
                        </div>

                        <div class="col-xs-12 col-sm-6 general-usuarios">
                            <p class="subtitulos-caja">TAREAS</p>
                            <a href="{{ route('admin.pendientes') }}" class="btn btn-info btn-md col-xs-12 col-sm-offset-4 col-sm-5" role="button">
                                <span class="icon-compass"></span>
                                <p>Tareas  <span class="hidden-xs"></span>pendientes</p>
                                 
                                
                            </a>
                        </div>
                    </div>
                   




                </div><!--fin panel body-->
            </div><!--fin panel-->
        </div>
    



    </div>

</div><!--fin contenedor interno-->
@stop