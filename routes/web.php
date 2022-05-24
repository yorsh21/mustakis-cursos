<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Routes: block
Route::get('seccion', 'Admin\\BlockController@index')->name('block.index');
Route::post('seccion', 'Admin\\BlockController@store')->name('block.store');
Route::get('seccion/crear', 'Admin\\BlockController@create')->name('block.create');
Route::get('seccion/{block}', 'Admin\\BlockController@show')->name('block.show');
Route::patch('seccion/{block}', 'Admin\\BlockController@update')->name('block.update');
Route::delete('seccion/{block}', 'Admin\\BlockController@destroy')->name('block.destroy');
Route::get('seccion/{block}/edit', 'Admin\\BlockController@edit')->name('block.edit');
Route::get('seccion/crear/{school_id}', 'Admin\\BlockController@create_from_school')->name('block.create.school');


//Routes: block-grade
Route::get('seccion-curso', 'Admin\\BlockGradeController@index')->name('block-grade.index');
Route::post('seccion-curso', 'Admin\\BlockGradeController@store')->name('block-grade.store');
Route::get('seccion-curso/crear', 'Admin\\BlockGradeController@create')->name('block-grade.create');
Route::get('seccion-curso/{block_grade}', 'Admin\\BlockGradeController@show')->name('block-grade.show');
Route::patch('seccion-curso/{block_grade}', 'Admin\\BlockGradeController@update')->name('block-grade.update');
Route::delete('seccion-curso/{block_grade}', 'Admin\\BlockGradeController@destroy')->name('block-grade.destroy');
Route::get('seccion-curso/{block-grade}/editar', 'Admin\\BlockGradeController@edit')->name('block-grade.edit');


//Routes: campus
Route::get('sedes', 'Admin\\CampusController@index')->name('campus.index');
Route::post('sedes', 'Admin\\CampusController@store')->name('campus.store');
Route::get('sedes/crear', 'Admin\\CampusController@create')->name('campus.create');
Route::get('sedes/{campus}', 'Admin\\CampusController@show')->name('campus.show');
Route::patch('sedes/{campus}', 'Admin\\CampusController@update')->name('campus.update');
Route::delete('sedes/{campus}', 'Admin\\CampusController@destroy')->name('campus.destroy');
Route::get('sedes/{campus}/editar', 'Admin\\CampusController@edit')->name('campus.edit');


//Route: Course
Route::get('puntajes', 'Admin\\CourseController@scores')->name('course.scores');
Route::get('colegio/crear', 'Admin\\CourseController@create')->name('course.create');
Route::get('ponderaciones', 'Admin\\CourseController@weighings')->name('course.weighings');
Route::post('colegio/guardar', 'Admin\\CourseController@store')->name('course.store');
Route::post('cursos/actualizar', 'Admin\\CourseController@update_course')->name('course.update.school');
Route::post('puntajes/actualizar', 'Admin\\CourseController@update_score')->name('course.update.score');
Route::post('ponderaciones/actualizar', 'Admin\\CourseController@update_weighings')->name('course.update.weighings');


//Routes: division-user
Route::get('division-user/{division-user}', 'Admin\\DivisionUserController@show')->name('division-user.show');
Route::get('division-user', 'Admin\\DivisionUserController@index')->name('division-user.index');
Route::post('division-user', 'Admin\\DivisionUserController@store')->name('division-user.store');
Route::get('division-user/crear', 'Admin\\DivisionUserController@create')->name('division-user.create');
Route::patch('division-user/{division_user}', 'Admin\\DivisionUserController@update')->name('division-user.update');
Route::delete('division-user/{division_user}', 'Admin\\DivisionUserController@destroy')->name('division-user.destroy');
Route::get('division-user/{division_user}/edit', 'Admin\\DivisionUserController@edit')->name('division-user.edit');

Route::post('division-user/destroy','Admin\\DivisionUserController@destroy_from_grade')->name('grade.delete.user');
Route::get('division-user/copy_rol','Admin\\DivisionUserController@copy_rol')->name('grade.copy.rol');


