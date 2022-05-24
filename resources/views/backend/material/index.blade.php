
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">Materiales</div>
                <div class="panel-body">
                    <div class="ibox float-e-margins">
                        <a href="{{ route('material.create.block', $block->id) }}" class="btn btn-success btn-sm" title="Agregar nuevo Material">
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
                                                <th>General</th>
                                                <th>Acciones</th>
                                            </tr>
                                         </thead>
                                        <tbody>
                                        @foreach($block->materials as $item)
                                            <tr>
                                                <td>{{ $loop->iteration or $item->id }}</td>
                                                <td>{{ $item->file_name }}</td>
                                                <td>{{ $item->general == 1 ? 'Si' : 'No' }}</td>
                                                <td>
                                                    <a href="{{ route('user.material.download', $item->id) }}" title="Descargar Material">
                                                        <button class="btn btn-info btn-xs">
                                                            <i class="fa fa-arrow-down" aria-hidden="true"></i> 
                                                            Descargar
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('material.edit', $item->id) }}" title="Editar Material">
                                                        <button class="btn btn-primary btn-xs">
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
                                                            Editar
                                                        </button>
                                                    </a>
                                                    <form method="POST" action="{{ route('material.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Material" onclick="return confirm('¿Deseas realizar la eliminación?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
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
