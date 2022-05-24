@extends('layouts.backend')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">

                <div class="ibox-content">

                    <form enctype="multipart/form-data" method="POST" id="form" action="{{ route('user.personal') }}" class="wizard-big wizard clearfix" role="application">
                        {{csrf_field()}}
                        <input type="hidden" name="type_form" value="personal">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        
                        <div class="steps clearfix"></div>
                        <div class="content clearfix">
                            <h1 id="form-h-0" tabindex="-1" class="title">Datos Personales</h1>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="fecha">Fecha de nacimiento @php echo '<i class="text-error">'. $errors->first('birth_date'). '</i>' @endphp</label>
                                        <input type="date" class="form-control" id="date" name="birth_date" value="{{ $user->birth_date or '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"
                                               for="Género">Género @php echo '<i class="text-error">'. $errors->first('gender'). '</i>' @endphp</label>
                                        <select class="form-control" name="gender">
                                            <option value="">Seleccione</option>
                                            <option value="0" {{ $user->genere === 0 ? 'selected' : '' }}>Masculino</option>
                                            <option value="1" {{ $user->genere === 1 ? 'selected' : '' }}>Femenino</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="fono">Teléfono @php echo '<i class="text-error">'. $errors->first('phone_number'). '</i>' @endphp</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number or '' }}" maxlength="9" minlength="9" placeholder="Ingrese teléfono">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="fono">Teléfono Alternativo @php echo '<i class="text-error">'. $errors->first('phone_number2'). '</i>' @endphp</label>
                                        <input type="text" class="form-control" id="phone_number2" name="phone_number2" value="{{ $user->phone_number2 or '' }}" maxlength="9" minlength="9" placeholder="Ingrese teléfono">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="nombre">Teléfono Tutor @php echo '<i class="text-error">'. $errors->first('phone_number_tutor'). '</i>' @endphp </label>
                                        <input type="text" class="form-control" name="phone_number_tutor" id="phone_number_tutor" placeholder="Ingrese nombre" value="{{ $user->phone_number_tutor or '' }}" maxlength="9" minlength="9">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="Género">Curso Actual @php echo '<i class="text-error">'. $errors->first('course'). '</i>' @endphp</label>
                                        <select id="select_course" class="form-control" name="course">
                                            <option value="">Seleccione</option>
                                            <option value="7 basico" {{ $user->course == '7 basico' ? 'selected' : '' }}>7º Básico</option>
                                            <option value="8 basico" {{ $user->course == '8 basico' ? 'selected' : '' }}>8º Básico</option>
                                            <option value="1 medio" {{ $user->course == '1 medio' ? 'selected' : '' }}>1º Medio</option>
                                            <option value="2 medio" {{ $user->course == '2 medio' ? 'selected' : '' }}>2º Medio</option>
                                            <option value="3 medio" {{ $user->course == '3 medio' ? 'selected' : '' }}>3º Medio</option>
                                            <option value="4 medio" {{ $user->course == '4 medio' ? 'selected' : '' }}>4º Medio</option>
                                            <option value="N/A" {{ $user->course == 'N/A' ? 'selected' : '' }}>N/A</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="correo">Correo Tutor @php echo '<i class="text-error">'. $errors->first('email_tutor'). '</i>' @endphp</label>
                                        <input type="email" class="form-control" id="email_tutor" placeholder="Ingrese email" name="email_tutor" value="{{ $user->email_tutor or '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="correo">Correo Mentor @php echo '<i class="text-error">'. $errors->first('email_teacher'). '</i>' @endphp</label>
                                        <input type="email" class="form-control" id="email_teacher" placeholder="Ingrese email" name="email_teacher" value="{{ $user->email_teacher or '' }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="select_region" class="control-label">Región</label>
                                    <div class="form-group">
                                        <select class="form-control" id="select_region">
                                            <option value="" name="">--- Elige una Región ---</option>
                                            @foreach($regiones as $region)
                                                <option value="{{ $region->id }}" {{ isset($user->commune->region_id) && $user->commune->region_id == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <label for="select_comuna" class="control-label">Comuna</label>
                                    <div class="form-group {{ $errors->has('commune_id') ? 'has-error' : ''}}">
                                        <select class="form-control" id="select_comuna" name="commune_id">
                                            <option value="" name="">--- Elige una Comuna ---</option>
                                            @foreach($comunas as $comuna)
                                                <option value="{{ $comuna->id }}" name="{{ $comuna->region_id }}" {{ $user->commune_id == $comuna->id ? 'selected' : '' }}>{{ $comuna->name }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('commune_id', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="direccion">Dirección @php echo '<i class="text-error">'. $errors->first('address'). '</i>' @endphp</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $user->address or '' }}" placeholder="Ingrese dirección">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                @roles('Administrador')
                                    <a href="{{route('user.show.profile', $user->id) }}" class="btn btn-success">Volver</a>
                                @else
                                    <a href="{{ route('sumary') }}" class="btn btn-success">Volver</a>
                                @endroles
                                <button type="submit" class=" btn btn-primary btn-md">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $('#select_course').change(function() {
                if($(this).val() == '4 medio') {
                    alert('Si eres alumno de 4º Medio, solo puedes postular a Club, NO a taller.');
                }
            });
        });
        
    </script>
@endsection