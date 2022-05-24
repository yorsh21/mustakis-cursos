<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">Nombre</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $material->name or ''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('file') ? 'has-error' : ''}}">
    <label for="file" class="col-md-4 control-label">Archivo</label>
    <div class="col-md-6">
        <input class="form-control" name="file" type="file" id="file">
        {{ $material->file_name or ''}}
        {!! $errors->first('file', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('general') ? 'has-error' : ''}}">
    <label for="general" class="col-md-4 control-label">General</label>
    <div class="col-md-6">
        <div class="radio">
            <label>
                <input name="general" type="radio" value="1" {{ (isset($material) && 1 == $material->general) ? 'checked' : '' }}> 
                Si
            </label>
        </div>
        <div class="radio">
            <label>
                <input name="general" type="radio" value="0" @if (isset($material)) {{ (0 == $material->general) ? 'checked' : '' }} @else {{ 'checked' }} @endif> 
                No
            </label>
        </div>
        {!! $errors->first('general', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@isset($block_id)
    <input name="block_id" type="hidden" id="block_id" value="{{ $block_id }}" >
@else
    <input name="block_id" type="hidden" id="block_id" value="{{ $material->block_id }}" >
@endisset

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
    </div>
</div>
