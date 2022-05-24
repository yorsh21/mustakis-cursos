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
            <li>
                <a href="{{ route('grade.view', $grade->id) }}">{{ $grade->school_workshop->name }}</a>
            </li>
            <li class="active">
                <strong>Respuesta Encuestas</strong>
            </li>
        </ol>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Respuesta Encuestas</div>
                    <div class="panel-body">
                        <div class="ibox float-e-margins">
                            <a href="{{ route('grade.view', $grade->id) }}" title="Atrás" class="btn btn-warning btn-sm">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás
                            </a>
                            <a href="{{ route('grade.create') }}" class="btn btn-success btn-sm" title="Agregar nuevo Curso">
                                <i class="fa fa-plus" aria-hidden="true"></i> Crear Nuevo
                            </a>

                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <div class="dataTadbles_wrapper forsm-inline dt-bootstrasp table-resposnsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Rut</th>
                                                    @if (!empty($answers))
                                                        @foreach ($answers[0]->questionary["form"] as $form)
                                                            @if(isset($form["label"]) && $form["type"] != "header")
                                                                <th>{{ $form["label"] }}</th>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($grade->division_users as $division_user)
                                                @if($division_user->rol == 4)
                                                    <tr>
                                                        <td>{{ $division_user->user->name }}</td>
                                                        <td>{{ $division_user->user->rut }}</td>
                                                        @foreach ($answers as $answer)
                                                            @foreach ($answer->answers as $key => $value)
                                                                @if($key != "_token")
                                                                    @if ($answer->user_id == $division_user->user->id)
                                                                        <th>{{ $value }}</th>
                                                                    @else
                                                                        <th></th>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    </tr>
                                                @endif
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
