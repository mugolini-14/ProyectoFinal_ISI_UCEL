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

// Función fnCrearArticulo
function fnCrearArticulo() {
    // Llamada a la función fngenerarPassword
    var numeroAleatorio = fngenerarPassword(8);

    // Obtener los valores de los campos
    var nombreArticulo = document.getElementById("nombre-articulo-alta-input").value;
    var nombrepilaArticulo = document.getElementById("nombrepila-articulo-alta-input").value;
    var apellidoArticulo = document.getElementById("apellido-articulo-alta-input").value;
    var direccionArticulo = document.getElementById("direccion-articulo-alta-input").value;
    var emailArticulo = document.getElementById("email-articulo-alta-input").value;
    var perfilAcceso = document.getElementById("perfil-acceso-alta-articulo-opciones").value;

    // Verificar si algún campo está vacío
    if (nombreArticulo == '' || perfilAcceso == '0' || nombrepilaArticulo == '0' || apellidoArticulo == '0' || direccionArticulo == '0' || emailArticulo == '0') {
        alert("No se han completado algunos campos. Por favor, complételos para poder continuar.");
        return;
    }

    // Confirmar la creación del articulo
    if (!confirm("¿Desea Crear el Articulo " + nombreArticulo + "?")) {
        return;
    }

    // Crear objeto FormData para enviar los datos al archivo PHP
    var formData = new FormData();
    formData.append('nombreArticulo', nombreArticulo);
    formData.append('nombrepilaArticulo', nombrepilaArticulo);
    formData.append('apellidoArticulo', apellidoArticulo);
    formData.append('direccionArticulo', direccionArticulo);
    formData.append('emailArticulo', emailArticulo);
    formData.append('numeroAleatorio', numeroAleatorio);
    formData.append('perfilAcceso', perfilAcceso);

    // Enviar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../abmarticulos/altaarticulo/insertar_articulo.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText); // Muestra la respuesta del servidor

            // Cambiar los valores de los elementos después de recibir la respuesta
            document.getElementById("nombre-articulo-alta-input").value = "";
            document.getElementById("nombrepila-articulo-alta-input").value = "";
            document.getElementById("apellido-articulo-alta-input").value = "";
            document.getElementById("direccion-articulo-alta-input").value = "";
            document.getElementById("email-articulo-alta-input").value = "";
            document.getElementById("perfil-acceso-alta-articulo-opciones").value = "0";
            document.getElementById("acceso-ventas-alta-fila").style.display = "none";
            document.getElementById("acceso-compras-alta-fila").style.display = "none";
            document.getElementById("acceso-informes-alta-fila").style.display = "none";
            document.getElementById("acceso-consultas-alta-fila").style.display = "none";
            document.getElementById("acceso-articulos-alta-fila").style.display = "none";
        }
    };
    xhr.send(formData);
}


