@extends('layouts.backend')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Perfil</div>
                    <div class="panel-body">
                        <a href="#" onclick="goBack()" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>

                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th> Nombre </th>
                                        <td> {{ $user->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Rut / Pasaporte </th>
                                        <td> {{ $user->rut }} </td>
                                    </tr>
                                    <tr>
                                        <th> Género </th>
                                        <td> {{ $user->gender }} </td>
                                    </tr>
                                    <tr>
                                        <th> Fecha de nacimiento </th>
                                        <td> {{ $user->birth_date }} </td>
                                    </tr>
                                    <tr>
                                        <th> Correo electrónico </th>
                                        <td> {{ $user->email }} </td>
                                    </tr>
                                    <tr>
                                        <th> Teléfono principal</th>
                                        <td> {{ $user->phone_number }} </td>
                                    </tr>
                                    <tr>
                                        <th> Teléfono secundario</th>
                                        <td> {{ $user->phone_number2 }} </td>
                                    </tr>
                                    <tr>
                                        <th> Dirección </th>
                                        <td> {{ $user->address }} {{ $user->commune->name or '' }} </td>
                                    </tr>
                                    <tr>
                                        <th> Creación de perfil </th>
                                        <td> {{ $user->created_at->format('d/m/Y') }} </td>
                                    </tr>
                                    <tr>
                                        <th><label for="name" class=" control-label">Imagen de perfil actual</label></th>
                                        <td>
                                            <img alt="image" class="img-circle" src="{{ asset($user->image) }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Sede a la que postulas </th>
                                        <td> {{ $user->city_postulation }} </td>
                                    </tr>
                                    <tr>
                                        <th> Curso </th>
                                        <td> {{ $user->show_course }} </td>
                                    </tr>
                                    <tr>
                                        <th> Correo Tutor </th>
                                        <td> {{ $user->email_tutor }} </td>
                                    </tr>
                                    <tr>
                                        <th> Correo Mentor </th>
                                        <td> {{ $user->email_teacher }} </td>
                                    </tr>
                                    <tr>
                                        <th> Teléfono Tutor </th>
                                        <td> {{ $user->phone_number_tutor }} </td>
                                    </tr>
                                    <tr>
                                        <th> Nombre de establecimiento educacional </th>
                                        <td> {{ $user->name_establishment }} </td>
                                    </tr>
                                    <tr>
                                        <th> ¿Tú colegio te ayudará con el transporte? </th>
                                        <td> {{ $user->EstablishmentTransport }} </td>
                                    </tr>
                                    <tr>
                                        <th> Tipo de establecimiento educacional </th>
                                        <td> {{ $user->TypeEstablishment }} </td>
                                    </tr>
                                    <tr>
                                        <th> Dependencia de tu establecimiento educacional </th>
                                        <td> {{ $user->DependencyEstablishment }} </td>
                                    </tr>
                                    <tr>
                                        <th> Carta Motivacional </th>
                                        <td> {{ $user->about_select_workshop }} </td>
                                    </tr>
                                    
                                @if(Auth::user()->rol->name == "Administrador" || Auth::user()->id == $user->id)
                                    <tr>
                                        <th>
                                            <a href="{{ route('user.edit.profile',$user->id) }}" class="btn btn-primary btn-md">Editar datos de cuenta</a>
                                            <a type="button" href="{{ route('user.documentacion.form', $user->id) }}" class=" btn btn-primary btn-md">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                Editar Documentación
                                            </a>
                                        </th>
                                        <td></td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            @roles('Administrador')
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Editar Formularios</div>
                        <div class="panel-body">
                            <a type="button" href="{{ route('user.personal.form', $user->id) }}" class=" btn btn-success btn-md">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                Datos personales
                            </a>
                        
                            <a type="button" href="{{ route('user.documentacion.form', $user->id) }}" class=" btn btn-success btn-md">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                Documentación
                            </a>
                        
                            <a type="button" href="{{ route('user.establecimiento.form', $user->id) }}" class=" btn btn-success btn-md">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                Establecimiento
                            </a>
                        
                            <a type="button" href="{{ route('user.encuesta.form', $user->id) }}" class=" btn btn-success btn-md">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                Encuesta
                            </a>
                            
                            <br><br>
                            <p>Se mantienen estos enlaces solo para acceder a información ingresada por alumnos antiguos.</p>
                        </div>
                    </div>
                </div>
            @endroles
            
            @roles("Administrador,Coordinador")
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Cursos Asignados</div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Taller</th>
                                        <th>Periodo</th>
                                        <th>Capacidad</th>
                                        <th>Tipo</th>
                                        <th>Fecha de inicio</th>
                                        <th>Fecha de Término</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($user->division_users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->grade->school_workshop->name }}</td>
                                        <td>{{ $item->grade->period->name }}</td>
                                        <td>{{ $item->grade->capacity }}</td>
                                        <td>{{ $item->grade->type }}</td>
                                        <td>{{ $item->grade->start }}</td>
                                        <td>{{ $item->grade->end }}</td>
                                        <td>
                                            <a href="{{ route('grade.show', $item->grade_id) }}" title="Ver Period">
                                                <button class="btn btn-info btn-xs">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> Ver
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
            @endroles

        </div>
        <br><br>
@endsection
