@extends('layouts.backend')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Cursos {{ $period->description or 'Cerrados' }}</div>
                    <div class="panel-body">
                        <div class="ibox float-e-margins">
                            <a href="{{ route('grade.create') }}" class="btn btn-success btn-sm" title="Agregar nuevo Curso">
                                <i class="fa fa-plus" aria-hidden="true"></i> Crear Nuevo
                            </a>
                            
                            @if(!is_null($period))
                            <a href="{{ route('grade.download.info', $period->id) }}" class="btn btn-primary btn-sm" title="Descargar información" target="_blank">
                                <i class="fa fa-download" aria-hidden="true"></i> Descargar información
                            </a>
                            @endif

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
                                            @foreach($grade as $item)
                                                <tr>
                                                    <td>{{ $item->school_workshop->name }}</td>
                                                    <td>{{ $item->period->name }}</td>
                                                    <td>{{ $item->capacity }}</td>
                                                    <td>{{ $item->type }}</td>
                                                    <td>{{ $item->start }}</td>
                                                    <td>{{ $item->end }}</td>
                                                    <td>
                                                        <a href="{{ route('grade.show', $item->id) }}" title="Ver Grade">
                                                            <button class="btn btn-info btn-xs">
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                                Ver
                                                            </button>
                                                        </a>
                                                        @unless($item->archived)
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
                                                        @endunless
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
@endsection
