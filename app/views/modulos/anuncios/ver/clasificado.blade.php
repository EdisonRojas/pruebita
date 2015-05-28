@extends('layout')
@section('metas')
	<meta property='og:locale' content='es_ES'/>
	<meta property="og:type" content="articulo"/>
	<meta property="og:title" content="Anuncio clasificado de {{$anuncio->anunciante->anunciante}}"/>
	<meta property="og:description" content="{{$anuncio->titulo}}"/>
	<meta property='og:site_name' content='Miradita Loja'/>
	<meta property="og:image" content="{{ asset($anuncio->foto1) }}"/>
	
@stop
@section('contenido')
	
<div class="contenedor-interno">

	<div class="centrar-div">
		<h3>Anuncio clasificado</h3>
	</div>
	@if(Session::has('error_bloqueado'))
		<p class="alert alert-danger">{{Session::get('error_bloqueado')}}</p>

	@endif


	<div class="row">
	{{-- Form::open(['route'=>'clasificadocreado', 'method'=>'POST', 'role'=>'form','files' => true, 'novalidate']) --}}		

		<div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10 cabeza">
			<ol class="breadcrumb">
			  <li><a href="#">Inicio</a></li>
			  <li><a href="{{ route('verclasificados') }}">{{$anuncio->seccion_title}}</a></li>
			  <li><a href="{{ route('clasificados.categoria.n',[$anuncio->categoria->id]) }}">{{$anuncio->categoria->categoria}}</a></li>
			  <li><a href="{{ route('clasificados.subcategoria.n',[ $anuncio->categoria->id, $anuncio->subcategoria->id ]) }}">{{$anuncio->subcategoria->subcategoria}}</a></li>
			  <li class="active">{{$anuncio->id}}</li>
			</ol>

		
		</div><!--fin cabeza-->				
		
		@if(Auth::check())
			@if(Auth::id()==$anuncio->usuario_id)
			<div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10">
				<p class="alert alert-info">Este anuncio fue creado por ti.</p>
			</div>
			@endif
		@endif

		<div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10 titulo-anuncio">
			{{ strtoupper($anuncio->titulo)}}
		</div>
		


		<div class="col-xs-8  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10 valor-anuncio">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
				<div class="cuadro-precio cuadro-default">
					<div class="opcionvalor">
						<div class="opcionvalor-text">
							{{-- $anuncio->opcionvalor --}}	
							{{ strtoupper($anuncio->estado)}}						
						</div>
					</div>
					<div class="cuadro-precio-contenido">
						<span>
							{{ strtoupper("$ ". $anuncio->valor)}}
						</span>
							
						
						<div>
							{{-- strtoupper($anuncio->estado)--}}
							{{ $anuncio->opcionvalor }}	
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10">

				<!--Aqui debe ir segmento informacion del anuncio-->
			<div class="row">
				<!--div class="col-xs-12 col-sm-12 col-md-6 subcuerpo-izquierda"-->
				<div class="col-xs-12 col-sm-6 col-md-6">
					<!--carrusel de fotos-->
					@include('modulos.anuncios.ver.detalles.detallefotos')
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 detalleanuncio">

					<!--detalle..descripcion del anuncio-->
					@include('modulos.anuncios.ver.detalles.detalleanuncio')
					
					
				</div>
			</div>
		</div>
		
		<div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10">
			<div class="col-xs-12 col-sm-6 col-md-6">	
				@include('modulos.anuncios.ver.detalles.detalleanunciante')
			</div>

			<div class="col-xs-12 col-sm-6 col-md-6">
				<div>
					<label for="">Compartir anuncio:</label>	
				</div>
					<a href="" title="">facebook</a>
					<a href="" title="">twitter</a>
					<a href="" title="">google plus</a>
			</div>
		</div>
		
			
		<!--div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10  comentarios">
			<a href="" class="btn btn-info col-xs-12" title="">Ver comentarios</a>
		</div-->	

		<!--div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10">
			<p>EsTOS NPOSON OJO</p>
			<a href="https://www.facebook.com/sharer/sharer.php?u=http://miraditaloja.com/anuncio/ver/Clasificados/{{$anuncio->id}}" target="_blank"><img src="https://lh3.googleusercontent.com/-H8xMuAxM-bE/UefWwJr2vwI/AAAAAAAAEdY/N5I41q19KMk/s32-no/facebook.png"></a>
			
			<a href="http://www.twitter.com/home?status=http://miraditaloja.com/anuncio/ver/Clasificados/{{$anuncio->id}}" target="_blank"><img src="https://lh5.googleusercontent.com/-xZVxH6CsUaQ/UefWwgi8o3I/AAAAAAAAEdk/reo5XS6z8-8/s32-no/twitter.png"></a>

			<a href="https://plus.google.com/share?url=http://miraditaloja.com/anuncio/ver/Clasificados/{{$anuncio->id}}" target="_blank"><img src="https://lh5.googleusercontent.com/-5Q7Sj0SXhOA/UefWwcrnZ-I/AAAAAAAAEdg/auK3wqGCbZE/s32-no/googleplus.png"></a>


		</div-->
		

<!--Los comentarios van aqui-->

@include('modulos.anuncios.ver.detalles.detalletodosloscomentarios')

<!--Inicio comentar-->
@if(Auth::check())
@include('modulos.anuncios.ver.detalles.detallecomentar')
@endif
<!--Fin comentar-->

	{{--Si anuncio está activo aparece el boton de bloquear anuncio--}}
	@if(Auth::check())	
		@if(is_admin())
			@include('modulos.anuncios.ver.detalles.botonbloquear')
		@endif
	@endif
	</div><!--Fin row-->
</div><!--fin contenedor-interno-->
@include('modales.mensajeanunciante')
@include('modales.modalbloquearanuncio')
@include('modales.modaldenuncia')
@stop
