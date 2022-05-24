<div class="form-group {{ $errors->has('presence') ? 'has-error' : ''}}">
    <label for="presence" class="col-md-4 control-label">{{ 'Presence' }}</label>
    <div class="col-md-6">
        <div class="radio">
    <label><input name="{{ presence }}" type="radio" value="1" {{ (isset($blockgradeuser) && 1 == $blockgradeuser->presence) ? 'checked' : '' }}> Yes</label>
</div>
<div class="radio">
    <label><input name="{{ presence }}" type="radio" value="0" @if (isset($blockgradeuser)) {{ (0 == $blockgradeuser->presence) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
</div>
        {!! $errors->first('presence', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('score') ? 'has-error' : ''}}">
    <label for="score" class="col-md-4 control-label">{{ 'Score' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="score" type="number" id="score" value="{{ $blockgradeuser->score or ''}}" >
        {!! $errors->first('score', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('specific_date') ? 'has-error' : ''}}">
    <label for="specific_date" class="col-md-4 control-label">{{ 'Specific Date' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="specific_date" type="datetime-local" id="specific_date" value="{{ $blockgradeuser->specific_date or ''}}" >
        {!! $errors->first('specific_date', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('block_grade_id') ? 'has-error' : ''}}">
    <label for="block_grade_id" class="col-md-4 control-label">{{ 'Block Grade Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="block_grade_id" type="number" id="block_grade_id" value="{{ $blockgradeuser->block_grade_id or ''}}" >
        {!! $errors->first('block_grade_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('division_user_id') ? 'has-error' : ''}}">
    <label for="division_user_id" class="col-md-4 control-label">{{ 'Division User Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="division_user_id" type="number" id="division_user_id" value="{{ $blockgradeuser->division_user_id or ''}}" >
        {!! $errors->first('division_user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
    </div>
</div>
