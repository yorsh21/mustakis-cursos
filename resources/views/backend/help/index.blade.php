@extends('layouts.backend')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Centro de Ayuda</h2>
    </div>
</div>
<div id="help-section" class="fh-breadcrumb">
    <div class="fh-column">
        <div class="full-height-scroll">
            <ul class="list-group elements-list">
                <li class="list-group-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab-1">
                        <strong>Introducción</strong>
                        <div class="small m-t-xs">
                            <p>
                                ¿Qué es Programa Robótica?
                            </p>
                        </div>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-2">
                        <strong>Acceso a la plataforma</strong>
                        <div class="small m-t-xs">
                            <p class="m-b-xs">
                                Iniciar y cerrar sesión, recuperar contraseña y registro de alumnos.
                            </p>
                        </div>
                    </a>
                </li>
                @roles("Administrador")
                <li class="list-group-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-3">
                        <strong>Sedes</strong>
                        <div class="small m-t-xs">
                            <p class="m-b-xs">
                                Gestionar sedes
                            </p>
                        </div>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-4">
                        <strong>Periodos</strong>
                        <div class="small m-t-xs">
                            <p class="m-b-xs">
                                Gestionar periodos académicos
                            </p>
                        </div>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-5">
                        <strong>Talleres</strong>
                        <div class="small m-t-xs">
                            <p class="m-b-xs">
                                Gestionar talleres, secciones y materiales
                            </p>
                        </div>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-6">
                        <strong>Postulaciones</strong>
                        <div class="small m-t-xs">
                            <p class="m-b-xs">
                                Gestionar postulaciones
                            </p>
                        </div>
                    </a>
                </li>
                @endroles
                @roles("Administrador,Coordinador")
                <li class="list-group-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-7">
                        <strong>Solicitudes</strong>
                        <div class="small m-t-xs">
                            <p class="m-b-xs">
                                Gestionar solicitudes
                            </p>
                        </div>
                    </a>
                </li>
                @endroles
                @roles("Alumno")
                <li class="list-group-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-7b">
                        <strong>Postulaciones</strong>
                        <div class="small m-t-xs">
                            <p class="m-b-xs">
                                Gestionar solicitudes para inscripción a cursos
                            </p>
                        </div>
                    </a>
                </li>
                @endroles
                <li class="list-group-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-9">
                        <strong>Cursos</strong>
                        <div class="small m-t-xs">
                            <p class="m-b-xs">
                                Gestionar cursos
                            </p>
                        </div>
                    </a>
                </li>
                @roles("Administrador")
                <li class="list-group-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-8">
                        <strong>Encuestas y Cuestionarios</strong>
                        <div class="small m-t-xs">
                            <p class="m-b-xs">
                                Gestionar encuestas y cuestionarios
                            </p>
                        </div>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-11">
                        <strong>Estadísticas</strong>
                        <div class="small m-t-xs">
                            <p class="m-b-xs">
                                Informes de asistencia y postulación de alumnos
                            </p>
                        </div>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-12">
                        <strong>Documentos</strong>
                        <div class="small m-t-xs">
                            <p class="m-b-xs">
                                Administración de los documentos descagables por los alumnos en formularios de postulación
                            </p>
                        </div>
                    </a>
                </li>
                @endroles
                @roles("Administrador,Coordinador")
                <li class="list-group-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-10">
                        <strong>Certificados</strong>
                        <div class="small m-t-xs">
                            <p class="m-b-xs">
                                Creación y generación de certificados para alumnos
                            </p>
                        </div>
                    </a>
                </li>
                @endroles
                @roles("Administrador,Coordinador,Mentor")
                <li class="list-group-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-13">
                        <strong>Coordinación</strong>
                        <div class="small m-t-xs">
                            <p class="m-b-xs">
                                Gestión de horas de coordinación
                            </p>
                        </div>
                    </a>
                </li>
                @endroles
                @roles("Administrador,Asesor,Mentor")
                <li class="list-group-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-14">
                        <strong>Videos</strong>
                        <div class="small m-t-xs">
                            <p class="m-b-xs">
                                Subida, revisión y comentarios de videoclases.
                            </p>
                        </div>
                    </a>
                </li>
                @endroles
                @roles("Administrador,Coordinador,Mentor")
                <li class="list-group-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-15">
                        <strong>Usuarios</strong>
                        <div class="small m-t-xs">
                            <p class="m-b-xs">
                                Listado y gestión de usuarios de la plataforma separados por ROL.
                            </p>
                        </div>
                    </a>
                </li>
                @endroles
            </ul>
        </div>
    </div>

    <div class="full-height">
        <div class="full-height-scroll white-bg border-left">

            <div class="element-detail-box">

                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">

                        <div class="small text-muted">
                            <i class="fa fa-clock-o"></i> Diciembre 2019
                        </div>

                        <h1>
                            Introducción
                        </h1>

                        <p>
                            Programa Robótica es una plataforma de gestión de cursos, orientada principalmente a cursos de robótica, pero en su etapa actual, permite gestión de cursos de distinta índole. La función principal es la de poder conectar a alumnos y mentores durante el periodo en que dura un curso, permitiéndoles interactuar mediante foros, calendario de actividades, listas de asistencia y notas, entre otras cosas.
                        </p><br>
                        <p>A los administradores y coordinadores les permite gestionar periodos académicos, talleres, sedes, cursos, entre otros.</p>
                        <br><br><br>

                        <h3>Uso de la plataforma y perfil de usuario</h3>
                        <p>Para hacer uso de la plataforma se requiere una cuenta de usuario. Esta puede ser de tipo alumno, voluntario, asesor, mentor, coordinador o administrador. Dependiendo del rol asignado a la cuenta, se contará con diversas opciones.
                        </p>
                        <p>Todas las cuentas tienen un perfil de usuario, el cual puede ser modificado desde las opciones que se encuentran debajo del icono de usuario en el menú lateral.</p>
                        <img src="{{ asset('img/guia/menu.perfil.jpg') }}" alt="página de login de usuario" class="img-responsive"><br>
                        <p>Desde el perfil de usuario se podrán modificar datos como el nombre, género, correo electrónico, teléfono, dirección, imagen de perfil, entre otros.</p>
                        <img src="{{ asset('img/guia/perfil.view.jpg') }}" alt="página de login de usuario" class="img-responsive"><br>
                        <p>Al editar perfil, se permitirá el cambio de todos los campos excepto del <strong>rut</strong>.</p>
                        <p>También se puede cambiar la contraseña de usuario, la cual debe ser introducida dos veces para evitar errores de tipeo.</p>
                        <img src="{{ asset('img/guia/perfil.edit.jpg') }}" alt="página de login de usuario" class="img-responsive">
                        <p><strong>NOTA: </strong><small>No cambie datos de perfil y contraseña al mismo tiempo, ya que el botón <strong>Actualizar perfil</strong> no guarda la contraseña y el botón <strong>Cambiar contraseña</strong> no guarda datos del perfil</small>.</p><br>
                        <p>Para cambiar la imagen de perfil, se debe seleccionar en <strong>Cambiar Avatar</strong> y elegir entre uno de los iconos que se muestran en la ventana modal.</p>
                        <img src="{{ asset('img/guia/perfil.img.jpg') }}" alt="página de login de usuario" class="img-responsive"><br>
                    </div>

                    <div id="tab-2" class="tab-pane">
                        <div class="small text-muted">
                            <i class="fa fa-clock-o"></i> Diciembre 2019
                        </div>

                        <h1>Acceso a la plataforma</h1>
                        <p>La plataforma cuenta con un control de acceso el cual requiere una dirección de correo electrónica y una contraseña, los cuales identifican a cada uno de los usuarios en forma única. En la plataforma no existen dos usuarios con la misma dirección de correo asociada.</p>

                        <br><br>
                        <h3>Inicio se sesión</h3>
                        <p>Para ingresar a la plataforma se debe ir a la siguiente dirección web: <a href="{{ url('/') }}">{{ url('/') }}</a> e ingresar el correo de su usuario y su contraseña.</p>
                        <img src="{{ asset('img/guia/1.jpg') }}" alt="página de login de usuario" class="img-responsive">

                        <br><br>
                        <h3>Cerrar se sesión</h3>
                        <p>Para cerrar sesión en la plataforma se debe buscar el botón <strong>Salir</strong> ubicado en la barra superior del dashboard del sistema, al costado izquierdo.</p>
                        <img src="{{ asset('img/guia/6.jpg') }}" alt="barra para cerrar sesión" class="img-responsive">

                        <br><br>
                        <h3>Reestablacer contraseña</h3>
                        <p>Para reestablecer la contraseña de su cuenta de usuario, en caso de olvido puede ir al enlace  <strong>Olvidé mi contraseña</strong> ubicado en la pantalla de inicio de sesión. Al ingresar allí deberá introducir el correo electrónico con el cual está registrado en la plataforma.</p>
                        <img src="{{ asset('img/guia/2.jpg') }}" alt="solicitar restauración de contraseña" class="img-responsive"><br>
                        <p>Con esto se le enviará un correo con un link para reestablecer la contraseña.</p>
                        <img src="{{ asset('img/guia/3.jpg') }}" alt="correo de recuperación" class="img-responsive"><br>
                        <p>Luego como medida de seguridad adicional la plataforma le pedirá el RUT asociado a su cuenta de usuario y luego introducir dos veces su nueva contraseña de usuario.</p>
                        <img src="{{ asset('img/guia/4.jpg') }}" alt="correo de recuperación" class="img-responsive"><br>
                        <p>Si las contraseñas coinciden y su RUT es correcto se mostrará un mensaje de éxito.</p>
                        <img src="{{ asset('img/guia/5.jpg') }}" alt="correo de recuperación" class="img-responsive"><br>

                        <br><br>
                        <h3>Creación de cuentas</h3>
                        <p>La creación de cuentas de usuario está limitada solo a los alumnos, siempre y cuando haya un proceso de postulación abierto. 
                            @roles("Administrador")
                                <div class="small text-muted">Véase <a href="{{ route('postulation.index') }}" target="_blank">Postulaciones</a></div>
                            @endroles
                        </p>
                        <p>Cuando haya postulaciones abiertas en la parte superior de la pantalla de inicio de sesión aparecerá la opción para <strong>Registrarse</strong>.</p>
                        <img src="{{ asset('img/guia/7.jpg') }}" alt="barra para cerrar sesión" class="img-responsive"><br>
                        <p>En el formulario de registro se pedirá el nombre, apellido, correo, contraseña y RUT.</p>
                        <p>En caso de que no se cuenta con un RUT chileno, se podrá íngresar el pasaporte en su lugar.</p>
                    </div>

                    <div id="tab-3" class="tab-pane">
                        <div class="small text-muted">
                            <i class="fa fa-clock-o"></i> Diciembre 2019
                        </div>

                        <h1>Sedes</h1>

                        <p>Las sedes representan los lugares físicos en donde se pueden realizar las clases de los distintos cursos.</p>
                        <p>En la sección <a href="{{ route('campus.index') }}" target="_blank">Sedes</a> se muestra un listado de todas las sedes.</p>
                        <p>Cada sede tiene un nombre, una dirección, comuna, región y un coordinador asociado.</p>
                        <img src="{{ asset('img/guia/sedes.index.jpg') }}" alt="listado de sedes" class="img-responsive"><br>
                        <p>Al crear una sede y seleccionar un coordinador, automáticamente se heredan y llenan los campos de <strong>Región</strong> y <strong>Comuna</strong> de este. Esta es la configuración por defecto que permite al coordinador listar cursos y alumnos asociados a la región y comuna. Esta asignación automática solo llena los campos, permitiendo que estos puedan ser cambiados, estableciendo una región y comuna distinta a la del coordinador.</p>
                        <img src="{{ asset('img/guia/sedes.create.jpg') }}" alt="listado de sedes" class="img-responsive"><br>
                        <p>No se recomienda la <strong>eliminación</strong> de una sede si está ya tiene cursos asociados, ya que al realizar esta acción se perderá información relacionada con todo lo que tenga que ver con esta sede, esto incluye: cursos, solicitudes, información asociada a alumnos, entre otros.</p>
                    </div>
                    <div id="tab-4" class="tab-pane">
                        <div class="small text-muted">
                            <i class="fa fa-clock-o"></i> Diciembre 2019
                        </div>

                        <h1>Periodos</h1>

                        <p>Los periodos permiten separar el año en varios intervalos de tiempo sobre los cuales se desarrollarán los distintos cursos. Una analogía a estos serían los semestres, trimestres o cuatrimestres.</p>
                        <p>En la sección <a href="{{ route('period.index') }}" target="_blank">Periodos</a> se muestra un listado de todos los periodos. Cada periodo tiene un nombre, descripción, fecha de inicio y fecha de término.</p>
                        <img src="{{ asset('img/guia/periodos.index.jpg') }}" alt="listado de periodos" class="img-responsive"><br>
                        <p>Al crear un periodo será obligatorio llenar cada uno de los campos que componen este. Cabe destacar que, para el buen funcionamiento del sistema, es necesario que entre cada periodo no haya lagunas de tiempo para un año determinado.</p>
                        <img src="{{ asset('img/guia/periodos.create.jpg') }}" alt="crear de periodos" class="img-responsive"><br>
                    </div>
                    <div id="tab-5" class="tab-pane">
                        <div class="small text-muted">
                            <i class="fa fa-clock-o"></i> Diciembre 2019
                        </div>

                        <h1>Talleres</h1>

                        <p>Los talleres son los distintos tipos de cursos que importe la organización. Estos son solo la definición de un curso, que </p>
                        <img src="{{ asset('img/guia/talleres.index.jpg') }}" alt="listado de sedes" class="img-responsive"><br>
                        <p>Al crear un taller se solicita el nombre, descripción, un código interno para identificación y el prerrequisito. Este último hace referencia a los talleres que deben cursarse previamente para cursar este taller.</p>
                        <img src="{{ asset('img/guia/talleres.create.jpg') }}" alt="listado de sedes" class="img-responsive"><br>
                        <p>Al ver el contenido de un taller (con el botón <strong>Ver</strong>) se muestran los campos ingresados en la creación y la lista de <strong>sesiones</strong>. Estas corresponden al conjunto de clases que componen dicho taller.</p>
                        <p>Cada sección tiene asociada una descripción, nombre de evaluación, tipo de evaluación, ponderación a la nota final y cuestionario.</p>
                        @roles("Administrador")
                            <div class="small text-muted">Véase <a href="{{ route('questionary.index') }}" target="_blank">Cuestionarios</a></div><br>
                        @endroles
                        <img src="{{ asset('img/guia/talleres.view.jpg') }}" alt="crear sesion" class="img-responsive"><br>
                        <p>Al ver el contenido de una sesión (con el botón <strong>Ver</strong>) se muestran los campos ingresados en la creación y la lista de <strong>materiales</strong>. Estos corresponden a los distintos archivos y documentos que los alumnos tendrán disponible durante dicha clase. Estos archivos podrán ser descargados desde la página del curso cuando llegue la fecha de dicha clase.</p>
                        <img src="{{ asset('img/guia/talleres.sesion.view.jpg') }}" alt="vista sesión" class="img-responsive"><br>
                        <p>Los materiales se componen de un nombre, un campo <strong>general</strong> que indica si el material puede ser descargado en cualquier momento o solo durante la sesión, y el archivo propiamente tal, el cual es subido y almacenado en la plataforma.</p>
                        <img src="{{ asset('img/guia/talleres.sesion.material.create.jpg') }}" alt="crear material" class="img-responsive"><br>
                        <p>Desde el listado de los materiales se pueden descargar los archivos subidos.</p>
                    </div>
                    <div id="tab-6" class="tab-pane">
                        <div class="small text-muted">
                            <i class="fa fa-clock-o"></i> Diciembre 2019
                        </div>

                        <h1>Postulaciones</h1>

                        <p>Las postulaciones son las instancias en donde se le permite a la plataforma aceptar inscripciones de alumnos y su posterior postulación a los distintos talleres. Las postulaciones comprenden un nombre, fecha de inicio, fecha de término y periodo.</p>
                        <img src="{{ asset('img/guia/postulacion.index.jpg') }}" alt="listado de postulaciones" class="img-responsive"><br>
                        <p>Al crear una postulación se piden campos adicionales como asociar una encuesta de postulación, asignar un prerrequisito y un campo de selección para indicar si es necesario solicitar documentos al momento de la postulación o no.</p>
                        <img src="{{ asset('img/guia/postulacion.create.jpg') }}" alt="crear postulaciones" class="img-responsive"><br>
                    </div>
                    <div id="tab-7" class="tab-pane">
                        <div class="small text-muted">
                            <i class="fa fa-clock-o"></i> Diciembre 2019
                        </div>

                        <h1>Solicitudes</h1>

                        <p>Las solicitudes corresponden a las peticiones que hacen los alumnos sobre un taller para inscribirse.</p>
                        <img src="{{ asset('img/guia/solicitudes.index.jpg') }}" alt="listado de solicitudes" class="img-responsive"><br>
                        <p>El coordinador y administrador pueden aprobar y reprobar a un alumno. También pueden ver los documentos y asignar puntajes a la carta de motivación.</p>
                        <img src="{{ asset('img/guia/solicitudes.acciones.jpg') }}" alt="acciones de solicitudes" class="img-responsive"><br>
                        <p>Al ver una postulación se mostrarán en detalle todos los datos la postulación del alumno, documentos subidos e ir al perfil de usuario.</p>
                        <img src="{{ asset('img/guia/solicitudes.view.jpg') }}" alt="ver solicitudes" class="img-responsive"><br>
                    </div>
                    <div id="tab-7b" class="tab-pane">
                        <div class="small text-muted">
                            <i class="fa fa-clock-o"></i> Diciembre 2019
                        </div>

                        <h1>Postulaciones</h1>

                        <p>Las postulaciones son la forma en la que puedes inscribirte a los distintos cursos que importe la plataforma. Puedes ver un listado de todos los cursos disponibles para el presente periodo académico.
                        Algunos cursos tienen prerrequisitos, por lo que necesitaras dichos cursos más básicos antes de tomar cursos más avanzados.
                        </p>
                        <img src="{{ asset('img/guia/missolicitudes.index.jpg') }}" alt="listado de solicitudes" class="img-responsive"><br>
                        <p>Cabe destacar que enviar una solicitud aun curso no asegura la inscripción a estos, ya que, se realiza un proceso interno de filtro y selección. En cualquier caso, serás notificado al correo electrónico que tengas registrado en la plataforma.</p>
                        <p>Al postular te aparecerá un mensaje de éxito y se habilitará la opción de cancelar la solicitud. Solo puedes postular a un curso por periodo académico.</p>
                        <img src="{{ asset('img/guia/missolicitudes.postular.jpg') }}" alt="postular de solicitudes" class="img-responsive"><br>
                        <p>En la parte inferior aparecerán todas las solicitudes a cursos que hayas realizado en periodos anteriores.</p>
                    </div>
                    <div id="tab-8" class="tab-pane">
                        <div class="small text-muted">
                            <i class="fa fa-clock-o"></i> Diciembre 2019
                        </div>

                        <h1>Encuestas y Cuestionarios</h1>

                        <p>Las encuestas se componen de uno o más cuestionarios, los cuales agrupan preguntas de una cierta temática que permite a los alumnos contestarlas tanto en los cursos como en los procesos de postulación.</p>
                        <img src="{{ asset('img/guia/encuestas.index.jpg') }}" alt="listado de encuestas" class="img-responsive"><br>
                        <p>Al crear una encuesta se pide el nombre, una descripción y un listado de cuestionarios asociados. Dado esto, es recomendable crear primero los cuestionados y luego crear la encuesta. Otra opción es crear la encuesta, luego crear los cuestionarios y finalmente editar las encuestas para asociar los cuestionarios ya creados.</p>
                        <img src="{{ asset('img/guia/encuestas.create.jpg') }}" alt="crear encuestas" class="img-responsive"><br>
                        <img src="{{ asset('img/guia/encuestas.completado.jpg') }}" alt="completar cuestionarios" class="img-responsive"><br>
                        
                        <h3>Cuestionarios</h3>
                        <p>Los cuestionarios son conjuntos de preguntas relacionadas con una temática en común.</p>
                        <img src="{{ asset('img/guia/cuestionarios.index.jpg') }}" alt="listado cuestionarios" class="img-responsive"><br>
                        <p>Al crear un cuestionario, se pide un nombre y una descripción como base. Luego se pide armar el cuestionario con los tipos de campos que se tienen disponible. La herramienta para crear los cuestionarios contienen varios campos, pero solo se pueden utilizar los siguientes:</p>
                        <ul>
                            <li><strong>Autocompletar: </strong> este campo permite al usuario escribir texto y mientras escriba se mostrarán opciones de autocompletado con la posibilidad de elegir una de ellas. El usuario puede no seleccionar ninguna y simplemente dejar el texto escrito.</li>
                            <li><strong>Grupo de casillas: </strong> este campo permite tener un conjunto de casillas de selección múltiple, donde el usuario podrá elegir una o varias opciones.</li>
                            <li><strong>Campo de Fecha: </strong> este campo permite tener un calendario para la selección de fechas dentro del cuestionario.</li>
                            <li><strong>Título: </strong> este elemento permite agregar títulos o subtítulos dentro del cuestionario, lo cual puede ser útil para realizar separaciones lógicas para un conjunto de preguntas.</li>
                            <li><strong>Número: </strong> este elemento permite tener un campo de tipo numérico dentro del cuestionario</li>
                            <li><strong>Párrafo: </strong> este elemento permite agregar párrafos o textos dentro del cuestionario, lo cual puede ser útil para explicar algunos conceptos dentro del cuestionario.</li>
                            <li><strong>Grupo de Selección: </strong> este campo permite al usuario seleccionar solo una de opción de entre una lista de elementos.</li>
                            <li><strong>Seleccionable: </strong> este campo permite tener una lista de elementos, donde el usuario podrá elegir uno o varios elementos. </li>
                            <li><strong>Campo de Texto: </strong> este elemento permite tener un campo de tipo texto dentro del cuestionario.</li>
                            <li><strong>Área de texto: </strong> este campo permite escribir grandes extensiones de texto, con la opción de mostrar un campo mucho más largo que el de los anteriores. </li>
                        </ul>
                        <img src="{{ asset('img/guia/cuestionarios.create.jpg') }}" alt="crear cuestionarios" class="img-responsive"><br>
                        <p>Para agregar un campo al cuestionario simplemente debe ser arrastrado desde la lista de campos disponibles hacia el centro del área de cuestionario.</p>
                        <img src="{{ asset('img/guia/cuestionarios.arrastrar.jpg') }}" alt="arrastrar cuestionarios" class="img-responsive"><br>
                        <p>Para ver cómo va quedando el cuestionario se puede presionar el botón <strong>Previsualizar</strong> de la parte superior. Se abrirá una ventana modal con la vista previa del formulario.</p>
                        <img src="{{ asset('img/guia/cuestionarios.previsualizar.jpg') }}" alt="previsualizar cuestionarios" class="img-responsive"><br>
                        <p>Desde el listado de cuestionarios se puede ver o editar un cuestionario ya existente.</p>
                        <img src="{{ asset('img/guia/cuestionarios.view.jpg') }}" alt="ver cuestionarios" class="img-responsive"><br>
                    </div>
                    <div id="tab-9" class="tab-pane">
                        <div class="small text-muted">
                            <i class="fa fa-clock-o"></i> Diciembre 2019
                        </div>

                        <h1>Cursos</h1>
                        @roles("Administrador,Coordinador")
                        <p>Los cursos son la entidad más importante del sistema ya que concentra la mayor cantidad de elementos y tiene relación con todo el resto de la plataforma.
                        El curso corresponde la realización de un taller en una sede determinada dentro de un periodo determinado. Los cursos además tienen cuentan con una capacidad de alumnos, un campo tipo y fechas de inicio y término.
                        </p>
                        <img src="{{ asset('img/guia/cursos.index.jpg') }}" alt="listado de cursos" class="img-responsive"><br>
                        <p>En la parte superior del listado se encuentra una serie de opciones para filtra los cursos, ya sea por periodo o estado: abierto o cerrado.</p>
                        <img src="{{ asset('img/guia/cursos.opciones.jpg') }}" alt="opciones de cursos" class="img-responsive"><br>
                        <p>Al crear un curso solicita todos los campos nombrados anteriormente.</p>
                        <img src="{{ asset('img/guia/cursos.create.jpg') }}" alt="crear de cursos" class="img-responsive"><br>
                        <p>Despues de crear se muestra una pantalla para asignar fechas, sala y comentarios a las sesiones o clases del curso. Cabe desatacar que estas heredan de las sesiones asignadas al taller al cual pertenece al curso. Al realizar cambios sobre cada sesión, se debe presionar el botón <strong>guardar</strong> de cada una.</p>
                        <img src="{{ asset('img/guia/cursos.sesiones.jpg') }}" alt="sesiones de cursos" class="img-responsive"><br>
                        <p>El siguiente paso es asignar a los mentores del curso. En el listado se puede ver el perfil de cada mentor y asignar al curso mediante el botón <strong>Vincular</strong>. Al realizar esta acción el botón pasará a ser rojo y dirá <strong>Desvincular</strong>. Esto permite desvincular al mentor de este curso.</p>
                        <img src="{{ asset('img/guia/cursos.mentores.jpg') }}" alt="mentores de cursos" class="img-responsive"><br>
                        <p>Lo mismo ocurre para los voluntarios y alumnos, para estos se puede ver su perfil, vincular y desvincular al curso actual.</p>
                        <img src="{{ asset('img/guia/cursos.voluntarios.jpg') }}" alt="mediadores de cursos" class="img-responsive"><br>
                        <img src="{{ asset('img/guia/cursos.alumnos.jpg') }}" alt="alumnos de cursos" class="img-responsive"><br>
                        <p>Una vez finalizada la creación y asignación de usuarios al curso, se regresará al listado de cursos y está listo para ser visualizado por los coordinadores pertinentes, y mentores, mediadores y alumnos que hayan sido asignados.</p>
                        <img src="{{ asset('img/guia/cursos.show.jpg') }}" alt="listado de cursos" class="img-responsive"><br>
                        <p>Al ver el <strong>Resumen del curso</strong> se puede ver el listado de los alumnos con sus notas y asistencias. La plataforma calcula en base a estos parámetros si el alumno está aprobando o reprobando.</p>
                        <p>Desde acá se puede cerrar un curso, seleccionando los alumnos que serán aprobados o reprobados (cambiando así en caso de excepciones el cálculo automático que realiza la plataforma). Los cursos cerrados ya no pueden ser modificados y ningún usuario podrá interactuar con él. Solo se podrán visualizar sus contendidos.</p>
                        <img src="{{ asset('img/guia/cursos.resumen.jpg') }}" alt="listado de cursos" class="img-responsive"><br>
                        <p>Al ver la <strong>Vista Mentor</strong> del curso se podrá acceder a las opciones académicas del curso, tal como son visualizadas por el mentor, y en gran medida por mediadores y alumnos.</p>
                        <p>En la pestaña <strong>Inicio</strong> se muestra la información básica del curso y contacto de mentores y ayudantes.</p>
                        <img src="{{ asset('img/guia/cursos.tab1.jpg') }}" alt="tab1 de cursos" class="img-responsive"><br>
                        <p>En la pestaña <strong>Sesiones</strong> se muestran las sesiones que componen el curso, mostrando información de la sala asignada, fecha y hora de inicio y término.</p>
                        <img src="{{ asset('img/guia/cursos.tab2.jpg') }}" alt="tab2 de cursos" class="img-responsive"><br>
                        <p>En la pestaña <strong>Materiales</strong> se muestran los materiales asignados al curso. Estos pueden ser descargadores directamente desde acá.</p>
                        <img src="{{ asset('img/guia/cursos.tab3.jpg') }}" alt="tab3 de cursos" class="img-responsive"><br>
                        <p>En la pestaña <strong>Anuncios</strong> se muestra el listado de mensajes del curso publicados por los mentores. Los alumnos puedes responder a cada uno de estos mensajes, con el fin de dar el espacio para generar una conversación.</p>
                        <img src="{{ asset('img/guia/cursos.tab4.jpg') }}" alt="tab4 de cursos" class="img-responsive"><br>
                        <p>En la pestaña <strong>Consultas</strong> se muestra en listado de los mensajes del curso publicados por los alumnos. Los profesores y los mismos alumnos pueden responder a cada uno de estos mensajes con el fin de poner generar una conversación.</p>
                        <img src="{{ asset('img/guia/cursos.tab5.jpg') }}" alt="tab5 de cursos" class="img-responsive"><br>
                        <p>En la pestaña <strong>Notas y Asistencia</strong> los mentores podrán llenar la asistencia de todos los participantes del curso. Además, podrán llenar las notas de los alumnos, escribir una bitácora para cada alumno y silenciarlos de foro de consultas y anuncios por una ventana de tiempo determinada.</p>
                        <img src="{{ asset('img/guia/cursos.tab6.jpg') }}" alt="tab6 de cursos" class="img-responsive"><br>
                        <p>En la pestaña <strong>Lista de Curso</strong> se muestra un listado de los alumnos del curso, con su correo electrónico y teléfono. Este listado está pensado para ser impreso y exportado en los distintos formatos que permite la tabla.</p>
                        <img src="{{ asset('img/guia/cursos.tab7.jpg') }}" alt="tab7 de cursos" class="img-responsive"><br>
                        <p>En la pestaña <strong>Hitos</strong> se muestra un calendario en la cual los mentores pueden agregar eventos para que los además integrantes del curso pueden verlos.</p>
                        <img src="{{ asset('img/guia/cursos.tab8.jpg') }}" alt="tab8 de cursos" class="img-responsive"><br>
                        @else
                        <p>Desde la sección cursos, los usuarios podrán visualizar los cursos a los que han sido asignados. En el listado aparecen datos rápidos del curso, y el estado: abierto o cerrado.</p>
                        <img src="{{ asset('img/guia/miscursos.index.jpg') }}" alt="listado de cursos" class="img-responsive"><br>
                        <p>Al seleccionar un curso, se podrá acceder al contenido completo del curso.</p>
                        <p>En la pestaña <strong>Inicio</strong> se muestra la información básica del curso y contacto de mentores y ayudantes.</p>
                        <img src="{{ asset('img/guia/cursos.tab1.jpg') }}" alt="tab1 de cursos" class="img-responsive"><br>
                        <p>En la pestaña <strong>Sesiones</strong> se muestran las sesiones que componen el curso, mostrando información de la sala asignada, fecha y hora de inicio y término.</p>
                        <img src="{{ asset('img/guia/cursos.tab2.jpg') }}" alt="tab2 de cursos" class="img-responsive"><br>
                        <p>En la pestaña <strong>Materiales</strong> se muestran los materiales asignados al curso. Estos pueden ser descargadores directamente desde acá.</p>
                        <img src="{{ asset('img/guia/cursos.tab3.jpg') }}" alt="tab3 de cursos" class="img-responsive"><br>
                        <p>En la pestaña <strong>Anuncios</strong> se muestra el listado de mensajes del curso publicados por los mentores. Los alumnos puedes responder a cada uno de estos mensajes, con el fin de dar el espacio para generar una conversación.</p>
                        <img src="{{ asset('img/guia/cursos.tab4.jpg') }}" alt="tab4 de cursos" class="img-responsive"><br>
                        <p>En la pestaña <strong>Consultas</strong> se muestra en listado de los mensajes del curso publicados por los alumnos. Los profesores y los mismos alumnos pueden responder a cada uno de estos mensajes con el fin de poner generar una conversación.</p>
                        <img src="{{ asset('img/guia/cursos.tab5.jpg') }}" alt="tab5 de cursos" class="img-responsive"><br>
                        <p>En la pestaña <strong>Asistencia</strong> los alumnos podrán ver su asistencia en cada una de las sesiones del curso.</p>
                        <img src="{{ asset('img/guia/miscursos.asistencia.jpg') }}" alt="listado de cursos" class="img-responsive"><br>
                        <p>En la pestaña <strong>Hitos</strong> se muestra un calendario en la cual los mentores pueden agregar eventos para que los demás integrantes del curso pueden verlos.</p>
                        <img src="{{ asset('img/guia/cursos.tab8.jpg') }}" alt="tab8 de cursos" class="img-responsive"><br>
                        @endroles
                        <p></p>
                    </div>
                    <div id="tab-10" class="tab-pane">
                        <div class="small text-muted">
                            <i class="fa fa-clock-o"></i> Diciembre 2019
                        </div>

                        <h1>Certificados</h1>

                        <p>Los certificados corresponden a reconocimientos en papel o medios digitales que se les pueden a hacer alumnos por algún motivo en específico o participación a algún evento.</p>
                        <img src="{{ asset('img/guia/certificados.index.jpg') }}" alt="listado de certificado" class="img-responsive"><br>
                        <p>Al crear un certificado se puede un nombre, descripción, orientación, fecha e imagen de fondo. Además, se mostrará una lista de campos del usuario y campos libres los cuales pueden utilizarse para llenar el certificado.</p>
                        <img src="{{ asset('img/guia/certificados.create1.jpg') }}" alt="crear de certificado - parte 1" class="img-responsive"><br>
                        <p>Al guardar el certificado, se generará un layout con la imagen y campos seleccionados. Los campos pueden moverse de lugar libremente dentro de área del certificado, además se puede redimensionar el contenedor de cada campo.</p>
                        <img src="{{ asset('img/guia/certificados.create2.jpg') }}" alt="crear de certificado - parte 2" class="img-responsive"><br>
                        <p>Desde el listado de certificados se puede ver, editar y eliminar cada uno. También se puede generar un certificado para todos los alumnos de un curso. La plataforma tomará los datos de cada alumno y los colocará en las posiciones definidas durante su creación. El resultado de la generación es un archivo comprimido con todos los certificados en formato PDF de todos los alumnos del curso seleccionado.</p>
                        <img src="{{ asset('img/guia/certificados.generate.jpg') }}" alt="listado de certificado" class="img-responsive"><br>
                    </div>
                    <div id="tab-11" class="tab-pane">
                        <div class="small text-muted">
                            <i class="fa fa-clock-o"></i> Diciembre 2019
                        </div>

                        <h1>Estadísticas</h1>

                        <p>La plataforma permite generar estadísticas de asistencia de usuarios que permiten ver los alumnos con un porcentaje de asistencia mayor al 63% tanto para cursos abiertos como cerrados. Se pueden realizar filtros por periodo y sede.</p>
                        <img src="{{ asset('img/guia/estadistica.postulaciones.jpg') }}" alt="asistencia de estadisticas" class="img-responsive"><br>
                        <p>La plataforma permite genera estadísticas de postulación que permiten ver la cantidad de alumnos inscritos a las distintas sedes de un periodo determinado.</p>
                        <img src="{{ asset('img/guia/estadistica.asistencia.jpg') }}" alt="postulaciones de estadisticas" class="img-responsive"><br>
                    </div>
                    <div id="tab-12" class="tab-pane">
                        <div class="small text-muted">
                            <i class="fa fa-clock-o"></i> Diciembre 2019
                        </div>

                        <h1>Documentos</h1>

                        <p>La plataforma permite gestionar los documentos tipo que pueden descargar los alumnos en los formularios de postulación. Como opciones adicionales se pueden descargar todos los documentos subidos por los alumnos hasta la fecha y eliminarlos para liberar espacio de almacenamiento en el servidor.</p>
                        <img src="{{ asset('img/guia/documentos.jpg') }}" alt="listado de solicitudes" class="img-responsive"><br>
                    </div>
                    <div id="tab-13" class="tab-pane">
                        <div class="small text-muted">
                            <i class="fa fa-clock-o"></i> Diciembre 2019
                        </div>

                        <h1>Coordinación</h1>

                        <p>Las horas de coordinación permiten asignara tiempo a las tareas que se ocupan durante el proceso de gestión de cursos a las distintas sedes y mentores.</p><br>
                        @roles("Administrador")
                        <p>Primero, se deben establecer las tareas de coordinación, que se componen de un nombre y una descripción.</p>
                        <img src="{{ asset('img/guia/coordinacion.tareas.jpg') }}" alt="tareas de coordinacion" class="img-responsive"><br>
                        @endroles
                        @roles("Administrador,Coordinador")
                        <p>Se pueden asignar a cada sede, dentro un periodo determinado, una cantidad de horas de coordinación.</p>
                        <img src="{{ asset('img/guia/coordinacion.horas.jpg') }}" alt="horas de coordinacion" class="img-responsive"><br>
                        <p>Luego los distintos coordinadores pueden distribuir las horas asignadas a su sede (para el periodo actual) a los distintos mentores.
                        Para cada tarea se debe asignar una cantidad de horas y mentores que quedan a cargo. Las horas se distribuirán en forma homogénea a los mentores asignados.
                        Para poder guardar la asignación de todas las horas, se deben ocupar todas las horas disponibles para la sede actual. Solo en ese momento se desbloqueará el botón para guardar las horas de coordinación.
                        </p>
                        <img src="{{ asset('img/guia/coordinacion.distribucion.jpg') }}" alt="distribucion de horas de coordinacion" class="img-responsive"><br>
                        @endroles
                        @roles("Mentor")
                        En este apartado se muestran las horas de coordinación que tienes asignadas para un periodo académico determinado.
                        <img src="{{ asset('img/guia/mishoras.coordinacion.jpg') }}" alt="distribucion de horas de coordinacion" class="img-responsive"><br>
                        @endroles
                    </div>
                    <div id="tab-14" class="tab-pane">
                        <div class="small text-muted">
                            <i class="fa fa-clock-o"></i> Diciembre 2019
                        </div>

                        <h1>Videos</h1>

                        <p>Los mentores pueden subir videos de sus clases a la plataforma de <a href="https://www.youtube.com/" target="_blank">YouTube</a> y enlazarlos a la plataforma, con el fin de que los <strong>Asesores</strong> puedan revisarlos y realizar comentarios. Los mentores también pueden realizar comentarios sobre sus videos, en respuesta a los comentarios de los asesores.</p>
                        <img src="{{ asset('img/guia/video.index.jpg') }}" alt="listado de videos" class="img-responsive">
                        <p><strong>NOTA: </strong> solo el usuario administrador puede eliminar los videos subidos.</p><br>
                        <p>Para crear un video se pide un nombre, descripción y el enlace del video obtenido directamente de la barra de direcciones del navegador web.</p>
                        <img src="{{ asset('img/guia/video.create.jpg') }}" alt="crear videos" class="img-responsive">
                    </div>
                    <div id="tab-15" class="tab-pane">
                        <div class="small text-muted">
                            <i class="fa fa-clock-o"></i> Diciembre 2019
                        </div>

                        <h1>Usuarios</h1>

                        <p>En este apartado se pueden visualizar la lista de todos los usuarios del sistema, separados por ROL.</p>
                        <p>Para los alumnos, primero se muestra un filtro, donde permite buscar alumnos por nombre, apellido, RUT y correo electrónico.</p>
                        <img src="{{ asset('img/guia/usuarios.filtro.jpg') }}" alt="listado de videos" class="img-responsive"><br>
                        <p>Los listados de los usuarios siguiente el siguiente esquema de visualización:</p>
                        <img src="{{ asset('img/guia/usuarios.listas.jpg') }}" alt="crear videos" class="img-responsive">
                        <p>Las listas permiten para el administrador ingresar a nuevos usuarios y descargar información completa de estos. Además, se permite la modificación y eliminación de los usuarios.
                        En el cuerpo de la tabla se muestran los datos básicos del usuario con las acciones permitidas según el ROL que tengan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
    <script>
        $("body").addClass("fixed-sidebar no-skin-config full-height-layout")

        // Add slimscroll to element
        $('.full-height-scroll').slimscroll({
            height: '100%'
        })
    </script>  
@endsection
