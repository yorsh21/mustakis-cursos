@extends('layouts.backend')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Resumen del Curso</div>
                    <div class="panel-body">
                        <a href="{{ route('grade.show', $grade->id) }}" title="Atrás">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>
                        </a>
                        <br><br>
                        
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                    <th>Bitacora</th>
                                                    <th>Promedio de Notas</th>
                                                    <th>Porcentaje de Asistencia</th>
                                                    <th>Resultado</th>
                                                    @roles("Administrador")
                                                    @if (!$grade->archived)
                                                        <th>Cambiar Resultado</th>
                                                    @endif
                                                    @endroles
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($grade->division_users as $item)
                                                    @if ($item->rol == 4)
                                                        <tr>
                                                            <td>{{ $item->user->firstname }}</td>
                                                            <td>{{ $item->user->lastname }}</td>
                                                            <td>{{ $item->binnacle }}</td>
                                                            <td>{{ $item->average_notes }}</td>
                                                            <td>{{ $item->attendance_percentage . " %"}}</td>
                                                            @if ($grade->archived)
                                                                <td>{{ $item->post_result }}</td>
                                                            @else
                                                                <td>{{ $item->result }}</td>
                                                            @endif
                                                            @roles("Administrador")
                                                                @if (!$grade->archived)
                                                                <td>
                                                                    @if ($item->approve)
                                                                        <div class="dropdown dropdown-approve">
                                                                            <button class="btn btn-success btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                                <i class="fa fa-bookmark" aria-hidden="true"></i> 
                                                                                <span class="name-approve">Aprueba</span>
                                                                                <span class="caret"></span>
                                                                            </button>
                                                                            <ul class="dropdown-menu">
                                                                                <li data-id="{{ $item->id }}" data-approve="1">Aprobar</li>
                                                                                <li data-id="{{ $item->id }}" data-approve="0">Reprobar</li>
                                                                            </ul>
                                                                        </div>
                                                                    @else
                                                                        <div class="dropdown dropdown-approve">
                                                                            <button class="btn btn-success btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                                <i class="fa fa-bookmark" aria-hidden="true"></i> 
                                                                                <span class="name-approve">Reprueba</span>
                                                                                <span class="caret"></span>
                                                                            </button>
                                                                            <ul class="dropdown-menu">
                                                                                <li data-id="{{ $item->id }}" data-approve="1">Aprobar</li>
                                                                                <li data-id="{{ $item->id }}" data-approve="0">Reprobar</li>
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                @endif
                                                            @endroles
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                @roles("Administrador")
                                    @unless($grade->archived)
                                        <form method="POST" action="{{ route('grade.close') }}" accept-charset="UTF-8">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="grade_id" value="{{ $grade->id }}">
                                            <input type="hidden" id="approves" name="approves" value="">
                                            <button type="submit" class="btn btn-danger" title="Eliminar Curso" onclick="return confirm('¿Deseas finalizar este curso?')">
                                                <i class="fa fa-file-archive-o" aria-hidden="true"></i>
                                                Finalizar curso
                                            </button>
                                        </form>
                                    @endunless
                                @endroles
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            var changes = {};
            var approves = $("#approves");
            $(".dropdown-approve li").click(function(e) {
                var text = $(this).text();
                var button = $(this).parent().parent().find("button");
                button.removeClass("btn-success");
                button.addClass("btn-warning");
                button.find(".name-approve").text(text);
                changes[$(this).data("id")] = $(this).data("approve");
                approves.val(JSON.stringify(changes));
            });
        });
        
    </script>
@endsection