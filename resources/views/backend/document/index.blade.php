@extends('layouts.backend')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Documentos de Postulación</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-info">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (!empty($errors->first('document')))
                            @php
                                echo '<div class="alert alert-danger"><i class="text-error">'. $errors->first('document') . '</i></div>';
                            @endphp
                        @endif
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Fecha de Subida</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($documents as $document)
                                            <tr>
                                                <td>{{ $loop->iteration or $document->id }}</td>
                                                <td>{{ $document->name }}</td>
                                                <td>{{ date_format(date_create($document->updated_at), 'd/m/Y H:m') }}</td>
                                                <td>
                                                    <form enctype="multipart/form-data" method="POST" action="{{ route('document.update') }}" role="application" class="form-inline">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="id" value="{{ $document->id }}">
                                                        <div class="form-group">
                                                            <input type="file" class="form-control" name="document">
                                                        </div>
                                                        <button type="submit" class=" btn btn-primary btn-xs"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                                                        <a href="{{ route('document.show', $document->key) }}" class="btn btn-info btn-xs" title="Ver documento"><i class="fa fa-eye" aria-hidden="true"></i> Ver Actual</a>
                                                        <a href="{{ route('document.delete', $document->id) }}" class="btn btn-danger btn-xs" title="Ver documento"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar Actual</a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                    <a id="download-all-documents" href="{{ route('document.backup') }}" class="btn btn-success btn-sm" title="Agregar nuevo Postulation" onclick="return confirm('A continuación se comprirán y descargarán todos los documentos subidos por los alumnos. Esta operación puede tardar varios minutos.')">
                                        <i class="fa fa-download" aria-hidden="true"></i> 
                                        Descargar documentos actuales
                                    </a>

                                    <a href="{{ route('document.destroy.all') }}" class="btn btn-danger btn-sm" title="Agregar nuevo Postulation" onclick="return confirm('A continuación se eliminarán los documentos de todos los alumnos. ¿Estas seguro de que deseas realizar esta acción?')">Borrar documentos actuales</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
