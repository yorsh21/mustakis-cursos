@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Solicitudes</div>
            <div class="panel-body">
                <h2>Descargando...</h2>
                <div style="visibility: hidden;" class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead style="visibility: hidden;">
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Estado Solicitud</th>
                                <th>ID Postulante</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo Postulante</th>
                                <th>Correo Tutor</th>
                                <th>Correo Mentor</th>
                                <th>Fecha de nacimiento</th>
                                <th>Rut</th>
                                <th>Género</th>
                                <th>Telefono</th>
                                <th>Telefono alternativo</th>
                                <th>Dirección</th>
                                <th>Curso</th>
                                <th>Motivación(es) para participar en el taller de robótica</th>
                                <th>¿Qué caracteristica llamó la atención del alumno?</th>
                                <th>¿El colegio del alumno cuenta con talleres de robótica?</th>
                                <th>¿El alumno ha participado en talleres de robótica en su colegio?</th>
                                <th>¿El alumno ha participado en talleres de robótica en otros lugares?</th>
                                <th>¿El alumno ha participado en competencias de robótica?</th>
                                <th>¿El alumno cuenta con un robot en casa?</th>
                                <th>¿El alumno cuenta con conocimiento en programación?</th>
                                <th>¿A través de qué medio se acerco el alumno a la robótica?</th>
                                <th>¿El alumno tiene experiencia programando en alguna plataforma?</th>
                                <th>Comuna de establecimiento alumno</th>
                                <th>Establecimiento</th>
                                <th>Nuevo establecimiento escrito por alumno</th>
                                <th>Dependencia de establecimiento educacional</th>
                                <th>¿El establecimiento dispone transporte para alumno?</th>
                                <th>Tipo de establecimiento educacional</th>
                                <th>Especialidad</th>
                                <th>¿El alumno posee necesidades especiales?</th>
                                <th>Descripción de las necesidades del alumno</th>
                                <th>Ciudad a la que postula el alumno</th>
                                <th>Si alumno eligió puerto montt, a que taller quiere inscribirse</th>
                                <th>Horario de preferencia alumno</th>
                                <th>¿El establecimiento del alumno cuenta con un taller de robótica?</th>
                                <th>¿Como fue el primer acercamiento del alumno a la robótica?</th>
                                <th>¿Como se entero el alumno del taller de robótica?</th>
                                <th>Como postulo el alumno</th>
                                <th>Carta Motivacional</th>
                                <th>Puntaje</th>
                                <th>Ponderación</th>
                                <th>Periodo</th>
                                <th>Encuestas ----></th>
                                @foreach ($answer_keys as $item)
                                    <th>{{ $item }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody style="visibility: hidden;">
                        @foreach($solicitudes as $request)
                            @roles('Coordinador')
                                @if($request->user->city_postulation != Auth::user()->city_postulation)
                                    @continue
                                @endif
                            @endroles
                            <tr>
                                <td>{{ $loop->iteration or $request->id }}</td>
                                <td> {{ $request->id }}</td>
                                <td> {{ $request->status }} </td>
                                <td> {{ $request->user_id }} </td>
                                <td> {{ $request->user->firstname }} </td>
                                <td> {{ $request->user->lastname }} </td>
                                <td> {{ $request->user->email }} </td>
                                <td> {{ $request->user->email_tutor }} </td>
                                <td> {{ $request->user->email_teacher }} </td>
                                <td> {{ $request->user->birth_date }} </td>
                                <td> {{ $request->user->rut }} </td>
                                <td> {{ $request->user->gender }} </td>
                                <td> {{ $request->user->phone_number }} </td>
                                <td> {{ $request->user->phone_number2 or '-' }} </td>
                                <td> {{ $request->user->address }}, {{ $request->user->commune->name }}, {{ $request->user->commune->region->name }} </td>
                                <td> {{ $request->user->course }} </td>
                                <td>
                                    @foreach($request->user->Motivations as $motivation) {{' *'.$motivation}} @endforeach
                                </td>
                                <td>
                                    @foreach($request->user->FeatureWorkshop as $features) {{' *'.$features}} </b> @endforeach
                                </td>
                                <td>
                                    {{ $request->user->school_workshop == '1' ? 'No' : '' }}
                                    {{ $request->user->school_workshop == '0' ? 'Si' : '' }}
                                </td>
                                <td>
                                    {{ $request->user->participate_school_workshop == '1' ? 'No' : '' }}
                                    {{ $request->user->participate_school_workshop == '0' ? 'Si' : '' }}
                                </td>
                                <td>
                                    {{ $request->user->participate_other_workshop == '1' ? 'No' : '' }}
                                    {{ $request->user->participate_other_workshop == '0' ? 'Si' : '' }}
                                </td>
                                <td>
                                    {{ $request->user->participate_tournament_robotic == '1' ? 'No' : '' }}
                                    {{ $request->user->participate_tournament_robotic == '0' ? 'Si' : '' }}
                                </td>
                                <td>
                                    {{ $request->user->robot_home == '1' ? 'No' : '' }}
                                    {{ $request->user->robot_home == '0' ? 'Si' : '' }}
                                </td>
                                <td>
                                    {{ $request->user->knowledge_programation == '1' ? 'No' : '' }}
                                    {{ $request->user->knowledge_programation == '0' ? 'Si' : '' }}
                                </td>
                                <td> {{ $request->user->FindRobotic }}</td>
                                <td>
                                    @foreach($request->user->Experience as $features) {{' *'.$features}} @endforeach
                                </td>

                                <td> {{ $request->user->NameCommune }} </td>
                                <td> {{ $request->user->NameEstablishment }} </td>
                                <td> {{ $request->user->new_school_commune }} </td>
                                <td>
                                    {{ $request->user->dependency_establishment_student == ''  ? '' : '' }}
                                    {{ $request->user->dependency_establishment_student == '0' ? 'Municipal' : '' }}
                                    {{ $request->user->dependency_establishment_student == '1' ? 'Particular subvencionado' : '' }}
                                    {{ $request->user->dependency_establishment_student == '2' ? 'Particular' : '' }}
                                </td>
                                <td>
                                    {{ $request->user->transport_establishment == '1' ? 'Si' : '' }}
                                    {{ $request->user->transport_establishment == '0' ? 'No' : '' }}
                                </td>
                                <td>
                                    {{ $request->user->type_establishment_student == '' ? '' : '' }}
                                    {{ $request->user->type_establishment_student == '0' ? 'Científico humanista' : '' }}
                                    {{ $request->user->type_establishment_student == '1' ? 'Técnico profesional' : '' }}
                                    {{ $request->user->type_establishment_student == '2' ? 'N/A' : '' }}
                                </td>
                                <td> {{ $request->user->especiality }}</td>
                                <td> 
                                    {{ $request->user->special_needs == '1' ? 'Si' : '' }}
                                    {{ $request->user->special_needs == '0' ? 'No' : '' }}
                                </td>
                                <td> {{ $request->user->needs_student }}</td>
                                <td> {{ $request->user->city_postulation }}</td>
                                <td>
                                    {{ $request->user->workshop_puerto_montt == ''  ? '' : '' }}
                                    {{ $request->user->workshop_puerto_montt == '0' ? 'Robotica Educativa' : '' }}
                                    {{ $request->user->workshop_puerto_montt == '1' ? 'Tecnologias Espaciales: ArduSat' : '' }}
                                </td>
                                <td>
                                    {{ $request->user->horary_preference == ''  ? '' : '' }}
                                    {{ $request->user->horary_preference == '0' ? 'Mañana (10:00) a (13:00)' : '' }}
                                    {{ $request->user->horary_preference == '1' ? 'Tarde (13:30) a (16:30) ' : '' }}
                                </td>
                                <td> 
                                    {{ $request->user->horary_preference == ''  ? '  ' : '' }}
                                    {{ $request->user->horary_preference == '0' ? 'No' : '' }}
                                    {{ $request->user->horary_preference == '1' ? 'Si' : '' }}
                                </td>
                                <td> {{$request->user->first_contact_robotic}}</td>
                                <td> {{ $request->user->broadcast }}</td>
                                <td> {{ $request->user->doing }}</td>
                                <td> {{ $request->user->LetterMotivational }}</td>
                                <td> {{ $request->user->score }}</td>
                                <td> {{ $request->user->ponderation }}</td>
                                <td> {{ $request->postulation->period->description }}</td>
                                <td></td>
                                @if (isset($request->answers))
                                    @foreach ($answer_keys as $item)
                                        @if (isset($request->answers[$item]))
                                            @if (is_array($request->answers[$item]))
                                                <td>{{ implode(", ", $request->answers[$item]) }}</td>
                                            @else
                                                <td>{{ $request->answers[$item] }}</td>
                                            @endif
                                        @else
                                            <td></td>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($answer_keys as $item)
                                        <td></td>
                                    @endforeach
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            setTimeout(function(){ $('.buttons-excel').click(); }, 1500);
            setTimeout(function(){ window.close(); }, 3000);
        });
        
    </script>
@endsection
