@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Curso {{ $grade->id }}</div>
                <div class="panel-body">
                    <a href="{{ route('grade.index') }}" title="Atrás">
                        <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás
                        </button>
                    </a>
                    
                    @unless($grade->archived)
                    <a href="{{ route('grade.edit', $grade->id) }}" title="Editar Curso">
                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Editar
                        </button>
                    </a>

                    <form method="POST" action="{{ route('grade.destroy', $grade->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Curso" onclick="return confirm('¿Deseas realizar la eliminación?')">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                            Eliminar
                        </button>
                    </form>
                    @endunless
                    <br/>
                    <br/>

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $grade->id }}</td>
                            </tr>
                            <tr>
                                <th> Capacidad</th>
                                <td> {{ $grade->capacity }} </td>
                            </tr>
                            <tr>
                                <th> Tipo</th>
                                <td> {{ $grade->type }} </td>
                            </tr>
                            <tr>
                                <th> Fecha de inicio</th>
                                <td> {{ $grade->start }} </td>
                            </tr>
                            <tr>
                                <th> Fecha de Término</th>
                                <td> {{ $grade->end }} </td>
                            </tr>
                            <tr>
                                <th> Horas de Coordinación</th>
                                <td> {{ $grade->hours }} </td>
                            </tr>
                            <tr>
                                <th> Campus</th>
                                <td> {{ $grade->campus->name }} </td>
                            </tr>
                            <tr>
                                <th> Taller</th>
                                <td> {{ $grade->school_workshop->name }} </td>
                            </tr>
                            <tr>
                                <th> Período</th>
                                <td> {{ $grade->period->name }} </td>
                            </tr>
                            </tbody>
                        </table>

                        <a href="{{ route('grade.view', $grade->id) }}" title="Vista Mentor">
                            <button class="btn btn-success"><i class="fa fa-binoculars" aria-hidden="true"></i>
                                Vista Mentor
                            </button>
                        </a>
                        
                        @roles("Administrador,Coordinador")
                        <a href="{{ route('grade.sumary', $grade->id) }}" title="Finalizar Curso">
                            <button class="btn btn-warning"><i class="fa fa-list-ul" aria-hidden="true"></i>
                                Resumen del curso
                            </button>
                        </a>
                        @endroles
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Mentores Vinculados</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $iteration = 1;
                            @endphp
                            @foreach($grade->division_users as $item)
                                @if($item->rol == 3)
                                    <tr>
                                        <td>{{ $iteration++ }}</td>
                                        <td>{{ $item->user->firstname }}</td>
                                        <td>{{ $item->user->lastname }}</td>
                                        <td>{{ $item->user->email }}</td>
                                        <td>{{ $item->user->phone_number }}</td>
                                        <td>
                                            <a href="{{ route('user.show.profile', $item->user->id) }}" title="Ver Usuario">
                                                <button class="btn btn-info btn-xs">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> Ver perfil
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Mediadores Vinculados</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $iteration = 1;
                            @endphp
                            @foreach($grade->division_users as $item)
                                @if($item->rol == 5)
                                    <tr>
                                        <td>{{ $iteration++ }}</td>
                                        <td>{{ $item->user->firstname }}</td>
                                        <td>{{ $item->user->lastname }}</td>
                                        <td>{{ $item->user->email }}</td>
                                        <td>{{ $item->user->phone_number }}</td>
                                        <td>
                                            <a href="{{ route('user.show.profile', $item->user->id) }}" title="Ver Usuario">
                                                <button class="btn btn-info btn-xs">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> Ver perfil
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Alumnos Vinculados</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $iteration = 1;
                            @endphp
                            @foreach($grade->division_users as $item)
                                @if($item->rol == 4)
                                <tr>
                                    <td>{{ $iteration++ }}</td>
                                    <td>{{ $item->user->firstname }}</td>
                                    <td>{{ $item->user->lastname }}</td>
                                    <td>{{ $item->user->email }}</td>
                                    <td>{{ $item->user->phone_number }}</td>
                                    <td>
                                        <a href="{{ route('user.show.profile', $item->user->id) }}" title="Ver Usuario">
                                            <button class="btn btn-info btn-xs">
                                                <i class="fa fa-eye" aria-hidden="true"></i> Ver perfil
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
