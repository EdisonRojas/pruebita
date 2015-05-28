@extends('layout')
@section('contenido')

<div class="contenedor-interno">		

	<div  class="alert alert-info col-xs-12 text-center">
		<p>Hola {{ $usuario->nombres }} por favor revisa tu correo electrónico y <strong>activa</strong> tu cuenta de Clasificados Loja .</p>
	</div>	
	
	<p class="col-xs-12 texto-centrado">Te hemos enviado un mensaje al correo electrónico {{ $usuario->correo }}, estas a un solo paso de utilizar completamente
		el sistema de Clasificados Loja.</p>
	<p class="col-xs-12 texto-centrado">Si tu no has recibido el correo de confirmación, por favor revisa en spam.</p>
	
	
	
	
	
       
</div>
@stop
