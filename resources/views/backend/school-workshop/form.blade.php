<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">Nombre</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $schoolworkshop->name or ''}}" required>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="col-md-4 control-label">Descripción</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="description" type="textarea" id="description" >{{ $schoolworkshop->description or ''}}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    <label for="code" class="col-md-4 control-label">Código</label>
    <div class="col-md-6">
        <input class="form-control" name="code" type="text" id="code" value="{{ $schoolworkshop->code or ''}}" >
        {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('requirement_id') ? 'has-error' : ''}}">
    <label for="requirement_id" class="col-md-4 control-label">Prerrequisito 1</label>
    <div class="col-md-6">
        <select name="requirement_id" id="requirement_id" class="form-control">
            <option value="">Ninguno</option>
            @foreach($schoolworkshopAll as $item)
                @if(isset($schoolworkshop) && $schoolworkshop->requirement_id == $item->id)
                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @elseif(isset($schoolworkshop) && $schoolworkshop->id == $item->id)
                    @continue
                @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
            @endforeach
        </select>
        {!! $errors->first('requirement_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('requirement2_id') ? 'has-error' : ''}}">
    <label for="requirement2_id" class="col-md-4 control-label">Prerrequisito 1</label>
    <div class="col-md-6">
        <select name="requirement2_id" id="requirement2_id" class="form-control">
            <option value="">Ninguno</option>
            @foreach($schoolworkshopAll as $item)
                @if(isset($schoolworkshop) && $schoolworkshop->requirement2_id == $item->id)
                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @elseif(isset($schoolworkshop) && $schoolworkshop->id == $item->id)
                    @continue
                @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
            @endforeach
        </select>
        {!! $errors->first('requirement2_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('requirement3_id') ? 'has-error' : ''}}">
    <label for="requirement3_id" class="col-md-4 control-label">Prerrequisito 1</label>
    <div class="col-md-6">
        <select name="requirement3_id" id="requirement3_id" class="form-control">
            <option value="">Ninguno</option>
            @foreach($schoolworkshopAll as $item)
                @if(isset($schoolworkshop) && $schoolworkshop->requirement3_id == $item->id)
                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @elseif(isset($schoolworkshop) && $schoolworkshop->id == $item->id)
                    @continue
                @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
            @endforeach
        </select>
        {!! $errors->first('requirement3_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
    </div>
</div>
