<nav class="navbar-default navbar-static-side">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                    <img alt="image" class="img-circle" src="{{ asset(Auth::user()->image) }}">
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> 
                            <span class="block m-t-xs"> 
                                <strong class="font-bold">{{ Auth::user()->name }}</strong>
                            </span> 
                            <span class="text-muted text-xs block">{{ Auth::user()->rol->name }} <b class="caret"></b></span> 
                        </span> 
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('user.show.profile', Auth::user()->id) }}">Perfil</a></li>
                        @if(!empty(Auth::user()->multiroles))
                            <li><a href="{{ route('user.switch.roles', Auth::user()->id) }}">Cambiar a {{ Auth::user()->MultirolesName }}</a></li>
                        @endif
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                Salir
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">

                </div>
            </li>

            <li><a href="{{ route('sumary') }}"><i class="fa fa-home"></i> <span class="nav-label">Inicio</span></a></li>

            @roles('Coordinador,Mentor,Voluntario,Alumno')
                <li><a href="{{ route('user.show.profile', Auth::user()->id) }}"><i class="fa fa-address-card"></i> <span class="nav-label">Mis Datos</span></a></li>
            @endroles

            @roles('Administrador')
                <li><a href="{{ route('campus.index') }}"><i class="fa fa-building-o"></i> <span class="nav-label">Sedes</span></a></li>
                <li><a href="{{ route('period.index') }}"><i class="fa fa-calendar"></i> <span class="nav-label">Periodos</span></a></li>
                <li><a href="{{ route('school-workshop.index') }}"><i class="fa fa-book"></i> <span class="nav-label">Talleres</span></a></li>
                <li><a href="{{ route('postulation.index') }}"><i class="fa fa-list-alt"></i> <span class="nav-label">Postulaciones</span></a></li>
                <li><a href="{{ route('survey.index') }}"><i class="fa fa-list-ul"></i> <span class="nav-label">Encuestas</span></a></li>
                <li><a href="{{ route('questionary.index') }}"><i class="fa fa-quora"></i> <span class="nav-label">Cuestionarios</span></a></li>
            @endroles
            
            @roles('Administrador,Coordinador')
                <li><a href="{{ route('request.index') }}"><i class="fa fa-paper-plane-o"></i> <span class="nav-label">Solicitudes</span></a></li>
            @endroles

            @roles('Alumno')
                <li><a href="{{ route('request.postulation') }}"><i class="fa fa-flask"></i> <span class="nav-label">Postulaciones</span></a></li>
            @endroles

            <li><a href="{{ route('grade.index') }}"><i class="fa fa-flask"></i> <span class="nav-label">Cursos</span></a></li>

            @roles('Administrador,Coordinador,Mentor')
                <li>
                    <a href="{{ route('hour.index') }}">
                        <i class="fa fa-clock-o"></i> 
                        <span class="nav-label">Coordinación</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse" style="height: 0px;">
                        @roles('Administrador')
                            <li><a href="{{ route('task.index') }}">Tareas</a></li>
                        @endroles
                        @roles('Administrador,Coordinador')
                            <li><a href="{{ route('hour.index') }}">Horas</a></li>
                            <li><a href="{{ route('hour.distribution') }}">Distribución</a></li>
                        @endroles
                        @roles('Mentor')
                            <li><a href="{{ route('task.asignacion') }}">Tareas</a></li>
                        @endroles
                    </ul>
                </li>
                @roles('Administrador')
                <li>
                    <a href="{{ route('statistics.show.asistencia') }}">
                        <i class="fa fa-bar-chart"></i> 
                        <span class="nav-label">Estadísticas</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse" style="height: 0px;">
                        <li><a href="{{ route('statistics.show.asistencia') }}">Asistencia</a></li>
                        <li><a href="{{ route('statistics.show.postulacion') }}">Postulaciones</a></li>
                    </ul>
                </li>
                @endroles
            @endroles

            @roles('Administrador,Coordinador,Mentor')
                <li>
                    <a href="{{ route('parameter.index') }}">
                        <i class="fa fa-user"></i> 
                        <span class="nav-label">Usuarios</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse" style="height: 0px;">
                    @roles('Administrador')
                        <li><a href="{{ route('user.list', 2) }}">Coordinadores</a></li>
                        <li><a href="{{ route('user.list', 6) }}">Asesores</a></li>
                    @endroles
                    @roles('Administrador,Coordinador')
                        <li><a href="{{ route('user.list', 3) }}">Mentores</a></li>
                    @endroles
                        <li><a href="{{ route('user.list', 5) }}">Mediadores</a></li>
                        <li><a href="{{ route('user.search', 4) }}">Alumnos</a></li>
                    </ul>
                </li>
            @endroles

            @roles('Administrador,Coordinador')
                <li><a href="{{ route('certificate.index') }}"><i class="fa fa-certificate"></i> <span class="nav-label">Certificados</span></a></li>
            @endroles

            @roles('Administrador')
                <li><a href="{{ route('document.index') }}"><i class="fa fa-file-text-o"></i> <span class="nav-label">Documentos</span></a></li>
                <li>
                    <a href="{{ route('parameter.index') }}">
                        <i class="fa fa-align-center"></i> 
                        <span class="nav-label">Parámetros</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse" style="height: 0px;">
                        <li><a href="{{ route('params.filter', 'email') }}">Correos</a></li>
                        <li><a href="{{ route('params.filter', 'text') }}">Textos</a></li>
                        <li><a href="{{ route('params.filter', 'permission') }}">Permisos</a></li>
                        <li><a href="{{ route('course.scores') }}">Puntajes</a></li>
                        <li><a href="{{ route('course.weighings') }}">Ponderaciones</a></li>
                    </ul>
                </li>
            @endroles
            @roles('Administrador,Mentor,Asesor')
                <li><a href="{{ route('video.index') }}"><i class="fa fa-video-camera"></i> <span class="nav-label">Videos</span></a></li>
            @endroles

            <li><a href="{{ route('help.index') }}"><i class="fa fa-question-circle"></i> <span class="nav-label">Ayuda</span></a></li>
        </ul>

    </div>
</nav>
