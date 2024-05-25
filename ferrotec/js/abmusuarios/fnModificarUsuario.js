function fnModificarUsuario() {
    // Obtener los valores de los campos
    var nombreUsuario = document.getElementById("nombre-usuario-modificacion-input").value;
    var nombrepilaUsuario = document.getElementById("nombrepila-usuario-modificacion-input").value;
    var apellidoUsuario = document.getElementById("apellido-usuario-modificacion-input").value;
    var direccionUsuario = document.getElementById("direccion-usuario-modificacion-input").value;
    var emailUsuario = document.getElementById("email-usuario-modificacion-input").value;
    var perfilAcceso = document.getElementById("perfil-acceso-modificacion-usuario-opciones").value;

    // Verificar si algún campo está vacío
    if (nombreUsuario == '' || nombrepilaUsuario == '' || apellidoUsuario == '' || direccionUsuario == '' || emailUsuario == '' || perfilAcceso == '0') {
        alert("No se han completado algunos campos. Por favor, complételos para poder continuar.");
        return;
    }

    // Confirmar la creación del usuario
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