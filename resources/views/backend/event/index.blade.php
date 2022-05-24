@extends('layouts.backend')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Notificaciones</div>
                    <div class="panel-body">
                        <div class="ibox float-e-margins">
                            <a title="Eliminar todas las notificaciones" onclick="return confirm('¿Deseas eliminación todas las notificaciones?')" class="btn btn-danger btn-sm" href="{{ route('event.delete.all') }}">
                                <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar todas las notificaciones
                            </a>
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Título</th>
                                                    <th>Contenido</th>
                                                    <th>Visto</th>
                                                    <th>Fecha</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($events as $event)
                                                    <tr class="{{ $event->viewed == 0 ? 'row-strong' : '' }}">
                                                        <td>{{ $loop->iteration or $event->id }}</td>
                                                        <td>{{ $event->title }}</td>
                                                        <td>{{ $event->content }}</td>
                                                        <td>{{ $event->viewed == 0 ? "No Vista" : "Vista" }}</td>
                                                        <td>{{ date_format(date_create($event->datetime), 'd/m/Y H:i') }} </td>
                                                        <td>
                                                            <a href="{{ route('event.show', $event->id) }}" title="Ver Notificación"><button class="btn btn-success btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>

                                                            <form method="POST" action="{{ route('event.destroy', $event->id) }}" accept-charset="UTF-8" style="display:inline">
                                                                {{ method_field('DELETE') }}
                                                                {{ csrf_field() }}
                                                                <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Notificación"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
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