//Routes: grade
Route::get('cursos', 'Admin\\GradeController@index')->name('grade.index');
Route::post('cursos', 'Admin\\GradeController@store')->name('grade.store');
Route::get('cursos/crear', 'Admin\\GradeController@create')->name('grade.create');
Route::get('cursos/{grade}', 'Admin\\GradeController@show')->name('grade.show');
Route::patch('cursos/{grade}', 'Admin\\GradeController@update')->name('grade.update');
Route::delete('cursos/{grade}', 'Admin\\GradeController@destroy')->name('grade.destroy');
Route::get('cursos/{grade}/editar', 'Admin\\GradeController@edit')->name('grade.edit');
Route::get('cursos/filtro/{period_id}', 'Admin\\GradeController@archived')->name('grade.archived');

Route::get('curso/vista/{id}','Admin\\GradeController@view')->name('grade.view');
Route::get('curso/sesiones/{grade_id}','Admin\\GradeController@blocks')->name('grade.blocks');
Route::get('curso/mentores/{grade_id}','Admin\\GradeController@teachers')->name('grade.teachers');
Route::get('curso/mediadores/{grade_id}','Admin\\GradeController@volunteers')->name('grade.volunteers');
Route::get('curso/alumnos/{grade_id}','Admin\\GradeController@students')->name('grade.students');
Route::get('curso/finalizar/{grade_id}','Admin\\GradeController@finish')->name('grade.finish');
Route::get('curso/descargar/informacion/{period_id}','Admin\\GradeController@download_info')->name('grade.download.info');
Route::post('curso/seccion/user','Admin\\GradeController@block_grade_user')->name('block.grade.user');
Route::get('curso/{id_grade}/view/{type_back_view}', 'Admin\\GradeController@back_view')->name('back.view');
Route::get('curso/descargar/lista/{grade_id}', 'Admin\\GradeController@download_list')->name('back.download.list');
Route::get('curso/sumary/{grade_id}', 'Admin\\GradeController@sumary')->name('grade.sumary');
Route::post('curso/cerrar', 'Admin\\GradeController@close')->name('grade.close');

Route::get('cursos/contestar/encuesta/{questionary_id}/{block_grade_id}', 'Admin\\GradeController@show_questionary')->name('grade.questionary.show');
Route::get('cursos/respuestas/encuesta/{questionary_id}/{grade_id}', 'Admin\\GradeController@summary_questionary')->name('grade.questionary.summary');
Route::post('cursos/contestar/encuesta/{questionary_id}/{block_grade_id}', 'Admin\\GradeController@answer_questionary')->name('grade.questionary.answer');


//Routes: material
Route::get('materiales', 'Admin\\MaterialController@index')->name('material.index');
Route::post('materiales', 'Admin\\MaterialController@store')->name('material.store');
Route::get('materiales/crear', 'Admin\\MaterialController@create')->name('material.create');
Route::get('materiales/{material}', 'Admin\\MaterialController@show')->name('material.show');
Route::patch('materiales/{material}', 'Admin\\MaterialController@update')->name('material.update');
Route::delete('materiales/{material}', 'Admin\\MaterialController@destroy')->name('material.destroy');
Route::get('materiales/{material}/editar', 'Admin\\MaterialController@edit')->name('material.edit');

Route::get('material/crear/{block_id}', 'Admin\\MaterialController@create_from_block')->name('material.create.block');
Route::get('file/{id}', 'Admin\\MaterialController@download_file')->name('user.material.download');


//Routes: parameter
Route::get('parametros', 'Admin\\ParameterController@index')->name('parameter.index');
Route::post('parametros', 'Admin\\ParameterController@store')->name('parameter.store');
Route::get('parametros/crear', 'Admin\\ParameterController@create')->name('parameter.create');
Route::get('parametros/{parameter}', 'Admin\\ParameterController@show')->name('parameter.show');
Route::patch('parametros/{parameter}', 'Admin\\ParameterController@update')->name('parameter.update');
Route::delete('parametros/{parameter}', 'Admin\\ParameterController@destroy')->name('parameter.destroy');
Route::get('parametros/{parameter}/editar', 'Admin\\ParameterController@edit')->name('parameter.edit');

Route::get('parametros/tipo/{type}','Admin\\ParameterController@filter')->name('params.filter');


