/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.


 require('./bootstrap');

 window.Vue = require('vue');
 */
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
/*
 Vue.component('example-component', require('./components/ExampleComponent.vue'));

 const app = new Vue({
 el: '#app'
 }); */

function goBack() {
    window.history.back();
}

function checkRut(rut) {
    // Despejar Puntos
    var valor = rut.value.replace('.','');
    // Despejar Guión
    valor = valor.replace('-','');
    
    // Aislar Cuerpo y Dígito Verificador
    cuerpo = valor.slice(0,-1);
    dv = valor.slice(-1).toUpperCase();
    
    // Formatear RUN
    rut.value = cuerpo + '-'+ dv
    
    // Si no cumple con el mínimo ej. (n.nnn.nnn)
    if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}
    
    // Calcular Dígito Verificador
    suma = 0;
    multiplo = 2;
    
    // Para cada dígito del Cuerpo
    for(i=1;i<=cuerpo.length;i++) {
    
        // Obtener su Producto con el Múltiplo Correspondiente
        index = multiplo * valor.charAt(cuerpo.length - i);
        
        // Sumar al Contador General
        suma = suma + index;
        
        // Consolidar Múltiplo dentro del rango [2,7]
        if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
  
    }
    
    // Calcular Dígito Verificador en base al Módulo 11
    dvEsperado = 11 - (suma % 11);
    
    // Casos Especiales (0 y K)
    dv = (dv == 'K')?10:dv;
    dv = (dv == 0)?11:dv;
    
    // Validar que el Cuerpo coincide con su Dígito Verificador
    if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }
    
    // Si todo sale bien, eliminar errores (decretar que es válido)
    rut.setCustomValidity('');
}

function checkKeys(e){
    var key = (document.all) ? e.keyCode : e.which;
    
    if (key == 8 || key == 75 || key == 107) {
        return true;
    }

    if (key == 189) {
        return false;
    }

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[0-9]/;
    key_final = String.fromCharCode(key);
    return patron.test(key_final);
} 

function checkPassword(password2) {
    var password1 = $('#password').val();

    if (password1 != password2.value) {
        password2.setCustomValidity("Las contraseñas no coinciden");
        return false;
    }
    else {
        password2.setCustomValidity('');
    }
}

function checkEmail(email2) {
    var email1 = $('#email').val();

    if(email1 != email2.value) {
        email2.setCustomValidity("Los correos no coinciden"); 
        return false;
    }
    else {
        email2.setCustomValidity('');
    }
}

function validateFileSize(input) {
    var file = input.files[0];

    if (file.size > 2048*1000) {
        input.setCustomValidity("El archivo no puede pesar más de 2MB");
        return false;
    }
    else {
        input.setCustomValidity('');
    }
}


