<div class="form-group {{ $errors->has('aptitude_score') ? 'has-error' : ''}}">
    <label for="aptitude_score" class="col-md-4 control-label">{{ 'Aptitude Score' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="aptitude_score" type="number" id="aptitude_score" value="{{ $divisionuser->aptitude_score or ''}}" >
        {!! $errors->first('aptitude_score', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('grade_id') ? 'has-error' : ''}}">
    <label for="grade_id" class="col-md-4 control-label">{{ 'Grade Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="grade_id" type="number" id="grade_id" value="{{ $divisionuser->grade_id or ''}}" >
        {!! $errors->first('grade_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-md-4 control-label">{{ 'User Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="user_id" type="number" id="user_id" value="{{ $divisionuser->user_id or ''}}" >
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
    </div>
</div>
