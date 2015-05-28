<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
    <div class="noefecto">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#desplegable-admin">

            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
    </div>
</div>
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse navbar-left" id="desplegable-admin">
    <ul class="nav navbar-nav main-menu-admin" id="main-menu">
        <li title="Vista general de administrador" class="{{ $current['administracion']}}">
            <a href="{{ route('administracion') }}">
                <span class="icon-user-3"></span>
                    GENERAL
            </a>
        </li>
        <li title="Tareas administrador" class="{{ $current['tareas'] }}">
            <a href="{{ route('admin.pendientes') }}" >
                <span class="glyphicon glyphicon-time"></span> 
                    TAREAS
            </a>
        </li>
        
       
                        
        <li title="Mensajes" class="{{ $current['mismensajes']}}">
            <a href="{{ route('mismensajes') }}">
                <span  class="icon-envelope-2"></span> 
                    MENSAJES
            </a>
        </li>
        @if (Auth::check())
            @if(is_super()) 
                <li title="Gestión de anuncios">
                    <a href="{{ route('super.anuncios') }}">
                        <span  class="icon-pencil-2"></span> 
                            ANUNCIOS
                    </a>
                </li>
                 <li title="Gestión de usuarios">
                    <a href="{{ route('super.usuarios') }}">
                        <span  class="icon-users"></span> 
                            USUARIOS
                    </a>
                </li>

                <li title="Equipo de administradores">
                    <a href="{{ route('lista.admins') }}">
                        <span  class="icon-accessibility"></span> 
                            ADMINISTRADORES
                    </a>
                </li>


            @endif
        @endif
        
        @if (Auth::check())
            @if(Auth::user()->rol_id==2) 
                <li title="Equipo de administradores">
                    <a href="{{ route('lista.administradores') }}">
                        <span  class="icon-accessibility"></span> 
                            EQUIPO
                    </a>
                </li>
            @endif
        @endif
    </ul>
</div><!-- fin .navbar-collapse -->