//Routes: period
Route::get('periodos', 'Admin\\PeriodController@index')->name('period.index');
Route::post('periodos', 'Admin\\PeriodController@store')->name('period.store');
Route::get('periodos/crear', 'Admin\\PeriodController@create')->name('period.create');
Route::get('periodos/{period}', 'Admin\\PeriodController@show')->name('period.show');
Route::patch('periodos/{period}', 'Admin\\PeriodController@update')->name('period.update');
Route::delete('periodos/{period}', 'Admin\\PeriodController@destroy')->name('period.destroy');
Route::get('periodos/{period}/editar', 'Admin\\PeriodController@edit')->name('period.edit');
Route::post('periodos/recalculate', 'Admin\\PeriodController@recalculate')->name('period.recalculate');

Route::get('documentos', 'Admin\\DocumentController@index')->name('document.index');
Route::get('documentos/ver/{file}', 'Admin\\DocumentController@show')->name('document.show');
Route::get('documentos/descargar/{id}', 'Admin\\DocumentController@download')->name('document.download');
Route::get('documentos/eliminar/{id}', 'Admin\\DocumentController@delete')->name('document.delete');
Route::get('documentos/respaldo', 'Admin\\DocumentController@backup')->name('document.backup');
Route::get('documentos/renovacion', 'Admin\\DocumentController@destroyAll')->name('document.destroy.all');
Route::post('documentos', 'Admin\\DocumentController@update')->name('document.update');


//Routes: post
Route::get('post', 'Admin\\PostController@index')->name('post.index');
Route::post('post', 'Admin\\PostController@store')->name('post.store');
Route::get('post/crear', 'Admin\\PostController@create')->name('post.create');
Route::get('post/{post}', 'Admin\\PostController@show')->name('post.show');
Route::patch('post/{post}', 'Admin\\PostController@update')->name('post.update');
Route::delete('post/{post}/{grade}', 'Admin\\PostController@destroy')->name('post.destroy');
Route::get('post/{post}/editar', 'Admin\\PostController@edit')->name('post.edit');
Route::get('post/descargar/{id_post}', 'Admin\\PostController@download')->name('post.download');

Route::get('posteo/{grade_id}/announcements/student/', 'Admin\\PostController@index_announcement_other')->name('post.announcement.student');
Route::get('posteo/{grade_id}/announcement/grade/', 'Admin\\PostController@index_announcement')->name('post.announcement.notice');
Route::get('posteo/crear/{forum}', 'Admin\\PostController@create')->name('post.create.forum');
Route::get('posteo/cursos/{id}', 'Admin\\PostController@grades')->name('grade.menu');
Route::get('foro/anuncios/usuario/{id_grade}', 'Admin\\PostController@announcement')->name('anuncios');
Route::get('foro/consultas/usuario/{id_grade}', 'Admin\\PostController@consult')->name('consultas');
Route::get('foro/crear/{id_post}', 'Admin\\PostController@crear_anuncio_consulta')->name('crear.post');

//Routes: postulation
Route::get('postulaciones', 'Admin\\PostulationController@index')->name('postulation.index');
Route::post('postulaciones', 'Admin\\PostulationController@store')->name('postulation.store');
Route::get('postulaciones/crear', 'Admin\\PostulationController@create')->name('postulation.create');
Route::get('postulaciones/{postulation}', 'Admin\\PostulationController@show')->name('postulation.show');
Route::patch('postulaciones/{postulation}', 'Admin\\PostulationController@update')->name('postulation.update');
Route::delete('postulaciones/{postulation}', 'Admin\\PostulationController@destroy')->name('postulation.destroy');
Route::get('postulaciones/{postulation}/editar', 'Admin\\PostulationController@edit')->name('postulation.edit');


//Routes: request
Route::get('solicitudes', 'Admin\\RequestController@index')->name('request.index');
Route::get('solicitudes/postular', 'Admin\\RequestController@postulation')->name('request.postulation');
Route::post('solicitudes', 'Admin\\RequestController@store')->name('request.store');
Route::get('solicitudes/crear', 'Admin\\RequestController@create')->name('request.create');
Route::get('solicitudes/{request}', 'Admin\\RequestController@show')->name('request.show');
Route::patch('solicitudes/{request}', 'Admin\\RequestController@update')->name('request.update');
Route::delete('solicitudes/{request}', 'Admin\\RequestController@destroy')->name('request.destroy');
Route::get('solicitudes/{request}/editar', 'Admin\\RequestController@edit')->name('request.edit');
Route::post('solicitudes/encuesta', 'Admin\\RequestController@surveys')->name('request.surveys');
Route::post('solicitudes/encuesta/{questionary}/{postulation}', 'Admin\\RequestController@survey')->name('request.survey');

