<div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
    <label for="start_date" class="col-md-4 control-label">Fecha de inicio</label>
    <div class="col-md-6">
        <input required class="form-control" name="start_date" type="date" id="start_date" value="{{ $postulation->start_date or ''}}" >
        {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
    <label for="end_date" class="col-md-4 control-label">Fecha de término</label>
    <div class="col-md-6">
        <input required class="form-control" name="end_date" type="date" id="end_date" value="{{ $postulation->end_date or ''}}" >
        {!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('period_id') ? 'has-error' : ''}}">
    <label for="period_id" class="col-md-4 control-label">Periodo</label>
    <div class="col-md-6">
        <select required class="form-control" name="period_id" id="period_id">
            <option value=""  >--- Elige un Período ---</option>
            @isset($postulation)
                @foreach($periods as $period)
                    <option value="{{ $period->id }}" {{ $period->id == $postulation->period_id ? 'selected' : '' }}>{{ $period->name }}</option>
                @endforeach
            @else
                @foreach($periods as $period)
                    <option value="{{ $period->id }}">{{ $period->name }}</option>
                @endforeach
            @endisset
        </select>
        {!! $errors->first('period_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('school_workshop_id') ? 'has-error' : ''}}">
    <label for="school_workshop_id" class="col-md-4 control-label">Taller</label>
    <div class="col-md-6">
        <select required class="form-control" name="school_workshop_id" id="school_workshop_id">
            <option value="">--- Elige un Taller ---</option>
            @isset($postulation)
                @foreach($workshops as $workshop)
                    <option value="{{ $workshop->id }}"{{ $workshop->id == $postulation->school_workshop_id ? 'selected' : '' }}>{{ $workshop->name }}</option>
                @endforeach
            @else
                @foreach($workshops as $workshop)
                    <option value="{{ $workshop->id }}">{{ $workshop->name }}</option>
                @endforeach
            @endisset
        </select> {!! $errors->first('school_workshop_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('survey_id') ? 'has-error' : ''}}">
    <label for="survey_id" class="col-md-4 control-label">Encuesta</label>
    <div class="col-md-6">
        <select required class="form-control" name="survey_id" id="survey_id">
            <option value="">--- Elige un Encuesta ---</option>
            @isset($postulation)
                @foreach($surveys as $survey)
                    <option value="{{ $survey->id }}"{{ $survey->id == $postulation->survey_id ? 'selected' : '' }}>{{ $survey->name }}</option>
                @endforeach
            @else
                @foreach($surveys as $survey)
                    <option value="{{ $survey->id }}">{{ $survey->name }}</option>
                @endforeach
            @endisset
        </select> {!! $errors->first('survey_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-check">
    <div class="col-md-6 col-md-offset-4">
        @isset($postulation)
            <input class="form-check-input" type="checkbox" value="1" name="documents" id="documents" {{ $postulation->documents ? 'checked' : '' }}>
        @else
            <input class="form-check-input" type="checkbox" value="1" name="documents" id="documents" checked>
        @endisset
        <label class="form-check-label" for="documents">Solicitar Documentos</label><br><br>
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Crear' }}">
    </div>
</div>
