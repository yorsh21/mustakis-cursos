@extends('layouts.backend')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Sesión {{ $block->id }}</div>
                    <div class="panel-body">

                        <a href="{{ route('school-workshop.show', session('current_item_school')) }}" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>
                        <a href="{{ route('block.edit', $block->id) }}" title="Editar Block"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ route('block.destroy', $block->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Eliminar Block" onclick="return confirm('¿Deseas realizar la eliminación?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $block->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Descripción </th>
                                        <td> {{ $block->description }} </td>
                                    </tr>
                                    <tr>
                                        <th> Nombre de Evaluación </th>
                                        <td> {{ $block->evaluation_name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Tipo de Evaluación </th>
                                        <td> {{ $block->evaluation_type }} </td>
                                    </tr>
                                    <tr>
                                        <th> Ponderación </th>
                                        <td> {{ $block->weighing }} </td>
                                    </tr>
                                    <tr>
                                        <th> Taller </th>
                                        <td> {{ $block->school_workshop->id }} </td>
                                    </tr>
                                    <tr>
                                        <th> Cuestionario </th>
                                        <td> 
                                            @if (empty($questionary))
                                                Ninguna
                                            @else
                                                <a href="{{ route('questionary.show', $questionary->_id) }}" title="Ver cuestionario" target="_blank">
                                                    {{ $questionary->name }}
                                                </a> 
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            @include('backend.material.index')

        </div>
@endsection
