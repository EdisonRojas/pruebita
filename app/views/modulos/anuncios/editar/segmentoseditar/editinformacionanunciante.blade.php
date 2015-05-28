<fieldset>
 	<legend>Información del anunciante</legend>
 		<div class="form-group">
			{{ Form::label('anunciante','* ¿A quién llamar?') }}
			<div class="input-group">
				{{ Form::text('anunciante',$anunciante->anunciante,
						[
							'class' => 'form-control',
							'title'=>'Nombre del anunciante',
							'placeholder' => 'Ejm: Edro Leal', 
							'required' => 'required'
						])
				}}
				<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
			</div>
			<p class="informacion-adicional">Nombre del anunciante</p>
			{{ $errors->first('anunciante', '<p class="alert alert-danger errores">:message </p>') }}
		</div>

		<div class="form-group">
   			{{ Form::label('correo', '* Correo electrónico') }} 
			<div class="input-group" data-validate="email">
				{{ Form::email('correo', $anunciante->correo,
						[
							'class' => 'form-control',
							'id'=>'validate-email',
							'title'=>'Correo del anunciante',
							'placeholder' => 'edroleal@dominio.com', 
							'required' => 'required'
						])
				}}
				<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
			</div>
			<p class="informacion-adicional">El correo permance oculto a los demás usuarios.</p>
			{{ $errors->first('correo', '<p class="alert alert-danger errores">:message</p>')}}
		</div>

		<div class="form-group">
			{{ Form::label('celular', 'Celular') }}      
       		<div class="input-group" data-validate="phone">
				{{ Form::text('celular', $anunciante->celular,
						[
							'class' => 'form-control',
							'title'=>'Debe introducir su celular',
							'id'=>'celular',
						])
				}}
				<span class="input-group-addon success"><span class="glyphicon glyphicon-check"></span></span>
			</div>
			</p>
				{{ $errors->first('celular', '<p class="alert alert-danger errores">:message</p>')}}
        </div>

		<div class="form-group">
			
				
			{{ $errors->first('telefono', '<p class="alert alert-danger errores">:message</p>')}}
			
				{{ Form::label('telefono', 'Teléfono convencional') }} 
				<div class="input-group">
					{{ Form::text('telefono', $anunciante->telefono,
							[
								'class' => 'form-control',
								'title'=>'Teléfono del anunciante',
								
								'id'=>'telefono_anunciante',
							])
					}}
					<span class="input-group-addon success"><span class="glyphicon glyphicon-check"></span></span>
				</div>
				
			
		<div class="form-group">
           	{{ Form::label('tipopersona', '* Eres') }} 
				<div class="input-group">
                     <select class="form-control" name="tipopersona" id="validate-select" placeholder="Validate Select" required>
                       	<!--option value="">- Selecciona -</option-->
                       	<option value="particular">Particular</option>
                       	<option value="negocio">Empresa/negocio</option>
                   	</select>
					<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
				</div>
			</div>
			{{ $errors->first('tipopersona', '<p class="alert alert-danger errores">:message</p>')}}
		</div>
</fieldset>