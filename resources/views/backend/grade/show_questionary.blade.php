@extends('layouts.survey')

@section('content')
    <div class="row breadcrumb-container">
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('sumary') }}">Inicio</a>
            </li>
            <li>
                <a href="{{ route('grade.index') }}">Mis Cursos</a>
            </li>
            <li>
                <a href="{{ route('grade.view', $block_grade_user->block_grade->grade->id) }}">{{ $block_grade_user->block_grade->grade->school_workshop->name }}</a>
            </li>
            <li class="active">
                <strong>{{ ucfirst($questionary->name) }}</strong>
            </li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Contestar {{ ucfirst($questionary->name) }}</div>
                <div class="panel-body">
                    <a href="{{ route('grade.view', $block_grade_user->block_grade->grade->id) }}" title="Atrás"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button></a>

                    <hr><p>{{ ucfirst($questionary->description) }}</p>

                    <form method="POST" action="{{ route('grade.questionary.answer', [$questionary->id, $block_grade_user->id]) }}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <div id="rendering"></div>
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </form>

                    
                </div>
            </div>
        </div>
    </div>
    
    <br><br><br>
@endsection


@section("scripts")answer_id
    <script>
        $(document).ready(function() {
            var data = '{{ json_encode($questionary->form) }}'.replace(/&quot;/g, '"');
            
            $('#rendering').formRender({
                dataType: 'json',
                formData: data
            });
        })
    </script>
@endsection