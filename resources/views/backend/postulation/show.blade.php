@extends('layouts.backend')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Postulación {{ $postulation->id }}</div>
                    <div class="panel-body">

                        <a href="{{ route('postulation.index') }}" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                        <a href="{{ route('postulation.edit', $postulation->id) }}" title="Editar Postulation"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ route('postulation.destroy', $postulation->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Postulation" onclick="return confirm('¿Deseas realizar la eliminación?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $postulation->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Fecha inicio </th>
                                        <td> {{ $postulation->start_date }}</td>
                                    </tr>
                                    <tr>
                                        <th> Fecha término </th>
                                        <td> {{ $postulation->end_date }} </td>
                                    </tr>
                                    <tr>
                                        <th> Encuesta </th>
                                        <td> {{ empty($postulation->survey_id) ? '-' : $surveys[$postulation->survey_id] }} </td>
                                    </tr>
                                    <tr>
                                        <th> Prerequisito </th>
                                        <td> {{ $postulation->school_workshop->parent->name or '-' }} </td>
                                    </tr>
                                    <tr>
                                        <th> Documentos </th>
                                        <td> {{ $postulation->documents == 1 ? "Si" : "No"  }} </td>
                                    </tr>
                                    <tr>
                                        <th> Periodo </th>
                                        <td>{{ $postulation->period->name }}</td>
                                    </tr>
                                    <tr>
                                        <th> Taller </th>
                                        <td>{{ $postulation->school_workshop->name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
