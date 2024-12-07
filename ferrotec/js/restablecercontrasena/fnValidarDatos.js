//  fnValidarDatos
//  Descripción: Función que valida los datos suministrados en el Restablecer Contraseña
//  A partir de parámetros de entrada
//      - Valida que el Código Aleatorio 
//      - Valida Repetición de Contraseñas
//      - Valida Longitud de Contraseñas
//      - Valida Mayúsculas, Minúsculas, Números y Caracteres Especiales en la Contraseña
//  Si pasa la validación, envia los datos a la base para guardar la contraseña en el usuario a restablecer
//  Parámetros:
//  - codigoAleatorioGenerado: El código generado en login_restablecer.php para validar si es correcto
//

function fnValidarDatos(codigoAleatorioGenerado){

    //  Funciones auxilares de Control
    //  Descripción: Funciones que validan las entradas del usuario según diferentes políticas aplicadas
    //

    function fnValidarMayusculas(cadenacontrasena){
        var regex = /[A-Z]/;
        return regex.test(cadenacontrasena);
    }

    function fnValidarMinusculas(cadenacontrasena){
        var regex = /[a-z]/;
        return regex.test(cadenacontrasena);
    }

    function fnValidarNumeros(cadena){
        const numero = Number(cadena);
        return Number.isInteger(numero);
    }

    function fnValidarNumerosContrasena(cadena){
        const regex = /\d/; 
        return regex.test(cadena);
    }

    function fnValidarCaracteresEspeciales(cadena){
        var regex = /[`!@#%^&*()_\-+=\[\]{};':"\\|,.<>\/?~ ]/;
        return regex.test(cadena);
    }

    var codigoaleatorio = document.getElementById('codigo-aleatorio').value;
    var contrasena = document.getElementById('contrasena').value;
    var repetircontrasena = document.getElementById('repetir-contrasena').value;

    var codigoAleatorioContenido = document.getElementById('codigo-aleatorio');
    var contrasenaContenido = document.getElementById('contrasena');
    var repetirContrasenaContenido = document.getElementById('repetir-contrasena');

    if(codigoaleatorio == '' && contrasena == '' && repetircontrasena == ''){
        // Validación inicial de contenido - Si no escribió Ningún Campo
        alert('Por favor complete todos los campos.');
        codigoAleatorioContenido.innerHTML = '';
        contrasenaContenido.innerHTML = '';
        repetirContrasenaContenido.innerHTML = '';
    }
    else if(codigoaleatorio == '' || contrasena == '' || repetircontrasena == ''){
        // Si no escribió alguno de los campos
        alert('Por favor complete todos los campos.');
        codigoAleatorioContenido.innerHTML = '';
        contrasenaContenido.innerHTML = '';
        repetirContrasenaContenido.innerHTML = '';
    }
    else if(codigoAleatorioGenerado !== codigoaleatorio){
        // Si el código aleatorio coincide con el enviado en el mail
        alert('El código de verificación es incorrecto.');
        codigoAleatorioContenido.innerHTML = '';
        contrasenaContenido.innerHTML = '';
        repetirContrasenaContenido.innerHTML = '';
    }
    else if(contrasena.length < 8 || contrasena.length > 12){           
        // El usuario no escribió la longitud adecuada de la contraseña
        alert('La contraseña no cumple con las políticas solicitadas.');
        codigoAleatorioContenido.innerHTML = '';
        contrasenaContenido.innerHTML = '';
        repetirContrasenaContenido.innerHTML = '';
    }
    else if(fnValidarMayusculas(contrasena)==false){                    
        // Si la contraseña no tiene una Mayúscula
        alert('La contraseña no cumple con las políticas solicitadas.');
        codigoAleatorioContenido.innerHTML = '';
        contrasenaContenido.innerHTML = '';
        repetirContrasenaContenido.innerHTML = '';
    }
    else if(fnValidarMinusculas(contrasena)==false){                    
        // Si la contraseña no tiene una Minúscula
        alert('La contraseña no cumple con las políticas solicitadas.');
        codigoAleatorioContenido.innerHTML = '';
        contrasenaContenido.innerHTML = '';
        repetirContrasenaContenido.innerHTML = '';
    }
    else if(fnValidarNumerosContrasena(contrasena)==false){               
        // Si la contraseña no tiene un número
        alert('La contraseña no cumple con las políticas solicitadas.');
        codigoAleatorioContenido.innerHTML = '';
        contrasenaContenido.innerHTML = '';
        repetirContrasenaContenido.innerHTML = '';
    }
    else if(fnValidarCaracteresEspeciales(contrasena)==false){             
        // Si la contraseña no tiene un símbolo
        alert('La contraseña no cumple con las políticas solicitadas.');
        codigoAleatorioContenido.innerHTML = '';
        contrasenaContenido.innerHTML = '';
        repetirContrasenaContenido.innerHTML = '';
    }
    else if(contrasena != repetircontrasena){                           
        // Si las contraseñas no son iguales
        alert('Las contraseñas no coinciden.');
        codigoAleatorioContenido.innerHTML = '';
        contrasenaContenido.innerHTML = '';
        repetirContrasenaContenido.innerHTML = '';
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
