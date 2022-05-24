@extends('layouts.backend')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear {{ $rol->name }}</div>
                    <div class="panel-body">
                        <a href="#" onclick="goBack()"  title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                        <br />
                        <br />

                        <form  method="POST" action="{{ route('user.guardar.completo') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="rol_id" value="{{ $rol->id }}">
                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="firstname">Primer nombre @php echo '<i class="text-error">'. $errors->first('firstname'). '</i>' @endphp </label>
                                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Ingrese primer nombre" value="{{ old('firstname') }}" maxlength="35" minlength="3" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="middlename">Segundo nombre @php echo '<i class="text-error">'. $errors->first('middlename'). '</i>' @endphp </label>
                                    <input type="text" class="form-control" name="middlename" id="middlename" placeholder="Ingrese segundo nombre" value="{{ old('middlename') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="lastname">Primer apellido @php echo '<i class="text-error">'. $errors->first('lastname'). '</i>' @endphp</label>
                                    <input type="text" class="form-control" id="lastname" placeholder="Ingrese primer apellido" name="lastname" value="{{ old('lastname') }}"  maxlength="35" minlength="3" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="lastname2">Segundo apellido @php echo '<i class="text-error">'. $errors->first('lastname2'). '</i>' @endphp</label>
                                    <input type="text" class="form-control" id="lastname2" placeholder="Ingrese segundo apellido" name="lastname2" value="{{ old('lastname2') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="rut">Rut @php echo '<i class="text-error">'. $errors->first('rut'). '</i>' @endphp</label>
                                    <input type="text" class="form-control" id="rut" name="rut" value="{{ old('rut') }}" placeholder="12345678-9" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="Género">Género @php echo '<i class="text-error">'. $errors->first('genere'). '</i>' @endphp</label>
                                    <select class="form-control" name="genere" required>
                                        <option value="">Seleccione</option>
                                        <option value="0" {{ old('genere') === "0" ? 'selected' : '' }}>Masculino</option>
                                        <option value="1" {{ old('genere') === "1" ? 'selected' : '' }}>Femenino</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="fono">Teléfono @php echo '<i class="text-error">'. $errors->first('phone_number'). '</i>' @endphp</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" maxlength="9" minlength="9" placeholder="Ingrese teléfono">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="direccion">Dirección @php echo '<i class="text-error">'. $errors->first('address'). '</i>' @endphp</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" placeholder="Ingrese dirección">
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

                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="career">Carrera @php echo '<i class="text-error">'. $errors->first('career'). '</i>' @endphp </label>
                                    <input type="text" class="form-control" name="career" id="career" placeholder="Ingrese carrera" value="{{ old('career') }}" maxlength="35" minlength="3">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="university">Universidad @php echo '<i class="text-error">'. $errors->first('university'). '</i>' @endphp </label>
                                    <input type="text" class="form-control" name="university" id="university" placeholder="Ingrese universidad" value="{{ old('university') }}" maxlength="35" minlength="3">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="correo">Correo @php echo '<i class="text-error">'. $errors->first('email'). '</i>' @endphp</label>
                                    <input type="email" class="form-control" id="email" placeholder="Ingrese email" name="email" value="{{ old('email') }}" minlength="8" maxlength="80" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="correo">Confirmar Correo @php echo '<i class="text-error">'. $errors->first('email2'). '</i>' @endphp</label>
                                    <input type="email" class="form-control" id="email2" placeholder="Ingrese email" name="email2" value="{{ old('email2') }}" oninput="checkEmail(this)" minlength="8" maxlength="80" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="contraseña">Contraseña @php echo '<i class="text-error">'. $errors->first('password'). '</i>' @endphp</label>
                                    <input type="password" class="form-control" id="password" placeholder="Ingrese Contraseña" name="password" value="{{ old('password2') }}"  minlength="6" maxlength="35" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="contraseña">Confirmar contraseña @php echo '<i class="text-error">'. $errors->first('password2'). '</i>' @endphp</label>
                                    <input type="password" class="form-control" id="password2" placeholder="Ingrese Contraseña" name="password2" value="{{ old('password2') }}" oninput="checkPassword(this)" minlength="6" maxlength="35" required>
                                </div>
                            </div>

                            @if($rol->id == "2")
                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="city_assist_workshop">Ciudad de coordinación @php echo '<i class="text-error">'. $errors->first('city_assist_workshop'). '</i>' @endphp</label>
                                    <select class="form-control" name="city_assist_workshop" required>
                                        <option value="">--- Elige una Ciudad ---</option>
                                        @foreach($comunas as $comuna)
                                            <option value="{{ $comuna->id }}" {{ old('city_assist_workshop') == $comuna->id ? 'selected' : '' }}>{{ $comuna->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="col-md-12">
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-success btn-md">Crear</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection
