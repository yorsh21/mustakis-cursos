    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
        <label for="title" class="col-md-4 control-label">Título</label>
        <div class="col-md-6">
            <input class="form-control" name="title" type="text" id="title" value="{{ $video->title or ''}}" required>
            {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('url') ? 'has-error' : ''}}">
        <label for="url" class="col-md-4 control-label">URL (Youtube)</label>
        <div class="col-md-6">
            <input class="form-control" name="url" type="url" id="url" value="{{ $video->url or ''}}" required>
            {!! $errors->first('url', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
        <label for="description" class="col-md-4 control-label">Descripción</label>
        <div class="col-md-6">
            <textarea class="form-control" name="description" cols="30" rows="10" required>{{ $video->description or ''}}</textarea>
            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    
    <div class="form-group">
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        <div class="col-md-offset-4 col-md-4">
            <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
        </div>
    </div>
    