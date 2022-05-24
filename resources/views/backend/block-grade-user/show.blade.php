@extends('layouts.backend')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">BlockGradeUser {{ $blockgradeuser->id }}</div>
                    <div class="panel-body">

                        <a href="{{ route('block-grade-user.index') }}" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                        <a href="{{ route('block-grade-user.edit', $blockgradeuser->id) }}" title="Editar BlockGradeUser"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ route('blockgradeuser.destroy', $blockgradeuser->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Eliminar BlockGradeUser" onclick="return confirm('¿Deseas realizar la eliminación?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $blockgradeuser->id }}</td>
                                    </tr>
                                    <tr><th> Presence </th><td> {{ $blockgradeuser->presence }} </td></tr><tr><th> Score </th><td> {{ $blockgradeuser->score }} </td></tr><tr><th> Specific Date </th><td> {{ $blockgradeuser->specific_date }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
