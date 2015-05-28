@extends('layout')
@section('contenido')
<div class="contenedor-interno">
<div class="centrar-div">
    <h4>Anuncios sobre servicios categoría {{strtolower($categoria->categoria)}}</h4>
</div>
<div class="row">
    <div class="col-xs-12  col-sm-12 col-md-12 cabeza">
      <ol class="breadcrumb">
        <li><a href="{{ route('main') }}">Inicio</a></li>
        <li><a href="{{ route('verservicios') }}">Servicios</a></li>
        <li class="active">{{$categoria->categoria}}</li>
      </ol>

    
    </div><!--fin cabeza--> 
  @foreach ($anuncios as $anuncio)
    <div class="col-xs-12 col-sm-4 col-md-4 cuadroproducto">
        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-12 titulo-clasificados">
                    {{ strtoupper(str_limit($anuncio->titulo,30)) }}
                </div>

                <p>Anunciante <span class="label label-success">{{$anuncio->pregunta_title}}</span></p>
                <div class="col-xs-12 col-sm-8 precio-clasificados">
                    @if($anuncio->seccion_id==1)
                    <div>
                      <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                      <label> Precio: </label> $ {{ $anuncio->valor }} 
                    </div>
                    @endif
                    <label class="opcionvalor-clasificados"> {{strtoupper($anuncio->opcionvalor)}}</label>
                </div>
            </div>

            <div class="col-xs-6 col-sm-5">
                @if($anuncio->imagen=="")
                    <img src="{{ asset('assets/images/anunciosinfoto.png')}}" class="img-responsive" alt="">
                @else
                    <img src="{{ asset($anuncio->imagen) }}" class="img-responsive" alt="">
                @endif       
            </div>
                    
            <div class="col-xs-6 col-sm-7 caja-derecha">
                <div class="fechas-anuncio">
                  <label>Publicado el:</label>
                      {{$anuncio->publicaciondate->format('j/m/Y H:i a')}}
                </div>
               
                
                  <div class="pull-left">
                    <?php $nombreseccion=$anuncio->seccion_title ?>
                      <a href="{{ route('veranuncio',[ $nombreseccion, $anuncio->id ]) }}" class="botones-misanuncios btn btn-primary btn-xs" role="button">
                          <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                          VER 
                      </a>
                  </div>
               
            </div>
        </div><!--fin ROW-->
    </div><!--fin cuadro producto-->
     

    @endforeach
</div><!--fin row-->
    {{$anuncios->links() }}
    {{-- $anuncios->previous().' '.$anuncios->next() --}}
</div>
@stop

