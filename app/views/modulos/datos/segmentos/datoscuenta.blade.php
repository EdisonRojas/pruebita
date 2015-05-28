
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Información de la cuenta</h3>
  </div>
  
  <div class="panel-body">
    <div class="row linea-inferior">
      <div class="col-xs-12 col-sm-3">
          {{ Form::label('correo','Correo electrónico:') }}
      </div>
 
      <div class="col-xs-12 col-sm-6">
        <p >  
          {{ $usuario->correo }}
        </p>
      </div> 
    </div>
    
    <div class="row linea-inferior">
      <div class="col-xs-12 col-sm-3">
          {{ Form::label('estado','Estado:') }}
      </div>
        
        <div class="col-xs-12 col-sm-6">
          <p>  
            {{ $usuario->estado->estado }}
          </p>
        </div>
        
    </div>
        
    <div class="row linea-inferior">
      <div class="col-xs-12 col-sm-3">
          {{ Form::label('creacion','Usuario desde:') }}
      </div>
      <div class="col-xs-12 col-sm-6">
          <p>  
            {{ $usuario->created_at->format("j-m-Y"); }}
          </p>
      </div>
    </div>
    
  </div><!--fin panel body-->

  <div class="panel-footer">

    <div class="row">
      <div class="col-xs-12 col-sm-4">
        @if(!empty(\Auth::user()->correo))
          <a href="{{ route('edicioncuenta', [$usuario->slug]) }}" class="btn btn-warning btn-sm col-xs-12">
            <i class="glyphicon glyphicon-edit">
            </i>
            Modificar correo
          </a>
        @else
          <a href="{{ route('correotwitter') }}" class="btn btn-success btn-sm col-xs-12">
            <i class="glyphicon glyphicon-edit">
            </i>
            Ingresar correo
          </a>
        @endif
        

      </div>
       @if(!empty(\Auth::user()->correo))
       <div class="col-xs-12 col-sm-4">
       
          <a href="{{ route('cambiarpassword') }}" class="btn btn-info btn-sm col-xs-12">
            <i class="icon-key">
            </i>
            Modificar contraseña
          </a>
      
      </div>
      <div class="col-xs-12 col-sm-4">
          <a href="{{ route('bajacuenta', [$usuario->slug]) }}" data-toggle="tooltip" data-placement="top"  class="btn col-xs-12 btn-danger btn-sm" title="Eliminar la cuenta">
            <i class="glyphicon glyphicon-remove">
            </i>
            Eliminar mi cuenta
          </a>

      </div>
      @endif  
    </div>  
      
  </div>
</div>