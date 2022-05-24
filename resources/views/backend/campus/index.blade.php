@extends('layouts.backend')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Sedes</div>
                    <div class="panel-body">
                        <div class="ibox float-e-margins">
                            <a href="{{ route('campus.create') }}" class="btn btn-success btn-sm" title="Crear nueva Sede">
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
                                                    <th>Dirección</th>
                                                    <th>Comuna</th>
                                                    <th>Región</th>
                                                    <th>Coordinador@</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($campus as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration or $item->id }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->address }}</td>
                                                        <td> {{ $item->commune->name }} </td>
                                                        <td> {{ $item->commune->region->name }} </td>
                                                        <td>{{ $item->user->name }}</td>
                                                        <td><a href="{{ route('campus.show', $item->id) }}" title="Ver Sede"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>

                                                            <a href="{{ route('campus.edit', $item->id) }}" title="Editar Sede"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                                            <form method="POST" action="{{ route('campus.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                                {{ method_field('DELETE') }}
                                                                {{ csrf_field() }}
                                                                <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Sede" onclick="return confirm('¿Deseas realizar la eliminación?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
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
