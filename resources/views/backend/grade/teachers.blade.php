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
                <strong>Mentores</strong>
            </li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">1. Curso | 2. Sesiones | <b>3. Mentores</b> | 4. Mediadores | 5. Alumnos</div>
                <div class="panel-body">
                    <div class="ibox float-e-margins">
                        <a href="{{ route('grade.blocks', $grade->id) }}" title="Atrás">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás
                            </button>
                        </a>
                        <a href="{{ route('grade.volunteers', $grade->id) }}" title="Atrás">
                            <button class="btn btn-success btn-xs"><i class="fa fa-arrow-right" aria-hidden="true"></i>
                                Continuar
                            </button>
                        </a>

                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <div id="DataTables_Table_0_wrapper"
                                         class="dataTables_wrapper form-inline dt-bootstrap">
                                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Correo</th>
                                                    <th>Teléfono</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($teachers as $item)
                                                    <tr>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->phone_number }}</td>
                                                        <td>
                                                            <a href="{{ route('user.show.profile', $item->id) }}" title="Ver Perfil">
                                                                <button class="btn btn-success btn-xs"><i class="fa fa-eye" aria-hidden="true"></i>
                                                                    Ver Perfil
                                                                </button>
                                                            </a>
                                                        
                                                        @if($item->division_users->where('grade_id', $grade->id)->count() == 0)
                                                            <form class="form-add-user-grade" method="POST" action="{{ route('division-user.store') }}" accept-charset="UTF-8" style="display:inline" id="add_user-{{ $item->id }}">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="grade_id" value="{{ $grade->id }}">
                                                                <input type="hidden" name="user_id" value="{{ $item->id }}">
                                                                <input type="hidden" name="rol_id" value="{{ $rol }}">
                                                                <button type="submit" class="btn btn-primary btn-xs" title="Vincular Mentor">
                                                                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                                    Vincular
                                                                </button>
                                                            </form>
                                                            <form class="form-del-user-grade" method="POST" action="{{ route('grade.delete.user') }}" accept-charset="UTF-8" style="display:none" id="del_user-{{ $item->id }}">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="grade_id" value="{{ $grade->id }}">
                                                                <input type="hidden" name="user_id" value="{{ $item->id }}">
                                                                <input type="hidden" name="rol_id" value="{{ $rol }}">
                                                                <button type="submit" class="btn btn-danger btn-xs" title="Quitar Mentor">
                                                                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                                                    Desvincular
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form class="form-add-user-grade" method="POST" action="{{ route('division-user.store') }}" accept-charset="UTF-8" style="display:none" id="add_user-{{ $item->id }}">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="grade_id" value="{{ $grade->id }}">
                                                                <input type="hidden" name="user_id" value="{{ $item->id }}">
                                                                <input type="hidden" name="rol_id" value="{{ $rol }}">
                                                                <button type="submit" class="btn btn-primary btn-xs" title="Vincular Mentor">
                                                                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                                    Vincular
                                                                </button>
                                                            </form>
                                                            <form class="form-del-user-grade" method="POST" action="{{ route('grade.delete.user') }}" accept-charset="UTF-8" style="display:inline" id="del_user-{{ $item->id }}">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="grade_id" value="{{ $grade->id }}">
                                                                <input type="hidden" name="user_id" value="{{ $item->id }}">
                                                                <input type="hidden" name="rol_id" value="{{ $rol }}">
                                                                <button type="submit" class="btn btn-danger btn-xs" title="Quitar Mentor">
                                                                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                                                    Desvincular
                                                                </button>
                                                            </form>
                                                        @endif
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
