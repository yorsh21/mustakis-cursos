@extends('layouts.backend')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Encuesta {{ $survey->name }}</div>
                    <div class="panel-body">
                        <a href="{{ route('survey.index') }}" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="ibox-content">
                            <form id="form-survey" action="{{ route('survey.update', $survey->id) }}" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                        {{ method_field('PATCH') }}
                                        {{ csrf_field() }}
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                    <label for="name" class="col-md-4 control-label">Nombre</label>
                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control" value="{{ $survey->name or ''}}" minlength="3" required>
                                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                    <label for="description" class="col-md-4 control-label">Descripción</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="1" name="description" type="textarea">{{ $survey->description or ''}}</textarea>
                                        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('questionnaires') ? 'has-error' : ''}}">
                                    <label for="questionnaires" class="col-md-4 control-label">Cuestionarios</label>
                                    <div class="col-md-6">
                                        <select id="questionnaires" class="form-control" name="questionnaires[]" multiple="multiple">
                                            @if (is_null($survey->questionnaires))
                                                @foreach ($questionnaires as $questionary)
                                                    <option value="{{ $questionary->id }}">{{ $questionary->name }}</option>
                                                @endforeach
                                            @else
                                            @foreach ($questionnaires as $questionary)
                                                @if (array_search($questionary->id, $survey->questionnaires) === false)
                                                    <option value="{{ $questionary->id }}">{{ $questionary->name }}</option>
                                                @else
                                                    <option value="{{ $questionary->id }}" selected>{{ $questionary->name }}</option>
                                                @endif
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-4 col-md-4">
                                        <input class="btn btn-primary" type="submit" value="Guardar">
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div id="fb-editor"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection


@section("scripts")
    <script>
        $(document).ready(function() {
            $('#questionnaires').select2();
        });
    </script>
@endsection