<fieldset>
 	<legend>Información del anunciante</legend>
 		<div class="form-group">
			{{ Form::label('anunciante','* ¿A quién llamar?') }}
			<div class="input-group">
				{{ Form::text('anunciante',Input::old('anunciante'),
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
				{{ Form::email('correo', Input::old('correo'),
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
				{{ Form::text('celular', Input::old('celular'),
						[
							'class' => 'form-control',
							'title'=>'Debe introducir su celular',
							'placeholder'=>'Ejem: 09 6967 2916',
							'id'=>'celular',
						])
				}}
				<span class="input-group-addon success"><span class="glyphicon glyphicon-check"></span></span>
			</div>
			<p class="informacion-adicional">Si deseas puedes añadir un teléfono convencional haciendo clic en el botón inferior.</p>
				{{ $errors->first('celular', '<p class="alert alert-danger errores">:message</p>')}}
        </div>

		<div class="form-group">
			<div id="addtelefono_contenedor">
				<a href="" id="enlace-addtelefono" class="enlace" title="">Añadir teléfono convencional
                    <button class="btn btn-success btn-addtelefono" type="button">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </a>
          	</div>
			{{ $errors->first('telefono', '<p class="alert alert-danger errores">:message</p>')}}
			<div id="telefono_contenedor">
				{{ Form::label('telefono', 'Teléfono convencional (072)') }} 
				<div class="input-group">
					{{ Form::text('telefono', Input::old('telefono'),
							[
								'class' => 'form-control',
								'title'=>'Teléfono del anunciante',
								'placeholder'=>'Ejem: 547750',
								'id'=>'telefono_anunciante',
							])
					}}
					<span class="input-group-addon success"><span class="glyphicon glyphicon-check"></span></span>
				</div>
				
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