@extends('layouts.backend')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Sede {{ $campus->name }}</div>
                    <div class="panel-body">

                        <a href="{{ route('campus.index') }}" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                        <a href="{{ route('campus.edit', $campus->id) }}" title="Editar Campus"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ route('campus.destroy', $campus->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Campus" onclick="return confirm('¿Deseas realizar la eliminación?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th> Nombre </th>
                                        <td> {{ $campus->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Dirección </th>
                                        <td> {{ $campus->address }} </td>
                                    </tr>
                                    <tr>
                                        <th> Teléfono de Contacto </th>
                                        <td> {{ $campus->contact_phone }} </td>
                                    </tr>
                                    <tr>
                                        <th> Región </th>
                                        <td> {{ $campus->commune->region->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Comuna </th>
                                        <td> {{ $campus->commune->name }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            @include('backend.room.index')

        </div>
@endsection
