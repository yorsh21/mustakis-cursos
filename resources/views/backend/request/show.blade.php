@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <a href="#" onclick="goBack()" title="Atrás">
                        <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>
                    </a>
                    <a href="{{ route('user.show.profile', $request->user_id) }}" title="Atrás">
                        <button class="btn btn-primary btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver Postulante</button>
                    </a>
                    <a href="{{ route('request.answer', [$request->postulation_id, $request->user_id]) }}" title="Atrás">
                        <button class="btn btn-success btn-xs"><i class="fa fa-check-square-o" aria-hidden="true"></i> Ver Formularios de Postulación</button>
                    </a>
                    <br/>
                    <br/>

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>ID Solicitud</th>
                                    <td> {{ $request->id }}</td>
                                </tr>
                                <tr>
                                    <th> Estado Solicitud</th>
                                    <td> {{ $request->status }} </td>
                                </tr>
                                <tr>
                                    <th> ID Postulante</th>
                                    <td> {{ $request->user_id }} </td>
                                </tr>
                                <tr>
                                    <th> Nombre</th>
                                    <td> {{ $request->user->firstname }} </td>
                                </tr>
                                <tr>
                                    <th> Apellido</th>
                                    <td> {{ $request->user->lastname }} </td>
                                </tr>
                                <tr>
                                    <th> Correo Postulante</th>
                                    <td> {{ $request->user->email }} </td>
                                </tr>
                                <tr>
                                    <th> Correo Tutor</th>
                                    <td> {{ $request->user->email_tutor }} </td>
                                </tr>
                                <tr>
                                    <th> Correo Mentor</th>
                                    <td> {{ $request->user->email_teacher }} </td>
                                </tr>
                                <tr>
                                    <th> Fecha de nacimiento</th>
                                    <td> {{ $request->user->birth_date }} </td>
                                </tr>
                                <tr>
                                    <th> Rut</th>
                                    <td> {{ $request->user->rut }} </td>
                                </tr>
                                <tr>
                                    <th> Género</th>
                                    <td> {{ $request->user->gender }} </td>
                                </tr>
                                <tr>
                                    <th> Telefono</th>
                                    <td> {{ $request->user->phone_number }} </td>
                                </tr>
                                <tr>
                                    <th> Telefono alternativo</th>
                                    <td> {{ $request->user->phone_number2 or '-' }} </td>
                                </tr>
                                <tr>
                                    <th> Dirección</th>
                                    <td> {{ $request->user->address }}, {{ $request->user->commune->name }}, {{ $request->user->commune->region->name }} </td>
                                </tr>
                                <tr>
                                    <th> Curso</th>
                                    <td> {{ $request->user->course }} </td>
                                </tr>
                                <tr>
                                    <th> Documento de autorización 1</th>
                                    <td>
                                        <a href="{{ asset('files/'.$request->user->auth_doc) }}" target="_blank">
                                            <button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i>
                                                Ver
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th> Documento de autorización 2</th>
                                    <td>
                                        <a href="{{ asset('files/'.$request->user->auth_doc2) }}" target="_blank">
                                            <button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i>
                                                Ver
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th> Carta de compromiso establecimiento 1</th>
                                    <td>
                                        <a href="{{ asset('files/'.$request->user->school_doc) }}" target="_blank">
                                            <button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i>
                                                Ver
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th> Carta de compromiso establecimiento 2</th>
                                    <td>
                                        <a href="{{ asset('files/'.$request->user->school_doc2) }}" target="_blank">
                                            <button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i>
                                                Ver
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th> Carta de cesion de derechos</th>
                                    <td>
                                        <a href="{{ asset('files/'.$request->user->cession_doc) }}" target="_blank">
                                            <button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i>
                                                Ver
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th> Cedula de identidad estudiante</th>
                                    <td>
                                        <a href="{{ asset('files/'.$request->user->license_student) }}" target="_blank">
                                            <button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i>
                                                Ver
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th> Cedula de identidad tutor</th>
                                    <td>
                                        <a href="{{ asset('files/'.$request->user->license_tutor) }}" target="_blank">
                                            <button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i>
                                                Ver
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th> Carta de recomendación establecimiento</th>
                                    <td>
                                        @if($request->user->recomendation_doc)
                                            <a href="{{ asset('files/'.$request->user->recomendation_doc) }}" target="_blank">
                                                <button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i>
                                                    Ver
                                                </button>
                                            </a>
                                        @else
                                            <button class="btn btn-info btn-xs disabled"><i class="fa fa-eye" aria-hidden="true"></i>
                                                Ver
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Motivación(es) para participar en el taller de robótica</th>
                                    <td>
                                        @foreach($request->user->Motivations as $motivation)
                                            <b> {{'*'.$motivation}} </b> <br>
                                        @endforeach

                                    </td>
                                </tr>
                                <tr>
                                    <th>¿Qué caracteristica del taller llamó más la atención del alumno?</th>
                                    <td>
                                        @foreach($request->user->FeatureWorkshop as $features)
                                            <b> {{'*'.$features}} </b> <br>
                                        @endforeach

                                    </td>
                                </tr>
                                <tr>
                                    <th>¿El colegio del alumno cuenta con talleres de robótica?</th>
                                    <td>{{ $request->user->WorkshopSchool }}</td>
                                </tr>
                                <tr>
                                    <th>¿El alumno ha participado en talleres de robótica en su colegio?</th>
                                    <td>{{ $request->user->ParticipeWorkshopSchool }}</td>
                                </tr>
                                <tr>
                                    <th>¿El alumno ha participado en talleres de robótica en otros lugares?</th>
                                    <td>{{ $request->user->ParticipeWorkshopOther }}</td>
                                </tr>
                                <tr>
                                    <th>¿El alumno ha participado en competencias de robótica?</th>
                                    <td>{{ $request->user->ParticipeRobiticTournament }}</td>
                                </tr>
                                <tr>
                                    <th>¿El alumno cuenta con un robot en casa?</th>
                                    <td>{{ $request->user->HomeRobot }}</td>
                                </tr>
                                <tr>
                                    <th>¿El alumno cuenta con conocimiento en programación?</th>
                                    <td>{{ $request->user->ProgramationKnowledge }}</td>
                                </tr>
                                <tr>
                                    <th>¿A través de qué medio se acerco el alumno a la robótica?</th>
                                    <td> {{ $request->user->FindRobotic }}</td>
                                </tr>
                                <tr>
                                    <th>¿El alumno tiene experiencia programando en alguna plataforma?</th>
                                    <td>
                                        @foreach($request->user->Experience as $features)
                                            <b> {{'*'.$features}} </b> <br>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th> Región de establecimiento alumno</th>
                                    <td> {{ $request->user->NameRegionEstablishment }} </td>
                                </tr>
                                <tr>
                                    <th> Establecimiento</th>
                                    <td> {{ $request->user->NameEstablishment }} </td>
                                </tr>
                                <tr>
                                    <th> Dependencia de establecimiento educacional</th>
                                    <td>{{ $request->user->DependencyEstablishment }}</td>
                                </tr>
                                <tr>
                                    <th>¿El establecimiento dispone transporte para alumno?</th>
                                    <td>{{ $request->user->EstablishmentTransport }}</td>
                                </tr>
                                <tr>
                                    <th> Tipo de establecimiento educacional</th>
                                    <td> {{ $request->user->TypeEstablishment }}</td>
                                </tr>
                                <tr>
                                    <th> Especialidad</th>
                                    <td> {{ $request->user->especiality }}</td>
                                </tr>
                                <tr>
                                    <th> ¿El alumno posee necesidades especiales?</th>
                                    <td>{{ $request->user->CanNeeds }}</td>
                                </tr>
                                <tr>
                                    <th> Descripción de las necesidades del alumno</th>
                                    <td> {{ $request->user->needs_student }}</td>
                                </tr>
                                <tr>
                                    <th>Ciudad a la que postula el alumno</th>
                                    <td> {{ $request->user->CityPostulation }}</td>
                                </tr>
                                <tr>
                                    <th>Si alumno eligió puerto montt, a que taller quiere inscribirse</th>
                                    <td>{{ $request->user->PuertoMontWorksop }}</td>
                                </tr>
                                <tr>
                                    <th>Horario de preferencia alumno</th>
                                    <td>{{ $request->user->PreferenceHour }}</td>
                                </tr>

                                <tr>
                                    <th>¿El establecimiento del alumno cuenta con un taller de robótica?</th>
                                    <td>{{ $request->user->EstablishmentRobotic }}</td>
                                </tr>
                                <tr>
                                    <th>¿Como fue el primer acercamiento del alumno a la robótica?</th>
                                    <td> {{$request->user->first_contact_robotic}}</td>
                                </tr>

                                <tr>
                                    <th>¿Como se entero el alumno del taller de robótica?</th>
                                    <td> {{ $request->user->broadcast }}</td>
                                </tr>
                                <tr>
                                    <th>¿Como postuló el alumno?</th>
                                    <td id="letter_motivational"> {{ $request->user->doing }}</td>
                                </tr>
                                <tr>
                                    <th> Carta Motivacional</th>
                                    <td> {{ $request->user->LetterMotivational }}</td>
                                </tr>
                                <tr>
                                    <th> Puntaje</th>
                                    <td> {{ $request->user->score }}</td>
                                </tr>
                                <tr>
                                    <th> Ponderación</th>
                                    <td> {{ $request->user->ponderation }}</td>
                                </tr>
                                <tr>
                                    <th>Acciones</th>
                                    <td>
                                        @if($request->status != "aprobada")
                                            <form class="form-solicitude" method="POST" action="{{ route('request.update', $request->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ csrf_field() }}
                                                {{ method_field('PATCH') }}
                                                <input type="hidden" name="status" value="aprobada">
                                                <button type="submit" class="btn btn-warning" title="Aprobar Solicitud" >
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Pendiente
                                                </button>
                                            </form>
                                        @else
                                            <form class="form-solicitude" method="POST" action="{{ route('request.update', $request->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ csrf_field() }}
                                                {{ method_field('PATCH') }}
                                                <input type="hidden" name="status" value="pendiente">
                                                <button type="submit" class="btn btn-primary" title="Aprobar Solicitud">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Aprobada
                                                </button>
                                            </form>
                                        @endif
                                        <form method="POST" action="{{ route('request.destroy', $request->id) }}"
                                            accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger" title="Eliminar Solicitud"
                                                    onclick="return confirm('¿Deseas realizar la eliminación?')">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar Solicitud
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
