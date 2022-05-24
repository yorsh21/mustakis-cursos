@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">Solicitudes</div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre postulante</th>
                                <th>Taller</th>
                                <th>Ciudad de Postulación</th>
                                <th>Periodo</th>
                                <th>Puntaje</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($solicitudes as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->postulation->school_workshop->name }}</td>
                                    <td>{{ $item->user->city_postulation }}</td>
                                    <td>{{ $item->postulation->period->description }}</td>
                                    <td id="score-global-{{ $item->user->id }}">{{ $item->user->score + $item->user->score_motivation }}</td>
                                    <td>
                                        <a class="btn btn-info btn-xs" href="{{ route('request.show', $item->id) }}" title="Ver Solicitud">
                                            <i class="fa fa-eye" aria-hidden="true"></i> Ver
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        @roles('Administrador')
        <div class="panel panel-default">
            <div class="panel-heading">Administrar Solicitudes</div>
                
            <div class="panel-body">
                <a href="{{ route('request.index') }}" class="btn btn-primary" title="Aprobar Solicitud">
                    <i class="fa fa-reply" aria-hidden="true"></i> 
                    Ver solicitudes actuales
                </a>

                <a href="{{ route('request.download', 'cerradas') }}" class="btn btn-primary" title="Aprobar Solicitud" target="_blank">
                    <i class="fa fa-file-excel-o" aria-hidden="true"></i> 
                    Exportar listado completo
                </a>
            </div>
        </div><br><br>
        @endroles

    </div>
</div>



@endsection