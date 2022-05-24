@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if(Session::has('message'))
            <div class="alert alert-{{ Session::get('message')[0] }}" role="alert">
                {{ Session::get('message')[1] }}
            </div>
        @endif

        @if(session()->has('status'))
            <div class="alert alert-info alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {{ session('status') }}
            </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading">Solicitudes</div>

            <div class="panel-body">
                @roles('Coordinador')
                    <a href="{{ route('request.download') }}" class="btn btn-primary" title="Aprobar Solicitud" target="_blank">
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i> 
                        Exportar listado completo
                    </a>
                    <br><br>
                @endroles
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre postulante</th>
                                <th>Taller</th>
                                <th>Ciudad de Postulación</th>
                                <th>Puntaje (ponderado)</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $contador = 0; @endphp
                        @foreach($solicitudes as $item)
                            @if(!in_array($item->user->city_assist_workshop, $campus))
                                @continue
                            @endif

                            @php $contador++; @endphp
                            <tr>
                                <td>{{ $contador }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->postulation->school_workshop->name }}</td>
                                <td>{{ $item->user->city_postulation }}</td>
                                <td id="score-global-{{ $item->user->id }}">{{ number_format($item->user->ponderation, 2, ",", ".") }}</td>
                                <td>
                                    <a class="btn btn-success btn-xs" href="{{ route('request.show', $item->id) }}" title="Ver Solicitud">
                                        <i class="fa fa-eye" aria-hidden="true"></i> Ver
                                    </a>
                                    @if($item->status != "aprobada")
                                        <form class="form-solicitude" method="POST" action="{{ route('request.update', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            <input type="hidden" name="status" value="aprobada">
                                            <button type="submit" class="btn btn-warning btn-xs" title="Aprobar Solicitud" >
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Pendiente
                                            </button>
                                        </form>
                                    @else
                                        <form class="form-solicitude" method="POST" action="{{ route('request.update', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            <input type="hidden" name="status" value="pendiente">
                                            <button type="submit" class="btn btn-primary btn-xs" title="Aprobar Solicitud">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Aprobada
                                            </button>
                                        </form>
                                    @endif
                                    <div class="btn-group">
                                        <button data-toggle="dropdown" class="btn btn-info btn-xs dropdown-toggle">Documentos <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="view-motivation" data-toggle="modal" data-target="#modal-motivation">Asignar puntaje a carta de motivación</a>
                                                <input type="hidden" name="hidden-id" value="{{ $item->user->id }}">
                                                <input type="hidden" name="hidden-name" value="{{ $item->user->name }}">
                                                <input type="hidden" name="hidden-score" value="{{ $item->user->score_motivation }}" id="score-motivation-{{ $item->user->id }}">
                                                <input type="hidden" name="hidden-motivation" value="{{ $item->user->about_select_workshop }}">
                                            </li>
                                            <li class="divider"></li>
                                            <li><a href="{{ asset('files/'.$item->user->auth_doc )}}" target="_blank">Documento de autorización 1</a></li>
                                            <li><a href="{{ asset('files/'.$item->user->auth_doc2 )}}" target="_blank">Documento de autorización 2</a></li>
                                            <li><a href="{{ asset('files/'.$item->user->school_doc )}}" target="_blank">Carta de establecimiento 1</a></li>
                                            <li><a href="{{ asset('files/'.$item->user->school_doc2 )}}" target="_blank">Carta de establecimiento 2</a></li>
                                            <li><a href="{{ asset('files/'.$item->user->cession_doc )}}" target="_blank">Carta de cesion de derechos</a></li>
                                            <li><a href="{{ asset('files/'.$item->user->license_student )}}" target="_blank">Cedula de identidad estudiante</a></li>
                                            <li><a href="{{ asset('files/'.$item->user->license_tutor )}}" target="_blank">Cedula de identidad tutor</a></li>
                                            <li><a href="{{ asset('files/'.$item->user->recomendation_doc )}}" target="_blank">Carta de recomendación establecimiento</a></li>
                                        </ul>
                                    </div>
                                    @roles("Administrador")
                                    <form method="POST" action="{{ route('request.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Solicitud" onclick="return confirm('¿Deseas realizar la eliminación?')">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar
                                        </button>
                                    </form>
                                    @endroles
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
                <a href="{{ route('send.confirm.request') }}" class="btn btn-primary" title="Aprobar Solicitud" onclick="return confirm('Se enviarán en total {{ $solicitudes->count() }} correos electrónicos. \nSe eliminarán todos los archivos subidos por los usuarios que esten pendientes. \nEl proceso tarda aproximadamente 5 segundos por solicitud, asi que es recomendable dejar esta pestaña abierta hasta que el proceso termine. \nAntes de continuar verifica que los parámetros \'email_aprobado\' y \'email_rechazado\' contengan el texto que se enviará a cada postulante según corresponda. \n¿Estas seguro de que deseas continuar?');">
                    <i class="fa fa-envelope" aria-hidden="true"></i> 
                    Enviar correo de postulación
                </a>
                <a href="{{ route('user.puntajes') }}" class="btn btn-success" title="Aprobar Solicitud">
                    <i class="fa fa-refresh" aria-hidden="true"></i> 
                    Actualizar Puntajes
                </a>
                <a href="{{ route('request.index.historicos') }}" class="btn btn-info" title="Aprobar Solicitud">
                    <i class="fa fa-clock-o" aria-hidden="true"></i> 
                    Ver solicitudes históricas
                </a>
                <a href="{{ route('request.download') }}" class="btn btn-primary" title="Aprobar Solicitud" target="_blank">
                    <i class="fa fa-file-excel-o" aria-hidden="true"></i> 
                    Exportar listado completo
                </a>
            </div>
        </div><br><br>
        @endroles

        @roles('Coordinador')
        <div class="panel panel-default">
            <div class="panel-heading">Administrar Solicitudes</div>
                
            <div class="panel-body">
                <a href="{{ route('user.puntajes') }}" class="btn btn-success" title="Aprobar Solicitud">
                    <i class="fa fa-refresh" aria-hidden="true"></i> 
                    Actualizar Puntajes
                </a>
            </div>
        </div><br><br>
        @endroles

    </div>
