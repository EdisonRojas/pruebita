@extends('layout')
@section('contenido')
<div class="contenedor-interno">
<div class="centrar-div">
    <h3>Anuncios sobre empleos</h3>
</div>
<div class="row">
   <div>
    <a href="{{ route('empleos.categorias') }}" title="" class="btn btn-info">Ver categorias</a>
  </div>
  @foreach ($anuncios as $anuncio)
    <div class="col-xs-12 col-sm-4 col-md-4 cuadroproducto">
        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-12 titulo-clasificados">
                    {{ strtoupper(str_limit($anuncio->titulo,30)) }}
                </div>

                <p>Anunciante <span class="label label-success">{{$anuncio->pregunta_title}}</span></p>


                <div class="col-xs-12 col-sm-8 precio-clasificados">
                    @if($anuncio->seccion_id==3)
                    <div>
                      <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                      <label> Sueldo: </label> $ {{ $anuncio->valor }} 
                    </div>
                    @endif
                    <label class="opcionvalor-clasificados"> {{strtoupper($anuncio->tipo_title)}}</label>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12">
                   <p>{{str_limit($anuncio->descripcion,40)}}</p> 
            </div>
                    
            <div class="col-xs-12 col-sm-12 caja-derecha">
                <div class="fechas-anuncio">
                  <label>Publicado el:</label>
                      {{$anuncio->publicaciondate->format('d-m-Y') }}
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

