<fieldset>
	<legend>Información adicional</legend>
		<div class="form-group">
           	{{ Form::label('estado', '* Estado') }} 
				<div class="input-group">
                     <select class="form-control" name="estado" id="validate-select" placeholder="Validate Select" required>
                       	<option value="">- Selecciona -</option>
                       	<option value="usado">Usado</option>
                       	<option value="nuevo">Nuevo</option>
                   	</select>
					<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
				</div>
				{{ $errors->first('estado', '<p class="alert alert-danger errores">:message </p>') }}
		</div>

		<div class="form-group ">
			{{ Form::label('valor','* Precio') }}
				<div class="input-group" data-validate="number">
					<span class="input-group-addon">$</span>
					{{ Form::text('valor',Input::old('valor'),
						[
							'class' => 'form-control',
							'id'=>'validate-number',
							'title'=>'Debe introducir el valor o sueldo',
							'placeholder' => 'Solo números enteros', 
							'required' => 'required'
						])
					}}
					<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
				</div>
				{{ $errors->first('valor', '<p class="alert alert-danger errores">:message </p>') }}
		</div>

		<div class="form-group">
    		<div class="input-group">
		       	<select class="form-control" name="opcionvalor" id="validate-select" placeholder="Validate Select" required>
		           	<option value="">- Selecciona -</option>
		           	<option value="negociable">Negociable</option>
		           	<option value="fijo">Fijo</option>
		       	</select>
				<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
			</div>
			{{ $errors->first('opcionvalor', '<p class="alert alert-danger errores">:message </p>') }}
		</div>
</fieldset>