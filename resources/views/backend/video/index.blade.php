@extends('layouts.backend')

@section('content')
        @roles('Mentor')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Nuevo Video</div>
                    <div class="panel-body">
                        <a href="{{ route('video.create') }}" class="btn btn-success btn-sm" title="Nuevo video">
                            <i class="fa fa-plus" aria-hidden="true"></i> Nuevo Video
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endroles

        <div class="row">
            @foreach($videos->sortByDesc('created_at') as $video)
                <div class="col-md-6">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Subido por {{ $video->user->name }}</h5>
                        </div>
                        <div class="ibox-content" style="">
                            <figure>
                                <iframe width="100%" height="420" src="https://www.youtube.com/embed/{{ $video->embed }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </figure>
                            <h5></h5>
                            <h4><strong>{{ $video->title }}</strong></h4>
                            <p><i class="fa fa-clock-o"></i> Subido el {{ $video->Date }}</p>
                            @php echo  nl2br($video->description); @endphp
                            <div class="row m-t-md">
                                <div class="col-md-10">
                                    <h5><strong>{{ $video->video_comments->count() }}</strong> Comentarios</h5>
                                </div>
                                <div class="col-md-2 text-right">
                                    @roles('Administrador,Coordinador')
                                        <a href="{{ route('video.edit', $video->id) }}">Editar </a>
                                    @endroles
                                    @roles('Administrador')
                                    <form method="POST" action="{{ route('video.destroy', $video->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-link" title="Eliminar Video" onclick="return confirm('¿Deseas realizar la eliminación?')">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    @endroles
                                </div>
                            </div>
                            <div class="social-footer">
                                @roles('Mentor,Asesor')
                                <div class="social-comment">
                                    <a href="" class="float-left">
                                        <img alt="image" src="{{ asset(Auth::user()->image) }}">
                                    </a>
                                    <form method="POST" action="{{ route('video.comment') }}" accept-charset="UTF-8" class="form-inline">
                                        {{ csrf_field() }}
            
                                        <textarea class="form-control textarea-full" name="comments" rows="1" placeholder="Escribe un comentario..."></textarea>
                                        <input type="hidden" name="video_id" value="{{ $video->id }}">
                                        <input type="submit" class="btn btn-primary btn-sm" value="Comentar">
                                    </form>
                                </div>
                                @endroles

                                @foreach($video->video_comments->sortByDesc('created_at') as $video_comment)
                                    <div class="social-comment">
                                        <a href="" class="float-left">
                                            <img alt="image" src="{{ asset($video_comment->user->image) }}">
                                        </a>
                                        <div class="media-body">
                                            <a href="#">
                                                {{ $video_comment->user->Name }}
                                            </a>
                                            {{ $video_comment->comments }}
                                            <br>
                                            <i class="fa fa-clock-o"> </i> <small class="text-muted"> {{ $video_comment->Date }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <br><br>
@endsection
