//  Función: fnCrearUsuario()
//  Descripción: Función que envìa los datos ingresados a insertar_usuario.php
//               Para grabar el nuevo usuario
//               Valida los campos ingresados por el usuario
//               Setea una contraseña temporal extraída de la función fngenerarPassword(longitud)
//               para evitar el ingreso por vacío
//  

function fnCrearUsuario() {
    
    //  Función: fngenerarPassword(longitud)
    //  Descripción: Función que genera una contraseña temporal para llenar la contraseña del usuario nuevo
    //               El Usuario luego debe restablecer la contraseña desde el login.php
    //  

    function fngenerarPassword(longitud) {
    const caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+{}[]|;:,.<>?";
    let password = "";
    for (let i = 0; i < longitud; i++) {
        const indice = Math.floor(Math.random() * caracteres.length);
        password += caracteres.charAt(indice);
    }
        return password;
    }

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

    // Llamada a la función fngenerarPassword
    var passwordTemporal = fngenerarPassword(8);

    // Obtener los valores de los campos
    var nombreUsuario = document.getElementById("nombre-usuario-alta-input").value;
    var nombrepilaUsuario = document.getElementById("nombrepila-usuario-alta-input").value;
    var apellidoUsuario = document.getElementById("apellido-usuario-alta-input").value;
    var direccionUsuario = document.getElementById("direccion-usuario-alta-input").value;
    var emailUsuario = document.getElementById("email-usuario-alta-input").value;
    var perfilAcceso = document.getElementById("perfil-acceso-alta-usuario-opciones").value;

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
                            // Confirmar la creación del usuario
                            if (!confirm("¿Desea Crear el Usuario " + nombreUsuario + "?")) {
                                return;
                            }

                            // Crear objeto FormData para enviar los datos al archivo PHP
                            var formData = new FormData();
                            formData.append('nombreUsuario', nombreUsuario);
                            formData.append('nombrepilaUsuario', nombrepilaUsuario);
                            formData.append('apellidoUsuario', apellidoUsuario);
                            formData.append('direccionUsuario', direccionUsuario);
                            formData.append('emailUsuario', emailUsuario);
                            formData.append('passwordTemporal', passwordTemporal);
                            formData.append('perfilAcceso', perfilAcceso);

                            // Enviar la solicitud AJAX
                            var xhr = new XMLHttpRequest();
                            xhr.open("POST", "../abmusuarios/altausuario/insertar_usuario.php", true);
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                    var respuesta = xhr.responseText; // Obtener la respuesta del servidor
                                    alert(respuesta); // Mostrar la respuesta del servidor

                                    // Verificar si la respuesta indica que el artículo se creó correctamente y si es así limpiar los campos
                                    if (respuesta.includes("creado correctamente")) {
                                        document.getElementById("nombre-usuario-alta-input").value = "";
                                        document.getElementById("nombrepila-usuario-alta-input").value = "";
                                        document.getElementById("apellido-usuario-alta-input").value = "";
                                        document.getElementById("direccion-usuario-alta-input").value = "";
                                        document.getElementById("email-usuario-alta-input").value = "";
                                        document.getElementById("perfil-acceso-alta-usuario-opciones").value = "0";
                                        document.getElementById("acceso-ventas-alta-fila").style.display = "none";
                                        document.getElementById("acceso-compras-alta-fila").style.display = "none";
                                        document.getElementById("acceso-informes-alta-fila").style.display = "none";
                                        document.getElementById("acceso-consultas-alta-fila").style.display = "none";
                                        document.getElementById("acceso-usuarios-alta-fila").style.display = "none";
                                    }
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
