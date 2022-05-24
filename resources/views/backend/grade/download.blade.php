@extends('layouts.backend')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Lista de Curso</div>
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
                                                    <th rowspan="2">Nombre</th>
                                                    <th rowspan="2">Apellido</th>
                                                    <th rowspan="2">Teléfono</th>
                                                    <th rowspan="2">Correo</th>
                                                    <th rowspan="2">Bitacora</th>
                                                    <th colspan="{{ $block }}">Sesiones</th>
                                                </tr>
                                                <tr>
                                                @for ($i = 1; $i <= $block; $i++)
                                                    <th>Nota {{ $i }}</th>
                                                @endfor
                                                @for ($i = 1; $i <= $block; $i++)
                                                    <th>Asistencia {{ $i }}</th>
                                                @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($grade->division_users as $item)
                                                    @if ($item->rol == 4)
                                                        <tr>
                                                            <td>{{ $item->user->firstname }}</td>
                                                            <td>{{ $item->user->lastname }}</td>
                                                            <td>{{ $item->user->phone_number }}</td>
                                                            <td>{{ $item->user->email }}</td>
                                                            <td>{{ $item->binnacle }}</td>
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
                                                        </tr>
                                                    @endif
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
