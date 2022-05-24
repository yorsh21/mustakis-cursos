@extends('layouts.backend')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<br>

			@roles('Alumno')
				@postulations()
	    		<h2>Gracias por registrarte en Robótica Educativa {{ date("Y") }}.</h2>
				
				@include('backend.user.view_forms', ["into_postulacion" => false])
				
				<p>*Recuerda, los antecedentes solicitados son un requisito obligatorio de la postulación, por lo tanto, la ausencia de cualquiera de éstos implicará la calificación de la postulación como incompleta, o sea, no podrás avanzar en el proceso de evaluación de su postulación.</p>
            	<hr>
				@endpostulations()
            @endroles

    		@php
    			echo $init_text->value;
    		@endphp
    		
		</div>
		<br><br><br><br><br>
	</div>
@endsection
