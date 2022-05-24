@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <br/>
                    <div class="table-responsive">
                        <a href="{{ route('grade.index',$id_grade[0]) }}" title="Atrás">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Atrás
                            </button>
                        </a>
                        <h3 align="center">Tablero de discusión</h3>
                        @isset($type_forum_grade)
                            @roles('Mentor,Voluntario')
                            @if($status_grade == true)
                            <br>
                            <div>
                                <a title="Crear nueva discusión" aria-hidden="true"
                                   href=" {{ route('post.create.forum',"notice") }}" class="btn btn-primary btn-md">Crear
                                    nuevo tema</a>
                            </div>
                            <br>
                            @endif
                            @endroles
                        @endisset

                        @isset($type_forum_query)
                            @roles('Alumno')
                            @if($status_grade == true)
                            <br>
                            <div>
                                <a title="Crear nueva discusión" aria-hidden="true"
                                   href="{{ route('post.create.forum','notice') }}" class="btn btn-primary btn-md">Crear
                                    nuevo tema</a>
                            </div>
                            <br>
                            @endif
                            @endroles
                        @endisset

                        @if(count($announcements) > 0)
                            <table class="table table-borderless border-top border-left border-bottom border-right">
                                <thead>
                                <tr>
                                    <th class="border-right">Tema</th>
                                    <th class="border-right">Creado por</th>
                                    <th class="border-right">Respuestas</th>
                                    <th class="border-right">Ultimo mensaje</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $cont_comments = 0;
                                    $cont_last_comment = 0;
                                @endphp
                                @for($i = 0;$i < count($announcements);$i++)
                                    <tr>
                                        <td class="border-right">
                                            <a href="{{route('post.show',$announcements[$i]->id) }}" class="btn btn-success btn-xs"> {{ $announcements[$i]->title}}</a>
                                        </td>
                                        <td class="border-right">{{ $announcements[$i]->firstname." ".$announcements[$i]->lastname }}</td>
                                        <td class="border-right">{{ $count_comments[$cont_comments]->ChildCount }}</td>
                                        @if($cont_last_comment < count($lasted_comments))
                                            <td align="right" class="border-right">
                                                {{ $lasted_comments[$cont_last_comment]->firstname . " " . $lasted_comments[$cont_last_comment]->lastname }}
                                                <br>
                                                {{\Carbon\Carbon::parse($lasted_comments[$cont_last_comment]->date)->format('D,')}}
                                                {{\Carbon\Carbon::parse($lasted_comments[$cont_last_comment]->date)->format('d')." de "}}
                                                {{\Carbon\Carbon::parse($lasted_comments[$cont_last_comment]->date)->format('M')." de "}}
                                                {{\Carbon\Carbon::parse($lasted_comments[$cont_last_comment]->date)->format('Y,')}}
                                                {{\Carbon\Carbon::parse($lasted_comments[$cont_last_comment]->date)->format('h:i')}}
                                            </td>
                                        @else
                                            <td align="right" class="border-right">
                                                {{ $announcements[$i]->firstname." ".$announcements[$i]->lastname }}
                                                <br>
                                                {{\Carbon\Carbon::parse($announcements[$i]->announcement_created)->format('D,')}}
                                                {{\Carbon\Carbon::parse($announcements[$i]->announcement_created)->format('d')." de "}}
                                                {{\Carbon\Carbon::parse($announcements[$i]->announcement_created)->format('M')." de "}}
                                                {{\Carbon\Carbon::parse($announcements[$i]->announcement_created)->format('Y,')}}
                                                {{\Carbon\Carbon::parse($announcements[$i]->announcement_created)->format('h:i')}}
                                            </td>
                                        @endif
                                    </tr>
                                    @php
                                        $cont_comments++;
                                        $cont_last_comment++;
                                    @endphp
                                @endfor
                                </tbody>
                            </table>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
