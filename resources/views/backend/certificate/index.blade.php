@extends('layouts.backend')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Certificados</div>
                    <div class="panel-body">
                        <div class="ibox float-e-margins">
                            <a href="{{ route('certificate.create') }}" class="btn btn-success btn-sm" title="Crear nueva Certificados">
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
                                                    <th>Descripción</th>
                                                    <th>Fecha</th>
                                                    <th>Fondo</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($certificates as $certificate)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $certificate->name }}</td>
                                                        <td>{{ $certificate->description }}</td>
                                                        <td>{{ $certificate->date }}</td>
                                                        <td class="index-background-certificate"><img src="{{ asset($certificate->background_url) }}" alt="fondo del certificado"></td>
                                                        <td>
                                                            <a href="{{ route('certificate.show', $certificate->id) }}" title="Ver Certificados" target="_blank">
                                                                <button class="btn btn-info btn-xs">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i> 
                                                                    Ver
                                                                </button>
                                                            </a>

                                                            <a href="{{ route('certificate.generate', $certificate->id) }}" title="Generar Certificados">
                                                                <button class="btn btn-success btn-xs">
                                                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i> 
                                                                    Generar
                                                                </button>
                                                            </a>

                                                            <a href="{{ route('certificate.edit', $certificate->id) }}" title="Editar Certificados">
                                                                <button class="btn btn-primary btn-xs">
                                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
                                                                    Editar
                                                                </button>
                                                            </a>

                                                            <form method="POST" action="{{ route('certificate.destroy', $certificate->id) }}" accept-charset="UTF-8" style="display:inline">
                                                                {{ method_field('DELETE') }}
                                                                {{ csrf_field() }}
                                                                <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Certificados" onclick="return confirm('¿Deseas realizar la eliminación?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
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
