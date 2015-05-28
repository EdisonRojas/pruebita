@if (Session::has('cambio_correcto'))
   <p class="alert alert-success">{{ Session::get('cambio_correcto') }}</p>
@endif

<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Información general</h3>
  </div>
  
  <div class="panel-body">
    <div class="row linea-inferior">
      <div class="col-xs-12 col-sm-3">
          {{ Form::label('nombres','Nombre y Apellido:') }}
      </div>
 
      <div class="col-xs-12 col-sm-6">
        <p >  
          {{ $usuario->nombres }}
        </p>
      </div> 
    </div>
    
    <div class="row linea-inferior">
      <div class="col-xs-12 col-sm-3">
          {{ Form::label('genero','Género:') }}
      </div>
        
        <div class="col-xs-12 col-sm-6">
          <p>  
            {{ $usuario->genero_title }}
          </p>
        </div>
        
    </div>
        
    <div class="row linea-inferior">
      <div class="col-xs-12 col-sm-3">
          {{ Form::label('telefono','Teléfono:') }}
      </div>
      <div class="col-xs-12 col-sm-6">
          <p>  
            @if(empty($usuario->telefono))
                    {{ 'Número no asignado' }}
                  @else
                    {{ $usuario->telefono }}
                  @endif
          </p>
      </div>
    </div>
       
     <div class="row linea-inferior">
        <div class="col-xs-12 col-sm-3">
          {{ Form::label('celular','Celular:') }}
        </div>

          
        <div class="col-xs-12 col-sm-6">
          <p>  
            @if(empty($usuario->celular))
                    {{ 'Número no asignado' }}
                  @else
                    {{ $usuario->celular }}
                  @endif
          </p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-12 col-sm-3">
          {{ Form::label('compania','Empresa telefónica:') }}
        </div>
        <div class="col-xs-12 col-sm-6">
          <p>  
            @if(empty($usuario->compania->nombre))
              {{ 'Empresa no asignada' }}
            @else
              {{ Auth::user()->compania->nombre }}
            @endif
          </p>
        </div>
    </div>
  </div><!--fin panel body-->

  <div class="panel-footer">
      <a href="{{ route('ediciondatos', [$usuario->slug]) }}" class="btn btn-sm btn-warning">
        <i class="glyphicon glyphicon-edit">
        </i>
        Modificar datos
      </a>
  </div>
</div>