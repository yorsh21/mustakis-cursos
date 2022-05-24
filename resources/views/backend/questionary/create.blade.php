@extends('layouts.survey')

@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear Cuestionario</div>
                    <div class="panel-body">
                        <div class="ibox float-e-margins">
                            <button id="button-save" class="btn btn-success btn-sm" title="Guardar">
                                <i class="fa fa-save" aria-hidden="true"></i> Guardar
                            </button>
                            <button id="button-preview" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalPreview" title="Previsualizar">
                                <i class="fa fa-desktop" aria-hidden="true"></i> Previsualizar
                            </button>

                            <a id="button-return" href="{{ route('questionary.index') }}" class="btn btn-warning btn-sm" title="Volver">
                                <i class="fa fa-repeat" aria-hidden="true"></i> Volver
                            </a>
                            <div class="ibox-content">
                                <div class="row">
                                    <form id="form-questionary" action="{{ route('questionary.store') }}" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                        {{ csrf_field() }}
                                        <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                                <label for="name" class="control-label">Nombre</label>
                                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group col-md-12 {{ $errors->has('description') ? 'has-error' : ''}}">
                                                <label for="description" class="control-label">Descripción</label>
                                                <textarea class="form-control" rows="1" name="description" type="textarea">{{ old('description') }}</textarea>
                                                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                        <input id="input-form" type="hidden" name="form" value="">
                                    </form>
                                </div>
                                <hr>
                                <div class="row">
                                    <div id="fb-editor"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modalPreview" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Previsualización de Encuesta</h4>
        </div>
        <div class="modal-body">
            <div id="rendering"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>

    </div>
    </div>

@endsection


@section("scripts")
    <script>
        var options = {
            i18n: {
                locale: 'es-ES'
            },
            showActionButtons: false
        };
        var formBuilder = $('#fb-editor').formBuilder(options);
        @if (old('form'))
            var formData = {!! json_encode(old("form")) !!};
            setTimeout(function(){ formBuilder.actions.setData(formData); }, 600);
        @endif

        $('#button-save').click(function() {
            var data = formBuilder.actions.getData();
            $("#input-form").val(JSON.stringify(data));

            $("#form-questionary").submit();
        })

        $('#button-preview').click(function() {
            $('#rendering').formRender({
                dataType: 'json',
                formData: formBuilder.actions.getData('json')
            });
        })
    </script>
@endsection
