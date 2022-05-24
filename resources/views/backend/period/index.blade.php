@extends('layouts.backend')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Periodos</div>
                    <div class="panel-body">
                        <div class="ibox float-e-margins">
                        <a href="{{ route('period.create') }}" class="btn btn-success btn-sm" title="Agregar nuevo Periodo">
                            <i class="fa fa-plus" aria-hidden="true"></i> Crear Nuevo
                        </a>
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                    <th>Descripción</th>
                                                    <th>Fecha de inicio</th>
                                                    <th>Fecha de término</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($period as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration or $item->id }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->description }}</td>
                                                    <td>{{ $item->start }}</td>
                                                    <td>{{ $item->end }}</td>
                                                    <td>
                                                        <a href="{{ route('period.show', $item->id) }}" title="Ver Periodo"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                                        <a href="{{ route('period.edit', $item->id) }}" title="Editar Periodo"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                                        <form method="POST" action="{{ route('period.recalculate') }}" accept-charset="UTF-8" style="display:inline">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                                            <button type="submit" class="btn btn-warning btn-xs" title="Recalcular Puntajes" onclick="return confirm('¿Deseas recalcular los puntajes de los colegios en base a la asistencia que obtuvieron los alumnos en los cursos de este semestre?')">
                                                                <i class="fa fa-calculator" aria-hidden="true"></i> Recalcular Puntajes
                                                            </button>
                                                        </form>

                                                        <form method="POST" action="{{ route('period.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Periodo" onclick="return confirm('¿Deseas realizar la eliminación?')">
                                                                <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar
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

@endsection
