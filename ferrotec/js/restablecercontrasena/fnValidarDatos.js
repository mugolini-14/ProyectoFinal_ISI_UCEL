//  fnValidarDatos
//  Descripción: Función que valida los datos suministrados en el Restablecer Contraseña
//  A partir de parámetros de entrada
//      - Valida Longitud y Números de Código Aleatorio
//      - Valida Repetición de Contraseñas
//      - Valida Longitud de Contraseñas
//      - Valida Mayúsculas, Minúsculas, Números y Caracteres Especiales en la Contraseña
//  Si pasa la validación, envia los datos a la base para guardar la contraseña en el usuario a restablecer

function fnValidarDatos(){

    // Funciones auxilares de Control

    function fnValidarMayusculas(cadenacontrasena){
        var regex = /[A-Z]/;
        return regex.test(cadenacontrasena);
    }

    function fnValidarMinusculas(cadenacontrasena){
        var regex = /[a-z]/;
        return regex.test(cadenacontrasena);
    }

    function fnValidarNumeros(cadena){
        return isNaN(parseFloat(cadena)) && isFinite(cadena);
    }

    function fnValidarNumerosContrasena(cadena){
        return isNaN(parseFloat(cadena)) && isFinite(cadena);
    }

    function fnValidarCaracteresEspeciales(cadena){
        var regex = /[`!@#$%^&*()_\-+=\[\]{};':"\\|,.<>\/?~ ]/;
        return regex.test(cadena);
    }

    var codigoaleatorio = document.getElementById("codigo-aleatorio").value;
    var contrasena = document.getElementById("contrasena").value;
    var repetircontrasena = document.getElementById("repetir-contrasena").value;

    if(codigoaleatorio.length < 8 || codigoaleatorio.length == 0){      // Codigo Aleatorio Vacío o menor a 8 caracteres -- Sale por Falso
        alert('El Código Aleatorio no esta Bien Escrito.');
    }
    else if(fnValidarNumeros(codigoaleatorio)==true){                   // Control de Números en Código Aleatorio -- Funcion No-Es-Nùmero - Sale por Verdaero
        alert('El Código Aleatorio contiene Caracteres que No Son Números.');
    }
    else if(contrasena != repetircontrasena){                           // Las contraseñas no coinciden -- Sale por Verdadero
        alert('La Contraseña y el Repetir Contraseña no coinciden.');
    }
    else if(contrasena.length < 8 || contrasena.length > 12){           // Control de Longitud de Contraseña -- Sale por Falso
        alert('La contraseña no tiene los Caracteres Necesarios.');
    }
    else if(fnValidarMayusculas(contrasena)==false){                    // Control de Mayúsculas -- Control por Expresión Regular -- Sale por Falso
        alert('La contraseña no tiene al menos una Mayúscula');
    }
    else if(fnValidarMinusculas(contrasena)==false){                    // Control de Minúsculas -- Control por Expresión Regular -- Sale por Falso
        alert('La contraseña no tiene al menos una Minúscula');
    }
    else if(fnValidarNumerosContrasena(contrasena)==true){               // Control de Nùmeros en Contraseña -- Funcion No-Es-Nùmero - Sale por Verdaero
        alert('La contraseña no tiene al menos un Número.');
    }
    else if(fnValidarCaracteresEspeciales(contrasena)==false){             // Control de Caracteres Especiales -- Control por Expresión Regular -- Sale por Falso
        alert('La contraseña no tiene al menos un Caracter Especial.');
    }         
    else{                                                                  // Contraseña Válida
        if (confirm("¿Desea Restablecer la Contraseña?")) {
            var formData = new FormData();
            formData.append('codigo-aleatorio', codigoaleatorio);
            formData.append('contrasena', contrasena);
    
            // Enviar la solicitud AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../restablecercontrasena/grabar_contrasena.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var respuesta = xhr.responseText; // Obtener la respuesta del servidor
                    alert(respuesta); // Mostrar la respuesta del servidor
    
                    // Verificar si la respuesta indica que la contraseña se grabó correctamente y si es así limpiar los campos
                    if (respuesta.includes("grabada correctamente")) {
                        document.getElementById("codigo-aleatorio").value = "";
                        document.getElementById("contrasena").value = "";
                        document.getElementById("repetir-contrasena").value = "";
                        document.location.href = "../login.php";                // Va al Login en caso de que la contraseña se grabe correctamente
                    }
                }
            };
            xhr.send(formData);
        }
        else{
            // Botón Cancelar
            // No hacer nada
        }   
    }
}
