@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                @if($status_grade == false)
                    @roles('Alumno')
                    @if($posts[0]->forum == 'consulta' && !$posts[0]->grade->archived)
                        <h3><a type="button" href="{{ route('post.create.forum',"comment") }}" class="btn pull-right ">Responder</a></h3>
                    @endif
                    @endroles
                    @roles('Mentor,Voluntario')
                    @if($posts[0]->forum == 'anuncio' && !$posts[0]->grade->archived)
                        <h3><a type="button" href="{{ route('post.create.forum',"comment") }}" class="btn pull-right ">Responder</a></h3>
                    @endif
                    @endroles
                @endif
                <div class="panel-body">
                    @if($posts[0]->forum == 'consulta')
                        <a href="{{ route('back.view',[$posts[0]->grade_id,'consulta']) }}" title="Atrás">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>
                        </a>
                    @elseif($posts[0]->forum == 'anuncio')
                        <a href="{{ route('back.view',[$posts[0]->grade_id,'anuncio']) }}" title="Atrás">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>
                        </a>
                    @endif
                    <br/>
                    <div class="table-responsive">
                        <br>
                        <p><strong>Tema: </strong>{{ $posts[0]->title }}</p>
                        <p><strong>Curso: </strong>{{ $posts[0]->grade->school_workshop->name }}</p>
                        <p><strong>Publicado: </strong>{{ $posts[0]->FullCreatedDate }}</p>
                        <div class="chat-discussion">
                            @foreach($posts as $post)
                                @if($posts[0]->title == $post->title)
                                    <div class="chat-message left first-comment">
                                        <div class="message">
                                            <a class="message-author btn-disabled-default" href="#">
                                                {{ $post->division_user->user->firstname.' '.$post->division_user->user->lastname }}
                                            </a>
                                            <span class="message-date">
                                                {{ $post->FullCreatedDate }}
                                            </span>
                                            <span class="message-content">
                                                <h5><b>{{ $post->title }}</b></h5>
                                            </span>
                                            @if((Auth::user()->rol_id == 3 && $post->division_user->user->id == Auth::user()->id) || ($post->can_delete && $post->division_user->user->id == Auth::user()->id))
                                                <form method="POST" action="{{ route('post.destroy', [$post->id, $posts[0]->grade->id]) }}" accept-charset="UTF-8">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-link pull-right" title="Eliminar Post" onclick="return confirm('¿Deseas realizar la eliminación?')">Eliminar</button>
                                                </form>
                                            @endif
                                            <span class="message-content">
                                                <p>{{ $post->body }}</p>
                                            </span>
                                            @if(!is_null($post->file))
                                                <a href="{{ route('post.download', $post->id) }}">{{ $post->name }}</a>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="chat-message left">
                                        <div class="message">
                                            <a class="message-author btn-disabled-default" href="#">
                                                {{ $post->division_user->user->firstname.' '.$post->division_user->user->lastname }} 
                                            </a>
                                            <span class="message-date">
                                                   {{ $post->FullCreatedDate }}
                                            </span>
                                            <span class="message-content"><h5>
                                                <b>{{ $post->title }}</b></h5>
                                            </span>
                                            @if((Auth::user()->rol_id == 3 && $post->division_user->user->id == Auth::user()->id) || ($post->can_delete && $post->division_user->user->id == Auth::user()->id))
                                                <form method="POST" action="{{ route('post.destroy', [$post->id, $posts[0]->grade->id]) }}" accept-charset="UTF-8">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-link pull-right" title="Eliminar Post" onclick="return confirm('¿Deseas realizar la eliminación?')">Eliminar</button>
                                                </form>
                                            @endif
                                            <span class="message-content">
                                                <p>{{ $post->body }}</p>
                                            </span>
                                            @if(!is_null($post->file))
                                                <a href="{{ route('post.download', $post->id) }}">{{ $post->name }}</a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                <br>
                            @endforeach
                        </div>
                        @if($status_grade == false)
                            @if($if_mute)
                                <h3 class="btn pull-right">{{ $mute }}</h3>
                            @elseif(!$posts[0]->grade->archived)
                                @roles('Alumno,Mentor,Voluntario')
                                <h3><a type="button" href="{{ route('post.create.forum',"comment") }}" class="btn pull-right">Responder</a></h3>
                                @endroles
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>

@endsection
