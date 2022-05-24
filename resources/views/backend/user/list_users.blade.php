@extends('layouts.backend')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $names }}</div>
                    <div class="panel-body">
                        <div class="ibox float-e-margins">
                            @roles('Administrador')
                                <a href="{{ route('user.crear', $rol_id) }}" class="btn btn-success btn-sm pull-left" title="Ingresar manualmente">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Ingresar manualmente
                                </a>
                                <form class="form" action="{{ route('user.descarga.rol') }}" method="POST" target="_blank">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="rol" value="{{ $rol_id }}">
                                    <input type="hidden" name="search" value="{{ $search or '' }}">
                                    <input type="hidden" name="campus" value="{{ $campus or '' }}">
                                    <input type="hidden" name="period" value="{{ $period or '' }}">
                                    <input type="hidden" name="school" value="{{ $school or '' }}">
                                    <div class="form-group pull-right">
                                        <button type="submit" class="btn btn-info btn-sm">
                                            <i class="fa fa-download" aria-hidden="true"></i> Descargar información de {{ $names }}
                                        </button>
                                    </div>
                                </form>
                            @endroles
                            @roles('Coordinador')
                                @if ($rol_id == 5)
                                    <a href="{{ route('user.crear', $rol_id) }}" class="btn btn-success btn-sm" title="Ingresar manualmente">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Ingresar manualmente
                                    </a>
                                @endif
                            @endroles
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                    <th>Rut / Pasaporte</th>
                                                    <th>Correo electrónico</th>
                                                    <th>Comuna</th>
                                                    <th>Región</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user)
                                                    <tr>
                                                        <td> {{ $loop->iteration or $user->id }} </td>
                                                        <td> {{ $user->firstname }} </td>
                                                        <td> {{ $user->lastname }} </td>
                                                        <td> {{ $user->rut }} </td>
                                                        <td> {{ $user->email }} </td>
                                                        <td> {{ $user->commune->name or '' }} </td>
                                                        <td> {{ $user->commune->region->name or '' }} </td>
                                                        <td><a href="{{ route('user.show.profile', $user->id) }}" title="Ver Usuario"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                                        @roles("Administrador")
                                                            <a href="{{ route('user.edit.profile', $user->id) }}" title="Editar Usuario"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                                            <form method="POST" action="{{ route('user.destroy', $user->id) }}" accept-charset="UTF-8" style="display:inline">
                                                                {{ csrf_field() }}
                                                                <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Usuario" onclick="return confirm('Esta acción es irreversible y eliminará todo registro del usuario en el sistema. ¿Esta seguro de que desea eliminar a {{ $user->name }}?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                                            </form>
                                                        @endroles
                                                        
                                                        @if($user->has_rol(5))
                                                            @roles("Coordinador")
                                                                <form method="POST" action="{{ route('user.destroy', $user->id) }}" accept-charset="UTF-8" style="display:inline">
                                                                    {{ csrf_field() }}
                                                                    <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Usuario" onclick="return confirm('Esta acción es irreversible y eliminará todo registro del usuario en el sistema. ¿Esta seguro de que desea eliminar a {{ $user->name }}?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                                                </form>
                                                            @endroles
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