</div>

<div class="modal inmodal fade in" id="modal-motivation" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Cerrar</span></button>
                <h4 class="modal-title">Carta de Motivación</h4>
                <small class="font-bold modal-name"></small>
            </div>
            <div class="modal-body">
                <p class="modal-motivation"></p>
            </div>

            <div class="modal-footer">
                <p class="text-center">Puntaje Asignado: <b class="modal-score"></b></p><br>
                <form id="form-motivation"  method="POST" action="{{ route('user.score.motivation') }}" accept-charset="UTF-8" style="display:inline">
                    {{ csrf_field() }}
                    <input type="hidden" id="motivation-id" name="id" value="">
                    <input type="hidden" id="motivation-score" name="score_motivation" value="">
                </form>
                <div class="text-center">
                    <button class="btn btn-info btn-lg btn-score" data-point="0" data-toggle="tooltip" data-placement="left" title="" data-original-title="La carta de motivación del postulante no contiene argumentos que permitan respaldar su postulación, tampoco es posible identificar proyecciones del alumno.">
                        <i class="fa fa-star-o" aria-hidden="true"></i> 0 puntos
                    </button>
                    <button class="btn btn-info btn-lg btn-score" data-point="1" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="El postulante refleja sus motivaciones y/o intereses, defendiendo con argumentos su postulación y/o proyectando intenciones gracias a la eventual experiencia que le entregaría el taller.">
                        <i class="fa fa-star-half-o" aria-hidden="true"></i> 1 punto
                    </button>
                    <button class="btn btn-info btn-lg btn-score" data-point="2" data-toggle="tooltip" data-placement="right" title="" data-original-title="El postulante refleja sus motivaciones e intereses, defendiendo con argumentos su postulación, proyectando intenciones gracias a la eventual experiencia que le entregaría el taller.">
                        <i class="fa fa-star" aria-hidden="true"></i> 2 puntos
                    </button>
                </div><br>
            </div>
        </div>
    </div>
</div>

@endsection
