@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if(Session::has('message'))
            <div class="alert alert-{{ Session::get('message')[0] }}" role="alert">
                {{ Session::get('message')[1] }}
            </div>
        @endif

        @if(session()->has('status'))
            <div class="alert alert-info alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {{ session('status') }}
            </div>
        @endif

        @unless($fill_full)
			@include('backend.user.view_forms', ["into_postulacion" => true])
        @endunless

        <div class="panel panel-default">
            <div class="panel-heading">Solicitudes</div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Periodo</th>
                                <th>Nombre Taller</th>
                                <th>Inicio Postulación</th>
                                <th>Término Postulación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($postulations as $postulation)
                            <tr>
                                <td>{{ $loop->iteration or $postulation->id }}</td>
                                <td>{{ $postulation->period->name }}</td>
                                <td>{{ $postulation->school_workshop->name }}</td>
                                <td>{{ $postulation->start }}</td>
                                <td>{{ $postulation->end }}</td>
                            @if($postulation->solicitudes->firstWhere('user_id', Auth::user()->id))
                                <td>
                                    <form class="form" method="POST" action="{{ route('request.destroy', $postulation->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-large btn-danger" title="Cancelar postulación" onclick="return confirm('¿Deseas cancelar la postulación a este taller?')">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i> Cancelar Solicitud
                                        </button>
                                    </form>
                                </td>
                            @else
                                <td class="{{ $fill_full ? '' : 'postulation-disabled' }}">
                                    @if ($postulation->school_workshop->parent || $postulation->school_workshop->parent2 || $postulation->school_workshop->parent3)
                                        @if (isset($attended[$postulation->school_workshop->id]))
                                            @if ($attended[$postulation->school_workshop->id] == 1)
                                                <form class="form" method="POST" action="{{ route('request.surveys') }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="postulation_id" value="{{ $postulation->id }}">
                                                    <button class="btn btn-large btn-primary" data-btn-ok-class="btn-success" type="submit" title="Postular a taller" {{ $fill_full ? '' :  'disabled' }}>
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                        Ver detalles
                                                    </button>
                                                </form>
                                                <p>Curso Aprobado</p>
                                            @else
                                                <form class="form" method="POST" action="{{ route('request.surveys') }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="postulation_id" value="{{ $postulation->id }}">
                                                    <button class="btn btn-large btn-primary" data-btn-ok-class="btn-success" type="submit" title="Postular a taller" {{ $fill_full ? '' :  'disabled' }}>
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                        Ver detalles
                                                    </button>
                                                </form>
                                                <p>Curso Reprobado</p>
                                            @endif
                                        @elseif (
                                            (isset($postulation->school_workshop->parent->id) && isset($attended[$postulation->school_workshop->parent->id]) && $attended[$postulation->school_workshop->parent->id] == 1) ||
                                            (isset($postulation->school_workshop->parent2->id) && isset($attended[$postulation->school_workshop->parent2->id]) && $attended[$postulation->school_workshop->parent2->id] == 1) ||
                                            (isset($postulation->school_workshop->parent3->id) && isset($attended[$postulation->school_workshop->parent3->id]) && $attended[$postulation->school_workshop->parent3->id] == 1)
                                        )
                                            <form class="form" method="POST" action="{{ route('request.surveys') }}" accept-charset="UTF-8" style="display:inline">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="postulation_id" value="{{ $postulation->id }}">
                                                <button class="btn btn-large btn-primary" data-btn-ok-class="btn-success" type="submit" title="Postular a taller" {{ $fill_full ? '' :  'disabled' }}>
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                    Ver detalles
                                                </button>
                                            </form>
                                            <p>No Cursado</p>
                                        @else
                                            <button class="btn btn-large btn-primary" data-btn-ok-class="btn-success" type="submit" title="Postular a taller" disabled>
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                Ver detalles
                                            </button>
                                            <p>No cumple con Prerrequisito</p>
                                        @endif
                                    @else
                                        @if (isset($attended[$postulation->school_workshop->id]))
                                            @if ($attended[$postulation->school_workshop->id] == 1)
                                                <form class="form" method="POST" action="{{ route('request.surveys') }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="postulation_id" value="{{ $postulation->id }}">
                                                    <button class="btn btn-large btn-primary" data-btn-ok-class="btn-success" type="submit" title="Postular a taller" {{ $fill_full ? '' :  'disabled' }}>
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                        Ver detalles
                                                    </button>
                                                </form>
                                                <p>Curso Aprobado</p>
                                            @else
                                                <form class="form" method="POST" action="{{ route('request.surveys') }}" accept-charset="UTF-8" style="display:inline">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="postulation_id" value="{{ $postulation->id }}">
                                                    <button class="btn btn-large btn-primary" data-btn-ok-class="btn-success" type="submit" title="Postular a taller" {{ $fill_full ? '' :  'disabled' }}>
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                        Ver detalles
                                                    </button>
                                                </form>
                                                <p>Curso Reprobado</p>
                                            @endif
                                        @else
                                            <form class="form" method="POST" action="{{ route('request.surveys') }}" accept-charset="UTF-8" style="display:inline">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="postulation_id" value="{{ $postulation->id }}">
                                                <button class="btn btn-large btn-primary" data-btn-ok-class="btn-success" type="submit" title="Postular a taller" {{ $fill_full ? '' :  'disabled' }}>
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                    Ver detalles
                                                </button>
                                            </form>
                                            <p>No Cursado</p>
                                        @endif
                                    @endif
                                </td>
                            @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Listado de Solicitudes</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Periodo</th>
                                <th>Taller</th>
                                @compareparameter('permitir_resultado_postulacion', 'si')
                                    <th>Estado</th>
                                @endcompareparameter
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($solicitudes as $item)
                            <tr>
                                <td>{{ $loop->iteration or $item->id }}</td>
                                <td>{{ $item->postulation->period->name }}</td>
                                <td>{{ $item->postulation->school_workshop->name }}</td>
                                @compareparameter('permitir_resultado_postulacion', 'si')
                                    <td><b>{{ ucfirst($item->status) }}</b></td>
                                @endcompareparameter
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