Route::get('solicitud/descargar/{old?}', 'Admin\\RequestController@download_request')->name('request.download');
Route::get('solicitud/enviar/confirmacion', 'Admin\\RequestController@send_confirm_request')->name('send.confirm.request');
Route::get('solicitud/historicos', 'Admin\\RequestController@index_historicos')->name('request.index.historicos');
Route::get('solicitud/fill/documents/{user_id}', 'Admin\\RequestController@fill_documents')->name('request.fill.documents');
Route::get('solicitud/respuestas/{postulation_id}/{user_id}', 'Admin\\RequestController@request_answers')->name('request.answer');


//Routes: room
Route::get('salas', 'Admin\\RoomController@index')->name('room.index');
Route::post('salas', 'Admin\\RoomController@store')->name('room.store');
Route::get('salas/crear', 'Admin\\RoomController@create')->name('room.create');
Route::get('salas/{room}', 'Admin\\RoomController@show')->name('room.show');
Route::patch('salas/{room}', 'Admin\\RoomController@update')->name('room.update');
Route::delete('salas/{room}', 'Admin\\RoomController@destroy')->name('room.destroy');
Route::get('salas/{room}/editar', 'Admin\\RoomController@edit')->name('room.edit');

Route::get('sala/crear/{campus_id}', 'Admin\\RoomController@create_from_campus')->name('room.create.campus');


//Routes: school-workshop
Route::get('talleres', 'Admin\\SchoolWorkshopController@index')->name('school-workshop.index');
Route::post('talleres', 'Admin\\SchoolWorkshopController@store')->name('school-workshop.store');
Route::get('talleres/crear', 'Admin\\SchoolWorkshopController@create')->name('school-workshop.create');
Route::get('talleres/{school_workshop}', 'Admin\\SchoolWorkshopController@show')->name('school-workshop.show');
Route::patch('talleres/{school_workshop}', 'Admin\\SchoolWorkshopController@update')->name('school-workshop.update');
Route::delete('talleres/{school_workshop}', 'Admin\\SchoolWorkshopController@destroy')->name('school-workshop.destroy');
Route::get('talleres/{school_workshop}/editar', 'Admin\\SchoolWorkshopController@edit')->name('school-workshop.edit');


//Route: User
Route::get('inicio', 'UserController@index')->name('sumary');
Route::get('user/{id}','UserController@user_profile')->name('user.show.profile');
Route::get('user/{id}/edit','UserController@edit')->name('user.edit.profile');

Route::post('update/user','UserController@update')->name('user.update.profile');
Route::post('update/user_roles','UserController@update_roles')->name('user.update_roles.profile');
Route::post('update/user_pass','UserController@update_password')->name('user.update_password.profile');
Route::get('usuario/update_scores','UserController@update_scores')->name('user.puntajes');
Route::post('usuario/score_motivation', 'UserController@score_motivation')->name('user.score.motivation');
Route::get('usuario/personal/form/{id?}','UserController@form_personal')->name('user.personal.form');
Route::get('usuario/documentacion/form/{id?}','UserController@form_documentacion')->name('user.documentacion.form');
Route::get('usuario/establecimiento/form/{id?}','UserController@form_establecimiento')->name('user.establecimiento.form');
Route::get('usuario/encuesta/form/{id?}','UserController@form_encuesta')->name('user.encuesta.form');
Route::post('usuario/personal','UserController@update_personal')->name('user.personal');
Route::post('usuario/documentacion','UserController@update_documentacion')->name('user.documentacion');
Route::post('usuario/establecimiento','UserController@update_establecimiento')->name('user.establecimiento');
Route::post('usuario/encuesta','UserController@update_encuesta')->name('user.encuesta');
Route::post('usuario/busqueda','UserController@search_list')->name('user.search.list');
Route::get('usuario/download/{document}/{user?}','UserController@download_document')->name('user.download');
Route::get('usuario/{rol}','UserController@list_users')->name('user.list');
Route::get('usuario/buscar/{rol}','UserController@search')->name('user.search');
Route::get('usuario/crear/{rol_id}','UserController@crear')->name('user.crear');
Route::post('usuario/guardar','UserController@guardar')->name('user.guardar');
Route::post('usuario/guardar_completo','UserController@guardar_completo')->name('user.guardar.completo');
Route::post('usuario/eliminar/{id}','UserController@destroy')->name('user.destroy');
Route::post('usuario/descarga','UserController@descarga_rol')->name('user.descarga.rol');
Route::get('usuario/mute/{id}/{time}','UserController@mute')->name('user.mute');
Route::get('usuario/multirol/cambiar','UserController@switch_roles')->name('user.switch.roles');


