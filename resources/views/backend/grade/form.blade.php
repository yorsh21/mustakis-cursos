<div class="form-group {{ $errors->has('capacity') ? 'has-error' : ''}}">
    <label for="capacity" class="col-md-4 control-label">Capacidad</label>
    <div class="col-md-6">
        <input class="form-control" name="capacity" type="number" id="capacity" value="{{ $grade->capacity or ''}}" min='0'>
        {!! $errors->first('capacity', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="col-md-4 control-label">Tipo</label>
    <div class="col-md-6">
        <input class="form-control" name="type" type="text" id="type" value="{{ $grade->type or ''}}">
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
    <label for="start_date" class="col-md-4 control-label">Fecha de inicio</label>
    <div class="col-md-6">
        <input class="form-control" name="start_date" type="date" id="start_date" value="{{ $grade->start_date or ''}}" required>
        {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
    <label for="end_date" class="col-md-4 control-label">Fecha de Término</label>
    <div class="col-md-6">
        <input class="form-control" name="end_date" type="date" id="end_date" value="{{ $grade->end_date or ''}}" required>
        {!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div id="select_taller" class="form-group {{ $errors->has('school_workshop_id') ? 'has-error' : ''}}">
    <label for="school_workshop_id" class="col-md-4 control-label">Taller</label>
    <div class="col-md-6">
        <select class="form-control" id="school_workshop_id" name="school_workshop_id" {{ isset($grade) ? "readonly" : "" }} required>
            @isset($grade)
                @foreach($schoolworkshops as $schoolworkshop)
                    @if($schoolworkshop->id == $grade->school_workshop_id)
                        <option value="{{ $schoolworkshop->id }}" "selected">{{ $schoolworkshop->name }}</option>
                        @break
                    @endif
                @endforeach
            @else
                <option value="" name="">--- Elige un Taller ---</option>
                @foreach($schoolworkshops as $schoolworkshop)
                    <option value="{{ $schoolworkshop->id }}">{{ $schoolworkshop->name }}</option>
                @endforeach
            @endisset
        </select>
        {!! $errors->first('school_workshop_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@roles("Coordinador")
    @foreach($campus as $item)
        @if ($item->commune_id == Auth::user()->city_assist_workshop)
            <input type="hidden" name="campus_id" value="{{ $item->id }}">
            @break
        @endif
    @endforeach
@else
<div class="form-group {{ $errors->has('campus_id') ? 'has-error' : ''}}">
    <label for="campus_id" class="col-md-4 control-label">Sede</label>
    <div class="col-md-6">
        <select class="form-control" id="campus_id" name="campus_id" required>
            <option value="" name="">--- Elige una Sede ---</option>
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
@endroles
<div class="form-group {{ $errors->has('period_id') ? 'has-error' : ''}}">
    <label for="period_id" class="col-md-4 control-label">Período</label>
    <div class="col-md-6">
        <select class="form-control" id="period_id" name="period_id" required>
            <option value="" name="">--- Elige un Período ---</option>
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

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
    </div>
</div>
