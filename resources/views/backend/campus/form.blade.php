<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">Nombre</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $campus->name or ''}}" required>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="col-md-4 control-label">Dirección</label>
    <div class="col-md-6">
        <input class="form-control" name="address" type="text" id="address" value="{{ $campus->address or ''}}" required>
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-md-4 control-label">Coordinador</label>
    <div class="col-md-6">
        <select class="form-control" id="select_coordinator" name="user_id" required>
            <option value="" name="">--- Elige un Coordinador ---</option>
            @isset($campus)
                @foreach($usuarios as $usuario)
                    <option data-city="{{ $usuario->city_assist_workshop }}" value="{{ $usuario->id }}" {{ $usuario->id == $campus->user_id ? 'selected' : '' }}>{{ $usuario->name }}</option>
                @endforeach
            @else
                @foreach($usuarios as $usuario)
                    <option data-city="{{ $usuario->city_assist_workshop }}" value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
            @endif
        </select>
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label for="select_region" class="col-md-4 control-label">Región</label>
    <div class="col-md-6">
        <select class="form-control" id="select_region" required>
            <option value="" name="">--- Elige una Región ---</option>
            @isset($campus)
                @foreach($regiones as $region)
                    <option value="{{ $region->id }}" {{ $region->id == $campus->commune->region_id ? 'selected' : '' }}>{{ $region->name }}</option>
                @endforeach
            @else
                @foreach($regiones as $region)
                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
<div class="form-group {{ $errors->has('commune_id') ? 'has-error' : ''}}">
    <label for="select_comuna" class="col-md-4 control-label">Comuna</label>
    <div class="col-md-6">
        <select class="form-control" id="select_comuna" name="commune_id" required>
            <option value="" name="">--- Elige una Comuna ---</option>
            @isset($campus)
                @foreach($comunas as $comuna)
                    <option value="{{ $comuna->id }}" name="{{ $comuna->region_id }}" {{ $campus->commune_id == $comuna->id ? 'selected' : '' }}>{{ $comuna->name }}</option>
                @endforeach
            @else
                @foreach($comunas as $comuna)
                    <option value="{{ $comuna->id }}" name="{{ $comuna->region_id }}" {{ old('commune_id') == $comuna->id ? 'selected' : '' }}>{{ $comuna->name }}</option>
                @endforeach
            @endif
        </select>
        {!! $errors->first('commune_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
    </div>
</div>
