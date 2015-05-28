@extends('layout')
@section('contenido')
	
<!--div class="contenedor-interno contenedor-crear-anuncio"-->
<div class="contenedor-interno">
	<div class="centrar-div espacio-inferior-mediano">
		<h2>Selecciona sección y categoría.</h2>
	</div>
	{{ Form::open(['route'=>'pasouno', 'method'=>'POST', 'role'=>'form','files' => true, 'novalidate']) }}
	<div class="row">
		<!--div class="col-xs-12 anunciocabecera"--><!--anuncio cabecera-->
			<div class="col-xs-12  col-sm-offset-2 col-sm-8 col-md-offset-1 col-md-10  cabeza">
				<div class="row">
					<div class="col-xs-12">
						<div>
							<label>Seleccione sección:</label>	
						</div>
				
						<div class="btn-group botonerasecciones" data-toggle="buttons">
							<label class="btn btn-primary btnseccion" id="btn_clasificados">
							<input class="input-opcion" value=1 type="radio" name="options" autocomplete="off">
							<span id="opcion1"></span> 
							Clasificados
							</label>
							
							<label class="btn btn-primary btnseccion" id="btn_servicios">
							<input class="input-opcion" value=2 type="radio" name="options" autocomplete="off">
							<span id="opcion2"></span>
							Servicios
							</label>
							
							<label class="btn btn-primary btnseccion" id="btn_empleos">
					    	<input class="input-opcion" value=3 type="radio" name="options" autocomplete="off">
					    	<span id="opcion3"></span> 
					    	Empleos
							</label>
						</div>
					</div>

					<div class="col-xs-12 col-sm-12 col-md-6">
   						
    					<div class="form-group">
		                	{{ Form::label('categoria', '* Seleccione categoría:') }} 
		            		
								<div class="input-group">
			                        <select class="form-control" name="categoria" id="categoria" placeholder="" required>
			                            <option value="">- Categorías -</option>
			                        </select>
			                       
									<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
								</div>
							</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6">
   						<div class="form-group">
		                	{{ Form::label('subcategoria', '* Seleccione subcategoría:') }} 
		            		
							<div class="input-group">
		                        <select class="form-control" name="subcategoria" id="subcategoria" placeholder="" required>
		                            <option value="">- Subcategorías -</option>
		                        </select>
		                       
								<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-4 col-md-4">
   						<div class="form-group">
		                	{{ Form::label('preguntas', '* ¿Qué deseas hacer?') }} 
		            		
							<div class="input-group">
		                        <select class="form-control" name="opcion" id="opcion_seccion" placeholder="" required>
		                            <option value="">- Selecciona -</option>
		                        </select>
		                       
								<span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
							</div>
						</div>
					</div>

				</div><!--fin row2-->
			</div><!--fin cabeza-->				
			
			<input id="oculto" type="hidden" name="seccion_id" value="">
			

			<div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-4 col-md-4">
				 <button type="submit" class="btn btn-primary col-xs-12 btn-success" data-loading-text="Enviando..." id="">
 			 		 SIGUIENTE PASO <i class="glyphicon glyphicon-menu-right"></i>
				</button>
				<a href="{{ URL::previous() }}" class="btn btn-danger col-xs-12 boton-cancelar">
        		<i class="glyphicon glyphicon-remove-circle">
        		</i>
        			CANCELAR
      			</a>
			</div>
	</div><!--fin row-->
	{{Form::close()}}


</div><!--fin contenedor-interno-->

@stop