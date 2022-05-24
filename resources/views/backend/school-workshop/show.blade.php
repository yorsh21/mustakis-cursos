@extends('layouts.backend')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $schoolworkshop->name }}</div>
                    <div class="panel-body">

                        <a href="{{ route('school-workshop.index') }}" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                        <a href="{{ route('school-workshop.edit', $schoolworkshop->id) }}" title="Editar SchoolWorkshop"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ route('school-workshop.destroy', $schoolworkshop->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Eliminar SchoolWorkshop" onclick="return confirm('¿Deseas realizar la eliminación?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $schoolworkshop->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Nombre </th>
                                        <td> {{ $schoolworkshop->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Descripción </th>
                                        <td> {{ $schoolworkshop->description }} </td>
                                    </tr>
                                    <tr>
                                        <th> Código </th>
                                        <td> {{ $schoolworkshop->code }} </td>
                                    </tr>
                                    <tr>
                                        <th>Prerrequisitos</th>
                                        <td>
                                            {{ $schoolworkshop->parent->name or '' }} <br>
                                            {{ $schoolworkshop->parent2->name or '' }} <br>
                                            {{ $schoolworkshop->parent3->name or '' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            @include('backend.block.index')

        </div>
@endsection
