@extends('layouts.backend')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">

                    <form enctype="multipart/form-data" method="POST" id="form" action="{{ route('user.documentacion') }}" class="wizard-big wizard clearfix" role="application">
                        {{csrf_field()}}
                        <input type="hidden" name="type_form" value="documentation">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <div class="steps clearfix"></div>
                        <div class="content clearfix">
                        <h1 id="form-h-0" tabindex="-1" class="title">Documentación</h1>
                        <br>
                        <p>Para completar este paso, procura descargar los formatos cada uno de los archivos que correspodan (Carta Carta Autorización Apoderados, Carta de Compromiso Colegios y Cesión de Imagen). Los puedes llenar a mano o en digital, deben ser firmados por las personas solicitadas (apoderados, Director del establecimiento según sea requerido) para luego ser digitalizados y subidos al campo indicado.</p>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label right-down" for="auth_doc">
                                        Carta Autorización Apoderados 
                                        @php echo $documents['auth_doc']; @endphp
                                        @php 
                                            echo '<i class="text-error">'. $errors->first('auth_doc'). '</i>' 
                                        @endphp
                                    </label>
                                    <input type="file" class="form-control" id="auth_doc" name="auth_doc" placeholder="Subir archivo" oninput='validateFileSize(this)'>
                                    @unless(is_null($user->auth_doc))
                                        Archivo subido: <a href="{{ route('user.download', ['auth_doc', $user->id])}}">Descargar archivo subido</a><br>
                                    @endunless
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label right-down" for="school_doc">
                                        Carta de Compromiso Colegios 
                                        @php echo $documents['school_doc']; @endphp
                                        @php 
                                            echo '<i class="text-error">'. $errors->first('school_doc'). '</i>' 
                                        @endphp
                                    </label>
                                    <input type="file" class="form-control" id="school_doc" name="school_doc" placeholder="Subir archivo" oninput='validateFileSize(this)'>
                                    @unless(is_null($user->school_doc))
                                        Archivo subido: <a href="{{ route('user.download', ['school_doc', $user->id])}}">Descargar archivo subido</a><br>
                                    @endunless
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label right-down" for="auth_doc2">
                                        Carta Autorización Apoderados, página 2 (opcional)
                                        @php 
                                            echo '<i class="text-error">'. $errors->first('auth_doc2'). '</i>' 
                                        @endphp
                                    </label>
                                    <input type="file" class="form-control" id="auth_doc2" name="auth_doc2" placeholder="Subir archivo" oninput='validateFileSize(this)'>
                                    @unless(is_null($user->auth_doc2))
                                        Archivo subido: <a href="{{ route('user.download', ['auth_doc2', $user->id])}}">Descargar archivo subido</a><br>
                                    @endunless
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label right-down" for="school_doc2">
                                        Carta de Compromiso Colegios, página 2 (opcional)
                                        @php 
                                            echo '<i class="text-error">'. $errors->first('school_doc2'). '</i>' 
                                        @endphp
                                    </label>
                                    <input type="file" class="form-control" id="school_doc2" name="school_doc2" placeholder="Subir archivo" oninput='validateFileSize(this)'>
                                    @unless(is_null($user->school_doc2))
                                        Archivo subido: <a href="{{ route('user.download', ['school_doc2', $user->id])}}">Descargar archivo subido</a><br>
                                    @endunless
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label right-down" for="cession_doc">
                                        Cesión de Imagen 
                                        @php echo $documents['cession_doc']; @endphp
                                        @php 
                                            echo '<i class="text-error">'. $errors->first('cession_doc'). '</i>' 
                                        @endphp
                                    </label>
                                    <input type="file" class="form-control" id="cession_doc" name="cession_doc" placeholder="Subir archivo" oninput='validateFileSize(this)'>
                                    @unless(is_null($user->cession_doc))
                                        Archivo subido: <a href="{{ route('user.download', ['cession_doc', $user->id])}}">Descargar archivo subido</a><br>
                                    @endunless
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label right-down" for="license_student">
                                        Cédula de identidad digitalizada estudiante 
                                        @php echo $documents['license_student']; @endphp
                                        @php 
                                            echo '<i class="text-error">'. $errors->first('license_student'). '</i>' 
                                        @endphp
                                    </label>
                                    <input type="file" class="form-control" id="license_student" name="license_student" placeholder="Subir archivo" oninput='validateFileSize(this)'>
                                    @unless(is_null($user->license_student))
                                        Archivo subido: <a href="{{ route('user.download', ['license_student', $user->id])}}">Descargar archivo subido</a><br>
                                    @endunless
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label right-down" for="license_tutor">
                                        Cédula de identidad digitalizada tutor 
                                        @php echo $documents['license_tutor']; @endphp
                                        @php 
                                            echo '<i class="text-error">'. $errors->first('license_tutor'). '</i>' 
                                        @endphp
                                    </label>
                                    <input type="file" class="form-control" id="license_tutor" name="license_tutor" placeholder="Subir archivo" oninput='validateFileSize(this)'>
                                    @unless(is_null($user->license_tutor))
                                        Archivo subido: <a href="{{ route('user.download', ['license_tutor', $user->id])}}">Descargar archivo subido</a><br>
                                    @endunless
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label right-down" for="recomendation_doc">
                                        Carta de Recomendación (opcional) 
                                        @php echo $documents['recomendation_doc']; @endphp
                                        @php 
                                            echo '<i class="text-error">'. $errors->first('recomendation_doc'). '</i>' 
                                        @endphp
                                    </label>
                                    <input type="file" class="form-control" id="recomendation_doc" name="recomendation_doc" placeholder="Subir archivo" oninput='validateFileSize(this)'>
                                    @unless(is_null($user->recomendation_doc))
                                        Archivo subido: <a href="{{ route('user.download', ['recomendation_doc', $user->id])}}">Descargar archivo subido</a><br>
                                    @endunless
                                </div>
                            </div>
                        </div>

                        <p id="file-size">*El formulario acepta archivos PDF, DOC, JPG y PNG, pero se recomienda el uso de PDF. El limite en el peso de cada archivo es de 2MB.</p>
                        <br>
                        <p>Para reducir el tamaño de un <b>PDF</b> has click <a href="https://www.ilovepdf.com/compress_pdf" target="_blank">aquí</a></p>
                        <p>Para reducir el tamaño de una <b>imagen</b> has click <a href="https://imageresize.org/" target="_blank">aquí</a></p>
                        <br>

                        <div class="row">
                            <div class="col-md-12">
                                @roles('Administrador')
                                    <a href="{{route('user.show.profile', $user->id) }}" class="btn btn-success">Volver</a>
                                @else
                                    <a href="#" onclick="goBack()" title="Atrás" class="btn btn-success">Volver</a>
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