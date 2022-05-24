<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="col-md-4 control-label">Descripción</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="description" type="textarea" id="description" >{{ $block->description or ''}}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('evaluation_name') ? 'has-error' : ''}}">
    <label for="evaluation_name" class="col-md-4 control-label">Nombre Evaluación</label>
    <div class="col-md-6">
        <input class="form-control" name="evaluation_name" type="text" id="evaluation_name" value="{{ $block->evaluation_name or ''}}" >
        {!! $errors->first('evaluation_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('evaluation_type') ? 'has-error' : ''}}">
    <label for="evaluation_type" class="col-md-4 control-label">{{ 'Tipo de Evaluación' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="evaluation_type" type="text" id="evaluation_type" value="{{ $block->evaluation_type or ''}}" >
        {!! $errors->first('evaluation_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('weighing') ? 'has-error' : ''}}">
    <label for="weighing" class="col-md-4 control-label">{{ 'Ponderación' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="weighing" type="number" step="0.01" id="weighing" value="{{ $block->weighing or ''}}" >
        {!! $errors->first('weighing', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('questionnaire_id') ? 'has-error' : ''}}">
    <label for="questionnaire_id" class="col-md-4 control-label">Cuestionarios</label>
    <div class="col-md-6">
        <select id="questionnaire_id" class="form-control" name="questionnaire_id">
            <option value="0">-- Ninguno --</option>
            @foreach ($questionnaires as $questionary)
                @if (isset($block) && $questionary->id == $block->questionnaire_id)
                    <option value="{{ $questionary->_id }}" selected>{{ $questionary->name }}</option>
                @else
                    <option value="{{ $questionary->_id }}">{{ $questionary->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>
@isset($school_id)
    <input name="school_workshop_id" type="hidden" id="school_workshop_id" value="{{ $school_id }}" >
@else
    <input name="school_workshop_id" type="hidden" id="school_workshop_id" value="{{ $block->school_workshop_id }}" >
@endisset

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
    </div>
</div>
