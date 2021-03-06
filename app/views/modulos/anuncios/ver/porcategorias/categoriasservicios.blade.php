@extends('layout')
@section('contenido')
<div class="contenedor-interno">
	<div class="centrar-div">
	    <h3>Categorias de servicios</h3>
	</div>
	

	<div class="row">
		<div class="col-xs-12  col-sm-12 col-md-12 cabeza">
			<ol class="breadcrumb">
			  <li><a href="{{ route('main') }}">Inicio</a></li>
			  <li><a href="{{ route('verservicios') }}">Servicios</a></li>
			  <li class="active">Categorias</li>
			</ol>

		
		</div><!--fin cabeza-->		
	  @foreach ($categorias as $categoria)
	  	 <div class=" col-xs-12 col-md-6">
           
            <div class="blockquote-box blockquote-info clearfix">
                <div class="square pull-left">
                    <span class="{{$categoria->icono}} glyphicon-lg"></span>
                </div>
                <h4 class="enlace-categoria">
                	<a href="{{ route('servicios.categoria.n',[$categoria->id]) }}" title="">{{$categoria->categoria}}
					</a>
                	
                </h4>
	                <p class="enlacessubcategorias">
		                @foreach ($categoria->subcategorias as $subcategoria)
			            	<a href="{{ route('servicios.subcategoria.n',[ $categoria->id, $subcategoria->id ]) }}" title="">{{$subcategoria->subcategoria}} </a>  -
			                	
		                @endforeach
	                </p>
            </div>
            
        </div>





	  @endforeach
	</div><!--fin row-->
</div>
@stop