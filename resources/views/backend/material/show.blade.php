@extends('layouts.backend')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Material {{ $material->name }}</div>
                    <div class="panel-body">

                        <a href="#" onclick="goBack()" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                        <a href="{{ route('material.edit', $material->id) }}" title="Editar Material"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ route('material.destroy', $material->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Material" onclick="return confirm('¿Deseas realizar la eliminación?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $material->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Nombre </th>
                                        <td> {{ $material->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> General </th>
                                        <td> {{ $material->general }} </td>
                                    </tr>
                                    <tr>
                                        <th> Evaluación </th>
                                        <td> {{ $material->block->evaluation_name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Taller </th>
                                        <td> {{ $material->block->school_workshop->name }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
