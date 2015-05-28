<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     @yield('metas')  
    <title>AnunciosLojaFinal</title>
	 
	<!-- ##### Estilos css de la app ####--> 
	{{ HTML::style('assets/css/bootstrap.min.css') }}
    {{ HTML::style('assets/css/iconclasificados.css') }}
     {{ HTML::style('assets/css/flexslider.css') }}
    {{ HTML::style('assets/css/basico.css') }}
    
    {{ HTML::style('assets/css/fileinput.min.css') }}
    {{ HTML::style('assets/css/anuncio.css') }}
    {{ HTML::style('assets/css/admin.css') }}
    
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- Inicio del header donde se encuentra incluido el menú responsive -->
    <header>
    	<!--inicio zona navbar-->
    	<nav class="navbar navbar-fixed-top" role= "navigation">
            <div class="container-fluid">
            	<div class="row menu-superior">
            		
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 centrar">
   						<p class="navbar-brand" href="#">LOGO</p>
            		</div>
                    
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="navbar-form navbar-right botonera-superior">
                            @include('appanuncia.botonerasuperior')
                        </div><!--Fin navbar-right-->   
                    </div>
            	</div><!--Fin row primera fila del menu-->		
           	    

                <?php 
                    $vista= Request::path();
                    $current=array
                                (
                        'main'=>'',
                        'clasificados'=>'',
                        'servicios'=>'',
                        'empleos'=>'',
                        'ingreso'=>'',
                        'crearanuncio'=>'',
                        'misanuncios'=>'',
                        'mismensajes'=>'',
                        'administracion'=>'',
                        'tareas'=>''
                        );

                    if($vista=='/'|| $vista=='main'){
                        $current['main']='active';
                    }else if($vista=='clasificados'){
                        $current['clasificados']='active';
                    }else if($vista=='servicios'){
                        $current['servicios']='active';
                    }else if($vista=='empleos'){
                        $current['empleos']='active';
                    }else if($vista=='ingreso'){
                        $current['ingreso']='active';
                    }else if($vista=='crear-anuncio'){
                        $current['crearanuncio']='active';
                    }else if($vista=='misanuncios'){
                        $current['misanuncios']='active';
                    }else if($vista=='ver/mensajes'){
                        $current['mismensajes']='active';
                    }else if($vista=='administracion'){
                        $current['administracion']='active';
                    }else if($vista=='tareas'){
                        $current['tareas']='active';
                    }
                ?>    

               
                
                 <!--menu de navegacion del usuario(navagacion simple)-->
                <div class="row menu-inferior">
                    @include('appanuncia.navusuario') 
                </div>
                
                @if(Auth::check())
                    @if(is_nav_avanzada())
                         <!--menu de navegacion del administrador-navegacion avanzada-->
                        <div class="row menu-inferior-admin">
                            @include('appanuncia.navadmin')
                            
                        </div>
                    @endif       
                @endif            
                        
                
                       
                
            </div><!-- fin .container-fluid -->
        </nav><!--fin .navbar-->
    </header><!-- Fin del header y menú responsive -->


    @if(Auth::check())
        @if(!is_nav_avanzada())

            <section class="contenido container">
        @else

            <section class="contenido-nav-avanzado container">
        @endif

    @else
        <section class="contenido container">

    @endif

  	
    @section('contenido')
          
    @show
  	    @include('modales.ingresocongoogle')
        @include('modales.ingresocontwitter')
            @include('modales.ingresoconfacebook')   
     
        
  	</section>	
		
    <!-- ##### Archivos js de la app ####-->    
    <!-- jQuery (necesario para los plugins de javaScript que usa Bootstrap) -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script-->
    <!-- Archivos js de Bootstrap  -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/registro.js') }}"></script>
    <script src="{{ asset('assets/js/basico.js') }}"></script>
    <script src="{{ asset('assets/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/fileinput_locale_es.js') }}"></script>

    <script src="{{ asset('assets/js/botones.js') }}"></script>

    <script src="{{ asset('assets/js/anunciofotos.js') }}"></script>
    <script src="{{ asset('assets/js/anuncio.js') }}"></script>        
     <script src="{{ asset('assets/js/jquery.flexslider-min.js') }}"></script>

    <!--script src="{{ asset('assets/js/admin.js') }}"></script-->

    <!--Presentar ventana modal siempre y cuando exista la session flash ingreso_social-->
    @if (Session::has('ingreso_social'))
        @if(Session::get('ingreso_social')=='facebook')
            <script src="{{ asset('assets/js/modales/modalfacebook.js') }}"></script>
        @elseif(Session::get('ingreso_social')=='google')
            <script src="{{ asset('assets/js/modales/modalgoogle.js') }}"></script>
        @elseif(Session::get('ingreso_social')=='twitter')
            <script src="{{ asset('assets/js/modales/modaltwitter.js') }}"></script>
        @endif
    @endif 
    
    <!-- Archivos js ventanas modales  -->
    
    @yield('scripts')  

    <script type="text/javascript">
    </script> 
   
    <section class="botonera-inferior container">
        <!--llamar a appanuncia.botonerainferior.blade.php-->
    </section>    

    <footer >
        <p>Pie de página:</p>
    </footer>
    <!-- Place in the <head>, after the three links -->
    <script type="text/javascript" charset="utf-8">
          $(window).load(function() {
            $('.flexslider').flexslider();
          });
    </script>

    @include('modales.modalnologin')
  </body>
</html>