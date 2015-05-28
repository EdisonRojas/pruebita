@extends('layout')
@section('contenido')
<div class="contenedor-interno">
    <div class="centrar-div">
        <h4>Anuncios que deben ser desactivados</h4>
    </div>
    <div class="row">
        @if (Session::has('status_error'))
            <p class="alert alert-danger">{{Session::get('status_error')}} </p>
        @endif
        @if (Session::has('status_ok'))
            <p class="alert alert-success">{{Session::get('status_ok')}} </p>
        @endif
        <div class="col-xs-12 col-md-8">
            <?php $i=1  ?>
          <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        
                        
                        <th>ID</th>
                        <th>descripcion</th>
                        
                        <th>Fecha expira</th>
                        
                       
                        
                    </tr>
                </thead>
              
                <tbody>
                     @foreach ($anuncios as $anuncio)
                      
                            <tr class="warning">
                                <td>{{ $i++ }}</td>
                               
                                <td>{{ $anuncio->id }}</td>
                                
                                <td>{{ $anuncio->descripcion }}</td>
                                <td>{{ $anuncio->expiradate }}</td>
                                
                                
                            </tr>
                            
                    @endforeach          
            </table>
        </div>       
        </div>
                   




               
    </div>
    
    <a href="{{route('desactivar.anuncios.expirados')}}" title="" class="btn btn-success">Desactivar auncios</a>


    

</div><!--fin contenedor interno-->
@stop