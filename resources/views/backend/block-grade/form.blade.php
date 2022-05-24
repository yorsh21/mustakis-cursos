<div class="form-group {{ $errors->has('comment') ? 'has-error' : ''}}">
    <label for="comment" class="col-md-4 control-label">{{ 'Comment' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="comment" type="text" id="comment" value="{{ $blockgrade->comment or ''}}" >
        {!! $errors->first('comment', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
    <label for="start_date" class="col-md-4 control-label">{{ 'Start Date' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="start_date" type="datetime-local" id="start_date" value="{{ $blockgrade->start_date or ''}}" >
        {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
    <label for="end_date" class="col-md-4 control-label">{{ 'End Date' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="end_date" type="datetime-local" id="end_date" value="{{ $blockgrade->end_date or ''}}" >
        {!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('block_id') ? 'has-error' : ''}}">
    <label for="block_id" class="col-md-4 control-label">{{ 'Block Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="block_id" type="number" id="block_id" value="{{ $blockgrade->block_id or ''}}" >
        {!! $errors->first('block_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('grade_id') ? 'has-error' : ''}}">
    <label for="grade_id" class="col-md-4 control-label">{{ 'Grade Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="grade_id" type="number" id="grade_id" value="{{ $blockgrade->grade_id or ''}}" >
        {!! $errors->first('grade_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('room_id') ? 'has-error' : ''}}">
    <label for="room_id" class="col-md-4 control-label">{{ 'Room Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="room_id" type="number" id="room_id" value="{{ $blockgrade->room_id or ''}}" >
        {!! $errors->first('room_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
    </div>
</div>
