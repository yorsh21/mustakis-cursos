@extends('layouts.backend')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Generar Certificados por Curso</div>
                    <div class="panel-body">
                        <a href="{{ route('certificate.index') }}" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                        <br />
                        <br />
                        
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th>Taller</th>
                                                    <th>Periodo</th>
                                                    <th>Tipo</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($grades as $grade)
                                                    <tr>
                                                        <td>{{ $grade->school_workshop->name }}</td>
                                                        <td>{{ $grade->period->name }}</td>
                                                        <td>{{ $grade->type }}</td>
                                                        <td>
                                                            <a href="{{ route('certificate.downloads', [$certificate->id, $grade->id]) }}" title="Generar Certificados">
                                                                <button class="btn btn-success btn-xs">
                                                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i> 
                                                                    Generar Certificados
                                                                </button>
                                                            </a>
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
