
	<fieldset>
		<legend>Información del anuncio</legend>
		<div class="form-group">
			{{ Form::label('titulo','* Titulo') }}
				<div class="input-group">
					{{ Form::text('titulo',Input::old('titulo'),
						[
							'class' => 'form-control',
							'id'=>'validate-text',
							'title'=>'Título del anuncio',
							'placeholder' => 'Ejm: Vendo Tablet Samsung Galaxy Tab 2 de 7pulg ', 
							'required' => 'required'
						])
					}}
					<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
				</div>
				<p class="informacion-adicional">Ingresa por lo menos 50 caracteres.</p>
				{{ $errors->first('titulo', '<p class="alert alert-danger errores">:message </p>') }}
		</div>
						
		<div class="form-group">
			{{ Form::label('descripcion','* Descripción') }}
				<div class="input-group" data-validate="length" data-length="3">
					{{ Form::textarea('descripcion', null, 
						[
							'class' => 'form-control', 
							'size' => '10x10',
							'maxlength'=>'400',
							'placeholder'=>'Describe lo mejor posible tu producto, referencia cosas como: Marca, color, modelo, año, accesorios, todas las caracteríticas posibles.', 
							'required'=>'required' 
						]) 
					}}
					<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
				</div>
				<p class="informacion-adicional">La descripción debe contener mínimo 20 caracteres.</p>
				{{ $errors->first('descripcion', '<p class="alert alert-danger errores">:message </p>') }}  
		</div>

		
	</fieldset>	
