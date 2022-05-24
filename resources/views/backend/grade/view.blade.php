@extends('layouts.backend')

@section('content')
    <div class="row breadcrumb-container">
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('sumary') }}">Inicio</a>
            </li>
            <li>
                <a href="{{ route('grade.index') }}">Mis Cursos</a>
            </li>
            <li class="active">
                <strong>{{ $grade->school_workshop->name }}</strong>
            </li>
        </ol>
    </div>
    <div id="view-course" class="row">
        <div class="col-md-12">
            @if(session()->has('message'))
                <div class="alert alert-info alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    {{ session('message') }}
                </div>
            @endif
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">Inicio</a></li>
                    <li><a data-toggle="tab" href="#tab-2" aria-expanded="false">Sesiones</a></li>
                    <li><a data-toggle="tab" href="#tab-3" aria-expanded="false">Materiales</a></li>
                    <li><a data-toggle="tab" id="announcement" name="{{$grade->id}}" href="#tab-4" aria-expanded="false">Anuncios</a></li>
                    <li><a data-toggle="tab" id="consult" name="{{$grade->id}}" href="#tab-5" aria-expanded="false">Consultas</a></li>
                @roles("Alumno")
                    <li><a data-toggle="tab" href="#tab-6" aria-expanded="false">Asistencia</a></li>
                @else
                    <li><a data-toggle="tab" id="notes" href="#tab-6" aria-expanded="false">Notas y Asistencia</a></li>
                    <li><a data-toggle="tab" id="consult" name="{{$grade->id}}" href="#tab-7" aria-expanded="false">Lista de Curso</a>
                @endroles
                    <li><a data-toggle="tab" id="hitos" href="#tab-8" aria-expanded="false">Hitos</a>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <h2><strong>Bienvenidos al curso "{{ $grade->school_workshop->name }}" del {{ $grade->period->name }}</strong></h2>

                            <h3>Información del Curso</h3>
                            <div class="col-md-12 margin-into">
                                <ul class="sortable-list connectList agile-list ui-sortable">
                                    <li class="warning-element ui-sortable-handle col-md-6">
                                        Capacidad
                                        <div class="agile-detail">
                                            <i class="fa fa-briefcase"></i> {{ $grade->capacity }}
                                        </div>
                                    </li>
                                    <li class="success-element ui-sortable-handle col-md-6">
                                        Tipo
                                        <div class="agile-detail">
                                            <i class="fa fa-cube"></i> {{ $grade->type }}
                                        </div>
                                    </li>
                                    <li class="info-element ui-sortable-handle col-md-6">
                                        Fecha de inicio
                                        <div class="agile-detail">
                                            <i class="fa fa-clock-o"></i> {{ $grade->start }}
                                        </div>
                                    </li>
                                    <li class="danger-element ui-sortable-handle col-md-6">
                                        Fecha de Término
                                        <div class="agile-detail">
                                            <i class="fa fa-clock-o"></i> {{ $grade->end }}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <h3>Mentores</h3>
                                @foreach($grade->division_users as $collaborator)
                                    @if($collaborator->rol == 3)
                                        <div class="col-md-6">
                                            <div class="profile-image">
                                                <img src="{{ asset($collaborator->user->image) }}"
                                                     class="img-circle circle-border m-b-md" alt="profile">
                                            </div>
                                            <div class="profile-info">
                                                <div class="">
                                                    <div>
                                                        <h2 class="no-margins">{{ $collaborator->user->name }}</h2>
                                                        <h4>{{ $collaborator->user->rol->name }}</h4>
                                                        <small>
                                                            {{ $collaborator->user->email }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <h3>Ayudantes</h3>
                                @foreach($grade->division_users as $collaborator)
                                    @if($collaborator->rol == 5)
                                        <div class="col-md-6">
                                            <div class="profile-image">
                                                <img src="{{ asset($collaborator->user->image) }}"
                                                     class="img-circle circle-border m-b-md" alt="profile">
                                            </div>
                                            <div class="profile-info">
                                                <div class="">
                                                    <div>
                                                        <h2 class="no-margins">{{ $collaborator->user->name }}</h2>
                                                        <h4>{{ $collaborator->user->rol->name }}</h4>
                                                        <small>
                                                            {{ $collaborator->user->email }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <strong>Este curso cuenta con un total de {{ $grade->block_grades->count() }} sesiones.</strong>
                            <p>A continuación tiene el cronograma de todo el taller.</p>
                            <div class="ibox-content inspinia-timeline">
                                @foreach($grade->block_grades as $block_grade)
                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-xs-2 date">
                                                <i>Sesión {{ $loop->iteration }}</i>
                                                <small class="text-navy">{{ $block_grade->date }}</small>
                                                <br>
                                                {{ $block_grade->hour }}
                                                <br>
                                                <b class="text-warning">Sala {{ $block_grade->room->number or 'sin asignar' }}</b>
                                            </div>
                                            <div class="col-xs-8 content no-top-border">
                                                <div class="col-xs-8">
                                                    <p class="m-b-xs">
                                                        <strong>Evaluación:</strong>
                                                        {{ $block_grade->block->evaluation_name }}
                                                        ({{ $block_grade->block->evaluation_type }})
                                                    </p>
                                                    <p>
                                                        <strong>Detalles: </strong>
                                                        {{ $block_grade->block->description }}
                                                    </p>
                                                    <p>
                                                        <strong>Comentarios: </strong>
                                                        {{ $block_grade->comment }}
                                                    </p>
                                                    
                                                </div>
                                                <div class="col-xs-4">
                                                    @if (empty($block_grade->block->questionnaire_id))
                                                        <p><strong>Encuesta: </strong></p>
                                                    @else
                                                        <p>
                                                            <strong>Encuesta: </strong>
                                                            {{ empty($block_grade->block->questionnaire_id) ? '' : $questionnaires[$block_grade->block->questionnaire_id] }}
                                                        </p>
                                                        @roles("Alumno")
                                                            <a href="{{ route('grade.questionary.show', [$block_grade->block->questionnaire_id, $block_grade->id]) }}" title="Contestar" class="btn btn-primary">
                                                                Contestar
                                                            </a>
                                                        @else
                                                            <a href="{{ route('grade.questionary.summary', [$block_grade->block->questionnaire_id, $block_grade->grade->id]) }}" title="Contestar" class="btn btn-primary">
                                                                Ver respuestas
                                                            </a>
                                                        @endroles
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body">
                            <strong>Materiales disponibles descarga</strong>
                            <p>A continuación tiene los archivos de cada sesión para su descarga.</p>

                            <div class="ibox-content inspinia-timeline">
                                @foreach($grade->block_grades as $block_grade)
                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-xs-2 date">
                                                <i>Sesión {{ $loop->iteration }}</i>
                                                <small class="text-navy">{{ $block_grade->date }}</small>
                                                <br>
                                                {{ $block_grade->hour }}
                                                <br>
                                                <b class="text-warning">Sala {{ $block_grade->room->number or 'sin asignar' }}</b>
                                            </div>
                                            <div class="col-xs-6 content no-top-border">
                                                <p class="m-b-xs"><strong>{{ $block_grade->evaluation_name }}</strong></p>

                                                <ul class="list-unstyled file-list">
                                                @forelse($block_grade->block->materials as $material)
                                                    <li>
                                                        @if ($material->general)
                                                            <b><a href="{{ route('user.material.download', $material->id) }}" title="Descargar Material"><i class="fa {{ $material->icon }}"></i> {{ $material->file_name }}</a></b>
                                                        @elseif($block_grade->active)
                                                            <b><a href="{{ route('user.material.download', $material->id) }}" title="Descargar Material"><i class="fa {{ $material->icon }}"></i> {{ $material->file_name }}</a></b>
                                                        @else
                                                            <span title="Material no disponible por el momento"><i class="fa {{ $material->icon }}"></i> {{ $material->file_name }}</span>
                                                        @endif
                                                    </li>
                                                @empty
                                                    <li>
                                                        <p>Esta sesión no cuenta con materiales.</p>
                                                    </li>
                                                @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane">
                        <div class="panel-body">
                            <strong>Anuncios del Mentor</strong>
                            <p>Anuncios realizados por el mentor y mediadores para informar a los alumnos.</p>

                            <div class="table-responsive">
                                @roles('Mentor,Voluntario')
                                @unless($grade->archived)
                                    <a title="Crear nuevo tema" aria-hidden="true" href="{{ route('post.create.forum',"notice") }}" class="btn btn-primary btn-md">Crear nuevo tema</a>
                                @endunless
                                @endroles
                                <div class="col-lg-12">
                                    <div id="anuncios" class="wrapper wrapper-content animated fadeInRight">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tab-5" class="tab-pane">
                        <div class="panel-body">
                            <strong>Consultas de los Alumnos</strong>
                            <p>Anuncios que pueden realizar los alumnos, tanto relacionados con el curso como de otros
                                temas.</p>
                            <div class="table-responsive">
                                @unless($grade->archived)
                                    @if(Auth::user()->if_mute)
                                        <a title="{{ Auth::user()->text_mute }}" aria-hidden="true" href="#" class="btn btn-primary btn-md" disabled>Crear nuevo tema</a>
                                    @else
                                        @roles('Alumno')
                                        <a title="Crear nuevo tema" aria-hidden="true" href="{{ route('post.create.forum',"consult") }}" class="btn btn-primary btn-md">Crear nuevo tema</a>
                                        @endroles
                                    @endif
                                @endunless
                                <div class="col-lg-12">
                                    <div id="consultas" class="wrapper wrapper-content animated fadeInRight">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @roles("Alumno")
                    <div id="tab-6" class="tab-pane">
                        <div class="panel-body">
                            <strong>Asistencia</strong>
                            
                            <div class="ibox-content inspinia-timeline">
                                @forelse($block_grade_users as $block_grade_user)
                                    <div class="timeline-item">
                                        <div class="row">
                                            <div class="col-xs-2 date">
                                                <i>Sesión {{ $loop->iteration }}</i>
                                                <small class="text-navy">{{ $block_grade_user->block_grade->date }}</small>
                                            </div>
                                            <div class="col-xs-10 content no-top-border">
                                                <p class="m-b-xs">
                                                    <strong>Estado:</strong>
                                                    @if (is_null($block_grade_user->presence))
                                                        {{ "No ingresada" }}
                                                    @else
                                                        {{ $block_grade_user->presence == 1 ? "Presente" : 'Ausente' }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No hay registros de asistencia por el momento</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @else
                    <div id="tab-6" class="tab-pane">
                        <div class="panel-body">
                            @unless($grade->archived)
                                <button id="save_all" class="btn btn-success btn-sm" title="Guardar cambios">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar cambios
                                </button>
                            @endunless
                            @roles("Administrador,Coordinador,Mentor")
                            <a href="{{ route('back.download.list', $grade->id) }}" class="btn btn-info btn-sm" title="Descargar lista" target="_blank">
                                <i class="fa fa-download" aria-hidden="true"></i> Descargar lista
                            </a>
                            @endroles
                            <br><br>

                            <div class="dataTables_wrapper form-inline dt-bootstrap table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                    <thead>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            @foreach($grade->block_grades as $block_grade)
                                                <th>Sesión {{ $loop->iteration }}</th>
                                            @endforeach
                                            <th>Bitácora</th>
                                            @if($grade->archived)
                                                <th>Resultado</th>
                                            @else
                                                <th>Foro</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($grade->division_users as $division_user)
                                        @if($division_user->rol == 4)
                                        <tr>
                                            <form class="form-block-grade-user" method="POST" action="{{ route('block.grade.user') }}" accept-charset="UTF-8">
                                                <input type="hidden" name="division_user" value="{{ $division_user->id }}">
                                                {{ csrf_field() }}
                                                <td>Alumno</td>
                                                <td>{{ $division_user->user->firstname }}</td>
                                                <td>{{ $division_user->user->lastname }}</td>
                                                @php $contador = 0; @endphp
                                                @foreach($grade->block_grades as $block_grade)
                                                    @foreach($block_grade->block_grade_users as $block_grade_user)
                                                        @if ($block_grade_user->block_grade_id == $block_grade->id && $block_grade_user->division_user_id == $division_user->id)
                                                            <td class="score-presence">
                                                                <input type="hidden" name="block_grades[]" value="{{ $block_grade->id }}">
                                                                <input type="checkbox" name="asistencias[{{ $contador }}]" placeholder="Asistencia" value="1" {{ $block_grade_user->presence == '1' ? 'checked' : '' }}>
                                                                <input type="number" min="0" max="100" name="notas[]" class="form-control" placeholder="Nota" value="{{ $block_grade_user->score or '' }}">
                                                            </td>
                                                            @php $contador++; @endphp
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                                <td><textarea name="binnacle" placeholder="Bitacora">{{ $division_user->binnacle or '' }}</textarea></td>
                                            </form>
                                            @if($grade->archived)
                                                <th>{{ $division_user->post_result or '-' }}</th>
                                            @else
                                                <td>
                                                    <div id="dropdownMute" class="dropdown">
                                                        <button 
                                                            class="btn {{ $division_user->user->if_mute ? 'btn-warning' : 'btn-info' }} btn-sm dropdown-toggle" 
                                                            type="button" id="dropdownDownloadGrades" 
                                                            data-toggle="dropdown" 
                                                            aria-haspopup="true" aria-expanded="true" 
                                                            title="{{ $division_user->user->text_mute }}"
                                                        >
                                                            <i class="fa fa-microphone-slash" aria-hidden="true"></i> Mute
                                                            <span class="caret"></span>
                                                        </button>
                                                        @roles("Administrador,Coordinador,Mentor")
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownDownloadGrades">
                                                            <li><a href="{{ route('user.mute', [$division_user->user->id, 1]) }}">1 hora</a></li>
                                                            <li><a href="{{ route('user.mute', [$division_user->user->id, 24]) }}">1 día</a></li>
                                                            <li><a href="{{ route('user.mute', [$division_user->user->id, 168]) }}">1 semana</a></li>
                                                            <li role="separator" class="divider"></li>
                                                            <li><a href="{{ route('user.mute', [$division_user->user->id, 0]) }}">Quitar Mute</a></li>
                                                        </ul>
                                                        @endroles
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                        @elseif($division_user->rol == 3)
                                        <tr>
                                            <form class="form-block-grade-user" method="POST" action="{{ route('block.grade.user') }}" accept-charset="UTF-8">
                                                <input type="hidden" name="division_user" value="{{ $division_user->id }}">
                                                {{ csrf_field() }}
                                                <td><b>Mentor</b></td>
                                                <td><b>{{ $division_user->user->firstname }}</b></td>
                                                <td><b>{{ $division_user->user->lastname }}</b></td>
                                                @php $contador = 0; @endphp
                                                @foreach($grade->block_grades as $block_grade)
                                                    @foreach($block_grade->block_grade_users as $block_grade_user)
                                                        @if ($block_grade_user->block_grade_id == $block_grade->id && $block_grade_user->division_user_id == $division_user->id)
                                                            <td class="score-presence">
                                                                <input type="hidden" name="block_grades[]" value="{{ $block_grade->id }}">
                                                                <input type="checkbox" name="asistencias[{{ $contador }}]" placeholder="Asistencia" value="1" {{ $block_grade_user->presence == '1' ? 'checked' : '' }}>
                                                                <input type="hidden" name="notas[]" value="0">
                                                            </td>
                                                            @php $contador++; @endphp
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </form>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @elseif($division_user->rol == 5)
                                        <tr>
                                            <form class="form-block-grade-user" method="POST" action="{{ route('block.grade.user') }}" accept-charset="UTF-8">
                                                <input type="hidden" name="division_user" value="{{ $division_user->id }}">
                                                {{ csrf_field() }}
                                                <td><b>Voluntario</b></td>
                                                <td><b>{{ $division_user->user->firstname }}</b></td>
                                                <td><b>{{ $division_user->user->lastname }}</b></td>
                                                @php $contador = 0; @endphp
                                                @foreach($grade->block_grades as $block_grade)
                                                    @foreach($block_grade->block_grade_users as $block_grade_user)
                                                        @if ($block_grade_user->block_grade_id == $block_grade->id && $block_grade_user->division_user_id == $division_user->id)
                                                            <td class="score-presence">
                                                                <input type="hidden" name="block_grades[]" value="{{ $block_grade->id }}">
                                                                <input type="checkbox" name="asistencias[{{ $contador }}]" placeholder="Asistencia" value="1" {{ $block_grade_user->presence == '1' ? 'checked' : '' }}>
                                                                <input type="hidden" name="notas[]" value="0">
                                                            </td>
                                                            @php $contador++; @endphp
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </form>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                @endroles


                @roles("Administrador,Coordinador,Mentor")
                    <div id="tab-7" class="tab-pane">
                        <div class="panel-body">

                            <div class="dataTadbles_wrapper forsm-inline dt-bootstrasp table-resposnsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Correo</th>
                                            <th>Teléfono</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($division_users as $division_user)
                                        @if($division_user->rol == 4)
                                            <tr>
                                                <td>{{ $division_user->user->firstname }}</td>
                                                <td>{{ $division_user->user->lastname }}</td>
                                                <td>{{ $division_user->user->email }}</td>
                                                <td>{{ $division_user->user->phone_number }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endroles

                <div id="tab-8" class="tab-pane">
                    <div class="panel-body">
                        <div id='calendar'></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @if(!$grade->archived)
        @roles("Mentor")
        <div id="create-milestone" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Crear Hito</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('milestone.store') }}" id="form-create-milestone" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" id="grade_id" name="grade_id" value="{{ $grade->id}}">
                            <input type="hidden" id="datetime" name="datetime" value="">

                            <div class="form-group">
                                <label for="type" class="col-md-4 control-label">Nombre</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="type" class="col-md-4 control-label">Detalles</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="details" rows="4"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-4 col-md-4">
                                    <input class="btn btn-primary" type="submit" value="Guardar">
                                </div>
                            </div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Volver</button>
                    </div>
                </div>
            </div>
        </div>
        @endroles
    @endif

    <div id="show-milestone" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Detalle Hito</h4>
                </div>
                <div class="modal-body">
                    <p>
                        <strong>Identificador: </strong>
                        <span id="sm-id"></span>
                    </p>
                    <p>
                        <strong>Nombre: </strong>
                        <span id="sm-name"></span>
                    </p>
                    <p>
                        <strong>Detalles: </strong>
                        <span id="sm-details"></span>
                    </p>
                    <p>
                        <strong>Fecha: </strong>
                        <span id="sm-datetime"></span>
                    </p>
                </div>
                <div class="modal-footer">
                    @if(!$grade->archived)
                        @roles("Mentor")
                            <form method="POST" action="{{ route('milestone.store') }}" id="form-delete-milestone" data-id="" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger" title="Eliminar Hito">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    Eliminar Hito
                                </button>
                            </form>
                        @endroles
                    @endif
                    <button type="button" class="btn btn-default" data-dismiss="modal">Volver</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        
        function add_milestone(date) {
            $('#datetime').val(date);

            $('#create-milestone').modal('show');
        }

        function view_milestone(id, name, details, datetime) {
            $('#sm-id').text(id);
            $('#sm-name').text(name);
            $('#sm-details').text(details);
            $('#sm-datetime').text(datetime);

            $('#form-delete-milestone').data("id", id);
            $('#show-milestone').modal('show');
        }

        function load_calendar() {
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var calendar = $('#calendar');
            
            calendar.fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                buttonText: {
                    today: 'hoy',
                    month: 'mes',
                    week: 'semana',
                    day: 'dia',
                    list: 'lista'
                },
                lang: 'es',
                @if(!$grade->archived)
                    @roles("Mentor")
                        selectable: true,
                        dayClick: function(date, jsEvent, view) {
                            add_milestone(date.format());
                        },
                    @endroles
                @endif
                eventClick: function(date, jsEvent, view) {
                    view_milestone(date.id, date.title, date.details, date.start.format('MM/DD/YYYY h:mm'))
                },
                events: [
                    @foreach($milestones as $milestone)
                    {
                        id: {{ $milestone->id }},
                        title: '{{ $milestone->name }}',
                        details: '{{ $milestone->details }}',
                        grade: '{{ $milestone->grade_id }}',
                        start: new Date('{{ $milestone->datetime }}'),
                        allDay: false
                    },
                    @endforeach
                ]
            });
        }

        $(document).ready(function () {
            @isset($select_view)
                @if($select_view == 'consulta')
                    $('#consult').click();
                @elseif($select_view == 'anuncio')
                    $('#announcement').click();
                @elseif($select_view == 'notas')
                    $('#notes').click();
                @endif
            @endisset
            
            @if($grade->archived)
                $('input[type=checkbox]').click(function(){
                    return false;
                });
                $(".score-presence input").attr("readonly", true);
                $("textarea").attr("readonly", true);
                $("#dropdownMute .dropdown-menu").css("display", "none");
            @else
                $('#save_all').click(function(){
                    var button = $(this);
                    button.attr('disabled', 'disabled');
                    $('.form-block-grade-user').each(function() {
                        $(this).submit();
                    });

                    setTimeout(function(){ 
                        button.attr('disabled', false); 
                    }, 4000);
                });
            @endif

            $("#tab-6 .html5buttons").hide();
            
            $('#hitos').click(function() {
                setTimeout(load_calendar, 200);
            });


            $('#form-create-milestone').submit(function(e) {
                e.preventDefault();

                var form = $(this);
                var type = form.attr("method");
                var url = form.attr("action");
                var data = form.serialize();
                var modal = $('#create-milestone');
                var calendar = $('#calendar');

                $.ajax({
                    type: type,
                    url: url,
                    data: data,
                    success: function(res) {
                        form.trigger("reset");
                        modal.modal('hide');
                        calendar.fullCalendar('renderEvent', {
                            id: res.milestone.id,
                            title: res.milestone.name,
                            details: res.milestone.details,
                            grade: res.milestone.grade_id,
                            start: res.milestone.datetime,
                            allDay: true
                        });
                    },
                });
            });

            $('#form-delete-milestone').submit(function(e) {
                e.preventDefault();
                
                var form = $(this);
                var type = form.attr("method");
                var id = form.data("id");
                var url = form.attr("action") + "/" + id;
                var data = form.serialize();
                var modal = $('#show-milestone');
                var calendar = $('#calendar');

                $.ajax({
                    type: type,
                    url: url,
                    data: data,
                    success: function(res) {
                        form.trigger("reset");
                        modal.modal('hide');
                        calendar.fullCalendar('removeEvents', id);
                    },
                });
            });
        });
    </script>
@endsection

