@extends('layouts.backend')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Estadística de Asistencia</div>
                    <div class="panel-body">
                        <div class="ibox float-e-margins">
                            <form id="filter-statistics-assistance" action="{{ route('statistics.filter.asistencia') }}" method="POST" class="form-inline">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Filtros </label>
                                </div>
                                <div class="form-group">
                                    <select name="period" id="period" class="form-control">
                                        <option value="">Todos los periodos</option>
                                        @foreach ($periods as $period)
                                            <option value="{{ $period->id }}">{{ $period->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="campus" id="campus" class="form-control">
                                        <option value="">Todas las sedes</option>
                                        @foreach ($campus as $camp)
                                            <option value="{{ $camp->id }}">{{ $camp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="form-control" value="Aceptar">
                                </div>
                            </form>
                            <div class="ibox-content m-t-lg">
                                <div id="contentChart">
                                    <canvas id="gradesChart" height="140"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

