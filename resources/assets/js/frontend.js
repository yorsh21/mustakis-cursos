function checkRut(rut) {
    // Despejar Puntos
    var valor = rut.value.replace('.', '');
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
    for(i = 1; i <= cuerpo.length; i++) {
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
    dv = (dv == 'K') ? 10 : dv;
    dv = (dv == 0) ? 11 : dv;
    
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

function checkPassword(password2) {
    var password1 = $('#password').val();

    if(password1 != password2.value) {
        password2.setCustomValidity("Las contraseñas no coinciden"); 
        return false;
    }
    else {
        password2.setCustomValidity('');
    }
}


$(document).ready(function () {
    $('.form').change(function () {
        $('.btn').attr('disabled', 'disabled');
    });

    $('#active_passport').change(function () {
        if($(this).is(':checked')){
            $("#passport").show();
            $("#rut").prop('disabled', true);
        }
        else{
            $("#passport").hide();
            $("#passport").val('');
            $("#rut").prop('disabled', false);
            
        }
    });

    $('#submit-register').click(function() {
        var button = $(this);
        button.addClass('disabled');

        setTimeout(function(){
            button.removeClass('disabled');
        }, 3000);
    });
});
