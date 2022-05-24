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
                            <label for="name" class="col-md-4 control-label">Nombre del Certificado</label>
                            <div class="col-md-6">
                                <input class="form-control" name="name" type="text" value="{{ $certificate->name or ''}}" required>
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
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
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="background">Imagen de Fondo</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="background" placeholder="Subir imagen" oninput='validateFileSize(this)'>
                                {!! $errors->first('background', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-4">
                                <div class="checkbox">
                                    <label><input id="prop-name" type="checkbox" name="properties[]" value="name">Nombre</label><br><br>
                                    <label><input id="prop-email" type="checkbox" name="properties[]" value="email">Correo</label><br><br>
                                    <label><input id="prop-rut" type="checkbox" name="properties[]" value="rut">RUT</label><br><br>
                                    <label><input id="prop-birth_date" type="checkbox" name="properties[]" value="birth_date">Fecha de Nacimiento</label><br><br>
                                    <label><input id="prop-genere" type="checkbox" name="properties[]" value="genere">Genero</label><br><br>
                                    <label><input id="prop-phone_number" type="checkbox" name="properties[]" value="phone_number">Teléfono</label><br><br>
                                    <label><input id="prop-address" type="checkbox" name="properties[]" value="address">Dirección</label><br><br>
                                    <label><input id="prop-commune" type="checkbox" name="properties[]" value="commune">Comuna</label><br><br>
                                    <label><input id="prop-region" type="checkbox" name="properties[]" value="region">Región</label><br><br>
                                    <label><input id="prop-course" type="checkbox" name="properties[]" value="course">Curso</label><br><br>
                                    <label><input id="prop-establishment" type="checkbox" name="properties[]" value="establishment">Colegio</label><br><br>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <input id="field0" type="text" name="fields[]" class="form-control fields-n" placeholder="Campo 0">
                                <input id="field1" type="text" name="fields[]" class="form-control fields-n" placeholder="Campo 1">
                                <input id="field2" type="text" name="fields[]" class="form-control fields-n" placeholder="Campo 2">
                                <input id="field3" type="text" name="fields[]" class="form-control fields-n" placeholder="Campo 3">
                                <input id="field4" type="text" name="fields[]" class="form-control fields-n" placeholder="Campo 4">
                                <input id="field5" type="text" name="fields[]" class="form-control fields-n" placeholder="Campo 5">
                                <input id="field6" type="text" name="fields[]" class="form-control fields-n" placeholder="Campo 6">
                                <input id="field7" type="text" name="fields[]" class="form-control fields-n" placeholder="Campo 7">
                                <input id="field8" type="text" name="fields[]" class="form-control fields-n" placeholder="Campo 8">
                                <input id="field9" type="text" name="fields[]" class="form-control fields-n" placeholder="Campo 9">
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

                    <div id="certificate-background" class="ui-widget-content"></div>

                </div>
            </div>
        </div>
    </div>
    <br><br><br>
@endsection


@section('scripts')
    <script type="text/javascript">
        let dataCert = {};
        let properties = [];
        let fields = [];

        function update_coordinates() {
            let count = 0;

            dataCert.properties.forEach(element => {
                if(element.text != null) {
                    element.y_pos = properties[count].position().top + "px";
                    element.x_pos = properties[count].position().left + "px";
                    element.width = properties[count].width() + "px";
                    element.height = properties[count].height() + "px";

                    count ++;
                }
            });

            count = 0;

            dataCert.fields.forEach(element => {
                if(element.text != null) {
                    element.y_pos = fields[count].position().top + "px";
                    element.x_pos = fields[count].position().left + "px";
                    element.width = fields[count].width() + "px";
                    element.height = fields[count].height() + "px";

                    count ++;
                }
            });
        }

        function design_background(data) {
            dataCert = data;

            let public_path = "{{ asset('certificates') }}/" + data.background;
            let certificate_background = $("#certificate-background");

            data.properties.forEach(element => {
                if(element.text != null) {
                    certificate_background.append(`<div id="${element.name}" class="certificate-draggable">${element.text}</div>`);
                    
                    let property = $("#" + element.name);
                    properties.push(property);
                    
                    property.css("top", element.y_pos);
                    property.css("left", element.x_pos);
                    property.css("width", element.width);
                    property.css("height", element.height);
                    property.css("font-size", element.size);
                    property.css("color", element.color);
                }
            });

            data.fields.forEach(element => {
                if(element.text != null) {
                    certificate_background.append(`<div id="field-${element.name}" class="certificate-draggable">${element.text}</div>`);
                    
                    let field = $("#field-" + element.name);
                    fields.push(field);

                    field.css("top", element.y_pos);
                    field.css("left", element.x_pos);
                    field.css("width", element.width);
                    field.css("height", element.height);
                    field.css("font-size", element.size);
                    field.css("color", element.color);
                }
            });

            let certificate_draggable = $(".certificate-draggable");
            let design_background = $("#design-background");

            certificate_draggable.draggable({ 
                containment: "#certificate-background",
                stop: function() {
                    update_coordinates();
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

            update_coordinates();
        }


        $(document).ready(function() {
            @if(isset($certificate))
                @foreach($certificate->properties as $prop)
                    @if(!is_null($prop['text']))
                        $("#prop-{{ $prop['name'] }}").prop("checked", true);
                    @endif
                @endforeach

                @foreach($certificate->fields as $field)
                    $("#{{ $field['name'] }}").val("{{ $field['text'] }}");
                @endforeach
            @endif
            
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
                        design_background(response.certificate);
                    }
                });
            });

            $("#certificate-update").submit(function(e) {
                e.preventDefault();

                var method = $(this).attr("method");
                var url = $(this).attr("action") + "/" + dataCert._id;
                var data = new FormData(this);
                console.log(data)

                data.append("certificate", JSON.stringify(dataCert));

                /*Object.keys(dataCert).forEach(function (key) {
                    data.append(key, dataCert[key]);
                });*/

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