//Route: visitor
Route::get('', 'VisitorController@index')->name('inicio');
Route::get('registro', 'VisitorController@viewFormRegisterUser')->name('registro');
Route::get('index', 'VisitorController@index')->name('index');
Route::get('postulacion', 'VisitorController@visitorPostulation')->name('postulacion');
Route::post('registroUsuario', 'VisitorController@RegisterUser')->name('enviar.registro');
Route::get('recuperar', 'VisitorController@recover_password')->name('recover.password');
Route::get('recuperar/{id}/{token}', 'VisitorController@recover_verify_token')->name('recover.verify');
Route::post('recuperar/sendmail', 'VisitorController@recover_send_email')->name('recover.sendmail');
Route::post('restart/password', 'VisitorController@restart_password')->name('recover.restart.password');


//Route: video
Route::get('videos', 'Admin\\VideoController@index')->name('video.index');
Route::get('videos/ver/{id}', 'Admin\\VideoController@show')->name('video.show');
Route::get('videos/editar/{id}', 'Admin\\VideoController@edit')->name('video.edit');
Route::get('videos/crear', 'Admin\\VideoController@create')->name('video.create');
Route::patch('videos/{id}', 'Admin\\VideoController@update')->name('video.update');
Route::delete('videos/{id}', 'Admin\\VideoController@destroy')->name('video.destroy');
Route::post('videos/guardar', 'Admin\\VideoController@store')->name('video.store');
Route::post('videos/comentar', 'Admin\\VideoController@comment')->name('video.comment');


//Route: survey
Route::get('encuestas', 'Admin\\SurveyController@index')->name('survey.index');
Route::get('encuestas/ver/{id}', 'Admin\\SurveyController@show')->name('survey.show');
Route::get('encuestas/editar/{id}', 'Admin\\SurveyController@edit')->name('survey.edit');
Route::get('encuestas/crear', 'Admin\\SurveyController@create')->name('survey.create');
Route::patch('encuestas/{id}', 'Admin\\SurveyController@update')->name('survey.update');
Route::delete('encuestas/{id}', 'Admin\\SurveyController@destroy')->name('survey.destroy');
Route::post('encuestas/guardar', 'Admin\\SurveyController@store')->name('survey.store');
Route::post('encuestas/llenar', 'Admin\\SurveyController@fill')->name('survey.fill');


//Route: questionary
Route::get('cuestionarios', 'Admin\\QuestionaryController@index')->name('questionary.index');
Route::post('cuestionarios', 'Admin\\QuestionaryController@store')->name('questionary.store');
Route::get('cuestionarios/crear', 'Admin\\QuestionaryController@create')->name('questionary.create');
Route::get('cuestionario/{questionary}', 'Admin\\QuestionaryController@show')->name('questionary.show');
Route::patch('cuestionario/{questionary}', 'Admin\\QuestionaryController@update')->name('questionary.update');
Route::delete('cuestionario/{questionary}', 'Admin\\QuestionaryController@destroy')->name('questionary.destroy');
Route::get('cuestionario/{questionary}/editar', 'Admin\\QuestionaryController@edit')->name('questionary.edit');


//Route: statistics
Route::get('estadisticas/asistencia', 'Admin\\StatisticsController@assistance')->name('statistics.show.asistencia');
Route::get('estadisticas/postulacion', 'Admin\\StatisticsController@postulation')->name('statistics.show.postulacion');
Route::post('estadisticas/asistencia/filtro', 'Admin\\StatisticsController@filter_assistance')->name('statistics.filter.asistencia');
Route::post('estadisticas/postulacion/filtro', 'Admin\\StatisticsController@filter_postulation')->name('statistics.filter.postulacion');


