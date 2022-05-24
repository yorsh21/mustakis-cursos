@extends('layouts.backend')

@section('content')

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Talleres</div>
                        <div class="panel-body">
                            <div class="ibox float-e-margins">
                            <a href="{{ route('school-workshop.create') }}" class="btn btn-success btn-sm" title="Agregar nuevo SchoolWorkshop">
                                <i class="fa fa-plus" aria-hidden="true"></i> Crear Nuevo
                            </a>
                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                            <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nombre</th>
                                                        <th>Descripción</th>
                                                        <th>Código</th>
                                                        <th>Prerrequisitos</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($schoolworkshop as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration or $item->id }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->description }}</td>
                                                        <td>{{ $item->code }}</td>
                                                        <td>
                                                            {{ $item->parent->name or '' }} <br>
                                                            {{ $item->parent2->name or '' }} <br>
                                                            {{ $item->parent3->name or '' }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('school-workshop.show', $item->id) }}" title="Ver SchoolWorkshop"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                                            <a href="{{ route('school-workshop.edit', $item->id) }}" title="Editar SchoolWorkshop"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                                            <form method="POST" action="{{ route('school-workshop.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                                {{ method_field('DELETE') }}
                                                                {{ csrf_field() }}
                                                                <button type="submit" class="btn btn-danger btn-xs" title="Eliminar SchoolWorkshop" onclick="return confirm('¿Deseas realizar la eliminación?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
