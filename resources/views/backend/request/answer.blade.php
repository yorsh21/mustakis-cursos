@extends('layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <a href="#" onclick="goBack()" title="Atrás">
                        <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás</button>
                    </a>
                    <br/>
                    <br/>

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                @foreach ($answers as $answer)
                                <tr>
                                    <td colspan="2">
                                        <strong>Cuestionario: {{ $answer->questionary["name"] }}</strong>
                                    </td>
                                </tr>
                                    @foreach ($answer->answers as $key => $value)
                                        @if ($key != "_token")
                                            <tr>
                                                <td class="sub-survey"> {{ $key }}</td>
                                                <td>
                                                    @if(is_array($value))
                                                        {{ join(", ", $value) }}
                                                    @else
                                                        {{ $value }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
