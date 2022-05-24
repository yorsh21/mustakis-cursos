@extends('layouts.backend')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Estadísticas de Postulaciones</div>
                    <div class="panel-body">
                        <div class="ibox float-e-margins">
                            <form id="filter-statistics-postulation" action="{{ route('statistics.filter.postulacion') }}" method="POST" class="form-inline">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Filtros </label>
                                </div>
                                <div class="form-group">
                                    <select name="period" id="period" class="form-control">
                                        @foreach ($periods as $period)
                                            <option value="{{ $period->id }}">{{ $period->description }}</option>
                                        @endforeach
                                    </select>
                                    {{--
                                    <select name="postulation" id="postulation" class="form-control">
                                        <option value="">Todos los procesos de postulación</option>
                                        @foreach ($postulations as $postulation)
                                            <option value="{{ $postulation->id }}">{{ $postulation->school_workshop->name . " - " . $postulation->period->name }}</option>
                                        @endforeach
                                    </select>
                                    --}}
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="form-control" value="Aceptar">
                                </div>
                            </form>
                            <div class="ibox-content m-t-lg">
                                <div id="contentChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

