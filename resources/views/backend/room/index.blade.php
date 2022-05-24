<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Salas</div>
                <div class="panel-body">
                    <div class="ibox float-e-margins">
                        <a href="{{ route('room.create.campus', $campus->id) }}" class="btn btn-success btn-sm" title="Crear nueva Sala">
                            <i class="fa fa-plus" aria-hidden="true"></i> Crear Nueva
                        </a>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                    <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Numero</th>
                                                <th>Capacidad</th>
                                                <th>Sede</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($campus->rooms as $item)
                                            <tr>
                                                <td>{{ $loop->iteration or $item->id }}</td>
                                                <td>{{ $item->number }}</td>
                                                <td>{{ $item->capacity }}</td>
                                                <td>{{ $item->campus->name }}</td>
                                                <td>
                                                    <a href="{{ route('room.show', $item->id) }}" title="Ver Sala"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                                    <a href="{{ route('room.edit', $item->id) }}" title="Editar Sala"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                                    <form method="POST" action="{{ route('room.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Sala" onclick="return confirm('¿Deseas realizar la eliminación?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
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


