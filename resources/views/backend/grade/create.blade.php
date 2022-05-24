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
                <strong>Curso</strong>
            </li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><b>1- Curso</b> | 2- Sesiones | 3-Mentores | 4-Mediadores | 5-Alumnos </div>
                <div class="panel-body">
                    <a href="{{ route('grade.index') }}" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ route('grade.store') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('backend.grade.form')

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