$(document).ready(function () {

    $(".postulation-disabled").on("mouseenter", function() {
        swal("Atención!", "Para postular debes completar tu perfil de usuario!", "info");
    });

    $('.form').submit(function () {
        var btn = $('.btn')
        btn.attr('disabled', 'disabled');

        setTimeout(function() {
            btn.removeAttr('disabled');
        }, 10)
    });

    $('#update-and-continue').click(function (e) {
        var form = $('#form-edit-grade');
        var url = form.attr('action');
        var data = form.serialize();
        var link = $(this).data('link');

        $.post(url, data, function (res) {
            window.location.href = link;
        });
    });

    //=====================================================//
    //================ Aceptar Solicitudes ================//
    //=====================================================//

    $('.form-solicitude').submit(function (e) {
        e.preventDefault();

        var url = $(this).attr('action');
        var data = $(this).serialize();
        var input = $(this).find('input[name=status]');
        var button = $(this).find('button[type=submit]');
        button.attr('disabled', 'disabled');

        $.post(url, data, function (res) {
            if (res.status == 'aprobada') {
                input.val('pendiente');
                button.removeClass('btn-warning');
                button.addClass('btn-primary');
                button.html('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Aprobada');
            }
            else {
                input.val('aprobada');
                button.removeClass('btn-primary');
                button.addClass('btn-warning');
                button.html('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Pendiente');
            }
            button.attr('disabled', false);
        });
    });


    //=====================================================//
    //============= Puntaje Carta Motivación ==============//
    //=====================================================//

    $('.view-motivation').click(function (e) {
        var id = $(this).next();
        var name = $(this).next().next();
        var score = $(this).next().next().next();
        var motivation = $(this).next().next().next().next();

        //score.attr('id', 'modal-pending');

        $('#modal-motivation .modal-name').html(name.val());
        $('#modal-motivation .modal-motivation').html(motivation.val());
        $('#modal-motivation .modal-score').html(score.val());
        $('#modal-motivation #motivation-id').val(id.val());
        $('#modal-motivation #motivation-score').val(score.val());
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('#modal-motivation .btn-score').click(function (e) {
        var button = $(this).attr('disabled', 'disabled');
        button.attr('disabled', 'disabled');

        $('#motivation-score').val($(this).data('point'));

        var form = $('#form-motivation')
        $.post(form.attr('action'), form.serialize(), function (res) {
            button.attr('disabled', false);
            
            $('#modal-motivation .close').trigger('click');
            $('#score-motivation-' + res.id).val(res.score_motivation);
        });
    });

    //=====================================================//
    //=============== Creación de un Curso ================//
    //=====================================================//

    $('.form-blocks').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var data = form.serialize();
        form.parent().find($('button')).attr('disabled', 'disabled');

        $.post(url, data, function (res) {
            form.parent().find($('button')).removeClass('btn-default');
            form.parent().find($('button')).addClass('btn-primary');
            form.parent().find($('button')).attr('disabled', false);
        });
    });

    $('.grades-block input, .grades-block select').change(function() {
        $(this).parent().parent().find($('button')).removeClass('btn-primary');
        $(this).parent().parent().find($('button')).addClass('btn-default');
    });

    $('.form-add-user-grade').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var data = form.serialize();
        form.parent().find($('button')).attr('disabled', 'disabled');

        $.post(url, data, function(res) {
            if(res.status != 0) {
                form.css('display', 'none');
                $('#del_user-' + res.user_id).css('display', 'inline');
            }
            else if(res.status == -1) {
                alert("Error al asignar este usuario al curso.");
            }
            else {
                alert("No se ha podido asignar este usuario al curso. Compruebe que no pertenece a un curso del mismo periodo.");
            }
            form.parent().find($('button')).attr('disabled', false);
        });
    });

    $('.form-del-user-grade').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var data = form.serialize();
        form.parent().find($('button')).attr('disabled', 'disabled');

        $.post(url, data, function(res) {
            form.css('display', 'none');
            $('#add_user-' + res.user_id).css('display', 'inline');

            form.parent().find($('button')).attr('disabled', false);
        });
    });


    //=====================================================//
    //============== Selecciones de Regiones ==============//
    //=====================================================//
    
    if($("#select_region").val() == "") {
        $("#select_comuna option").each(function() {
            $(this).css("display", "none");
        });
    }
    else {
        var region_input = $("#select_region").val();
        $("#select_comuna option").each(function(){
            if($(this).attr("name") == region_input)
              $(this).css("display", "block");
            else
                $(this).css("display", "none");
        });
    }
    

    $("#select_region").change(function(){
        $("#select_comuna").val("-");

        var region = $("#select_region option:selected").val();
        $("#select_comuna option").each(function(){
            if($(this).attr("name") == region)
              $(this).css("display", "block");
            else
                $(this).css("display", "none");
        });
    });

    $("#select_coordinator").change(function(){
        var city = $("#select_coordinator option:selected").data("city");
        var region = 0;

        $("#select_comuna option").each(function(){
            $(this).css("display", "block");
            if($(this).attr("value") == city) {
                $(this).attr("selected", "selected");
                region = $(this).attr("name");
            }
            else {
                $(this).removeAttr("selected");
            }
        });

        $("#select_region option").each(function(){
            if($(this).attr("value") == region) {
                $(this).attr("selected", "selected");
            }
            else {
                $(this).removeAttr("selected");
            }
        });
    });


    // var cont_checkbox_motivation = 0;
    $("#phonenumber").keypress(function (e) {
        var numero = '1234567890';
        var caracter = String.fromCharCode(e.which);

        if (numero.indexOf(caracter) < 0)
            return false;
    });

    $("#phonenumber2").keypress(function (e) {
        var numero = '1234567890';
        var caracter = String.fromCharCode(e.which);

        if (numero.indexOf(caracter) < 0)
            return false;
    });

    $("#phone_number_tutor").keypress(function (e) {
        var numero = '1234567890';
        var caracter = String.fromCharCode(e.which);

        if (numero.indexOf(caracter) < 0)
            return false;
    });

    if($("#needs_student").val() == "") {
        $("#needs_student").prop('disabled', true);
    }

    $("#special_needs").change(function (e) {
        if ($(this).val() == 1) {
            $("#needs_student").prop('disabled', false);
        }
        else {
            $("#needs_student").prop('disabled', true);
            $("#needs_student").val("");
        }
    });

    $(".type_establishment_student").change(function () {
        if ($(this).val() == '1') {
            $("#especiality").prop('disabled', false);
        }
        else {
            $("#especiality").prop('disabled', true);
            $("#especiality").val("");
        }
    });

    if($("#city_assist_workshop").val() != "244") {
        $("#workshop_puerto_montt").prop('disabled', true);
        $("#workshop_puerto_montt").val("");
    }

    $("#city_assist_workshop").change(function () {
        if ($(this).val() == "244") {
            $("#workshop_puerto_montt").prop('disabled', false);
        }
        else {
            $("#workshop_puerto_montt").prop('disabled', true);
            $("#workshop_puerto_montt").val("");
        }
    });


    //=====================================================//
    //================ Anuncios y Consultas ===============//
    //=====================================================//

    $("#announcement").click(function () {
        var id_grade = $(this).attr("name");
        $("#announcement").addClass('btn-disabled');

        $.ajax({
            type: "GET",
            url: "/foro/anuncios/usuario/{id_grade}",
            data: {'id': id_grade},
            dataType: 'json',
            success: function (response) {

                $("#anuncios").html("")
                var elemento = JSON.parse(JSON.stringify(response));
                var div_item = '<div class="vote-item">';
                var div_row = '<div class="row">';
                var div_col_10 = '<div class="col-md-10">';
                var div_actions = '<div class="vote-actions">';
                var i_up = '<i class="fa fa-chevron-up"> </i>';
                var div = '<div>';
                var i_down = '<i class="fa fa-chevron-down "> </i>';
                var tag_a_end = '</a>';
                var div_end = '</div>';
                var div_details = '<div class="vote-info">';
                var comments = '<i class="fa fa-comments-o"></i>';
                var date_lasted_comment = '<i class="fa fa-clock-o"></i>';
                var name_lasted_comment = '<i class="fa fa-user"></i>';
                var a_start = '<a class="btn-disabled-default">';
                var a_end = '</a>';

                $.each(elemento, function (key, value) {

                    var a_title_start = '<a class="faq-question" href="/post/' + value.id_mensaje + '" >';

                    if (value.fecha_ultimo_mensaje == null) {
                        $("#anuncios").append
                        (
                            div_item + div_row + div_col_10 + div_details + name_lasted_comment + a_start
                            + ' Creado por ' + value.firstname + ' ' + value.lastname + tag_a_end + div_end
                            + div_actions + a_start + i_up + tag_a_end
                            + div + value.comentarios + div_end + a_start + i_down + tag_a_end + div_end
                            + a_title_start + value.mensaje + tag_a_end + div_details
                            + comments + ' ' + a_start + 'Comentarios (' + value.comentarios + ')' + a_end
                            + date_lasted_comment + ' ' + a_start + 'Ultimo mensaje ' + value.fecha_anuncio_creado.created_at
                            + tag_a_end + name_lasted_comment + ' ' + a_start + value.firstname + ' ' + value.lastname
                            + tag_a_end + div_end + div_end + div_end + div_end
                        );
                    }

                    else {
                        $("#anuncios").append
                        (
                            div_item + div_row + div_col_10 + div_details + name_lasted_comment + a_start
                            + ' Creado por ' + value.firstname + ' ' + value.lastname + tag_a_end + div_end
                            + div_actions + a_start + i_up + tag_a_end
                            + div + value.comentarios + div_end + a_start + i_down + tag_a_end + div_end
                            + a_title_start + value.mensaje + tag_a_end + div_details
                            + comments + ' ' + a_start + 'Comentarios (' + value.comentarios + ')' + a_end
                            + date_lasted_comment + ' ' + a_start + 'Ultimo mensaje ' + value.fecha_ultimo_mensaje
                            + tag_a_end + name_lasted_comment + ' ' + a_start + value.nombre_usuario_ultimo_mensaje.user.firstname
                            + ' ' + value.nombre_usuario_ultimo_mensaje.user.lastname
                            + tag_a_end + div_end + div_end + div_end + div_end
                        );
                    }


                });
            },
        });

        $('#announcement').removeClass('btn-disabled');
    });

    $("#consult").click(function () {
        var id_grade = $(this).attr("name");
        $('#consult').addClass('btn-disabled');

        $.ajax({
            type: "GET",
            url: "/foro/consultas/usuario/{id_grade}",
            data: {'id': id_grade},
            dataType: 'json',
            success: function (response) {

                $("#consultas").html("");
                var elemento = JSON.parse(JSON.stringify(response));

                var div_item = '<div class="vote-item">';
                var div_row = '<div class="row">';
                var div_col_10 = '<div class="col-md-10">';
                var div_actions = '<div class="vote-actions">';
                var i_up = '<i class="fa fa-chevron-up"> </i>';
                var div = '<div>';
                var i_down = '<i class="fa fa-chevron-down "> </i>';
                var tag_a_end = '</a>';
                var div_end = '</div>';
                var div_details = '<div class="vote-info">';
                var comments = '<i class="fa fa-comments-o"></i>';
                var date_lasted_comment = '<i class="fa fa-clock-o"></i>';
                var name_lasted_comment = '<i class="fa fa-user"></i>';
                var a_start = '<a class="btn-disabled-default">';
                var a_end = '</a>';

                $.each(elemento, function (key, value) {
                    var a_title_start = '<a class="faq-question" href="/post/' + value.id_mensaje + '" >';


                    if (value.fecha_ultimo_mensaje == null) {
                        $("#consultas").append
                        (
                            div_item + div_row + div_col_10 + div_details + name_lasted_comment + a_start
                            + ' Creado por ' + value.firstname + ' ' + value.lastname + tag_a_end + div_end
                            + div_actions + a_start + i_up + tag_a_end
                            + div + value.comentarios + div_end + a_start + i_down + tag_a_end + div_end
                            + a_title_start + value.mensaje + tag_a_end + div_details
                            + comments + ' ' + a_start + 'Comentarios (' + value.comentarios + ')' + a_end
                            + date_lasted_comment + ' ' + a_start + 'Ultimo mensaje ' + value.fecha_anuncio_creado.created_at
                            + tag_a_end + name_lasted_comment + ' ' + a_start + value.firstname + ' ' + value.lastname
                            + tag_a_end + div_end + div_end + div_end + div_end
                        );
                    }

                    else {
                        $("#consultas").append
                        (
                            div_item + div_row + div_col_10 + div_details + name_lasted_comment + a_start
                            + ' Creado por ' + value.firstname + ' ' + value.lastname + tag_a_end + div_end
                            + div_actions + a_start + i_up + tag_a_end
                            + div + value.comentarios + div_end + a_start + i_down + tag_a_end + div_end
                            + a_title_start + value.mensaje + tag_a_end + div_details
                            + comments + ' ' + a_start + 'Comentarios (' + value.comentarios + ')' + a_end
                            + date_lasted_comment + ' ' + a_start + 'Ultimo mensaje ' + value.fecha_ultimo_mensaje.created_at
                            + tag_a_end + name_lasted_comment + ' ' + a_start + value.nombre_usuario_ultimo_mensaje.user.firstname
                            + ' ' + value.nombre_usuario_ultimo_mensaje.user.lastname
                            + tag_a_end + div_end + div_end + div_end + div_end
                        );
                    }


                });
            },
        });

        $('#consult').removeClass('btn-disabled');

    });

    
    //=====================================================//
    //==================== DataTables =====================//
    //=====================================================//

    $('.dataTables-example').DataTable({
        pageLength: 100,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'Tabla Mustakis'},
            {extend: 'pdf', title: 'Tabla Mustakis'},

            {
                extend: 'print',
                customize: function (win) {
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            }
        ],
        language: {
            lengthMenu: "Mostrar _MENU_ registros por página",
            zeroRecords: "No se han encontrado registros",
            emptyTable: "No se han encontrado registros",
            info: "Mostrando página _PAGE_ de un total de _PAGES_",
            infoEmpty: "No hay registros disponibles",
            infoFiltered: "(filtrando _MAX_ del total de registros)",
            decimal: ",",
            thousands: ".",
            lengthMenu: "Mostrando _MENU_ registros",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            search: "Buscar:",
            zeroRecords: "No se han encontrado registros",
            paginate: {
                first: "Primera",
                last: "Última",
                next: "Siguiente",
                previous: "Anterior"
            },
            aria: {
                sortAscending: ": activar ordenamiento en forma ascendente",
                sortDescending: ": activar ordenamiento en forma descendente"
            }
        }
    });


    //=====================================================//
    //=============== Editar perfil usuario ===============//
    //=====================================================//

    $('.choose-avatar').click(function() {
        var avatar = $(this).data('avatar');
        var avatar_url = $(this).attr('src');
        $('#image_profile').val(avatar);

        var button_preview = $('#preview-avatar');
        var url = button_preview.attr('src');

        button_preview.attr('src', avatar_url);
    });

    $("#change_rol1").change(function (e) {
        if ($(this).val() == 1) {
            $("#multiroles1").prop('disabled', false);
            $("#change_rol1").val("0");
        }
        else {
            $("#multiroles1").prop('disabled', true);
            $("#change_rol1").val("1");
        }
    });

    $("#change_rol2").change(function (e) {
        if ($(this).val() == 1) {
            $("#multiroles2").prop('disabled', false);
            $("#change_rol2").val("0");
        }
        else {
            $("#multiroles2").prop('disabled', true);
            $("#change_rol2").val("1");
        }
    });

    $("#multiroles1, #multiroles2").change(function (e) {
        $("#submit-roles").prop('disabled', false);
    });


    //=====================================================//
    //==================== Vista Curso ====================//
    //=====================================================//

    $('.form-block-grade-user').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var data = form.serialize();
        //form.parent().find($('button')).attr('disabled', 'disabled');

        $.post(url, data, function (res) {
            //console.log(res);
            //form.parent().find($('button')).attr('disabled', false);
        });
    });


    //=====================================================//
    //==================== Estadisticas ===================//
    //=====================================================//

    $("#filter-statistics-assistance").submit(function (event) {
        event.preventDefault();
        var data = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "/estadisticas/asistencia/filtro",
            data: data,
            dataType: 'json',
            success: function (response) {
                var elemento = JSON.parse(JSON.stringify(response));

                var barData = {
                    labels: elemento[0],
                    datasets: [
                        {
                            label: "63% asistencia",
                            backgroundColor: 'rgba(26,179,148,0.5)',
                            pointBackgroundColor: "rgba(26,179,148,1)",
                            pointBorderColor: "#fff",
                            data: elemento[2]
                        },
                        {
                            label: "Total Alumnos",
                            backgroundColor: 'rgba(220, 220, 220, 0.5)',
                            pointBorderColor: "#fff",
                            data: elemento[1]
                        }
                    ]
                };
        
                var barOptions = {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                };
        
                var content = document.getElementById("contentChart");
                content.innerHTML = "<canvas id='gradesChart' height='140'></canvas>";

                var ctx2 = document.getElementById("gradesChart").getContext("2d");
                new Chart(ctx2, {type: 'bar', data: barData, options: barOptions});
            },
        });
    });


    $("#filter-statistics-postulation").submit(function (event) {
        event.preventDefault();
        var data = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "/estadisticas/postulacion/filtro",
            data: data,
            dataType: 'json',
            success: function (response) {
                var elemento = JSON.parse(JSON.stringify(response));

                var barData = {
                    labels: elemento[0],
                    datasets: [
                        {
                            label: "Postulaciones Aprobadas",
                            backgroundColor: 'rgba(26,179,148,0.5)',
                            pointBackgroundColor: "rgba(26,179,148,1)",
                            pointBorderColor: "#fff",
                            data: elemento[1]
                        },
                        {
                            label: "Postulaciones Reprobadas",
                            backgroundColor: 'rgba(220, 220, 220, 0.5)',
                            pointBorderColor: "#fff",
                            pointBackgroundColor: "rgba(26,179,148,1)",
                            data: elemento[2]
                        }
                    ]
                };
        
                var barOptions = {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                };
        
                var content = document.getElementById("contentChart");
                content.innerHTML = "<canvas id='gradesChart' height='140'></canvas>";

                var ctx2 = document.getElementById("gradesChart").getContext("2d");
                new Chart(ctx2, {type: 'bar', data: barData, options: barOptions});
            },
        });
    });


    $("#filter-statistics-survey2").submit(function (event) {
        event.preventDefault();
        var data = $(this).serialize();
        var chartArea = $('#contentChart');

        $.ajax({
            type: "POST",
            url: "/estadisticas/postulacion/filtro",
            data: data,
            dataType: 'json',
            success: function (response) {
                var elemento = JSON.parse(JSON.stringify(response));
                var colors = [
                    "rgba(26, 179, 148, 0.5)", 
                    "rgba(20, 143, 118, 0.5)", 
                    "rgba(15, 107, 88, 0.5)", 
                    "rgba(71, 194, 169, 0.5)", 
                    "rgba(94, 201, 180, 0.5)", 
                    "rgba(140, 217, 201, 0.5)"
                ];
                var contador = 1;

                var barOptions = {
                    responsive: true
                };

                Object.keys(elemento).forEach(function(k) {
                    var id = `grades-chart-${contador}`;
                    var datasets = [];
                    var sub_contador = 0;

                    chartArea.append(`<canvas id="${id}" height="140"></canvas><br>`);

                    Object.keys(elemento[k]).forEach(function(j) {
                        datasets.push({
                            label: j,
                            backgroundColor: colors[sub_contador],
                            pointBorderColor: "#fff",
                            data: [elemento[k][j]]
                        });
                        sub_contador++;
                    });

                    var barData = {
                        labels: [k],
                        datasets: datasets
                    };

                    var ctx2 = document.getElementById(id).getContext("2d");
                    new Chart(ctx2, {type: 'bar', data: barData, options:barOptions});
                    
                    contador++;
                });
                
            }
        });
    });
    
    
});
