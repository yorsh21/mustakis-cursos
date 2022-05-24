@extends('layouts.backend')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear nuevo colegio</div>
                    <div class="panel-body">
                        <a href="{{ route('course.scores') }}" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ route('course.store') }}" accept-charset="UTF-8" class="form-horizontal">
                            {{ csrf_field() }}

                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label for="name"> Nombre</label>
                                    <input class="form-control" type="text" name="name">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label for="name"> Puntaje</label>
                                    <input class="form-control" type="number" name="score">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="select_region">Región @php echo '<i class="text-error">'. $errors->first('region'). '</i>' @endphp</label>
                                    <select class="form-control" id="select_region" name="region">
                                        <option value="" name="">--- Elige una Región ---</option>
                                        @foreach($regiones as $region)
                                            <option value="{{ $region->id }}" {{ old('region') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="select_comuna">Comuna @php echo '<i class="text-error">'. $errors->first('commune_idion'). '</i>' @endphp</label>
                                    <select class="form-control" id="select_comuna" name="commune_id">
                                        <option value="" name="">--- Elige una Comuna ---</option>
                                        @foreach($comunas as $comuna)
                                            <option value="{{ $comuna->id }}" name="{{ $comuna->region_id }}" {{ old('commune_id') == $comuna->id ? 'selected' : '' }}>{{ $comuna->name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('commune_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group col-md-12"><br>
                                    <input class="btn btn-primary" type="submit" value="Crear">
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection
