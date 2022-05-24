@extends('layouts.backend')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Horas de Coordinación</div>
                    <div class="panel-body">
                        <div class="ibox float-e-margins">
                            @roles("Administrador")
                                <a href="{{ route('hour.create') }}" class="btn btn-success btn-sm" title="Crear nueva hora de coordinación">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Crear Nueva
                                </a>
                            @endroles
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Sede</th>
                                                    <th>Periodo</th>
                                                    <th>Horas</th>
                                                @roles("Administrador")
                                                    <th>Acciones</th>
                                                @endroles
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($coordination_hours as $item)
                                                    @if(Auth::user()->has_rol(1) || (Auth::user()->has_rol(2) && $item->campus->commune_id == Auth::user()->city_assist_workshop))
                                                        <tr>
                                                            <td>{{ $loop->iteration or $item->id }}</td>
                                                            <td>{{ $item->campus->name }}</td>
                                                            <td>{{ $item->period->name }}</td>
                                                            <td>{{ $item->hours }}</td>
                                                        @roles("Administrador")
                                                            <td>
                                                                <!--<a href="{{ route('hour.show', $item->id) }}" title="Ver hora de coordinación"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>-->

                                                                <a href="{{ route('hour.edit', $item->id) }}" title="Editar hora de coordinación"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                                                <form method="POST" action="{{ route('hour.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                                    {{ method_field('DELETE') }}
                                                                    {{ csrf_field() }}
                                                                    <button type="submit" class="btn btn-danger btn-xs" title="Eliminar hora de coordinación" onclick="return confirm('¿Deseas realizar la eliminación?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                                                </form>
                                                            </td>
                                                        @endroles
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
