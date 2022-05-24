@extends('layouts.backend')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Encuesta {{ $survey->name }}</div>
                    <div class="panel-body">

                        <a href="{{ route('survey.index') }}" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                        <a href="{{ route('survey.edit', $survey->id) }}" title="Editar Encuesta"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ route('survey.destroy', $survey->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Encuesta" onclick="return confirm('¿Deseas realizar la eliminación?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th> Nombre </th>
                                        <td> {{ $survey->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Descripción </th>
                                        <td> {{ $survey->description }} </td>
                                    </tr>
                                    <tr>
                                        <th> Cuestionarios </th>
                                        <td>
                                            @foreach ($questionnaires as $questionary)
                                                <a href="{{ route('questionary.show', $questionary->id) }}" title="Ver cuestionario" target="_blank">
                                                    {{ $questionary->name }}
                                                </a> 
                                                @if (!$loop->last)
                                                , 
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Fecha Creación </th>
                                        <td> {{ $survey->created_at }} </td>
                                    </tr>
                                    <tr>
                                        <th> Fecha Creación</th>
                                        <td> {{ $survey->updated_at }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
