@extends('layouts.frontend')

@section('content')

<section class="bg-white text-white mb-0">
    <div class="container"><br><br><br>
        <div class="row">
            <div class="col-lg-12 ml-auto">
                @isset ($status)
                    @if ($status == 0)
                        <form method="POST" action="{{ route('recover.restart.password') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $id or '' }}">
                            <input type="hidden" name="token" value="{{ $token or '' }}">
                            <div class="container">
                                <h2 align="center">Recuperar Contraseña</h2><br>

                                <div class="row">
                                    <div align="center" class="col-md-12">
                                        <div class="form-group col-md-6 col-sm-10">
                                            <label class="control-label" for="rut">Rut</label>
                                            <input type="text" class="form-control" id="rut" name="rut" value="{{ old('rut') }}" oninput="checkRut(this)" onkeypress="return checkKeys(event)" minlength="9" maxlength="10" placeholder="12345678-9">
                                            <p id="message_error">{{ $message or '' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div align="center" class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="contraseña">Contraseña</label>
                                                <input type="password" class="form-control" id="password" placeholder="Ingrese Contraseña" name="password" value="{{ old('password2') }}"  minlength="6" maxlength="35" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div align="center" class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="contraseña">Confirmar contraseña</label>
                                            <input type="password" class="form-control" id="password2" placeholder="Ingrese Contraseña" name="password2" value="{{ old('password2') }}" oninput="checkPassword(this)" minlength="6" maxlength="35" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div align="center" class="col-md-12"><br><br>
                                    <button id="submit-register" type="submit" class="col-md-3 btn btn-primary btn-md">Cambiar</button>
                                    <a href="{{ route('inicio') }}" class="col-md-3 btn btn-warning btn-md">Volver</a>
                                </div>
                            </div>
                        </form>
                    @elseif($status == 1)
                        <div class="container text-center">
                            <h2 align="center">Recuperar Contraseña</h2><br>
                            <p>Error en la solicitud. Intente solicitar su contraseña nuevamente</p>
                            <p><a href="{{ route('recover.password') }}">Recuperar contraseña</a></p><br>
                            <a href="{{ route('inicio') }}" class="btn btn-warning btn-xl">Volver</a>
                        </div>
                    @else
                        <div class="container text-center">
                            <h2 align="center">Recuperar Contraseña</h2><br>
                            <p>La solicitud esta caducada</p>
                            <a href="{{ route('inicio') }}" class="btn btn-warning btn-xl">Volver</a>
                        </div>
                    @endif
                @else
                    <div class="container text-center">
                        <h2 align="center">Sitio no encontrado</h2><br>
                        <a href="{{ route('inicio') }}" class="btn btn-warning btn-xl">Volver</a>
                    </div>
                @endisset
            </div>
        </div>
    </div>
</section>


@endsection
