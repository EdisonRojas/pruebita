{{ Form::label('fotos','Foto actual') }}
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


			