//Routes: event
Route::get('notificaciones', 'Admin\\EventController@index')->name('event.index');
Route::get('notificaciones/listar', 'Admin\\EventController@fetch')->name('event.fetch');
Route::get('notificaciones/delete/all', 'Admin\\EventController@destroy_all')->name('event.delete.all');
Route::get('notificaciones/visto/{id?}', 'Admin\\EventController@viewed')->name('event.viewed');
Route::get('notificaciones/{event}', 'Admin\\EventController@show')->name('event.show');
Route::delete('notificaciones/{event}', 'Admin\\EventController@destroy')->name('event.destroy');
Route::get('notificaciones/{event}/editar', 'Admin\\EventController@edit')->name('event.edit');


//Routes: milestone
Route::get('hitos', 'Admin\\MilestoneController@index')->name('milestone.index');
Route::post('hitos', 'Admin\\MilestoneController@store')->name('milestone.store');
Route::patch('hitos/{milestone}', 'Admin\\MilestoneController@update')->name('milestone.update');
Route::delete('hitos/{milestone}', 'Admin\\MilestoneController@destroy')->name('milestone.destroy');


//Routes: certificate
Route::get('certificados', 'Admin\\CertificateController@index')->name('certificate.index');
Route::post('certificados', 'Admin\\CertificateController@store')->name('certificate.store');
Route::get('certificados/crear', 'Admin\\CertificateController@create')->name('certificate.create');
Route::get('certificados/generar/{certificate}', 'Admin\\CertificateController@generate')->name('certificate.generate');
Route::get('certificados/descargar/{certificate}/{user}', 'Admin\\CertificateController@download')->name('certificate.download');
Route::get('certificados/descargas/{certificate}/{grade}', 'Admin\\CertificateController@downloads')->name('certificate.downloads');
Route::get('certificados/{certificate}', 'Admin\\CertificateController@show')->name('certificate.show');
Route::patch('certificados/{certificate}', 'Admin\\CertificateController@update')->name('certificate.update');
Route::delete('certificados/{certificate}', 'Admin\\CertificateController@destroy')->name('certificate.destroy');
Route::get('certificados/{certificate}/editar', 'Admin\\CertificateController@edit')->name('certificate.edit');


//Routes: task
Route::get('coordinacion/tareas', 'Admin\\TaskController@index')->name('task.index');
Route::post('coordinacion/tareas', 'Admin\\TaskController@store')->name('task.store');
Route::get('coordinacion/tareas/crear', 'Admin\\TaskController@create')->name('task.create');
Route::get('coordinacion/tareas/{task}', 'Admin\\TaskController@show')->name('task.show');
Route::patch('coordinacion/tareas/{task}', 'Admin\\TaskController@update')->name('task.update');
Route::delete('coordinacion/tareas/{task}', 'Admin\\TaskController@destroy')->name('task.destroy');
Route::get('coordinacion/tareas/{task}/editar', 'Admin\\TaskController@edit')->name('task.edit');
Route::get('coordinacion/asignacion/tareas', 'Admin\\TaskController@asignacion')->name('task.asignacion');


//Routes: coordination hour
Route::get('coordinacion/horas', 'Admin\\CoordinationHourController@index')->name('hour.index');
Route::get('coordinacion/distribuir', 'Admin\\CoordinationHourController@distribution')->name('hour.distribution');
Route::post('coordinacion/distribuir/periodo', 'Admin\\CoordinationHourController@filter')->name('hour.filter');
Route::post('coordinacion/horas', 'Admin\\CoordinationHourController@store')->name('hour.store');
Route::post('coordinacion/tareas', 'Admin\\CoordinationHourController@task_period_store')->name('task.period.store');
Route::get('coordinacion/horas/crear', 'Admin\\CoordinationHourController@create')->name('hour.create');
Route::get('coordinacion/hora/{coordination_hour}', 'Admin\\CoordinationHourController@show')->name('hour.show');
Route::patch('coordinacion/horas/{coordination_hour}', 'Admin\\CoordinationHourController@update')->name('hour.update');
Route::delete('coordinacion/horas/{coordination_hour}', 'Admin\\CoordinationHourController@destroy')->name('hour.destroy');
Route::get('coordinacion/horas/{coordination_hour}/editar', 'Admin\\CoordinationHourController@edit')->name('hour.edit');


//Resources Auth
Auth::routes();


//Routes: error
Route::get('error401', 'ErrorsController@error401')->name("401");
Route::get('error404', 'ErrorsController@error404')->name("404");


//Routes: help
Route::get('ayuda', 'HelpController@index')->name("help.index");
