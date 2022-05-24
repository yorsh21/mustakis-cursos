@extends('layouts.survey')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('message')[0] }}" role="alert">
                    {{ Session::get('message')[1] }}
                </div>
            @endif

            @if(session()->has('status'))
                <div class="alert alert-info alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    {{ session('status') }}
                </div>
            @endif

            <div class="panel panel-default">
            <div class="panel-heading">Formulario de Postulación a {{ $postulation->school_workshop->name }}</div>

                <div class="panel-body">
                    <div class="tabs-container">
                        <a href="{{ route('request.postulation') }}" title="Atrás">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>
                        </a><br><br>

                        <div class="tabs-left">
                            <ul class="nav nav-tabs">
                                <li id="main-tab" class="active"><a data-toggle="tab" href="#tab-0" aria-expanded="false">Inscripción</a></li>
                                @foreach ($questionnaires as $questionary)
                                    <li class="tab-restrict">
                                        <a id="link-{{ $loop->iteration }}" data-toggle="tab" href="#tab-{{ $loop->iteration }}" aria-expanded="false">
                                            {{ ucfirst($questionary->name) }} 
                                            <i class="fa fa-check hidden" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                <div id="tab-0" class="tab-pane active">
                                    <div class="panel-body">
                                        <h2>{{ $postulation->school_workshop->name }}</h2>
                                        <p>{{ $postulation->period->name }}</p>
                                        <p>{{ $postulation->school_workshop->description }}</p>

                                        <br>
                                        <p><b>Inicio:</b> {{ $postulation->start }}</p>
                                        <p><b>Término:</b> {{ $postulation->end }}</p>
                                        <br>
                                        @if ($postulation->documents)
                                            <p id="message-request">Primero debes subir los documentos de postulación y luego contestar los formularios para postular a este taller.</p>
                                            @if(Auth::user()->is_fill_documentacion_data)
                                                <a type="button" href="{{ route('user.documentacion.form') }}" class=" btn btn-primary btn-md">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                    Documentación
                                                </a><br><br>
                                            @else
                                                <a type="button" href="{{ route('user.documentacion.form') }}" class=" btn btn-default btn-md">
                                                    <i class="fa fa-genderless" aria-hidden="true"></i>
                                                    Documentación
                                                </a><br><br>
                                            @endif
                                        @else
                                            <p id="message-request">Debes contestar los formularios de postulación para postular a este taller.</p>
                                        @endif

                                        <form id="form-request" class="form" method="POST" action="{{ route('request.store') }}" accept-charset="UTF-8">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="postulation_id" value="{{ $postulation->id }}">
                                            <button id="submit-request" class="btn btn-large btn-primary" data-btn-ok-class="btn-success" type="submit" title="Postular a taller" disabled>
                                                <i class="fa fa-send" aria-hidden="true"></i> 
                                                Enviar solicitud de postulación 
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @foreach ($questionnaires as $questionary)
                                    <div id="tab-{{ $loop->iteration }}" class="tab-pane">
                                        <div class="panel-body">
                                            <h2>{{ ucfirst($questionary->name) }}</h2>
                                            <p>{{ ucfirst($questionary->description) }}</p><hr>

                                            <form id="form-{{ $loop->iteration }}" method="POST" action="{{ route('request.survey', [$questionary->id, $postulation->id]) }}" accept-charset="UTF-8">
                                                {{ csrf_field() }}
                                                <div id="fb-viewer-{{ $loop->iteration }}"></div>
                                                <input id="submit-{{ $loop->iteration }}" type="submit" class="btn btn-primary" value="Guardar">
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
        </div>
    </div>
@endsection


@section("scripts")
    <script>
        var questionnaires = {{ count($questionnaires) }};
        var answered = 0;
        var documents = {{ $postulation->documents ? "false" : "true" }};

        if(questionnaires == answered) {
            $("#submit-request").attr("disabled", false);
            $("#message-request").hide();
        }

        $(".tab-restrict").click(function(e) {
            if(!documents) {
                e.preventDefault();

                $.get("{{ route('request.fill.documents', Auth::user()->id) }}", function(data) {
                    if(data["fill"]) {
                        documents = true;
                    }
                    else {
                        $("#main-tab > a").click();
                        alert("Debes subir los documentos solicitados para contestar las encuestas.")
                        $("#main-tab > a").click();
                    }
                })
            }
        });


        $("#form-request").submit(function(e) {
            if(!documents) {
                e.preventDefault();
                var form = $(this);

                $.get("{{ route('request.fill.documents', Auth::user()->id) }}", function(data) {
                    if(data["fill"]) {
                        documents = true;
                        form.submit();
                    }
                    else {
                        alert("Debes subir los documentos solicitados para postular a este taller.")
                    }
                })
            }
        });

        $(document).ready(function() {
            @foreach ($questionnaires as $questionary)
                var data{{ $loop->iteration }} = '{{ json_encode($questionary->form) }}'.replace(/&quot;/g, '"');
                
                $('#fb-viewer-{{ $loop->iteration }}').formRender({
                    dataType: 'json',
                    formData: data{{ $loop->iteration }}
                });

                $("#form-{{ $loop->iteration }}").submit(function(e) {
                    e.preventDefault();
                    var data = $(this).serialize();
                    var url = $(this).attr('action');

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: data,
                        dataType: 'json',
                        success: function (res) {
                            var response = JSON.parse(JSON.stringify(res));
                            
                            if(response["status"] == 1) {
                                answered++;
                                $("#link-{{ $loop->iteration }} > i").removeClass("hidden");
                                $("#submit-{{ $loop->iteration }}").prop("disabled", true);
                            }

                            if(questionnaires == answered) {
                                $("#submit-request").attr("disabled", false);
                                alert("Ya completaste todos los cuestionarios, ahora estas listo para enviar tu solicitud de postulación.");
                                $("#main-tab > a").click();
                            }
                        },
                    });
                    
                });


            @endforeach
        })
    </script>
@endsection