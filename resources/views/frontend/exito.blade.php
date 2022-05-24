@extends('layouts.frontend')

@section('content')

    <section class="bg-info text-white mb-0">
      <div class="container"><br><br><br>
        <div class="row">
          <div class="col-lg-12 ml-auto text-center">
                <div class="container">
                    <br><br>
                    <h3>Gracias por registrarte en Robótica Educativa {{ date('Y') }}</h3><br>
                    <p>¡Completaste el primer paso! Para continuar y postular a nuestro programa deberás iniciar sesión y completar toda la información requerida que te solicitamos más adelante.</p>
                    <p></p>
                    <div class="row">
                        <div class="col-md-12">
                            <br><br><br><br>
                            <a href="{{ route('inicio') }}" class=" col-md-6 btn btn-warning btn-md">Iniciar Sesión</a>
                        </div>
                        <br><br><br><br><br><br><br><br>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>

@endsection







