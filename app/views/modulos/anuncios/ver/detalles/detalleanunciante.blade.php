<fieldset>
 	<label>ANUNCIANTE</label>
 		<p>{{ $anuncio->anunciante->anunciante }} ({{ $anuncio->anunciante->tipopersona }})</p>
		<p><span>Celular: </span>{{ $anuncio->anunciante->celular }}</p>
		<p><span>Teléfono: </span>{{ $anuncio->anunciante->telefono }}</p>

		@if(Auth::check())
			@if(Auth::id()!=$anuncio->usuario_id)
				<a href="" data-toggle="modal" data-target="#mensajeanunciante" class="btn btn-warning btn-xs btn-separado" title="">Escribir un mensaje</a>
			@endif
		@endif

		@if(Session::has('estatus_ok'))
			<p class="alert alert-success">{{Session::get('estatus_ok')}}</p>

		@endif
		@if(Session::has('estatus_error'))
			<p class="alert alert-danger">{{Session::get('estatus_error')}}</p>

			<p class="alert alert-info">
				{{ $errors->first('nombre', ':message')}}
				{{ $errors->first('apellido', ':message')}}
				{{ $errors->first('correo', ':message')}}
				{{ $errors->first('asunto', ':message')}}
				{{ $errors->first('mensaje', ':message')}}
			</p>
		@endif

		{{--Solo se muestra boton agendar anunciante si se tiene cuenta en miraditaloja--}}
		@if(Auth::check())
			@if(Auth::id()!=$anuncio->usuario_id)
				<a href="{{route('agendar', [$anuncio->anunciante->id])}}" class="btn btn-primary btn-xs btn-separado" title="">Agendar anunciante</a>
			@endif
		@endif
		@if(Session::has('agendar_ok'))
			<p class="alert alert-success">{{Session::get('agendar_ok')}}</p>

		@endif
		@if(Session::has('agendar_error'))
			<p class="alert alert-success">{{Session::get('agendar_error')}}</p>

		@endif


</fieldset>

