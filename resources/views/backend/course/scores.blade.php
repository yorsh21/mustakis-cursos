@extends('layouts.backend')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Puntajes</div>
                    <div class="panel-body">
                        <div class="ibox float-e-margins">
                            <a href="{{ route('course.create') }}" class="btn btn-success btn-sm" title="Crear nueva Sede">
                                <i class="fa fa-plus" aria-hidden="true"></i> Crear Nuevo
                            </a>
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Colegio</th>
                                                    <th>Comuna</th>
                                                    <th>Puntaje</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($courses as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration or $item->id }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->commune->name }}</td>
                                                        <td>
                                                            <form class="form-course-score" method="POST" action="{{ route('course.update.school') }}" accept-charset="UTF-8">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                                <input type="number" data-id="{{ $item->id }}" class="form-control input-score" name="score" value="{{ $item->score }}">
                                                                <button type="submit" id="button-{{ $item->id }}" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
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

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            function actions() {
                $('.input-score').change(function() {
                    var id = $(this).data("id");
                    var button = $("#button-" + id);
                    button.removeClass('btn-dafault');
                    button.removeClass('disabled');
                    button.addClass('btn-primary');
                });
                
                $('.form-course-score').submit(function(e) {
                    e.preventDefault();

                    var form = $(this);
                    var url = form.attr('action');
                    var data = form.serialize();

                    $.post(url, data, function (res) {
                        var button = form.find($('button'));
                        button.removeClass('btn-primary');
                        button.addClass('btn-dafault');
                        button.addClass('disabled');
                    });
                });
            }

            actions();

            $(".dataTables_paginate, .sorting_desc, .sorting_asc, .sorting").click(function() {
                actions();
            });
        });
        
    </script>
@endsection