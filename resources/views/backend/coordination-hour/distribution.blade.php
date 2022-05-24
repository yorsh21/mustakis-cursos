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
                                <div class="form-group {{ $errors->has('period_id') ? 'has-error' : ''}}">
                                    <select name="period_id" class="form-control" required>
                                        <option value="">-- Seleccione un Periodo --</option>
                                        @foreach ($periods as $period)
                                            <option value="{{ $period->id }}">{{ $period->description }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('period_id', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="form-group {{ $errors->has('campus_id') ? 'has-error' : ''}}">
                                    <select name="campus_id" class="form-control" required>
                                        <option value="">-- Selecione una Sede --</option>
                                        @foreach ($campus as $camp)
                                            <option value="{{ $camp->id }}">{{ $camp->name }}</option>
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
@endsection