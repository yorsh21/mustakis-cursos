@extends('layouts.survey')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Cuestionario {{ $questionary->name }}</div>
                    <div class="panel-body">

                        <a href="{{ route('questionary.index') }}" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                        <a href="{{ route('questionary.edit', $questionary->id) }}" title="Editar Period"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ route('questionary.destroy', $questionary->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Period" onclick="return confirm('¿Deseas realizar la eliminación?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $questionary->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Nombre </th>
                                        <td> {{ $questionary->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Descripción </th>
                                        <td> {{ $questionary->description }} </td>
                                    </tr>
                                    <tr>
                                        <th> Fecha de creación </th>
                                        <td> {{ $questionary->created_at }} </td>
                                    </tr>
                                    <tr>
                                        <th> Fecha de actualización </th>
                                        <td> {{ $questionary->updated_at }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Vista Encuesta</div>
                    <div class="panel-body">
                        <div id="rendering"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <br><br><br>
@endsection


@section("scripts")
    <script>
        $(document).ready(function() {
            var data = `{{ json_encode($questionary->form) }}`.replace(/&quot;/g, '"');
            
            $('#rendering').formRender({
                dataType: 'json',
                formData: data
            });
        })
    </script>
@endsection