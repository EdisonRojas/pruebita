<div class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10">
	<div class="page-header">
        <h4><small class="pull-right">{{count($comentarios)}} comentarios</small> Comentarios </h4>
    </div>
	<ul class="chat">
	@foreach ($comentarios as $comentario)
        <li class="left clearfix">
            <span class="chat-img pull-left">
            @if($comentario->usuario->foto=="")
          		<img src="{{ asset('assets/images/user2.jpg')}}" class="img-circle img-comentario" alt="">
       		@else
       			<img src="{{ asset($comentario->usuario->foto) }}" class="img-circle img-comentario" alt="">
       		@endif		
            </span>
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">{{$comentario->usuario->nombres}}</strong> 
                    <small class="pull-right text-muted">
                        <span class="glyphicon glyphicon-time"></span>{{$comentario->created_at->format('j/m/Y H:i a')}}
                    </small>
                </div>
                <p>
                    {{$comentario->comentario}}
                </p>
               
	            <!--Nueva seccion de respuestas-->
	            	
		        <div class="caja-respuestas col-xs-12">
		            <ul class="respuestas listarespuesta_{{$comentario->id}}">
		              	@foreach ($comentario->respuestas as $respuesta)
				        	<li class="left clearfix">
		                        <div class="cajita-respuesta">
			                        <span class="chat-img pull-left">
							            @if($respuesta->usuario->foto=="")
							          		<img src="{{ asset('assets/images/user2.jpg')}}" class="img-circle img-respuesta" alt="">
							       		@else
							       			<img src="{{ asset($respuesta->usuario->foto) }}" class="img-circle img-respuesta" alt="">
							       		@endif		
							        </span>
			                        <div class="chat-respuesta clearfix">
			                            <div class="header">
			                                <strong class="fuente-nombrecomentario">{{$respuesta->usuario->nombres}}</strong> 
			                                <small class="pull-right text-muted">
			                                    <span class="glyphicon glyphicon-time"></span>{{$respuesta->created_at->format('j/m/Y H:i a')}}
			                                </small>
			                            </div>
			                            <p>
							            	{{$respuesta->respuesta}}
							        	</p>
			                        </div>
		                        </div>
		                    </li>

			        	@endforeach
			        </ul>   
			    </div>			
		        <!--fin seccion de respuestas-->
		        @if(Auth::check())
			 	<div class="cajaresponder_{{$comentario->id}} col-xs-12 ocultisimo">
		          	<div>
						{{ Form::open(array(
							'action'=>'ComentarioController@respuesta',
							'method'=>'POST',
							'role'=>'form',
							'id'=>'formrespuesta_'.$comentario->id,
							'class'=>'formulariorespuestas',
							'novalidate'
							))
						}}	

		                {{ Form::textarea('respuesta',Input::old('respuesta'), array('class'=>'form-control', 'placeholder'=>'Escribe tu respuesta'.$comentario->id.'', 'size' => '1x1')) }}
			                <input id="comentario_id" type="hidden"  name="comentario_id" value={{$comentario->id}} >
						{{Form::input('button', null, 'Enviar respuesta', array('class'=>'btn btn-success col-xs-12 col-sm-3 enviarrespuesta', 'data-title'=>$comentario->id))}} 
			            {{ Form::close()}}
			            	{{Form::input('button', 'cancelar', 'Cancelar', array('class'=>'btn btn-danger col-xs-12 col-sm-3 cancelarespuesta'))}} 
		            </div>
		        </div>
		        @endif
		        @if(Auth::check())

		    	<div class="col-xs-12">
		            <a href="" data-title="{{$comentario->id}}" class="btn btn-success btn-xs respuesta pull-right"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>Responder{{$comentario->id}}</a>
			        <div class="respuesta-enviada{{$comentario->id}}">
		            </div>
		        </div>
		        @endif
	   		</div>
        </li>
    @endforeach
    </ul>		
</div>	