//  Función: fnModificarUsuario()
//  Descripción: Función que envía el formulario a la base de datos para Modificar un Usuario
//  A partir de validaciones iniciales
//  Valida si hay campos vacíos
//  Confirma si se desea envíar el formulario
//

function fnModificarUsuario() {
    
    //  Función: fnValidarEmail(email)
    //  Descripción: Valida que el texto ingresado en el campo email sea válido
    //               Mediante expresiones regulares
    //               Verifica que la cadena del campo email cumpla con la expresión determinada
    //               (texto_nombre(n) + "@" + texto_dominio(n) + "." + texto(2))
    //  Parámetros:
    //  - email:     Cadena de texto del email ingresado por el usuario

    function fnValidarEmail(email) {
        const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return regex.test(email);
    }
    
    // Obtener los valores de los campos
    var nombreUsuario = document.getElementById("nombre-usuario-modificacion-input").value;
    var nombrepilaUsuario = document.getElementById("nombrepila-usuario-modificacion-input").value;
    var apellidoUsuario = document.getElementById("apellido-usuario-modificacion-input").value;
    var direccionUsuario = document.getElementById("direccion-usuario-modificacion-input").value;
    var emailUsuario = document.getElementById("email-usuario-modificacion-input").value;
    var perfilAcceso = document.getElementById("perfil-acceso-modificacion-usuario-opciones").value;

    // Verifica que los campos no estén vacíos
    if( nombreUsuario != ''
        && nombrepilaUsuario != ''
        && apellidoUsuario != ''
        && direccionUsuario != ''
        && emailUsuario != ''
        && perfilAcceso != ''){
            //Verificar que alguno de los campos no esté vacío
            if( nombreUsuario != ''
                || nombrepilaUsuario != ''
                || apellidoUsuario != ''
                || direccionUsuario != ''
                || emailUsuario != ''
                || perfilAcceso != ''){
                    // Verifica que el e-mail ingresado sea correcto
                    if(fnValidarEmail(emailUsuario) != false){
                        // Verifica que el Perfil de Acceso esté seleccionado
                        if(perfilAcceso != '0'){
                            // Confirmar la modificación del usuario
                            if (!confirm("¿Desea Modificar el Usuario " + nombreUsuario + " con los valores ingresados?")) {
                                return;
                            }

                            // Crear objeto FormData para enviar los datos al archivo PHP
                            var formData = new FormData();
                            formData.append('nombreUsuario', nombreUsuario);
                            formData.append('nombrepilaUsuario', nombrepilaUsuario);
                            formData.append('apellidoUsuario', apellidoUsuario);
                            formData.append('direccionUsuario', direccionUsuario);
                            formData.append('emailUsuario', emailUsuario);
                            formData.append('perfilAcceso', perfilAcceso);

                            // Enviar la solicitud AJAX
                            var xhr = new XMLHttpRequest();
                            xhr.open("POST", "../abmusuarios/modificarusuario/modificar_usuario.php", true);
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                    alert(xhr.responseText); // Muestra la respuesta del servidor
                                }
                            };
                            xhr.send(formData);
                        }
                        else{
                            alert('Por favor, seleccione un Perfil del Usuario.');
                        }
                    }
                    else{
                        // No se seleccionó ningún perfil de Usuario
                        alert ('Por favor ingrese un correo válido.')
                    }
            }
            else{
                // Los campos están vacíos
                alert('Por favor complete todos los campos.');
            }
    }
    else{
        // Los campos están vacíos
        alert('Por favor complete todos los campos.');
    }
}