@extends('layouts.frontend')

@section('content')

    <section id="contact">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Ingresar al Sistema</h2><br><br>
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <form method="POST" action="{{ route('login') }}">
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
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls mb-0 pb-2">
                        <label>Contraseña</label>
                        <input class="form-control" type="password" name="password" placeholder="Contraseña" required="required">
                        @if ($errors->has('password'))
                            <p class="help-block text-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                            </p>
                        @endif
                    </div>
                    <p><a href="{{ route('recover.password') }}">Olvidé mi contraseña</a></p>
                </div><br>
                <div id="success"></div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-xl" id="sendMessageButton">Entrar</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    @if($errors->has('email') || $errors->has('password'))
        <script type="text/javascript">
            window.location.hash = "#contact";
        </script>
    @endif

@endsection