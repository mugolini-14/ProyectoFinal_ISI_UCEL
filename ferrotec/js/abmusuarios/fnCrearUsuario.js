// Declaración de la función fngenerarPassword
function fngenerarPassword(longitud) {
    const caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+{}[]|;:,.<>?";
    let password = "";
    for (let i = 0; i < longitud; i++) {
        const indice = Math.floor(Math.random() * caracteres.length);
        password += caracteres.charAt(indice);
    }
    return password;
}

// Función fnCrearUsuario
function fnCrearUsuario() {
    // Llamada a la función fngenerarPassword
    var numeroAleatorio = fngenerarPassword(8);

    // Obtener los valores de los campos
    var nombreUsuario = document.getElementById("nombre-usuario-alta-input").value;
    var nombrepilaUsuario = document.getElementById("nombrepila-usuario-alta-input").value;
    var apellidoUsuario = document.getElementById("apellido-usuario-alta-input").value;
    var direccionUsuario = document.getElementById("direccion-usuario-alta-input").value;
    var emailUsuario = document.getElementById("email-usuario-alta-input").value;
    var perfilAcceso = document.getElementById("perfil-acceso-alta-usuario-opciones").value;

    // Verificar si algún campo está vacío
    if (nombreUsuario == '' || perfilAcceso == '0' || nombrepilaUsuario == '0' || apellidoUsuario == '0' || direccionUsuario == '0' || emailUsuario == '0') {
        alert("No se han completado algunos campos. Por favor, complételos para poder continuar.");
        return;
    }

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
    formData.append('numeroAleatorio', numeroAleatorio);
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


