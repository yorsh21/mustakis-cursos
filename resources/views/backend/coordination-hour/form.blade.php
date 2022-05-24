<div class="form-group {{ $errors->has('hours') ? 'has-error' : ''}}">
    <label for="hours" class="col-md-4 control-label">Horas</label>
    <div class="col-md-6">
        <input class="form-control" name="hours" type="number" id="hours" value="{{ $coordination_hour->hours or ''}}" min="0" required>
        {!! $errors->first('hours', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('period_id') ? 'has-error' : ''}}">
    <label for="period_id" class="col-md-4 control-label">Período</label>
    <div class="col-md-6">
        <select class="form-control" id="period_id" name="period_id" required>
            <option value="" name="">--- Elige un Período ---</option>
            @isset($coordination_hour)
                @foreach($periods as $period)
                    <option value="{{ $period->id }}" {{ $period->id == $coordination_hour->period_id ? 'selected' : '' }}>{{ $period->name }}</option>
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
<div class="form-group {{ $errors->has('campus_id') ? 'has-error' : ''}}">
    <label for="campus_id" class="col-md-4 control-label">Sede</label>
    <div class="col-md-6">
        <select class="form-control" id="campus_id" name="campus_id" required>
            <option value="" name="">--- Elige una Sede ---</option>
            @isset($coordination_hour)
                @foreach($campus as $item)
                    <option name="{{ $item->school_workshop_id }}" value="{{ $item->id }}" {{ $item->id == $coordination_hour->campus_id ? 'selected' : '' }}>{{ $item->name }}</option>
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

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
    </div>
</div>
