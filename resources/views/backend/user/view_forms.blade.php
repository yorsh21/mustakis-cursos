<br><br>
<div class="panel panel-default">
    <div class="panel-body">
        <p>¡Completaste el primer paso! Para continuar y postular a nuestro programa deberás completar toda la información requerida que te solicitamos a continuación.</p>
        <br>
        @if(Auth::user()->is_fill_profile)
            <a type="button" href="{{ route('user.show.profile', Auth::user()->id) }}" class=" btn btn-primary btn-md">
                <i class="fa fa-check" aria-hidden="true"></i>
                Completar perfil
            </a>
        @else
            <a type="button" href="{{ route('user.show.profile', Auth::user()->id) }}" class=" btn btn-default btn-md">
                <i class="fa fa-genderless" aria-hidden="true"></i>
                Completar perfil
            </a>
        @endif


        {{-- 
        @if(Auth::user()->is_fill_personal_data)
            <a type="button" href="{{ route('user.personal.form') }}" class=" btn btn-primary btn-md">
                <i class="fa fa-check" aria-hidden="true"></i>
                Datos personales
            </a>
        @else
            <a type="button" href="{{ route('user.personal.form') }}" class=" btn btn-default btn-md">
                <i class="fa fa-genderless" aria-hidden="true"></i>
                Datos personales
            </a>
        @endif
        
        @if(Auth::user()->is_fill_documentacion_data)
            <a type="button" href="{{ route('user.documentacion.form') }}" class=" btn btn-primary btn-md">
                <i class="fa fa-check" aria-hidden="true"></i>
                Documentación
            </a>
        @else
            <a type="button" href="{{ route('user.documentacion.form') }}" class=" btn btn-default btn-md">
                <i class="fa fa-genderless" aria-hidden="true"></i>
                Documentación
            </a>
        @endif
        
        @if(Auth::user()->is_fill_establecimiento_data)
            <a type="button" href="{{ route('user.establecimiento.form') }}" class=" btn btn-primary btn-md">
                <i class="fa fa-check" aria-hidden="true"></i>
                Establecimiento
            </a>
        @else
            <a type="button" href="{{ route('user.establecimiento.form') }}" class=" btn btn-default btn-md">
                <i class="fa fa-genderless" aria-hidden="true"></i>
                Establecimiento
            </a>
        @endif

        @if(Auth::user()->is_fill_encuesta_data)
            <a type="button" href="{{ route('user.encuesta.form') }}" class=" btn btn-primary btn-md">
                <i class="fa fa-check" aria-hidden="true"></i>
                Encuesta
            </a>
        @else
            <a type="button" href="{{ route('user.encuesta.form') }}" class=" btn btn-default btn-md">
                <i class="fa fa-genderless" aria-hidden="true"></i>
                Encuesta
            </a>
        @endif
        --}}

        @if (isset($into_postulacion) && !$into_postulacion)
            @if(Auth::user()->is_fill_profile)
                <a type="button" href="{{ route('request.postulation') }}" class=" btn btn-success btn-md">
                    Ir a Postulaciones
                </a>
            @else
                <a type="button" href="#" class=" btn btn-success btn-md" disabled>
                    Ir a Postulaciones
                </a>
            @endif
        @endisset
        
    </div>
</div>
