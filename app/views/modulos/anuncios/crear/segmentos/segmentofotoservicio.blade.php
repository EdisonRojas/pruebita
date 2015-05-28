<div class="form-group">
	{{ Form::label('fotos','Fotos') }}
		
		<input id="foto1" name="foto1" type="file" class="file" data-show-preview="false">
		<p class="informacion-adicional">Subir foto con formato .jpg .jpeg o .png. Que su tamaño no supere los 4 MB.</p>
			{{ $errors->first('foto1', '<p class="alert alert-danger errores">:message </p>') }} 
</div>
