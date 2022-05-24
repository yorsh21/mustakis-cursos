@extends('layouts.backend')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Postulación</div>
                        <div class="panel-body">
                            <div class="ibox float-e-margins">
                                <a href="{{ route('postulation.create') }}" class="btn btn-success btn-sm" title="Agregar nuevo Postulation">
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
                                                        <th>Fecha de inicio</th>
                                                        <th>Fecha de término</th>
                                                        <th>Periodo</th>
                                                        <th>Encuesta</th>
                                                        <th>Prerrequisito</th>
                                                        <th>Documentos</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($postulations as $postulation)
                                                    <tr>
                                                        <td>{{ $loop->iteration or $postulation->id }}</td>
                                                        <td>{{ $postulation->school_workshop->name }}</td>
                                                        <td>{{ $postulation->start_date }}</td>
                                                        <td>{{ $postulation->end_date }}</td>
                                                        <td>{{ $postulation->period->name }}</td>
                                                        <td>{{ !empty($postulation->survey_id) && isset($surveys[$postulation->survey_id]) ? $surveys[$postulation->survey_id] : "" }}</td>
                                                        <td>{{ $postulation->school_workshop->parent->name or '' }}</td>
                                                        <td>{{ $postulation->documents == 1 ? "Si" : "No" }}</td>

                                                        <td>
                                                            <a href="{{ route('postulation.show', $postulation->id) }}" title="Ver Postulation"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                                            <a href="{{ route('postulation.edit', $postulation->id) }}" title="Editar Postulation"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                                            <form method="POST" action="{{ route('postulation.destroy', $postulation->id) }}" accept-charset="UTF-8" style="display:inline">
                                                                {{ method_field('DELETE') }}
                                                                {{ csrf_field() }}
                                                                <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Postulation" onclick="return confirm('¿Deseas realizar la eliminación?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
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
