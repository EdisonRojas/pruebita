@extends('layout')
@section('contenido')
<div class="contenedor-interno">
<div class="centrar-div">
    <h3>Mis anuncios</h3>
</div>

<div class="row">
  @if (Session::has('status_ok'))
    <p class="alert alert-success"> {{ Session::get('status_ok') }}</p>
                    
  @endif
  @if (Session::has('status_error'))
    <p class="alert alert-danger"> {{ Session::get('status_error') }}</p>
                    
  @endif
    @foreach ($anuncios as $anuncio)
    
    <div class="col-xs-12 col-sm-6 col-md-6 column cuadroproducto">
        <div class="row">
             
            <div class="col-xs-12">
                <div class="col-xs-12 producttitle">
                    
                    {{ strtoupper(str_limit($anuncio->titulo,30)) }}
                </div>
                <div class="col-xs-12">
                    
                    SECCIÓN {{ strtoupper($anuncio->seccion_title) }}
                </div>
                <div class="col-xs-12 precio">
                    @if($anuncio->seccion_id==1)
                      <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                      <label> Precio: </label> $ {{ $anuncio->valor }} 
                    @elseif($anuncio->seccion_id==2)
                   
                      <span class=" glyphicon glyphicon-certificate" aria-hidden="true"></span>
                      <label>--</label> 
                    @elseif($anuncio->seccion_id==3)
                      <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                      <label> Sueldo: </label> $ {{ $anuncio->valor }} 
                    @endif


                  


                    @if($anuncio->estado_id==1)
                        <a class="btn btn-desactivar btn-xs" role="button" data-title="Desactivar" data-href="{{ route('desactivaranuncio',[ $anuncio->id ]) }}" title="" data-toggle="modal" data-target="#deactivate">
                             <span class="glyphicon glyphicon-circle-arrow-down" ></span>
                             DESACTIVAR ANUNCIO
                         </a>
                    @elseif($anuncio->estado_id==2)

                        <a class="btn btn-publicacion btn-xs" title="" role="button" data-href="{{ route('publicaranuncio',[ $anuncio->id ]) }}" data-toggle="modal" data-target="#publish">
                            <span class="glyphicon glyphicon-circle-arrow-up" ></span>
                            PUBLICAR ANUNCIO
                        </a>
                    @elseif($anuncio->estado_id==3) 
                        <a class="btn btn-info btn-xs btn-oculto" title="">------e------</a>
                     @elseif($anuncio->estado_id==5) 
                        <a  class="btn btn-info btn-xs btn-oculto" title="">------f-------</a>
                    @elseif($anuncio->estado_id==6) 
                        <a  class="btn btn-info btn-xs btn-oculto" title="">-------g------</a>
                    @elseif($anuncio->estado_id==7) 
                        <a  class="btn btn-info btn-xs btn-oculto" title="">-------h------</a>
                    @endif
                    
                </div>
                <div class="col-xs-10">
                    
                    
                
                </div>
            </div>
            <div class="col-xs-6 col-sm-6">
                @if($anuncio->imagen=="")
                    <img src="{{ asset('assets/images/anunciosinfoto.png')}}" class="img-responsive" alt="">
                @else
                    <img src="{{ asset($anuncio->imagen) }}" class="img-responsive" alt="">
                @endif       
            </div>
                    
            <div class="col-xs-6 col-sm-6 caja-derecha-misanuncios">
                
                        
                @if($anuncio->estado_id!=1)
                    <div class="fechas-anuncio">
                        <label>Creado el:</label>   {{$anuncio->created_at->format('j/m/Y')}}
                    </div>
                    <div class="fechas-anuncio">
                        <label>Actualizado:</label>   {{$anuncio->updated_at->format('j/m/Y')}}
                    </div>


                @else
                    <div class="fechas-anuncio">
                       <label>Publicado el:</label>
                           {{$anuncio->publicaciondate->format('j/m/Y')}}
                   </div>
                   <div class="fechas-anuncio">
                       <label>Activo hasta:</label>
                           {{$anuncio->expiradate->format('j/m/Y')}}
                   </div>


                @endif

                <div class="">
                    <div class="pull-left">
                        <?php $nombreseccion=$anuncio->seccion_title ?>
                        <a href="{{ route('veranuncio',[ $nombreseccion, $anuncio->id ]) }}" class="botones-misanuncios btn btn-primary btn-xs col-xs-10 col-sm-10" role="button">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            VER
                        </a>
                        <a href="{{ route('editaranuncio',[ $anuncio->id ]) }}" class="botones-misanuncios btn btn-warning btn-xs col-xs-10 col-sm-10" role="button">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            EDITAR
                        </a>
                        


                                  <!--route('borraranuncio',[ $anuncio->id, $anuncio->id ])-->  
                        <a class="botones-misanuncios btn btn-danger btn-xs col-xs-10 col-sm-10" role="button" data-href="{{ route('borraranuncio',[ $anuncio->id ]) }}" data-toggle="modal" data-target="#delete">
                            <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
                           ELIMINAR
                        </a>
                    </div>
                </div> 
            </div>

            <div class="col-xs-12">
                      <div class="list-group">
                        
                          <div class="list-group-item">
                              <h5 class="list-group-item-heading">
                                  ESTADO DEL ANUNCIO 

                              </h5>
                              
                              <p class="list-group-item-text">
                                @if($anuncio->estado_id==1 )    
                                  <span class="label label-success">{{ $anuncio->estado_title }}</span>
                                  <small>Tu anuncio se encuentra bien y es visto por todos los usuarios</small>
                                @elseif($anuncio->estado_id==2)
                                    
                                  <span class="label label-primary">{{ $anuncio->estado_title }}</span>
                                  <small>Tu anuncio está creado pero no has solicitado su publicación.</small> 
                                @elseif($anuncio->estado_id==3)
                                   
                                  <span class="label label-bloqueado">{{ $anuncio->estado_title }}</span> 
                                  <small>Tu anuncio ha sido bloqueado por no cumplir las normas de uso</small> 
                                @elseif($anuncio->estado_id==5)
                                  <span class="label label-revision">{{ $anuncio->estado_title }}</span> 
                                  <small>Un administrador lo está revisando para su debida publicación</small> 
                                @elseif($anuncio->estado_id==6)
                                  <span class="label label-denunciado">{{ $anuncio->estado_title }}</span> 
                                  <small>Tu anuncio ha recibido alguna denuncia, ahora está en revisión</small>   
                                @elseif($anuncio->estado_id==7)
                                  <span class="label label-denunciado">{{ $anuncio->estado_title }}</span> 
                                  <small>Tu anuncio no paso con éxito la revisión. Editalo y publicalo.</small>   
                                @endif
                              </p>
                          </div>
                          
                           
                      </div>
            </div>
           
        </div>
    </div><!--fin cuadro producto-->
     

    @endforeach
    @include('modales.modaldelete')
    @include('modales.modaldesactivar') 
    @include('modales.modalpublicar')
</div><!--fin row-->
    {{$anuncios->links() }}
    {{-- $anuncios->previous().' '.$anuncios->next() --}}
</div>
@stop

