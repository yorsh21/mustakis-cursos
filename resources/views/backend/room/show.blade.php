@extends('layouts.backend')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Sala {{ $room->name }}</div>
                    <div class="panel-body">

                        <a href="#" onclick="goBack()" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                        <a href="{{ route('room.edit', $room->id) }}" title="Editar Sala"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ route('room.destroy', $room->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Sala" onclick="return confirm('¿Deseas realizar la eliminación?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $room->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Capacidad </th>
                                        <td> {{ $room->capacity }} </td>
                                    </tr>
                                    <tr>
                                        <th> Número </th>
                                        <td> {{ $room->number }} </td>
                                    </tr>
                                    <tr>
                                        <th> Sede </th>
                                        <td> {{ $room->campus_id }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
