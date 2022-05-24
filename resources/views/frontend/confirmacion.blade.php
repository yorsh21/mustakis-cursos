@extends('layout.frontend')

@section('content')

    <section class="bg-info text-white mb-0" id="about">
      <div class="container">
        <h2 class="text-center text-uppercase text-white">Postulación Exitosa</h2>
        <hr class="star-light mb-5">
        <div class="row">
          <div class="col-lg-12 ml-auto">
            <p class="lead">Tu postulación fue ingresada exitosamente, en los proximos días te enviaremos un correo con los resultados de ésta</p>
          </div>
        </div>
        <div class="text-center mt-4">
          <a class="btn btn-xl btn-outline-light" href="{{ route('inicio')}}">
            <i class="fa fa-address-card-o mr-2"></i>
            Volver al Inicio
          </a>
        </div>
      </div>
    </section>

@endsection
