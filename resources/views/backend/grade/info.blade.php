@extends('layouts.backend')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Cursos</div>
                    <div class="panel-body">
                        <h2>Descargando...</h2>
                        <div style="visibility: hidden;" class="ibox float-e-margins">
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <div id="DataTables_Table_0_wrapper"
                                         class="dataTables_wrapper form-inline dt-bootstrap">
                                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">Rol</th>
                                                    <th rowspan="2">Nombre</th>
                                                    <th rowspan="2">Apellido</th>
                                                    <th rowspan="2">RUT</th>
                                                    <th rowspan="2">Género</th>
                                                    <th rowspan="2">Taller</th>
                                                    <th rowspan="2">Sede</th>
                                                    <th rowspan="2">Colegio</th>
                                                    <th rowspan="2">Comuna</th>
                                                    <th rowspan="2">Curso</th>
                                                    <th rowspan="2">Bitacora</th>
                                                    <th rowspan="2">Promedio de Notas</th>
                                                    <th rowspan="2">Porcentaje de Asistencia</th>
                                                    <th rowspan="2">Resultado</th>
                                                    <th colspan="{{ $blocks }}">Sesiones</th>
                                                </tr>
                                                <tr>
                                                @for ($i = 1; $i <= $blocks; $i++)
                                                    <th>Nota {{ $i }}</th>
                                                @endfor
                                                @for ($i = 1; $i <= $blocks; $i++)
                                                    <th>Asistencia {{ $i }}</th>
                                                @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($grades as $grade)
                                                @foreach($grade->division_users as $item)
                                                    <tr>
                                                        <td>{{ $item->user->rol->name }}</td>
                                                        <td>{{ $item->user->firstname }}</td>
                                                        <td>{{ $item->user->lastname }}</td>
                                                        <td>{{ $item->user->rut }}</td>
                                                        <td>{{ $item->user->gender }}</td>
                                                        <td>{{ $grade->school_workshop->name }}</td>
                                                        <td>{{ $grade->campus->name }}</td>
                                                        <td>{{ $item->user->name_establishment }}</td>
                                                        <td>{{ $item->user->commune->name }}</td>
                                                        <td>{{ $item->user->course }}</td>
                                                        <td>{{ $item->binnacle }}</td>
                                                        <td>{{ $item->average_notes }}</td>
                                                        <td>{{ $item->attendance_percentage . " %"}}</td>
                                                        <td>{{ $item->result }}</td>
                                                        @foreach($grade->block_grades as $block)
                                                            @foreach($block->block_grade_users as $block_grade_user)
                                                                @if ($block_grade_user->division_user_id == $item->id)
                                                                    <td>{{ $block_grade_user->score }}</td>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                        @php $contador = 0; @endphp
                                                        @foreach($grade->block_grades as $block)
                                                            @foreach($block->block_grade_users as $block_grade_user)
                                                                @if ($block_grade_user->division_user_id == $item->id)
                                                                    <td>{{ $block_grade_user->presence }}</td>
                                                                    @php $contador += 1; @endphp
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                        @for ($i = $contador; $i < $blocks; $i++)
                                                            <td></td>
                                                            <td></td>
                                                        @endfor
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
            setTimeout(function(){ $('.buttons-excel').click(); }, 1500);
            setTimeout(function(){ window.close(); }, 3000);
        });
        
    </script>
@endsection
