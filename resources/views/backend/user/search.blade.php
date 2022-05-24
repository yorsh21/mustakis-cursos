@extends('layouts.backend')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $names }}</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                @roles('Administrador')
                                    <a href="{{ route('user.crear', $rol_id) }}" class="btn btn-success btn-sm" title="Ingresar manualmente">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Ingresar manualmente
                                    </a>
                                    <a href="{{ route('user.list', $rol_id) }}" class="btn btn-primary btn-sm" title="Información por Rol" target="_blank">
                                        <i class="fa fa-list-o" aria-hidden="true"></i> Mostrar todos los {{ $names }} 
                                    </a>
                                @endroles
                                @roles('Coordinador')
                                    @if ($rol_id == 5)
                                        <a href="{{ route('user.crear', $rol_id) }}" class="btn btn-success btn-sm" title="Ingresar manualmente">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Ingresar manualmente
                                        </a>
                                    @endif
                                @endroles
                            </div>

                            <div class="col-md-7 col-sm-12">
                                <h2>Filtros</h2>
                                <form class="form" action="{{ route('user.search.list') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="rol" value="{{ $rol_id }}">
                                    <div class="form-group form-space {{ $errors->has('campus_id') ? 'has-error' : ''}}">
                                        <label for="campus_id" class="col-md-4 control-label">Sede</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="campus_id" name="campus_id" >
                                                <option value="" name="">Seleccione Sede</option>
                                                @isset($grade)
                                                    @foreach($campus as $item)
                                                        <option name="{{ $item->school_workshop_id }}" value="{{ $item->id }}" {{ $item->id == $grade->campus_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach($campus as $item)
                                                        <option name="{{ $item->school_workshop_id }}" value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            {!! $errors->first('campus_id', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group form-space {{ $errors->has('period_id') ? 'has-error' : ''}}">
                                        <label for="period_id" class="col-md-4 control-label">Período</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="period_id" name="period_id" >
                                                <option value="" name="">Seleccione Período</option>
                                                @isset($grade)
                                                    @foreach($periods as $period)
                                                        <option value="{{ $period->id }}" {{ $period->id == $grade->period_id ? 'selected' : '' }}>{{ $period->name }}</option>
                                                    @endforeach
                                                @else
                                                    @foreach($periods as $period)
                                                        <option value="{{ $period->id }}">{{ $period->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            {!! $errors->first('period_id', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group form-space {{ $errors->has('school_workshop_id') ? 'has-error' : ''}}">
                                        <label for="school_workshop_id" class="col-md-4 control-label">Taller</label>
                                        <div class="col-md-8">
                                            <select class="form-control" id="school_workshop_id" name="school_workshop_id" {{ isset($grade) ? "readonly" : "" }} >
                                                @isset($grade)
                                                    @foreach($schoolworkshops as $schoolworkshop)
                                                        @if($schoolworkshop->id == $grade->school_workshop_id)
                                                            <option value="{{ $schoolworkshop->id }}" "selected">{{ $schoolworkshop->name }}</option>
                                                            @break
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <option value="" name="">Seleccione Taller</option>
                                                    @foreach($schoolworkshops as $schoolworkshop)
                                                        <option value="{{ $schoolworkshop->id }}">{{ $schoolworkshop->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            {!! $errors->first('school_workshop_id', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group form-space">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-success btn-md">Buscar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                            <div class="col-md-5 col-sm-12">
                                <h2>Búsqueda</h2>
                                <div class="ibox-content-AA"><br>
                                    <form class="form" action="{{ route('user.search.list') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="rol" value="{{ $rol_id }}">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Buscar" name="search" minlength="3" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-md">Buscar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
