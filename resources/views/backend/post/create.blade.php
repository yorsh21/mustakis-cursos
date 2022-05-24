@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                @if($type_forum == 'comment')
                    <div class="panel-heading">Nuevo Comentario</div>
                @elseif($type_forum == 'consult')
                    <div class="panel-heading">Nueva Consulta</div>
                @else
                    <div class="panel-heading">Nuevo Anuncio</div>
                @endif
                <div class="panel-body">
                    @if($type_forum == 'comment')
                        <a href="{{ route('post.show',Session::get('data_announcement')[0]) }}" title="Atrás">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Atrás
                            </button>
                        </a>
                    @elseif($type_forum == 'notice')
                        <a href="{{route('back.view',[$grade->id,'anuncio']) }}" title="Atrás">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Atrás
                            </button>
                        </a>
                    @elseif($type_forum == 'consult')
                        <a href="{{route('back.view',[$grade->id,'consulta']) }}" title="Atrás">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Atrás
                            </button>
                        </a>
                    @endif
                    <br/>
                    <br/>
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form enctype="multipart/form-data" method="POST" action="{{ route('post.store') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        <input type="hidden" name="type_forum" value="{{$type_forum}}">
                        @include ('backend.post.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
