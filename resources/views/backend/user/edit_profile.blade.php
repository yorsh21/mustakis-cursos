@extends('layouts.backend')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Datos de Cuenta</div>
                <div class="panel-body">
                    <a href="{{ route('user.show.profile', $profile->id) }}" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>

                    <form method="POST" action="{{ route('user.update.profile') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $profile->id }}">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('firstname') ? 'has-error' : ''}}">
                                <label for="firstname" class="col-md-3 control-label">Nombre</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="firstname" type="text" id="firstname" placeholder="Ingrese nombre" value="{{ $profile->firstname or ''}}" >
                                    {!! $errors->first('firstname', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('lastname') ? 'has-error' : ''}}">
                                <label for="lastname" class="col-md-3 control-label">Apellido</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="lastname" placeholder="Ingrese apellido" name="lastname" value="{{ $profile->lastname or ''}}" minlength="3" maxlength="15" required>
                                    {!! $errors->first('lastname', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                <label for="email" class="col-md-3 control-label">Correo</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" id="email" placeholder="Ingrese correo electrónico" name="email" value="{{ $profile->email or ''}}" minlength="12" maxlength="35" required>
                                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('birth_date') ? 'has-error' : ''}}">
                                <label for="fecha" class="col-md-3 control-label">Fecha de nacimiento</label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" id="date" name="birth_date" value="{{ $profile->birth_date or '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                        @roles('Administrador')
                            <div class="form-group {{ $errors->has('rut') ? 'has-error' : ''}}">
                                <label for="city_assist_workshop" class="col-md-3 control-label">Rut / Pasaporte</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="rut" placeholder="Ingrese rut" name="rut" value="{{ $profile->rut or ''}}" minlength="6" maxlength="35" required>
                                    {!! $errors->first('rut', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        @else
                            <div class="form-group {{ $errors->has('rut') ? 'has-error' : ''}}">
                                <label for="city_assist_workshop" class="col-md-3 control-label">Rut / Pasaporte</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="rut" placeholder="Ingrese rut" name="rut" value="{{ $profile->rut or ''}}" minlength="6" maxlength="35" readonly>
                                    {!! $errors->first('rut', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        @endroles
                        </div>

                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('genere') ? 'has-error' : ''}}">
                                <label for="Género" class="control-label col-md-3">Género</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="genere" required>
                                        <option value="">Seleccione</option>
                                        <option value="0" {{ $profile->genere == 0 ? 'selected' : '' }}>Masculino</option>
                                        <option value="1" {{ $profile->genere == 1 ? 'selected' : '' }}>Femenino</option>
                                    </select>
                                    {!! $errors->first('genere', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
                                <label for="phone_number" class="col-md-3 control-label">Teléfono</label>
                                <div class="col-md-9">
                                    <input type="phone_number" class="form-control" placeholder="Ingrese teléfono" name="phone_number" value="{{ $profile->phone_number or ''}}" minlength="9" maxlength="9" required>
                                    {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fono" class="col-md-3 control-label">Teléfono Alternativo</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="phone_number2" name="phone_number2" value="{{ $profile->phone_number2 or '' }}" maxlength="9" minlength="9" placeholder="Ingrese teléfono">
                                </div>
                            </div>
                        </div>
                        
                    @noroles("Alumno")
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('study_career') ? 'has-error' : ''}}">
                                <label for="study_career" class="col-md-3 control-label">Carrera</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="study_career" type="text" id="study_career" placeholder="Ingrese carrera" value="{{ $profile->study_career or ''}}" >
                                    {!! $errors->first('study_career', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('study_institution') ? 'has-error' : ''}}">
                                <label for="study_institution" class="col-md-3 control-label">Universidad</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="study_institution" placeholder="Ingrese universidad" name="study_institution" value="{{ $profile->study_institution or ''}}"   >
                                    {!! $errors->first('study_institution', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    @endnoroles

                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                                <label for="address" class="col-md-3 control-label">Dirección</label>
                                <div class="col-md-9">
                                    <input type="address" class="form-control" id="address" placeholder="Ingrese dirección" name="address" value="{{ $profile->address or ''}}" required>
                                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="select_region" class="col-md-3 control-label">Región</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="select_region">
                                        <option value="" name="">--- Elige una Región ---</option>
                                        @foreach($regiones as $region)
                                            <option value="{{ $region->id }}" {{ isset($profile->commune->region_id) && $profile->commune->region_id == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('commune_id') ? 'has-error' : ''}}">
                                <label for="select_comuna" class="col-md-3 control-label">Comuna</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="select_comuna" name="commune_id">
                                        <option value="" name="">--- Elige una Comuna ---</option>
                                        @foreach($comunas as $comuna)
                                            <option value="{{ $comuna->id }}" name="{{ $comuna->region_id }}" {{ $profile->commune_id == $comuna->id ? 'selected' : '' }}>{{ $comuna->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    @roles("Alumno")
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Género" class="col-md-3 control-label">Sede a la que postulas</label>
                                    <div class="col-md-9">
                                        <select id="city_assist_workshop" class="form-control" name="city_assist_workshop">
                                        <option value="">Seleccione</option>
                                        @foreach($cities as $city => $id)
                                            <option value="{{ $id }}" {{ $profile->city_assist_workshop == $id ? 'selected' : '' }}>{{ $city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endroles

                    @roles("Coordinador")
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('city_assist_workshop') ? 'has-error' : ''}}">
                                <label for="city_assist_workshop" class="col-md-3 control-label">Ciudad de coordinación</label>
                                <div class="col-md-9">
                                    <select class="form-control city_assist_workshop" name="city_assist_workshop">
                                        <option value="">--- Elige una Ciudad ---</option>
                                        @foreach($comunas as $comuna)
                                            <option value="{{ $comuna->id }}" {{ $profile->city_assist_workshop == $comuna->id ? 'selected' : '' }}>{{ $comuna->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endroles
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="col-md-3 control-label"></label>
                                <div class="col-md-9">
                                    <input type="hidden" name="image_profile" id="image_profile" value="{{ $profile->image_profile or ''}}">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                                      Cambiar Avatar
                                      <img id="preview-avatar" src="{{ asset('img/avatars/' . $profile->image_file) }}" class="choose-avatar" alt="avatar" data-current="{{ $profile->image_file }}">
                                    </button>
                                </div>
                            </div>
                        </div>


                    @roles("Alumno")
                        <div class="col-md-12">
                            <hr>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="correo">Correo Tutor</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" id="email_tutor" placeholder="Ingrese email" name="email_tutor" value="{{ $profile->email_tutor or '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="correo">Correo Mentor</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" id="email_teacher" placeholder="Ingrese email" name="email_teacher" value="{{ $profile->email_teacher or '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="nombre">Teléfono Tutor</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="phone_number_tutor" id="phone_number_tutor" placeholder="Ingrese nombre" value="{{ $profile->phone_number_tutor or '' }}" maxlength="9" minlength="9">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="Género">Curso Actual</label>
                                <div class="col-md-9">
                                    <select id="select_course" class="form-control" name="course">
                                        <option value="">Seleccione</option>
                                        <option value="7 basico" {{ $profile->course == '7 basico' ? 'selected' : '' }}>7º Básico</option>
                                        <option value="8 basico" {{ $profile->course == '8 basico' ? 'selected' : '' }}>8º Básico</option>
                                        <option value="1 medio" {{ $profile->course == '1 medio' ? 'selected' : '' }}>1º Medio</option>
                                        <option value="2 medio" {{ $profile->course == '2 medio' ? 'selected' : '' }}>2º Medio</option>
                                        <option value="3 medio" {{ $profile->course == '3 medio' ? 'selected' : '' }}>3º Medio</option>
                                        <option value="4 medio" {{ $profile->course == '4 medio' ? 'selected' : '' }}>4º Medio</option>
                                        <option value="N/A" {{ $profile->course == 'N/A' ? 'selected' : '' }}>N/A</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="establishment">Nombre de establecimiento educacional</label>
                                <div class="col-md-9">
                                    <select id="select_establishment" class="form-control" name="establishment" {{ empty($profile->establishment) || is_numeric($profile->establishment) ? '' : 'disabled' }}>
                                        <option id="select_default" value="">Seleccione</option>
                                        @foreach($establishments as $establishment)
                                            <option name="{{ $establishment->commune->region_id}}" value="{{ $establishment->id }}" {{ $profile->establishment == $establishment->id ? 'selected' : '' }}>{{ $establishment->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <a id="non-list" data-show="{{ empty($profile->establishment) || is_numeric($profile->establishment) ? '0' : '1' }}" href="#">Haz click aquí si tu establecimiento no está en la lista</a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="div_school_commune" class="col-md-12" style="{{ empty($profile->establishment) || is_numeric($profile->establishment) ? 'display: none;' : '' }}">
                                <div class="form-group">
                                    <label class="control-label col-md-3" for="nombre">Ingresa el nombre de tu establecimiento</label>
                                    <div class="col-md-9">
                                        <input id="new_school_commune" type="text" class="form-control" name="new_school_commune" id="new_school_commune" placeholder="Ingrese su establecimiento" value="{{ is_numeric($profile->establishment) ? '' : $profile->establishment }}" maxlength="250" minlength="3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="Género">Tipo de establecimiento educacional</label>
                                <div class="col-md-9">
                                    <select class="form-control type_establishment_student" name="type_establishment_student">
                                        <option value="">Seleccione</option>
                                        <option value="0" {{ $profile->type_establishment_student == '0' ? 'selected' : '' }}>Científico humanista</option>
                                        <option value="1" {{ $profile->type_establishment_student == '1' ? 'selected' : '' }}>Técnico profesional</option>
                                        <option value="2" {{ $profile->type_establishment_student == '2' ? 'selected' : '' }}>N/A</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="Género">¿Tú colegio te ayudará con el transporte? @php echo '<i class="text-error">'. $errors->first('transport_establishment'). '</i>' @endphp</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="transport_establishment">
                                        <option value="">Seleccione</option>
                                        <option value="1" {{ $profile->transport_establishment == '1' ? 'selected' : '' }}>Si</option>
                                        <option value="0" {{ $profile->transport_establishment == '0' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="Género">Dependencia de tu establecimiento educacional @php echo '<i class="text-error">'. $errors->first('dependency_establishment_student'). '</i>' @endphp</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="dependency_establishment_student">
                                        <option value="">Seleccione</option>
                                        <option value="0" {{ $profile->dependency_establishment_student == '0' ? 'selected' : '' }}>Municipal</option>
                                        <option value="1" {{ $profile->dependency_establishment_student == '1' ? 'selected' : '' }}>Particular subvencionado</option>
                                        <option value="2" {{ $profile->dependency_establishment_student == '2' ? 'selected' : '' }}>Particular</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="nombre">¿Por qué crees que deberías ser seleccionado para participar en este taller? Indica tu principal compromiso y qué razones te convierten en un aporte para un equipo de robótica @php echo '<i class="text-error">'. $errors->first('average_notes_language'). '</i>' @endphp </label>
                                <div class="col-md-9">
                                    <h3><span class="text-navy">*Al redactar, recuerda que el máximo de caracteres son 500 </span> </h3>
                                    <textarea  class="form-control" name="about_select_workshop" id="about_select_workshop" placeholder="Ingrese un comentario" value="{{old('about_select_workshop')}}" maxlength="500" minlength="3">{{ $profile->about_select_workshop or '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endroles

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-offset-4 col-md-4">
                                    <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Actualizar perfil' }}">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Elegir Avatar</h4>
              </div>
              <div class="modal-body">
                @foreach ($avatars as $avatar)
                    @if($avatar == $profile->image_profile)
                        <img src="{{ asset('img/avatars/' . $avatar) }}" class="choose-avatar" alt="avatar" data-dismiss="modal" data-avatar="{{ $avatar }}" style="background: gray">
                    @else
                        <img src="{{ asset('img/avatars/' . $avatar) }}" class="choose-avatar" alt="avatar" data-dismiss="modal" data-avatar="{{ $avatar }}">
                    @endif
                @endforeach
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>

        @roles('Administrador')
            @if($profile->rol_id == 4)
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Formularios</div>
                    <div class="panel-body">
                        <a type="button" href="{{ route('user.personal.form', $profile->id) }}" class=" btn btn-success btn-md">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Datos personales
                        </a>
                    
                        <a type="button" href="{{ route('user.documentacion.form', $profile->id) }}" class=" btn btn-success btn-md">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Documentación
                        </a>
                    
                        <a type="button" href="{{ route('user.establecimiento.form', $profile->id) }}" class=" btn btn-success btn-md">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Establecimiento
                        </a>
                    
                        <a type="button" href="{{ route('user.encuesta.form', $profile->id) }}" class=" btn btn-success btn-md">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Encuesta
                        </a>
                    </div>
                </div>
            </div>
        @endif

        @if($profile->rol_id != 1)
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Roles</div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('user.update_roles.profile') }}" accept-charset="UTF-8" class="form-horizontal">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $profile->id }}">

                            <div class="form-group {{ $errors->has('multiroles') ? 'has-error' : ''}}">
                                <label for="multiroles1" class="col-md-4 control-label">Rol Primario</label>
                                <div class="col-md-6">
                                    <select name="multiroles1" id="multiroles1" class="form-control" disabled>
                                        @foreach($roles as $rol)
                                            <option value="{{ $rol->id }}" {{ $rol->id == $profile->rol_id ? "selected" : "" }}>{{ $rol->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="change_rol1" value="1"> Modificar
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('multiroles') ? 'has-error' : ''}}">
                                <label for="multiroles2" class="col-md-4 control-label">Rol Secundario</label>
                                <div class="col-md-6">
                                    <select name="multiroles2" id="multiroles2" class="form-control" disabled>
                                        <option value="">Ninguno</option>
                                        @foreach($roles as $rol)
                                            <option value="{{ $rol->id }}" {{ $rol->id == $profile->multiroles ? "selected" : "" }}>{{ $rol->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="change_rol2" value="1"> Modificar
                                        </label>
                                    </div>
                                </div>
                            </div>

                            @if($errors->has('multiroles'))
                            <div class="form-group has-error">
                                <div class="col-md-offset-4 col-md-4">
                                    {{ $errors->has('multiroles') ? $errors->first('multiroles') : ''}}
                                </div>
                            </div>
                            @endif
                            
                            <div class="form-group">
                                <div class="col-md-offset-4 col-md-4">
                                    <input class="btn btn-primary" id="submit-roles" type="submit" value="{{ $submitButtonText or 'Aplicar Roles' }}" disabled>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @endroles

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Cambiar Contraseña</div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('user.update_password.profile') }}" accept-charset="UTF-8" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $profile->id }}">
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" id="password" placeholder="Ingrese contraseña" name="password" minlength="6" maxlength="35" required>
                                {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password2') ? 'has-error' : ''}}">
                            <label for="password2" class="col-md-4 control-label">Confirmar contraseña</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" id="password2" placeholder="Ingrese contraseña nuevamente" name="password2" oninput="checkPassword(this)" minlength="6" maxlength="35" required>
                                {!! $errors->first('password2', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Cambiar Contraseña' }}">
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
            $("#select_establishment").select2({
                placeholder: "Selecciona un Colegio",
                allowClear: true
            });

            $("#non-list").click(function(e) {
                e.preventDefault();
                if($(this).data("show") == "0") {
                    $("#div_school_commune").fadeIn();
                    $(this).data("show", "1");

                    $("#select_establishment").prop("disabled", true);
                    $("#new_school_commune").val("");
                }
               else {
                    $("#div_school_commune").fadeOut();
                    $(this).data("show", "0");

                    $("#select_establishment").prop("disabled", false);
               }
            });

            $('#select_course').change(function() {
                if($(this).val() == '4 medio') {
                    alert('Si eres alumno de 4º Medio, solo puedes postular a Club, NO a taller.');
                }
            });

        });
        
    </script>
@endsection