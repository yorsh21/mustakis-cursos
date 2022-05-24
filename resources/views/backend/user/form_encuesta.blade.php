@extends('layouts.backend')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">

                <div class="ibox-content">

                    <form enctype="multipart/form-data" method="POST" id="form" action="{{ route('user.encuesta') }}" class="wizard-big wizard clearfix" role="application">
                        {{csrf_field()}}
                        <input type="hidden" name="type_form" value="inquiry">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <div class="steps clearfix"></div>
                        <div class="content clearfix">
                            <h1 id="form-h-0" tabindex="-1" class="title">Encuesta</h1>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>De las siguientes alternativas, indica tus 3 principales motivaciones para participar en el Taller de Robótica</label><br>
                                        <input type="checkbox" class="motivation" value="0" name="motivation[]" {{ strpos($user->motivation, '0') === false ? '' : 'checked'  }}>
                                            Quiero aprender robótica con mayor profundidad<br>
                                        <input type="checkbox" class="motivation" value="1" name="motivation[]" {{ strpos($user->motivation, '1') === false ? '' : 'checked'  }}>
                                            Quiero mejorar mis conocimientos en ciencias<br>
                                        <input type="checkbox" class="motivation" value="2" name="motivation[]" {{ strpos($user->motivation, '2') === false ? '' : 'checked'  }}>
                                            Deseo tener una actividad extra programática fuera de mi colegio<br>
                                        <input type="checkbox" class="motivation" value="3" name="motivation[]" {{ strpos($user->motivation, '3') === false ? '' : 'checked'  }}>
                                            Fue una recomendación de mi familia<br>
                                        <input type="checkbox" class="motivation" value="4" name="motivation[]" {{ strpos($user->motivation, '4') === false ? '' : 'checked'  }}>
                                            Fue una recomendación de mis amigos<br>
                                        <input type="checkbox" class="motivation" value="5" name="motivation[]" {{ strpos($user->motivation, '5') === false ? '' : 'checked'  }}>
                                            Fue una recomendación de un profesor<br>
                                        <input type="checkbox" class="motivation" value="6" name="motivation[]" {{ strpos($user->motivation, '6') === false ? '' : 'checked'  }}>
                                            Para hacer nuevos amigos<br>
                                        <input type="checkbox" class="motivation" value="7" name="motivation[]" {{ strpos($user->motivation, '7') === false ? '' : 'checked'  }}>
                                            Para participar en una competencia de robótica<br>
                                        <input type="checkbox" class="motivation" value="8" name="motivation[]" {{ strpos($user->motivation, '8') === false ? '' : 'checked'  }}>
                                            Conocer la universidad<br>
                                        <input type="checkbox" class="motivation" value="9" name="motivation[]" {{ strpos($user->motivation, '9') === false ? '' : 'checked'  }}>
                                            Identificar mi vocación de estudios superiores<br>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>¿Qué características del Taller de Robótica de la Fundación Mustakis te gustan más?</label><br>
                                        <input type="checkbox" value="0" class="features_workshop" name="features_workshop[]" {{ strpos($user->features_workshop, '0') === false ? '' : 'checked'  }}>
                                        Porque se hacen en una Universidad<br> 
                                        <input type="checkbox" value="1" class="features_workshop" name="features_workshop[]" {{ strpos($user->features_workshop, '1') === false ? '' : 'checked'  }}>
                                        Porque me facilitan elrobot<br>
                                        <input type="checkbox" value="2" class="features_workshop" name="features_workshop[]" {{ strpos($user->features_workshop, '2') === false ? '' : 'checked'  }}>
                                        Porque son gratuitos<br>
                                        <input type="checkbox" value="3" class="features_workshop" name="features_workshop[]" {{ strpos($user->features_workshop, '3') === false ? '' : 'checked'  }}>
                                        Porque me acomoda el horario<br>
                                        <input type="checkbox" value="4" class="features_workshop" name="features_workshop[]" {{ strpos($user->features_workshop, '4') === false ? '' : 'checked'  }}>
                                        Porque el taller es impartido por jóvenes universitarios<br> 
                                        <input type="checkbox" value="5" class="features_workshop" name="features_workshop[]" {{ strpos($user->features_workshop, '5') === false ? '' : 'checked'  }}>
                                        Porque es un taller convarios días y horas de trabajo<br> 
                                        <input type="checkbox" value="6" class="features_workshop" name="features_workshop[]" {{ strpos($user->features_workshop, '6') === false ? '' : 'checked'  }}>
                                        Porque nos prepara para una competencia <br>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>¿Tu colegio tiene talleres de robótica para alumnos?</label>
                                        <br>
                                        <label class="radio-inline">
                                            <input value="0" type="radio" name="school_workshop" {{ $user->school_workshop == '0' ? 'checked' : ''  }}>
                                            Si
                                        </label>
                                        <label class="radio-inline">
                                            <input value="1" type="radio" name="school_workshop" {{ $user->school_workshop == '1' ? 'checked' : ''  }}>
                                            No
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>¿Has participado en talleres de robótica en tu colegio?</label>
                                        <br>
                                        <label class="radio-inline">
                                            <input value="0" type="radio" name="participate_school_workshop" {{ $user->participate_school_workshop == '0' ? 'checked' : ''  }}>
                                            Si
                                        </label>
                                        <label class="radio-inline">
                                            <input value="1" type="radio" name="participate_school_workshop" {{ $user->participate_school_workshop == '1' ? 'checked' : ''  }}>
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>¿Has participado en talleres de robótica en otros lugares?</label>
                                        <br>
                                        <label class="radio-inline">
                                            <input value="0" type="radio" name="participate_other_workshop" {{ $user->participate_other_workshop == '0' ? 'checked' : ''  }}>
                                            Si
                                        </label>
                                        <label class="radio-inline">
                                            <input value="1" type="radio" name="participate_other_workshop" {{ $user->participate_other_workshop == '1' ? 'checked' : ''  }}>
                                            No
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>¿Has participado en competencias de robótica?</label>
                                        <br>
                                        <label class="radio-inline">
                                            <input value="0" type="radio" name="participate_tournament_robotic" {{ $user->participate_tournament_robotic == '0' ? 'checked' : ''  }}>
                                            Si
                                        </label>
                                        <label class="radio-inline">
                                            <input value="1" type="radio" name="participate_tournament_robotic" {{ $user->participate_tournament_robotic == '1' ? 'checked' : ''  }}>
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>¿Tienes un robot en tu casa?</label>
                                        <br>
                                        <label class="radio-inline">
                                            <input value="0" type="radio" name="robot_home" {{ $user->robot_home == '0' ? 'checked' : ''  }}>
                                            Si
                                        </label>
                                        <label class="radio-inline">
                                            <input value="1" type="radio" name="robot_home" {{ $user->robot_home == '1' ? 'checked' : ''  }}>
                                            No
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> ¿Cuentas con algún conocimiento de programación?</label>
                                        <br>
                                        <label class="radio-inline">
                                            <input value="0" type="radio" name="knowledge_programation" {{ $user->knowledge_programation == '0' ? 'checked' : ''  }}>
                                            Si
                                        </label>
                                        <label class="radio-inline">
                                            <input value="1" type="radio" name="knowledge_programation" {{ $user->knowledge_programation == '1' ? 'checked' : ''  }}>
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>¿A través de qué medio fue tu primer acercamiento a la robótica?</label><br>
                                        <input value="0" type="radio" name="find_about_workshop" {{ $user->find_about_workshop == '0' ? 'checked' : '' }}>
                                        Por la TV <br>
                                        <input value="1" type="radio" name="find_about_workshop" {{ $user->find_about_workshop == '1' ? 'checked' : '' }}>
                                        Amigos <br>
                                        <input value="2" type="radio" name="find_about_workshop" {{ $user->find_about_workshop == '2' ? 'checked' : '' }}>
                                        Familia <br>
                                        <input value="3" type="radio" name="find_about_workshop" {{ $user->find_about_workshop == '3' ? 'checked' : '' }}>
                                        Colegio <br>
                                        <input value="4" type="radio" name="find_about_workshop" {{ $user->find_about_workshop == '4' ? 'checked' : '' }}>
                                        Internet <br>
                                        <input value="5" type="radio" name="find_about_workshop" {{ $user->find_about_workshop == '5' ? 'checked' : '' }}>
                                        Libros <br>
                                        <input value="6" type="radio" name="find_about_workshop" {{ $user->find_about_workshop == '6' ? 'checked' : '' }}>
                                        Este será mi primer acercamiento <br>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>¿Tienes experiencia programando en alguna de estas plataformas?</label><br>
                                        <input value="0" type="checkbox" name="experience_platform[]" {{ strpos($user->experience_platform, '0') === false ? '' : 'checked'  }}>
                                        NXC <br>
                                        <input value="1" type="checkbox" name="experience_platform[]" {{ strpos($user->experience_platform, '1') === false ? '' : 'checked'  }}>
                                        NQC <br>
                                        <input value="2" type="checkbox" name="experience_platform[]" {{ strpos($user->experience_platform, '2') === false ? '' : 'checked'  }}>
                                        NXT (Bloques) <br>
                                        <input value="3" type="checkbox" name="experience_platform[]" {{ strpos($user->experience_platform, '3') === false ? '' : 'checked'  }}>
                                        RoboctC <br>
                                        <input value="4" type="checkbox" name="experience_platform[]" {{ strpos($user->experience_platform, '4') === false ? '' : 'checked'  }}>
                                        RoboLab <br>
                                        <input value="5" type="checkbox" name="experience_platform[]" {{ strpos($user->experience_platform, '5') === false ? '' : 'checked'  }}>
                                        Arduino <br>
                                        <input value="6" type="checkbox" name="experience_platform[]" {{ strpos($user->experience_platform, '6') === false ? '' : 'checked'  }}>
                                        C <br>
                                        <input value="6" type="checkbox" name="experience_platform[]" {{ strpos($user->experience_platform, '6') === false ? '' : 'checked'  }}>
                                        C++ <br>
                                        <input value="7" type="checkbox" name="experience_platform[]" {{ strpos($user->experience_platform, '7') === false ? '' : 'checked'  }}>
                                        Ninguna  <br>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pensando en el futuro: ¿cuál es el nivel de educación más alto que crees que vas a poder completar?</label><br>
                                        <input value="0" type="radio" name="education_level" {{ $user->education_level == '0' ? 'checked' : '' }}>
                                        No creo que llegue a completar 4º Año de Educación Media<br>
                                        <input value="1" type="radio" name="education_level" {{ $user->education_level == '1' ? 'checked' : '' }}>
                                        Una carrera en un Instituto Profesional o Centro de Formación Técnica<br>
                                        <input value="2" type="radio" name="education_level" {{ $user->education_level == '2' ? 'checked' : '' }}>
                                        Una carrera en una Universidad<br>
                                        <input value="3" type="radio" name="education_level" {{ $user->education_level == '3' ? 'checked' : '' }}>
                                        Post grado en una Universidad<br>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="study_career">¿Qué carrera es la que más te gustaría estudiar? @php echo '<i class="text-error">'. $errors->first('study_career'). '</i>' @endphp </label>
                                        <input type="text" class="form-control" name="study_career" id="study_career" placeholder="Ingrese una carrera" value="{{ $user->study_career or '' }}" maxlength="150" minlength="3">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="study_institution">¿En que institución crees que vas a estudiar? @php echo '<i class="text-error">'. $errors->first('study_institution'). '</i>' @endphp </label>
                                        <input type="text" class="form-control" name="study_institution" id="study_institution" placeholder="Ingrese una institución" value="{{ $user->study_institution or '' }}" maxlength="150" minlength="3">
                                    </div>
                                </div>
                            </div>

                        </div> <!-- End Container-->

                        <div class="row">
                            <div class="col-md-12">
                                @roles('Administrador')
                                    <a href="{{route('user.show.profile', $user->id) }}" class="btn btn-success">Volver</a>
                                @else
                                    <a href="{{ route('sumary') }}" class="btn btn-success">Volver</a>
                                @endroles
                                <button type="submit" class=" btn btn-primary btn-md">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>



@endsection












