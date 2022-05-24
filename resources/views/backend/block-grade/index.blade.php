@extends('layouts.backend')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Blockgrade</div>
                    <div class="panel-body">
                        <a href="{{ route('block-grade.create') }}" class="btn btn-success btn-sm" title="Agregar nuevo BlockGrade">
                            <i class="fa fa-plus" aria-hidden="true"></i> Crear Nuevo
                        </a>

                        <form method="GET" action="{{ route('block-grade.index') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Buscar..." value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Comment</th><th>Start Date</th><th>End Date</th><th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($blockgrade as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->comment }}</td><td>{{ $item->start_date }}</td><td>{{ $item->end_date }}</td>
                                        <td>
                                            <a href="{{ route('block-grade.show', $item->id) }}" title="Ver BlockGrade"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                            <a href="{{ route('block-grade.edit', $item->id) }}" title="Editar BlockGrade"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                            <form method="POST" action="{{ route('block-grade.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Eliminar BlockGrade" onclick="return confirm('¿Deseas realizar la eliminación?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $blockgrade->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
