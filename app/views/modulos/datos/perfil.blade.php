@extends('layout')
@section('contenido')

<div class="contenedor-interno">
	<div class="centrar-div">
		<h2>Perfil y cuenta de usuario</h2>
	</div>
    <div class="row profile">
    	@if (Session::has('cambio_password'))
         	<p class="alert alert-success">{{ Session::get('cambio_password') }}</p>
                    
        @endif
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					@if($usuario->foto=="")
					 	<img src="{{ asset('assets/images/user2.jpg')}}" class="img-responsive" alt="">
					@else
						<img src="{{ asset($usuario->foto) }}" class="img-responsive" alt="">
					@endif
				</div>
				
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						{{$usuario->nombres}}
					</div>
					<div class="profile-usertitle-genero">
						{{$usuario->genero_title}}
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					<a href="{{ route('edicionfoto', $usuario->slug) }}" type="button" class="btn btn-success btn-sm" id="boton-foto-perfil">Cambiar foto</a>


					<!--button type="button" class="btn btn-danger btn-sm">Message</button-->
				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav" id="menu-perfil">
						<li>
							<a href="">
							<i class="glyphicon glyphicon-user"></i>
							Datos generales </a>
						</li>
						<li>
							<a href="">
							<i class="glyphicon glyphicon-cog"></i>
							Mi cuenta </a>
						</li>
						<li>
							<a href="">
							<i class="glyphicon glyphicon-ok"></i>
							Deseo ser administrador </a>
						</li>
						
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
            <div id="contenido-perfil">
            	
            	
        		

            	<div class="tab">
            		
            		@include('modulos.datos.segmentos.datosgenerales')
            	</div>

            	<div class="tab">
            		
            		@include('modulos.datos.segmentos.datoscuenta')
            	</div>
            	@if($usuario->rol_id==1)
	            	<div class="tab">

	            		@include('modulos.datos.segmentos.postularparaadmin')

	            	</div>
	            @elseif($usuario->rol_id==2)
	            	<div class="tab">

	            		<p>Ya eres parte del equipo de administradores de miradita</p>

	            	</div>
			   	@endif
            </div>
		</div>

	</div>

</div>

















@stop