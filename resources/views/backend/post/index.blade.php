@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <br/>

                    <div class="table-responsive">
                        <a href="{{ route('grade.index') }}" title="Atrás">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Atrás
                            </button>
                        </a>
                        <br>
                        <br>

                        @roles('Alumno,Mentor,Voluntario')
                        <h3>Herramientas de comunicación</h3>
                        <br>
                        <div>
                            <a type="button" href="{{route('post.announcement.notice',$posts)}}"
                               class="btn btn-primary btn-xs">Anuncios</a>
                            <h5>Anuncios realizados por el mentor y el voluntario a los alumnos </h5>
                        </div>
                        @endroles
                        <br>

                        @roles('Alumno')
                        <div>
                            <a type="button" href="{{route('post.announcement.student',$posts)}}"
                               class="btn btn-primary btn-xs">Consultas</a>
                            <h5>Anuncios que pueden realizar los alumnos, tanto relacionados con el curso como de otros
                                temas </h5>
                        </div>
                        @endroles

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
