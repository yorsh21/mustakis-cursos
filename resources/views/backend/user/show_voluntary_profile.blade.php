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
                                        <th> Rut </th>
                                        <td> {{ $user->rut }} </td>
                                    </tr>
                                    <tr>
                                        <th> Género </th>
                                        <td> {{ $user->gender }} </td>
                                    </tr>
                                    <tr>
                                        <th> Correo electrónico </th>
                                        <td> {{ $user->email }} </td>
                                    </tr>
                                    <tr>
                                        <th> Teléfono </th>
                                        <td> {{ $user->phone_number }} </td>
                                    </tr>
                                    <tr>
                                        <th> Dirección </th>
                                        <td> {{ $user->address }}, {{ $user->commune->name or '' }} </td>
                                    </tr>
                                    <tr>
                                        <th> Carrera</th>
                                        <td> {{ $user->study_career }} </td>
                                    </tr>
                                    <tr>
                                        <th> Universidad</th>
                                        <td> {{ $user->study_institution }} </td>
                                    </tr>
                                    <tr>
                                        <th> Creación de perfil </th>
                                        <td> {{ $user->created_at->format('d/m/Y') }} </td>
                                    </tr>
                                    <tr>
                                        <th><label for="name" class=" control-label">Imagen de perfil actual</label></th>
                                        <td>
                                            <img alt="image" class="img-circle" src="{{ asset(Auth::user()->image) }}">
                                        </td>
                                    </tr>
                                @if(Auth::user()->rol->name == "Administrador" || Auth::user()->id == $user->id)
                                    <tr>
                                        <th><a href="{{ route('user.edit.profile',$user->id) }}" class="btn btn-primary btn-md">Editar datos de cuenta</a></th>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            
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
                                            <a href="{{ route('grade.show', $item->grade_id) }}" title="Ver Period"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
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
