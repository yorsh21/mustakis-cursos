@extends('layouts.backend')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Ponderaciones</div>
                    <div class="panel-body">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable dtr-inline">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                    <th>Puntaje</th>
                                                    <th>Ponderación</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Curso 7° Básico</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_7_basico' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_7_basico'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                    <td class="td-weighings" rowspan="6">
                                                        <form class="form-parameter-weighings" method="POST" action="{{ route('course.update.weighings') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'ponderacion_curso' }}">
                                                            <input type="text" class="form-control input-parameter" name="weighings" value={{ $weighings['ponderacion_curso'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Curso 8° Básico</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_8_basico' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_8_basico'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Curso 1° Medio</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_1_medio' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_1_medio'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Curso 2° Medio</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_2_medio' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_2_medio'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>Curso 3° Medio</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_3_medio' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_3_medio'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>Curso 4° Medio</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_4_medio' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_4_medio'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>7</td>
                                                    <td>Colegio con Transporte</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_si_transporte' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_si_transporte'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                    <td class="td-weighings" rowspan="2">
                                                        <form class="form-parameter-weighings" method="POST" action="{{ route('course.update.weighings') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'ponderacion_transporte' }}">
                                                            <input type="text" class="form-control input-parameter" name="weighings" value={{ $weighings['ponderacion_transporte'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>8</td>
                                                    <td>Colegio sin Transporte</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_no_transporte' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_no_transporte'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>9</td>
                                                    <td>Ponderación Establecimientos</td>
                                                    <td>
                                                        <a href="{{ route('course.scores') }}" target="_blank">Ver Puntajes</a>
                                                    </td>
                                                    <td class="td-weighings">
                                                        <form class="form-parameter-weighings" method="POST" action="{{ route('course.update.weighings') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'ponderacion_establecimiento' }}">
                                                            <input type="text" class="form-control input-parameter" name="weighings" value={{ $weighings['ponderacion_establecimiento'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>10</td>
                                                    <td>Postulación propia</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_propia' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_propia'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                    <td class="td-weighings" rowspan="4">
                                                        <form class="form-parameter-weighings" method="POST" action="{{ route('course.update.weighings') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'ponderacion_postulacion' }}">
                                                            <input type="text" class="form-control input-parameter" name="weighings" value={{ $weighings['ponderacion_postulacion'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>11</td>
                                                    <td>Postulación propia con apoderados</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_propia_apoderados' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_propia_apoderados'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>12</td>
                                                    <td>Postulación propia con profesores</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_propia_profesores' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_propia_profesores'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>13</td>
                                                    <td>Postulación propia con apoderados y profesores</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_propia_apoderados_profesores' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_propia_apoderados_profesores'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>14</td>
                                                    <td>Poderación Carta Motivacional</td>
                                                    <td>
                                                        
                                                    </td>
                                                    <td class="td-weighings">
                                                        <form class="form-parameter-weighings" method="POST" action="{{ route('course.update.weighings') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'ponderacion_carta_motivacional' }}">
                                                            <input type="text" class="form-control input-parameter" name="weighings" value={{ $weighings['ponderacion_carta_motivacional'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>15</td>
                                                    <td>Genero Masculino</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_masculino' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_masculino'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                    <td class="td-weighings" rowspan="2">
                                                        <form class="form-parameter-weighings" method="POST" action="{{ route('course.update.weighings') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'ponderacion_genero' }}">
                                                            <input type="text" class="form-control input-parameter" name="weighings" value={{ $weighings['ponderacion_genero'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>16</td>
                                                    <td>Genero Femenino</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_femenino' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_femenino'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>17</td>
                                                    <td>Dependencia Establecimiento: Municipal</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_establecimiento_municipal' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_establecimiento_municipal'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                    <td class="td-weighings" rowspan="3">
                                                        <form class="form-parameter-weighings" method="POST" action="{{ route('course.update.weighings') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'ponderacion_dependencia' }}">
                                                            <input type="text" class="form-control input-parameter" name="weighings" value={{ $weighings['ponderacion_dependencia'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>18</td>
                                                    <td>Dependencia Establecimiento: Particular Subvencionado</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_establecimiento_particular_subvencionado' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_establecimiento_particular_subvencionado'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>19</td>
                                                    <td>Dependencia Establecimiento: Particular</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_establecimiento_particular' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_establecimiento_particular'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>20</td>
                                                    <td>Tipo Establecimiento: Científico humanista</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_tipo_cientifico' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_tipo_cientifico'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                    <td class="td-weighings" rowspan="3">
                                                        <form class="form-parameter-weighings" method="POST" action="{{ route('course.update.weighings') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'ponderacion_tipo_establecimiento' }}">
                                                            <input type="text" class="form-control input-parameter" name="weighings" value={{ $weighings['ponderacion_tipo_establecimiento'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>21</td>
                                                    <td>Tipo Establecimiento: Técnico profesional</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_tipo_tecnico' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_tipo_tecnico'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>22</td>
                                                    <td>Tipo Establecimiento: N/A</td>
                                                    <td>
                                                        <form class="form-parameter-score" method="POST" action="{{ route('course.update.score') }}" accept-charset="UTF-8">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="key" value="{{ 'puntaje_tipo_n_a' }}">
                                                            <input type="text" class="form-control input-parameter" name="score" value={{ $scores['puntaje_tipo_n_a'] }}>
                                                            <button type="submit" class="btn btn-dafault btn-xs disabled" title="Guardar Puntaje"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td>Suma ponderaciones</td>
                                                    <td></td>
                                                    <td>
                                                        <span id="sum-weighings">{{ $weighings['ponderacion_curso'] + $weighings['ponderacion_transporte'] + $weighings['ponderacion_establecimiento'] + $weighings['ponderacion_postulacion'] + $weighings['ponderacion_carta_motivacional'] + $weighings['ponderacion_genero'] + $weighings['ponderacion_dependencia'] + $weighings['ponderacion_tipo_establecimiento'] }}</span>
                                                    </td>
                                                </tr>
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
        $( document ).ready(function() {
            $('.input-parameter').change(function() {
                var button = $(this).next();
                button.removeClass('btn-dafault');
                button.removeClass('disabled');
                button.addClass('btn-primary');

                var sum = 0;
                $('input[name="weighings"]').each(function() {
                    sum += parseFloat($(this).val());
                });

                $("#sum-weighings").text(sum.toFixed(2));
            });

            $('.form-parameter-score, .form-parameter-weighings').submit(function(e) {
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
        });
        
    </script>
@endsection