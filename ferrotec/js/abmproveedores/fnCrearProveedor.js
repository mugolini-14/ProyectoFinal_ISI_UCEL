// Función fnCrearProveedor
function fnCrearProveedor() {

    // Obtener los valores de los campos
    var nombreProveedor = document.getElementById("nombre-proveedor-alta-input").value;
    var descripcionProveedor = document.getElementById("descripcion-proveedor-alta-input").value;
    var direccionProveedor = document.getElementById("direccion-proveedor-alta-input").value;
    var localidadProveedor = document.getElementById("localidad-proveedor-alta-input").value;
    var provinciaProveedor = document.getElementById("provincia-proveedor-alta-input").value;
    var telefono1Proveedor = document.getElementById("telefono1-proveedor-alta-input").value;
    var telefono2Proveedor = document.getElementById("telefono2-proveedor-alta-input").value;
    var emailProveedor = document.getElementById("email-proveedor-alta-input").value;
    var cuitProveedor = document.getElementById("cuit-proveedor-alta-input").value;

    // Verificar si algún campo está vacío
    if (nombreProveedor == '' || descripcionProveedor == '' || direccionProveedor == '' 
        || localidadProveedor == '' || provinciaProveedor == '' 
        || telefono1Proveedor == '' || telefono2Proveedor == '' 
        || emailProveedor == '' || cuitProveedor == '') {
        alert("No se han completado algunos campos. Por favor, complételos para poder continuar.");
        return;
    }

    // Confirmar la creación del Proveedor
    if (!confirm("¿Desea Crear el Proveedor " + nombreProveedor + "?")) {
        return;
    }

    // Crear objeto FormData para enviar los datos al archivo PHP
    var formData = new FormData();
    formData.append('nombreProveedor', nombreProveedor);
    formData.append('descripcionProveedor', descripcionProveedor);
    formData.append('direccionProveedor', direccionProveedor);
    formData.append('localidadProveedor', localidadProveedor);
    formData.append('provinciaProveedor', provinciaProveedor);
    formData.append('telefono1Proveedor', telefono1Proveedor);
    formData.append('telefono2Proveedor', telefono2Proveedor);
    formData.append('emailProveedor', emailProveedor);
    formData.append('cuitProveedor', cuitProveedor);

    // Enviar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../abmproveedores/altaproveedor/insertar_proveedor.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var respuesta = xhr.responseText; // Obtener la respuesta del servidor
            alert(respuesta); // Mostrar la respuesta del servidor

            // Verificar si la respuesta indica que el artículo se creó correctamente y si es así limpiar los campos
            if (respuesta.includes("creado correctamente")) {
                document.getElementById("nombre-proveedor-alta-input").value = "";
                document.getElementById("descripcion-proveedor-alta-input").value = "";
                document.getElementById("direccion-proveedor-alta-input").value = "";
                document.getElementById("localidad-proveedor-alta-input").value = "";
                document.getElementById("provincia-proveedor-alta-input").value = "";
                document.getElementById("telefono1-proveedor-alta-input").value = "";
                document.getElementById("telefono2-proveedor-alta-input").value = "";
                document.getElementById("email-proveedor-alta-input").value = "";
                document.getElementById("cuit-proveedor-alta-input").value = "";
            }
        }
    };
    xhr.send(formData);
}


