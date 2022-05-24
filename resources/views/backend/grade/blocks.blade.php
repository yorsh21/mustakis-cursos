@extends('layouts.backend')

@section('content')
    <div class="row breadcrumb-container">
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('sumary') }}">Inicio</a>
            </li>
            <li>
                <a href="{{ route('grade.index') }}">Cursos</a>
            </li>
            <li>
                Crear curso
            </li>
            <li class="active">
                <strong>Sesiones</strong>
            </li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">1. Curso | <b>2. Sesiones</b> | 3. Mentores | 4. Mediadores | 5. Alumnos </div>
                <div class="panel-body">
                    <div class="ibox float-e-margins grades-block">
                        <a href="{{ route('grade.edit', $grade->id) }}" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                        <a href="{{ route('grade.teachers', $grade->id) }}" title="Atrás"><button class="btn btn-success btn-xs"><i class="fa fa-arrow-right" aria-hidden="true"></i> Continuar</button></a>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                    <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Evaluación</th>
                                                <th>Comentarios</th>
                                                <th>Fecha/hora de inicio</th>
                                                <th>Fecha/hora de término</th>
                                                <th>Sala</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($grade->block_grades as $item)
                                            <tr>
                                                <form class="form-blocks" method="POST" action="{{ route('block-grade.update', $item->id) }}" accept-charset="UTF-8">
                                                    {{ method_field('PATCH') }}
                                                    {{ csrf_field() }}
                                                    <td>{{ $loop->iteration or $item->id }}</td>
                                                    <td>{{ $item->block->evaluation_name }}</td>
                                                    <td><input type="text" name="comment" value="{{ $item->comment }}"></td>
                                                    <td><input type="datetime-local" name="start_date" value="{{ $item->start }}"></td>
                                                    <td><input type="datetime-local" name="end_date" value="{{ $item->end }}"></td>
                                                    <td>
                                                        <select class="form-control" id="room_id" name="room_id">
                                                            <option value="" name="">--- Elige una Sala ---</option>
                                                            @foreach($rooms as $room)
                                                                <option value="{{ $room->id }}" {{ $room->id == $item->room_id ? 'selected' : '' }}>{{ $room->number }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-default btn-xs" title="Guardar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Guardar</button>
                                                    </td>
                                                </form>
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

@endsection
