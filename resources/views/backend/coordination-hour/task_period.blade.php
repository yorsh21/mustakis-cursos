@extends('layouts.backend')

@section('content')
    <div class="wrapper wrapper-content wrapper-filters">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Filtros</strong></div>
                    <div class="panel-body">
                        <div class="ibox float-e-margins">
                            <form action="{{ route('hour.filter') }}" method="POST" class="form-inline">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Filtros </label>
                                </div>
                                <div class="form-group">
                                    <select name="period_id" class="form-control" {{ $errors->has('period_id') ? 'has-error' : ''}} required>
                                        <option value="">-- Seleccione un Periodo --</option>
                                        @foreach ($periods as $item)
                                            @if ($item->id == $period->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->description }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->description }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    {!! $errors->first('period_id', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="form-group">
                                    <select name="campus_id" class="form-control" {{ $errors->has('campus_id') ? 'has-error' : ''}} required>
                                        <option value="">-- Seleecione una Sede --</option>
                                        @foreach ($campus as $item)
                                            @if ($item->id == $campu->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    {!! $errors->first('campus_id', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="form-control" value="Aceptar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>{{ $period->name }} / Sede {{ $campu->name }}</strong></div>
                    <div class="panel-body">
                        @if (is_null($coordination_hour))
                            <p>No hay horas de coordinación para este periodo y/o sede</p>
                        @else
                            <div class="ibox float-e-margins">
                                <p><strong>Horas de Coordinación del Periodo: </strong> {{ $coordination_hour->hours }}</p>
                                <p><strong>Horas Asignadas: </strong> <span id="horas-asignadas">0</span></p>
                                <p><strong>Horas por Asignar: </strong> <span id="horas-restantes">0</span></p>
                                
                                <form action="{{ route('task.period.store') }}" method="POST" class="form-inline">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="coordination_hour" value="{{ $coordination_hour->id }}">
                                    <div class="form-group">
                                        <input id="submit-hours" type="submit" class="btn btn-warning" title="Guardar horas de coordinación" onclick="return confirm('¿Estas seguro de que deseas guardar todas las horas de coordinación? Estas no podrán ser modificadas posteriormente')" value="Guardar horas de coordinación" disabled>
                                    </div>

                                    <br>

                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                                <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>Descripción</th>
                                                            <th>Horas de Coordinación</th>
                                                            <th>Mentor Encargado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($tasks as $task)
                                                        @php
                                                            $tasks_periods_hours = $task->task_periods->where('task_id', $task->id)->where('coordination_hour_id', $coordination_hour->id);
                                                            $count_hours = $tasks_periods_hours->sum(function($task_period) {
                                                                return $task_period->hours;
                                                            });
                                                            //dd($tasks_periods_hours);
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $task->name }}</td>
                                                            <td>{{ $task->description }}</td>
                                                            <td>
                                                                <input type="hidden" name="tasks[]" value="{{ $task->id }}" {{ $assigned }}>
                                                                <input class="form-control hours-inputs" type="number" name="hour{{ $task->id }}" min="0" value="{{ $count_hours or "0" }}" {{ $assigned }}>
                                                            </td>
                                                            <td>
                                                                <select class="form-control" name="users{{ $task->id }}[]" {{ $assigned }} multiple>
                                                                    @foreach($users as $user)
                                                                        @if ($tasks_periods_hours->search(function($value, $key) use(&$user) {
                                                                            return $user->id == $value->user->id;
                                                                        }))
                                                                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                                                        @else
                                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        $(document).ready(function() {
            function contar_horas(){
                horas_asignadas = 0
                $(".hours-inputs").each(function() {
                    horas_asignadas += parseInt($(this).val());
                });
                input_asignadas.text(horas_asignadas);
                input_restantes.text(horas_periodo - horas_asignadas);

                if(horas_periodo > horas_asignadas) {
                    input_asignadas.css("color", "#676a6c");
                    input_restantes.css("color", "#676a6c");
                    input_submit.prop('disabled', true);
                }
                else if(horas_periodo == horas_asignadas) {
                    input_submit.prop('disabled', false);
                    input_asignadas.css("color", "#676a6c");
                    input_restantes.css("color", "#676a6c");
                }
                else {
                    input_asignadas.css("color", "#ED5565");
                    input_restantes.css("color", "#ED5565");
                    input_submit.prop('disabled', true);
                }
            }

            var input_asignadas = $("#horas-asignadas");
            var input_restantes = $("#horas-restantes");
            var input_submit = {!! empty($assigned) ? '$("#submit-hours")' : '""' !!};

            var horas_asignadas = 0;
            var horas_periodo = {{ $coordination_hour->hours or '' }};
            
            contar_horas();

            $(".hours-inputs").change(function() {
                contar_horas();
            });

        });
    </script>
@endsection