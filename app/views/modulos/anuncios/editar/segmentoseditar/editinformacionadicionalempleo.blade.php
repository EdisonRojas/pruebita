<fieldset>
	<legend>Información adicional</legend>
		<div class="form-group ">
			{{ Form::label('valor','* Sueldo  estimado') }}
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
			{{ Form::label('tipo','* Tipo') }}
    		<div class="input-group">
		       	<select class="form-control" name="tipo" id="validate-select" placeholder="Validate Select" required>
		           	<option value="">- Selecciona -</option>
		           	<option value="tiempocompleto">Tiempo completo</option>
		           	<option value="mediotiempo">Medio tiempo</option>
		           	<option value="temporal">Temporal</option>
		           	<option value="porhoras">Por horas</option>

		           	
		       	</select>
				<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
			</div>
			{{ $errors->first('tipo', '<p class="alert alert-danger errores">:message </p>') }}
		</div>
</fieldset>