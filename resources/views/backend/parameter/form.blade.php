<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="col-md-4 control-label">Tipo</label>
    <div class="col-md-6">
        <input class="form-control" name="type" type="text" id="type" value="{{ $parameter->type or ''}}" >
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('key') ? 'has-error' : ''}}">
    <label for="key" class="col-md-4 control-label">Clave</label>
    <div class="col-md-6">
        <input class="form-control" name="key" type="text" id="key" value="{{ $parameter->key or ''}}" >
        {!! $errors->first('key', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('value') ? 'has-error' : ''}}">
    <label for="value" class="col-md-4 control-label">Valor</label>
    <div class="col-md-6">
        <textarea class="form-control" name="value" id="summernote">{{ $parameter->value or ''}}</textarea>
        {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
        <p>* Para escribir valores sin formato presionar el botón &nbsp <i class="note-icon-code"></i>&nbsp, escribir el texto deseado, volver a presionar el botón &nbsp <i class="note-icon-code"></i>&nbsp y guardar.</p>
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
    </div>
</div>


@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script type="text/javascript">
        $('#summernote').summernote({
            placeholder: 'write here...'
        });
    </script>
@endsection