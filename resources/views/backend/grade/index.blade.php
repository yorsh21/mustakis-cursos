@extends('layouts.backend')

@section('content')
    @roles('Administrador,Coordinador')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Cursos Abiertos</div>
                    <div class="panel-body">
                        <div class="ibox float-e-margins">
                            <a href="{{ route('grade.create') }}" class="btn btn-success btn-sm" title="Agregar nuevo Curso">
                                <i class="fa fa-plus" aria-hidden="true"></i> Crear Nuevo
                            </a>

                            <div id="dropdownGrades" class="dropdown">
                                @roles("Administrador,Coordinador")
                                <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownDownloadGrades" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" title="Información de Cursos">
                                    <i class="fa fa-filter" aria-hidden="true"></i> Filtro de cursos por período
                                    <span class="caret"></span>
                                </button>
                                @endroles
                                <ul class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownDownloadGrades">
                                    <li><a href="{{ route('grade.index') }}">Todos los abiertos</a></li>
                                    <li><a href="{{ route('grade.archived', 0) }}">Todos los archivados</a></li>
                                    <li role="separator" class="divider"></li>
                                    @foreach ($periods as $item)
                                        <li><a href="{{ route('grade.archived', $item->id) }}">{{ $item->description }}</a></li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th>Taller</th>
                                                    <th>Periodo</th>
                                                    <th>Capacidad</th>
                                                    <th>Tipo</th>
                                                    <th>Fecha de inicio</th>
                                                    <th>Fecha de término</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($grades as $item)
                                                <tr>
                                                    <td>{{ $item->school_workshop->name }}</td>
                                                    <td>{{ $item->period->name }}</td>
                                                    <td>{{ $item->capacity }}</td>
                                                    <td>{{ $item->type }}</td>
                                                    <td>{{ $item->start }}</td>
                                                    <td>{{ $item->end }}</td>
                                                    <td>
                                                        <a href="{{ route('grade.show', $item->id) }}" title="Ver Curso">
                                                            <button class="btn btn-info btn-xs">
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                                Ver
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('grade.edit', $item->id) }}" title="Editar Curso">
                                                            <button class="btn btn-primary btn-xs">
                                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
                                                                Editar
                                                            </button>
                                                        </a>

                                                        <form method="POST" action="{{ route('grade.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Curso" onclick="return confirm('¿Deseas realizar la eliminación?')">
                                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                Eliminar
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @else
    
    <div class="row breadcrumb-container">
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('sumary') }}">Inicio</a>
            </li>
            <li class="active">
                <strong>Mis Cursos</strong>
            </li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Mis Cursos</div>
                <div class="panel-body">
                    @forelse($grades as $grade)
                        <div class="col-md-12">
                            <div class="ibox">
                                <div class="ibox-content">
                                    <a href="{{ route('grade.view', $grade->id) }}" class="btn-link">
                                        <h2>
                                            <i class="fa fa-caret-right" aria-hidden="true"></i>
                                            {{ $grade->school_workshop->name }}
                                        </h2>
                                    </a>
                                    <div class="small m-b-xs">
                                        @isset($teachers)
                                            <strong>Mentor: </strong> <span class="text-muted"><i class="fa fa-clock-o"></i> {{ $teachers[$loop->count]->firstname . " " . $teachers[$loop->count]->lastname }}</span>
                                        @endisset
                                    </div>
                                    <p>{{ $grade->school_workshop->description }}</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5><span class="text-navy">Fecha Inicio: </span> {{ $grade->start_date }}</h5>
                                            <h5><span class="text-navy">Fecha término: </span> {{ $grade->end_date }}</h5>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="small text-right">
                                                @if($grade->archived)
                                                    <h5 class="pull-right grade-close"><a class="tag_disabled">Estado: </a>Curso cerrado </span>
                                                @else
                                                    <h5 class="pull-right grade-open"><a class="tag_disabled">Estado: </a> Curso abierto </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <strong>Atención!</strong> Actualmente no perteneces a ningun curso. Postulate a un taller y espera la aprobación.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @endroles
@endsection
