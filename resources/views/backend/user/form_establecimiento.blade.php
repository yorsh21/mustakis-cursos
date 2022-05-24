@extends('layouts.backend')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">

                <div class="ibox-content">

                    <form enctype="multipart/form-data" method="POST" id="form" action="{{ route('user.establecimiento') }}" class="wizard-big wizard clearfix" role="application">
                        {{csrf_field()}}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        
                        <div class="steps clearfix"></div>
                        <div class="content clearfix">
                            <h1 class="title">Establecimiento</h1>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="commune_establishment_student">La región de tu establecimiento educacional @php echo '<i class="text-error">'. $errors->first('commune_establishment_student'). '</i>' @endphp</label>
                                        <select id="select_region" class="form-control" name="commune_establishment_student">
                                            <option value="">Seleccione</option>
                                            @foreach($regions as $commune => $id)
                                                <option value="{{ $id }}" {{ $user->commune_establishment_student == $id ? 'selected' : '' }}>{{ $commune }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="establishment">Nombre de establecimiento educacional @php echo '<i class="text-error">'. $errors->first('establishment'). '</i>' @endphp</label>
                                        <select id="select_establishment" class="form-control" name="establishment" {{ empty($user->establishment) || is_numeric($user->establishment) ? '' : 'disabled' }}>
                                            <option id="select_default" value="">Seleccione</option>
                                            @foreach($establishments as $establishment)
                                                <option name="{{ $establishment->commune->region_id}}" value="{{ $establishment->id }}" {{ $user->establishment == $establishment->id ? 'selected' : '' }}>{{ $establishment->name }}</option>
                                            @endforeach
                                        </select>
                                        <a id="non-list" data-show="{{ empty($user->establishment) || is_numeric($user->establishment) ? '0' : '1' }}" href="#">Haz click aquí si tu establecimiento no está en la lista</a>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div id="div_school_commune" class="col-md-12" style="{{ empty($user->establishment) || is_numeric($user->establishment) ? 'display: none;' : '' }}">
                                        <div class="form-group">
                                            <label class="control-label" for="nombre">Ingresa el nombre de tu establecimiento @php echo '<i class="text-error">'. $errors->first('new_school'). '</i>' @endphp </label>
                                            <input id="new_school_commune" type="text" class="form-control" name="new_school_commune" id="new_school_commune" placeholder="Ingrese su establecimiento" value="{{ is_numeric($user->establishment) ? '' : $user->establishment }}" maxlength="250" minlength="3">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="Género">Dependencia de tu establecimiento educacional @php echo '<i class="text-error">'. $errors->first('dependency_establishment_student'). '</i>' @endphp</label>
                                        <select class="form-control" name="dependency_establishment_student">
                                            <option value="">Seleccione</option>
                                            <option value="0" {{ $user->dependency_establishment_student == '0' ? 'selected' : '' }}>Municipal</option>
                                            <option value="1" {{ $user->dependency_establishment_student == '1' ? 'selected' : '' }}>Particular subvencionado</option>
                                            <option value="2" {{ $user->dependency_establishment_student == '2' ? 'selected' : '' }}>Particular</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="Género">¿Tú colegio te ayudará con el transporte? @php echo '<i class="text-error">'. $errors->first('transport_establishment'). '</i>' @endphp</label>
                                        <select class="form-control" name="transport_establishment">
                                            <option value="">Seleccione</option>
                                            <option value="1" {{ $user->transport_establishment == '1' ? 'selected' : '' }}>Si</option>
                                            <option value="0" {{ $user->transport_establishment == '0' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="Género">Tipo de establecimiento educacional @php echo '<i class="text-error">'. $errors->first('type_establishment_student'). '</i>' @endphp</label>
                                        <select class="form-control type_establishment_student" name="type_establishment_student">
                                            <option value="">Seleccione</option>
                                            <option value="0" {{ $user->type_establishment_student == '0' ? 'selected' : '' }}>Científico humanista</option>
                                            <option value="1" {{ $user->type_establishment_student == '1' ? 'selected' : '' }}>Técnico profesional</option>
                                            <option value="2" {{ $user->type_establishment_student == '2' ? 'selected' : '' }}>N/A</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="nombre">¿Cuál es tu especialidad? @php echo '<i class="text-error">'. $errors->first('especiality'). '</i>' @endphp </label>
                                        <input id="especiality" type="text" class="form-control" name="especiality" id="especiality" placeholder="Ingrese especialidad" value="{{ $user->especiality or '' }}" maxlength="250" minlength="3" {{ is_null($user->especiality) ? 'disabled' : '' }}>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="Género">¿El postulante posee necesidades especiales? @php echo '<i class="text-error">'. $errors->first('special_needs'). '</i>' @endphp</label>
                                        <select id="special_needs" class="form-control" name="special_needs">
                                            <option value="">Seleccione</option>
                                            <option value="1" {{ $user->special_needs == '1' ? 'selected' : '' }}>Si</option>
                                            <option value="0" {{ $user->special_needs == '0' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="nombre">Indique brevemente las necesidades @php echo '<i class="text-error">'. $errors->first('needs_student'). '</i>' @endphp </label>
                                        <input type="text" class="form-control" name="needs_student" id="needs_student" placeholder="Ingrese necesidades" value="{{ $user->needs_student or '' }}" maxlength="250" minlength="3">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="Género">Sede a la que postulas @php echo '<i class="text-error">'. $errors->first('city_assist_workshop'). '</i>' @endphp</label>
                                        <select id="city_assist_workshop" class="form-control" name="city_assist_workshop">
                                            <option value="">Seleccione</option>
                                            @foreach($cities as $city => $id)
                                                <option value="{{ $id }}" {{ $user->city_assist_workshop == $id ? 'selected' : '' }}>{{ $city }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="Género">Si elegiste Puerto Montt, ¿En que taller deseas inscribirte? @php echo '<i class="text-error">'. $errors->first('workshop_puerto_montt'). '</i>' @endphp</label>
                                        <select id="workshop_puerto_montt" class="form-control" name="workshop_puerto_montt" {{ is_null($user->city_assist_workshop) ? 'disabled' : '' ? 'selected' : '' }}>
                                            <option value="">Seleccione</option>
                                            <option value="0" {{ $user->workshop_puerto_montt == '0' ? 'selected' : '' }}>Robotica Educativa</option>
                                            <option value="1" {{ $user->workshop_puerto_montt == '1' ? 'selected' : '' }}>Tecnologias Espaciales: ArduSat</option>
                                        </select>
                                    </div>
                                </div>

                            </div>


                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="Género">Selecciona tu horario de
                                            preferencia @php echo '<i class="text-error">'. $errors->first('horary_preference'). '</i>' @endphp</label>
                                        <select class="form-control" name="horary_preference">
                                            <option value="">Seleccione</option>
                                            <option value="0" {{ $user->horary_preference == '0' ? 'selected' : '' }}>Mañana (10:00) a (13:00)</option>
                                            <option value="1" {{ $user->horary_preference == '1' ? 'selected' : '' }}>Tarde (13:30) a (16:30)</option>
                                        </select>
                                        <small>*Sólo es una preferencia,  no significa que serás seleccionado en ese horario</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="establishment_workshop_robotic">¿Tú
                                            establecimiento educacional cuenta con un taller de
                                            robótica? @php echo '<i class="text-error">'. $errors->first('establishment_workshop_robotic'). '</i>' @endphp</label>
                                        <select class="form-control" name="establishment_workshop_robotic">
                                            <option value="">Seleccione</option>
                                            <option value="1" {{ $user->establishment_workshop_robotic == '1' ? 'selected' : '' }}>Si</option>
                                            <option value="0" {{ $user->establishment_workshop_robotic == '0' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="nombre"> ¿Cómo fue tu primer acercamiento a la robótica? @php echo '<i class="text-error">'. $errors->first('first_contact_robotic'). '</i>' @endphp </label>
                                        <input type="text" class="form-control" name="first_contact_robotic" id="first_contact_robotic" placeholder="Ingrese su primer acercamiento a la robótica" value="{{ $user->first_contact_robotic or '' }}" maxlength="250">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="broadcast_first_contact">¿Cómo te enteraste del Taller de Robótica? @php echo '<i class="text-error">'. $errors->first('broadcast_first_contact'). '</i>' @endphp</label>
                                        <select class="form-control" name="broadcast_first_contact">
                                            <option value="">Seleccione</option>
                                            <option value="0" {{ $user->broadcast_first_contact == '0' ? 'selected' : '' }}>Por mis profesores, ellos me invitaron a inscribirme
                                            </option>
                                            <option value="1" {{ $user->broadcast_first_contact == '1' ? 'selected' : '' }}>Recomendacion de mi familia</option>
                                            <option value="2" {{ $user->broadcast_first_contact == '2' ? 'selected' : '' }}>Invitación de amigos, compañeros de colegio</option>
                                            <option value="3" {{ $user->broadcast_first_contact == '3' ? 'selected' : '' }}>Aviso en los diarios</option>
                                            <option value="4" {{ $user->broadcast_first_contact == '4' ? 'selected' : '' }}>Redes sociales: Facebook, Twitter, etc.</option>
                                            <option value="5" {{ $user->broadcast_first_contact == '5' ? 'selected' : '' }}>Información en mi establecimiento educacional(afiche,diario mural)</option>
                                            <option value="6" {{ $user->broadcast_first_contact == '6' ? 'selected' : '' }}>Otro medio</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="doing_postulation">Cómo estás realizando esta postulación? @php echo '<i class="text-error">'. $errors->first('doing_postulation'). '</i>' @endphp</label>
                                        <select class="form-control" name="doing_postulation">
                                            <option value="">Seleccione</option>
                                            <option value="0" {{ $user->doing_postulation == '0' ? 'selected' : '' }}>Por mi propia cuenta</option>
                                            <option value="1" {{ $user->doing_postulation == '1' ? 'selected' : '' }}>Por mi propia cuenta y con el apoyo de mi(s) apoderado(s)</option>
                                            <option value="2" {{ $user->doing_postulation == '2' ? 'selected' : '' }}>Por mi propia cuenta y con el apoyo de mi(s) profesor(es)</option>
                                            <option value="3" {{ $user->doing_postulation == '3' ? 'selected' : '' }}>Por mi propia cuenta y con el apoyo de mi(s) apoderado(s) y mi(s) profesor(es)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="nombre">¿Por qué crees que deberías ser seleccionado para participar en este taller? Indica tu principal compromiso y qué razones te convierten en un aporte para un equipo de robótica @php echo '<i class="text-error">'. $errors->first('average_notes_language'). '</i>' @endphp </label>
                                        <h3><span class="text-navy">*Al redactar, recuerda que el máximo de caracteres son 500 </span> </h3>
                                        <textarea  class="form-control" name="about_select_workshop" id="about_select_workshop" placeholder="Ingrese un comentario" value="{{old('about_select_workshop')}}" maxlength="500" minlength="3">{{ $user->about_select_workshop or '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

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


@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $("#select_establishment").select2({
                placeholder: "Selecciona un Colegio",
                allowClear: true
            });

            /*if($("#select_region").val() == ""){
                $("#select_establishment").prop("disabled", true);
            }

            $("#select_region").change(function () {
                $("#select_establishment").val("");
                if ($(this).val() == "")
                    $("#select_establishment").prop("disabled", true);
                else
                    $("#select_establishment").prop("disabled", false);

                var region = $("#select_region option:selected").val();

                $("#select_establishment option").each(function () {
                    if ($(this).attr("name") == region)
                        $(this).css("display", "block");
                    else
                        $(this).css("display", "none");
                });
            });

            $("#select_establishment").change(function () {
               $("#new_school_commune").val("");
               console.log($(this).val())
               if($(this).val() == 'otro')
                   $("#div_school_commune").show();
               else
                   $("#div_school_commune").hide();
            });*/

            

            $("#non-list").click(function() {
                if($(this).data("show") == "0") {
                    $("#div_school_commune").fadeIn();
                    $(this).data("show", "1");

                    $("#select_establishment").prop("disabled", true);
                    $("#new_school_commune").val("");
                }
               else {
                    $("#div_school_commune").fadeOut();
                    $(this).data("show", "0");

                    $("#select_establishment").prop("disabled", false);
               }
            });

        });
        
    </script>
@endsection