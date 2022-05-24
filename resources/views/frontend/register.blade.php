@extends('layouts.frontend')

@section('content')

@postulations()
    <section class="bg-white text-white mb-0">
        <div class="container"><br><br><br>
            <div class="row">
                <div class="col-lg-12 ml-auto">
                    <form  method="POST" action="{{ route('enviar.registro') }}" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <div class="container">
                            <h2 align="center">Formulario de Registro</h2><br>
                            <div class="form-text-container">
                                @php
                                  echo $register_text->value;
                                @endphp
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="control-label" for="nombre">Nombre:  @php echo '<i class="text-error">'. $errors->first('firstname'). '</i>' @endphp </label>
                                      <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Ingrese nombre" value="{{ old('firstname') }}" maxlength="35" minlength="3" required>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label" for="apellido">Apellido: @php echo '<i class="text-error">'. $errors->first('lastname'). '</i>' @endphp</label>
                                      <input type="text" class="form-control" id="lastname" placeholder="Ingrese apellido" name="lastname" value="{{ old('lastname') }}"  maxlength="35" minlength="3" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="correo">Correo Alumno: @php echo '<i class="text-error">'. $errors->first('email'). '</i>' @endphp</label>
                                        <input type="email" class="form-control" id="email" placeholder="Ingrese email" name="email" value="{{ old('email') }}" minlength="8" maxlength="80" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="correo">Confirmar Correo: @php echo '<i class="text-error">'. $errors->first('email2'). '</i>' @endphp</label>
                                        <input type="email" class="form-control" id="email2" placeholder="Ingrese email" name="email2" value="{{ old('email2') }}" oninput="checkEmail(this)" minlength="8" maxlength="80" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                        <label class="control-label" for="contraseña">Contraseña: @php echo '<i class="text-error">'. $errors->first('password'). '</i>' @endphp</label>
                                        <input type="password" class="form-control" id="password" placeholder="Ingrese Contraseña" name="password" value="{{ old('password2') }}"  minlength="6" maxlength="35" required>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                        <label class="control-label" for="contraseña">Confirmar contraseña: @php echo '<i class="text-error">'. $errors->first('password2'). '</i>' @endphp</label>
                                        <input type="password" class="form-control" id="password2" placeholder="Ingrese Contraseña" name="password2" value="{{ old('password2') }}" oninput="checkPassword(this)" minlength="6" maxlength="35" required>
                                  </div>
                              </div>
                            </div>
                            <div class="row">
                                <div align="center" class="col-md-12">
                                    <div class="form-group col-md-6 col-sm-10">
                                        <label class="control-label" for="rut">Rut: @php echo '<i class="text-error">'. $errors->first('rut'). '</i>' @endphp</label>
                                        <input type="text" class="form-control" id="rut" name="rut" value="{{ old('rut') }}" oninput="checkRut(this)" onkeypress="return checkKeys(event)" minlength="9" maxlength="10" placeholder="12345678-9">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div align="center" class=" col-md-12">
                                    <div  class="form-group col-md-6 col-sm-10">
                                        <label class="control-label" for="passport">
                                          <input type="checkbox" value="1" id="active_passport">Pasaporte: @php echo '<i class="text-error">'. $errors->first('passport'). '</i>' @endphp
                                        </label>
                                        <input type="text" class="form-control" id="passport" name="passport" value="{{ old('passport') }}" placeholder="Ingrese su número de Pasaporte" maxlength="100" style="display: none;"}}>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                              <div align="center" class="col-md-12">
                                  <button id="submit-register" type="submit" class="col-md-6 col-sm-10 btn btn-warning btn-md">Comenzar postulación</button>
                              </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@else
    <section class="bg-white text-white mb-0">
      <div class="container"><br><br><br>
        <div class="row">
          <div class="col-lg-12 ml-auto">
              <h2 align="center">Postulaciones cerradas</h2><br><br>
                <div align="center" class="col-md-12">
                    <a class="btn btn-warning btn-md" href="{{ route('inicio') }}">Volver al Inicio</a>
                </div>
          </div>
        </div>
      </div>
    </section>
@endpostulations

@endsection







