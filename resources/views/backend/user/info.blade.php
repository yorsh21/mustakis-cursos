@extends('layouts.backend')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Cursos</div>
                    <div class="panel-body">
                        <h2>Descargando...</h2>
                        <div style="visibility: hidden;" class="ibox float-e-margins">
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <div id="DataTables_Table_0_wrapper"
                                         class="dataTables_wrapper form-inline dt-bootstrap">
                                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                    <th>Correo</th>
                                                    <th>RUT</th>
                                                    <th>Fecha de Nacimiento</th>
                                                    <th>Género</th>
                                                    <th>Dirección</th>
                                                    <th>Comuna</th>
                                                    <th>Número de Teléfono</th>
                                                    @if ($users->first()->has_rol(4))
                                                        <th>Número de Teléfono secundario</th>
                                                        <th>Correo Mentor</th>
                                                        <th>Correo Tutor</th>
                                                        <th>Teléfono Tutor</th>
                                                        <th>Curso</th>
                                                        <th>Ciudad de Postulación</th>
                                                        <th>¿Como postuló?</th>
                                                        <th>Nombre del establecimiento educacional</th>
                                                        <th>Región del establecimiento educacional</th>
                                                        <th>Dependencia de establecimiento educacional</th>
                                                        <th>Tipo de establecimiento educacional</th>
                                                        <th>Especialidad</th>
                                                        <th>Transporte del establecimiento educacional</th>
                                                        <th>¿Posee necesidades especiales?</th>
                                                        <th>Descripción de las necesidades del alumno</th>
                                                        <th>Taller de inscripción Puerto Montt</th>
                                                        <th>Horario de preferencia alumno</th>
                                                        <th>Carta Motivacional</th>
                                                        <th>Establecimiento con taller de robotica</th>
                                                        <th>Primer acercamiento a la robótica</th>
                                                        <th>Principales motivaciones para participar</th>
                                                        <th>Medio de Acercamiento a la Robótica</th>
                                                        <th>Características de mayor interes del taller</th>
                                                        <th>Colegio con talleres de robótica</th>
                                                        <th>Participación en talleres de robótica en el colegio</th>
                                                        <th>Participación en talleres de robótica en otros lugares</th>
                                                        <th>Participación en competencias de robótica</th>
                                                        <th>Robot en casa</th>
                                                        <th>Conocimiento en programación</th>
                                                        <th>Experiencia programando en alguna plataforma</th>
                                                        <th>¿Como se entero el alumno del taller de robótica?</th>
                                                        <th>Nivel de educación proyectado</th>
                                                        <th>Carrera que desea estudiar</th>
                                                        <th>Institución en la que desea estudiar</th>
                                                        <th>Ponderación</th>
                                                        <th>Puntaje</th>
                                                    @elseif ($users->first()->has_rol(2) || $users->first()->has_rol(5))
                                                        <th>Carrera</th>
                                                        <th>Universidad</th>
                                                    @elseif ($users->first()->has_rol(2))
                                                        <th>Ciudad de Coordinación</th>
                                                    @endif
                                                    <th>Fecha creación de perfil</th>
                                                    <th>Fecha actualización de perfil</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->firstname }}</td>
                                                    <td>{{ $user->lastname }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->rut }}</td>
                                                    <td>{{ date_format(date_create($user->birth_date), 'd/m/Y') }}</td>
                                                    <td>{{ $user->gender }}</td>
                                                    <td>{{ $user->address }}</td>
                                                    <td>{{ $user->commune->name or '' }}</td>
                                                    <td>{{ $user->phone_number }}</td>
                                                    @if ($user->has_rol(4))
                                                        <td>{{ $user->phone_number2 }}</td>
                                                        <td>{{ $user->email_teacher }}</td>
                                                        <td>{{ $user->email_tutor }}</td>
                                                        <td>{{ $user->phone_number_tutor }}</td>
                                                        <td>{{ $user->course }}</td>
                                                        <td>{{ $user->CityPostulation }}</td>
                                                        <td>{{ $user->doing }}</td>
                                                        <td>{{ $user->NameEstablishment }}</td>
                                                        <td>{{ $user->NameRegionEstablishment }}</td>
                                                        <td>{{ $user->DependencyEstablishment }}</td>
                                                        <td>{{ $user->TypeEstablishment }}</td>
                                                        <td>{{ $user->especiality }}</td>
                                                        <td>{{ $user->EstablishmentTransport }}</td>
                                                        <td>{{ $user->CanNeeds }}</td>
                                                        <td>{{ $user->needs_student }}</td>
                                                        <td>{{ $user->PuertoMontWorksop }}</td>
                                                        <td>{{ $user->PreferenceHour }}</td>
                                                        <td>{{ $user->LetterMotivational }}</td>
                                                        <td>{{ $user->EstablishmentRobotic }}</td>
                                                        <td>{{ $user->first_contact_robotic }}</td>
                                                        <td>{{ join(', ', $user->Motivations) }}</td>
                                                        <td>{{ $user->FindRobotic }}</td>
                                                        <td>{{ join(', ', $user->FeatureWorkshop) }}</td>
                                                        <td>{{ $user->WorkshopSchool }}</td>
                                                        <td>{{ $user->ParticipeWorkshopSchool }}</td>
                                                        <td>{{ $user->ParticipeWorkshopOther }}</td>
                                                        <td>{{ $user->ParticipeRobiticTournament }}</td>
                                                        <td>{{ $user->HomeRobot }}</td>
                                                        <td>{{ $user->ProgramationKnowledge }}</td>
                                                        <td>{{ join(', ', $user->Experience) }}</td>
                                                        <td>{{ $user->Broadcast }}</td>
                                                        <td>{{ $user->Education }}</td>
                                                        <td>{{ $user->study_career }}</td>
                                                        <td>{{ $user->study_institution }}</td>
                                                        <td>{{ $user->ponderation }}</td>
                                                        <td>{{ $user->score }}</td>
                                                    @elseif ($user->has_rol(2) || $users->first()->has_rol(5))
                                                        <td>{{ $user->study_career }}</td>
                                                        <td>{{ $user->study_institution }}</td>
                                                    @elseif ($users->first()->has_rol(2))
                                                        <td>{{ $user->CityPostulation }}</td>
                                                    @endif
                                                    <td>{{ date_format(date_create($user->created_at), 'd/m/Y') }}</td>
                                                    <td>{{ date_format(date_create($user->updated_at), 'd/m/Y') }}</td>
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

@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            setTimeout(function(){ $('.buttons-excel').click(); }, 1500);
            setTimeout(function(){ window.close(); }, 3000);
        });
        
    </script>
@endsection
