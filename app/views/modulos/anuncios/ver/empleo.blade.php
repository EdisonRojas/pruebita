@extends('layout')
@section('metas')
	<meta property='og:locale' content='es_ES'/>
	<meta property="og:type" content="articulo"/>
	<meta property="og:title" content="Anuncio sobre empleo de {{$anuncio->anunciante->anunciante}}"/>
	<meta property="og:description" content="{{$anuncio->titulo}}"/>
	<meta property='og:site_name' content='Miradita Loja'/>
	<meta property="og:image" content="{{ asset($anuncio->foto1) }}"/>
	
@stop
@section('contenido')
	
<div class="contenedor-interno">

	<div class="centrar-div">
		<h3>Anuncio empleos</h3>
	</div>
	@if(Session::has('error_bloqueado'))
		<p class="alert alert-danger">{{Session::get('error_bloqueado')}}</p>

	@endif
	<div class="row">
	{{-- Form::open(['route'=>'clasificadocreado', 'method'=>'POST', 'role'=>'form','files' => true, 'novalidate']) --}}		

		<div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10 cabeza">
			<ol class="breadcrumb">
			  <li><a href="#">Inicio</a></li>
			  <li><a href="{{ route('verempleos') }}">{{$anuncio->seccion_title}}</a></li>
			   <li><a href="{{ route('empleos.categoria.n',[$anuncio->categoria->id]) }}">{{$anuncio->categoria->categoria}}</a></li>
			  <li><a href="{{ route('empleos.subcategoria.n',[ $anuncio->categoria->id, $anuncio->subcategoria->id ]) }}">{{$anuncio->subcategoria->subcategoria}}</a></li>
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

		<div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10 ">

				<!--Aqui debe ir segmento informacion del anuncio-->
			<div class="row">
				<!--div class="col-xs-12 col-sm-12 col-md-6 subcuerpo-izquierda"-->
				<div class="col-xs-12 col-sm-6 col-md-6 detalleanuncio">
					
					<label>INFORMACIÓN</label>

			 		<p><span>Sueldo estimado: </span>{{ $anuncio->valor }}</p>
					<p><span>Tipo: </span>{{ $anuncio->tipo_title }}</p>

					@include('modulos.anuncios.ver.detalles.detalleanuncio')
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 ">
					@include('modulos.anuncios.ver.detalles.detalleanunciante')
					<!--detalle..descripcion del anuncio-->
					
					
				</div>

				<div class="col-xs-12 col-sm-6 col-md-6 ">
						<div>
							<label for="">Compartir anuncio:</label>	
						</div>
							<a href="" title="">facebook</a>
							<a href="" title="">twitter</a>
							<a href="" title="">google plus</a>
					</div>
				</div>
		</div>
		
		<div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10 ">
			

			
		</div>
		
	

		



		
		<!--div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10">
			<p>EsTOS NPOSON OJO</p>
			<a href="https://www.facebook.com/sharer/sharer.php?u=http://miraditaloja.com/anuncio/ver/Clasificados/{{$anuncio->id}}" target="_blank"><img src="https://lh3.googleusercontent.com/-H8xMuAxM-bE/UefWwJr2vwI/AAAAAAAAEdY/N5I41q19KMk/s32-no/facebook.png"></a>
			
			<a href="http://www.twitter.com/home?status=http://miraditaloja.com/anuncio/ver/Clasificados/{{$anuncio->id}}" target="_blank"><img src="https://lh5.googleusercontent.com/-xZVxH6CsUaQ/UefWwgi8o3I/AAAAAAAAEdk/reo5XS6z8-8/s32-no/twitter.png"></a>

			<a href="https://plus.google.com/share?url=http://miraditaloja.com/anuncio/ver/Clasificados/{{$anuncio->id}}" target="_blank"><img src="https://lh5.googleusercontent.com/-5Q7Sj0SXhOA/UefWwcrnZ-I/AAAAAAAAEdg/auK3wqGCbZE/s32-no/googleplus.png"></a>


		</div-->
<!--Los comentarios van aqui-->
@include('modulos.anuncios.ver.detalles.detalletodosloscomentarios')

<!--Inicio comentar-->

@include('modulos.anuncios.ver.detalles.detallecomentar')

<!--Fin comentar-->
		



		
			
		@if(Auth::check())	
			@if(is_admin())
				@include('modulos.anuncios.ver.detalles.botonbloquear')
			@endif
		@endif

	</div><!--fin row-->
</div><!--fin contenedor-interno-->
@include('modales.mensajeanunciante')
@include('modales.modalbloquearanuncio')
@include('modales.modaldenuncia')
@stop