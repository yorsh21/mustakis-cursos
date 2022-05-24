<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="col-md-4 control-label">Número</label>
    <div class="col-md-6">
        <input class="form-control" name="number" type="text" id="number" value="{{ $room->number or ''}}" >
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('capacity') ? 'has-error' : ''}}">
    <label for="capacity" class="col-md-4 control-label">Capacidad</label>
    <div class="col-md-6">
        <input class="form-control" name="capacity" type="number" id="capacity" value="{{ $room->capacity or ''}}" >
        {!! $errors->first('capacity', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@isset($campus_id)
    <input name="campus_id" type="hidden" id="campus_id" value="{{ $campus_id }}" >
@else
    <input name="campus_id" type="hidden" id="campus_id" value="{{ $room->campus_id }}" >
@endisset

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
    </div>
</div>
