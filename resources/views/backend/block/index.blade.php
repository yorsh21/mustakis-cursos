
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Sesiones</div>
                <div class="panel-body">
                    <div class="ibox float-e-margins">
                        <a href="{{ route('block.create.school', $schoolworkshop->id) }}" class="btn btn-success btn-sm" title="Agregar nueva sesión">
                            <i class="fa fa-plus" aria-hidden="true"></i> Crear Nueva
                        </a>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                    <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Descripción</th>
                                                <th>Nombre de Evaluación</th>
                                                <th>Tipo Evaluación</th>
                                                <th>Ponderación</th>
                                                <th>Cuestionario</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($schoolworkshop->blocks as $item)
                                            <tr>
                                                <td>{{ $loop->iteration or $item->id }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>{{ $item->evaluation_name }}</td>
                                                <td>{{ $item->evaluation_type }}</td>
                                                <td>{{ $item->weighing }}</td>
                                                <td>{{ empty($item->questionnaire_id) ? '' : $questionnaires[$item->questionnaire_id] }}</td>
                                                <td>
                                                    <a href="{{ route('block.show', $item->id) }}" title="Ver Block"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                                    <a href="{{ route('block.edit', $item->id) }}" title="Editar Block"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                                    <form method="POST" action="{{ route('block.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Block" onclick="return confirm('¿Deseas realizar la eliminación?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
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
