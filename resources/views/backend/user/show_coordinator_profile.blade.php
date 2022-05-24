@extends('layouts.backend')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Perfil</div>
                    <div class="panel-body">
                    @roles('Administrador,Coordinador,Mentor')
                        <a href="{{ route('user.list', $user->rol_id) }}" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                    @else
                        <a href="#" onclick="goBack()" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                    @endroles

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
                                        <th> Ciudad de coordinación</th>
                                        <td> {{ $user->city_postulation }} </td>
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
                                    <tr>
                                        <th><a href="{{ route('user.edit.profile',$user->id) }}" class="btn btn-primary btn-md">Editar datos de cuenta</a></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <br><br>
@endsection
