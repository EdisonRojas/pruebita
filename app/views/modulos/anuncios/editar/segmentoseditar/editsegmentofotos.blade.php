{{ Form::label('fotos','Fotos actuales') }}
<div class="form-group fotoedicion">
	@if($anuncio->foto1=="")
	 	<div class="fotos-edicion">
			<span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
			
			
		</div>
		<small>Sin foto, presiona Foto principal y sube una.</small>
	 	
	@else
	<div>
		<img class="fotos-edicion" src="{{ asset($anuncio->foto1) }}" alt="">
	</div>
		
		<small>Si deseas cambiar foto, presiona Foto y sube una nueva</small>
	@endif
	<input id="foto1" name="foto1" type="file" class="file" data-show-preview="false">
	{{ $errors->first('foto1', '<p class="alert alert-danger errores">:message </p>') }} 
</div>

<div class="form-group fotoedicion">
	@if($anuncio->foto2=="")
		<div class="fotos-edicion">
			<span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
			
			
		</div>
		<small>Sin foto, presiona Foto y sube una.</small>
	 	{{--<img class="fotos-edicion" src="{{ asset('assets/images/sinfoto.png')}}" alt="">--}}
	
	@else
		<div>
		<img src="{{ asset($anuncio->foto2) }}" class="fotos-edicion" alt="">
		</div>
		<small>Si deseas cambiar foto, presiona Foto y sube una nueva</small>
	@endif
	<input id="foto2" name="foto2" type="file" class="file " data-show-preview="false">
	{{ $errors->first('foto2', '<p class="alert alert-danger errores">:message </p>') }} 
</div>
			
<div class="form-group fotoedicion">
	@if($anuncio->foto3=="")
	 	<div class="fotos-edicion">
			<span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
			
			
		</div>
		<small>Sin foto, presiona Foto y sube una.</small>
	@else
		<div>
		<img src="{{ asset($anuncio->foto3) }}" class="fotos-edicion" alt="">
		</div>
		<small>Si deseas cambiar foto, presiona Foto y sube una nueva</small>
	@endif
	<input id="foto3" name="foto3" type="file" class="file" data-show-preview="false">
	{{ $errors->first('foto3', '<p class="alert alert-danger errores">:message </p>') }}  
</div>
							
<div class="form-group fotoedicion">
	@if($anuncio->foto4=="")
	 	<div class="fotos-edicion">
			<span class="glyphicon glyphicon-camera" aria-hidden="true"></span>

			
		</div>
		<small>Sin foto, presiona Foto y sube una.</small>
	@else
		<div>
		<img src="{{ asset($anuncio->foto4) }}" class="fotos-edicion" alt="">
		</div>
		<small>Si deseas cambiar foto, presiona Foto y sube una nueva</small>
	@endif
	<input id="foto4" name="foto4" type="file" class="file" data-show-preview="false">
	{{ $errors->first('foto4', '<p class="alert alert-danger errores">:message </p>') }} 
</div>
<p class="informacion-adicional">Subir fotos con formato .jpg o .png. Que su tamaño no supere los 4 MB.</p>