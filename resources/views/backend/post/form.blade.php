<div class="form-group {{ $errors->has('asunto') ? 'has-error' : ''}}">
    <label for="title" class="col-md-4 control-label">{{ 'Asunto' }}</label>
    <div class="col-md-6">
        <input class="form-control" maxlength="250" name="asunto" type="text" id="asunto" value="{{ old('asunto') }}">
    </div>
</div>
<div class="form-group {{ $errors->has('mensaje') ? 'has-error' : ''}}">
    <label for="body" class="col-md-4 control-label">{{ 'Mensaje' }}</label>
    <div class="col-md-6">
        <textarea maxlength="12000" class="form-control textarea" rows="6" name="mensaje" type="textarea" id="mensaje">{{ old('mensaje') }}</textarea>
    </div>
</div>
@roles("Mentor")
<div class="form-group {{ $errors->has('mensaje') ? 'has-error' : ''}}">
    <label for="body" class="col-md-4 control-label">{{ 'Archivo' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="file" type="file" id="file" value="{{ old('file') }}">
    </div>
</div>
@endroles
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
    </div>
</div>
