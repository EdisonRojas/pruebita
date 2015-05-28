<div class="form-group">
	{{ Form::label('fotos','Fotos') }}
		<p class="informacion-adicional">Subir fotos con formato .jpg o .png. Que su tamaño no supere los 4 MB.</p>
		<input id="foto1" name="foto1" type="file" class="file" data-show-preview="false">
			{{ $errors->first('foto1', '<p class="alert alert-danger errores">:message </p>') }} 
</div>

<div class="form-group">
	<input id="foto2" name="foto2" type="file" class="file" data-show-preview="false">
		{{ $errors->first('foto2', '<p class="alert alert-danger errores">:message </p>') }} 
</div>
			
<div class="form-group">
	<input id="foto3" name="foto3" type="file" class="file" data-show-preview="false">
		{{ $errors->first('foto3', '<p class="alert alert-danger errores">:message </p>') }}  
	</div>
							
<div class="form-group">
	<input id="foto4" name="foto4" type="file" class="file" data-show-preview="false">
		{{ $errors->first('foto4', '<p class="alert alert-danger errores">:message </p>') }} 
</div>