<div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10" id="comentar">
	<label>Puedes realizar una pregunta o comentario sobre el anuncio</label>
	{{ Form::open(array(
		'action'=>'ComentarioController@comenta',
		'method'=>'POST',
		'role'=>'form',
		'id'=>'form',
		'novalidate'
		))
	}}
	<div>
        {{ Form::textarea('comentario',Input::old('comentario'), array('class'=>'form-control', 'placeholder'=>'Escribe tu pregunta o comentario', 'size' => '1x2')) }}
            <div class="bg-danger" id="_comentario">{{ $errors->first('comentario')}}</div>
            <input id="anuncio_id" type="hidden"  name="anuncio_id" value={{$anuncio->id}} >
				<div id="mensaje">
				</div>
		{{Form::input('button', null, 'Enviar comentario', array('class'=>'btn btn-success col-xs-12','id'=>'enviarcomentario'))}}      
    </div>	
		{{ Form::close()}}
		<div id="img-cargando">
			<img src="{{ asset('assets/images/loading.gif')}}">
		</div>
</div>