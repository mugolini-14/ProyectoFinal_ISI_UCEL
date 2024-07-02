//  fnValidarDatos
//  Descripción: Función que valida los datos suministrados en el Validar Contraseña
//  A partir de parámetros de entrada
//      - Valida si el código aleatorio tiene los 8 dìgitos
//      - Valida si la contraseña y el repetir coinciden

function fnValidarDatos(codigoaleatorio,contrasena,repetircontrasena){
    if(length(codigoaleatorio)<8){
        alert("El código aleatorio no está completo. Por favor verifique este dato");
    }
    else{
        if(contrasena == repetircontrasena){
            if(confirm("¿Desea Grabar la nueva Contraseña?")){
                // Enviar la solicitud AJAX
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "../reestablecercontrasena/grabar_contrasena.php", true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var respuesta = xhr.responseText; // Obtener la respuesta del servidor
                        alert(respuesta); // Mostrar la respuesta del servidor

                        // Verificar si la respuesta indica que la contraseña se grabó exitosamente
                        if (respuesta.includes("grabada correctamente")) {
                            document.getElementById("codigo-aleatorio").value = "";
                            document.getElementById("contrasena").value = "";
                            document.getElementById("repetir-contrasena").value = "";
                            document.location="../login.php";
                        }
                        else {
                            document.getElementById("codigo-aleatorio").value = "";
                            document.getElementById("contrasena").value = "";
                            document.getElementById("repetir-contrasena").value = "";
                        }
                    }
                };
                xhr.send(formData);
                } 
        }
        else{
            alert("La contraseña y el repetir contraseña no coinciden.");
        }
    }
}