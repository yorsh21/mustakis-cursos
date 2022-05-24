@extends('layouts.frontend')

@section('content')

    <section id="contact">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Recuperar Contraseña</h2><br><br>
        <div class="row">
          <div class="col-lg-8 mx-auto">
            @if(session('status1'))
                <div class="text-center">
                    <br>
                    <p id="message_success">{{ session('status1') }}</p><br>
                    <a href="{{ route('inicio') }}" class="btn btn-warning btn-xl">Volver</a>
                </div>
            @else
                <p class="text-center">Ingresa tus datos y te enviaremos las instrucciones para recuperar la contraseña</p>
                <form method="POST" action="{{ route('recover.sendmail') }}">
                    {{ csrf_field() }}
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label>Correo</label>
                            <input class="form-control" name="email" type="text" placeholder="Correo" required="required" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <p class="help-block text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </p>
                            @endif
                        </div>
                    </div>
                    <p id="message_error">{{ session('status0') }}</p><br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-xl">Recuperar</button>
                        <a href="{{ route('inicio') }}" class="btn btn-warning btn-xl">Volver</a>
                    </div>
                </form>
            @endif
          </div>
        </div>
      </div>
    </section>

@endsection