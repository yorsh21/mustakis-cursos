@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                @isset($certificate)
                    <div class="panel-heading">Editar Certificado {{ $certificate->name }}</div>
                @else
                    <div class="panel-heading">Crear nuevo Certificado</div>
                @endif
                <div class="panel-body">
                    <a href="{{ route('certificate.index') }}" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                @isset($certificate)
                    <form method="POST" action="{{ route('certificate.update', $certificate->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="certificate-create">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                @else
                    <form method="POST" action="{{ route('certificate.store') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="certificate-create">
                        {{ csrf_field() }}
                @endisset

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>
                            <div class="col-md-6">
                                <input class="form-control" name="name" type="text" value="{{ $certificate->name or ''}}" required>
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                            <label for="description" class="col-md-4 control-label">Descripción</label>
                            <div class="col-md-6">
                                <input class="form-control" name="description" type="text" value="{{ $certificate->description or ''}}" required>
                                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('horizontal') ? 'has-error' : ''}}">
                            <label for="horizontal" class="col-md-4 control-label">Orientación</label>
                            <div class="col-md-6">
                                <select class="form-control" name="horizontal" id="orientation" required>
                                    <option value="0">Vertical</option>
                                    <option value="1" {{ (isset($certificate) && $certificate->horizontal) ? "selected" : "" }}>Horizontal</option>
                                </select>
                                {!! $errors->first('horizontal', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
                            <label for="date" class="col-md-4 control-label">Fecha</label>
                            <div class="col-md-6">
                                <input class="form-control" name="date" type="date" value="{{ $certificate->date or ''}}" required>
                                {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="background">Imágen de Fondo</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="background" placeholder="Subir imágen" oninput='validateFileSize(this)'>
                                {!! $errors->first('background', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                <input class="btn btn-primary" type="submit" value="Continuar">
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <div id="design-background" class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Diseñar Certificado</div>
                <div id="container-background" class="panel-body">
                    <form method="POST" action="{{ route('certificate.store') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="certificate-update">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                                
                        <div class="form-group">
                            <div class="col-md-12">
                                <input class="btn btn-primary" type="submit" value="Guardar">
                            </div>
                        </div>
                    </form>

                    <div id="certificate-background" class="ui-widget-content">
                        <div id="name" class="certificate-draggable">Nombre del Alumno</div>
                        <div id="description" class="certificate-draggable"></div>
                        <div id="date" class="certificate-draggable"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <br><br><br>
@endsection


@section('scripts')
    <script type="text/javascript">
        var idCert = 0;
        var dataCert = {
            user_top: 0,
            user_left: 0,
            user_width: 300,
            user_height: 40,
            description_top: 0,
            description_left: 0,
            description_width: 300,
            description_height: 40,
            date_top: 0,
            date_left: 0,
            date_width: 300,
            date_height: 40,
            user_size: 18,
            description_size: 18,
            date_size: 18,
            user_color: "#000000",
            description_color: "#000000",
            date_color: "#000000",
        };

        function update_coordinates(name, description, date) {
            dataCert.user_top = name.position().top;
            dataCert.user_left = name.position().left;
            dataCert.user_width = name.width();
            dataCert.user_height = name.height();

            dataCert.description_top = description.position().top;
            dataCert.description_left = description.position().left;
            dataCert.description_width = description.width();
            dataCert.description_height = description.height();

            dataCert.date_top = date.position().top;
            dataCert.date_left = date.position().left;
            dataCert.date_width = date.width();
            dataCert.date_height = date.height();
        }

        function design_background(data) {
            var public_path = "{{ asset('certificates') }}/" + data.certificate.background;
            var name = $("#name");
            var description = $("#description");
            var date = $("#date");

            idCert = data.certificate.id;

            description.text(data.certificate.description);
            date.text(data.certificate.date);

            name.css("top", data.certificate.user_top);
            description.css("top", data.certificate.description_top);
            date.css("top", data.certificate.date_top);

            name.css("left", data.certificate.user_left);
            description.css("left", data.certificate.description_left);
            date.css("left", data.certificate.date_left);

            name.css("width", data.certificate.user_width);
            description.css("width", data.certificate.description_width);
            date.css("width", data.certificate.date_width);

            name.css("height", data.certificate.user_height);
            description.css("height", data.certificate.description_height);
            date.css("height", data.certificate.date_height);

            name.css("font-size", data.certificate.user_size);
            description.css("font-size", data.certificate.description_size);
            date.css("font-size", data.certificate.date_size);

            name.css("color", data.certificate.user_color);
            description.css("color", data.certificate.description_color);
            date.css("color", data.certificate.date_color);
            
            update_coordinates(name, description, date);

            var certificate_draggable = $(".certificate-draggable");
            var certificate_background = $("#certificate-background");
            var design_background = $("#design-background");

            certificate_draggable.draggable({ 
                containment: "#certificate-background",
                stop: function() {
                    update_coordinates(name, description, date);
                }
            });
            certificate_draggable.resizable({ 
                containment: "#certificate-background"
            });
            /*$("#certificate-background").resizable({ 
                containment: "#container-background",
                animate: true,
            });*/

            if($("#orientation").val() == 0) {
                var size_width = 794 - 100;
                var size_height = 1123 - 100;
            }
            else {
                var size_width = 1123 - 100;
                var size_height = 794 - 100;
            }

            certificate_background.css("width", size_width.toString() + "px");
            certificate_background.css("height", size_height.toString() + "px");
            certificate_background.css("background-size", size_width.toString() + "px " + size_height.toString() + "px");
            certificate_background.css("background-image", `url(${public_path})`);
            design_background.css("display", "block");

            update_coordinates(name, description, date);
        }


        $(document).ready(function() {
            $("#certificate-create").submit(function(e) {
                e.preventDefault();

                var method = $(this).attr("method");
                var url = $(this).attr("action");
                var data = new FormData(this);

                $.ajax({
                    type: method,
                    url: url,
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        design_background(response);
                    }
                });
            });

            $("#certificate-update").submit(function(e) {
                e.preventDefault();

                var method = $(this).attr("method");
                var url = $(this).attr("action") + "/" + idCert;
                var data = new FormData(this);

                Object.keys(dataCert).forEach(function (key) {
                    data.append(key, dataCert[key]);
                });

                $.ajax({
                    type: method,
                    url: url,
                    data: data,
                    processData : false,
                    contentType : false,
                    success: function(response) {
                        window.location.href = "{{ route('certificate.index') }}";
                    }
                });
            });

        });
        
    </script>
@endsection