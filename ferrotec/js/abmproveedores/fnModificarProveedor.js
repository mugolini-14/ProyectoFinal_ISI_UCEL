function fnModificarProveedor() {
    // Obtener los valores de los campos
    var nombreProveedor = document.getElementById("nombre-proveedor-modificacion-input").value;
    var descripcionProveedor = document.getElementById("descripcion-proveedor-modificacion-input").value;
    var direccionProveedor = document.getElementById("direccion-proveedor-modificacion-input").value;
    var localidadProveedor = document.getElementById("localidad-proveedor-modificacion-input").value;
    var provinciaProveedor = document.getElementById("provincia-proveedor-modificacion-input").value;
    var telefono1Proveedor = document.getElementById("telefono1-proveedor-modificacion-input").value;
    var telefono2Proveedor = document.getElementById("telefono2-proveedor-modificacion-input").value;
    var emailProveedor = document.getElementById("email-proveedor-modificacion-input").value;
    var cuitProveedor = document.getElementById("cuit-proveedor-modificacion-input").value;

    // Verificar si algún campo está vacío
    if (descripcionProveedor == '' || direccionProveedor == '' || localidadProveedor == '' 
        || provinciaProveedor == '' || telefono1Proveedor == '' || emailProveedor == ''
        || cuitProveedor == '') {
        alert("No se han completado algunos campos. Por favor, complételos para poder continuar.");
        return;
    }

    // Confirmar la creación del usuario
    if (!confirm("¿Desea Modificar el Proveedor " + nombreProveedor + " con los valores ingresados?")) {
        return;
    }

    // Crear objeto FormData para enviar los datos al archivo PHP
    var formData = new FormData();
    formData.append('nombreProveedor', nombreProveedor);
    formData.append('descripcionProveedor', descripcionProveedor);
    formData.append('localidadProveedor', localidadProveedor);
    formData.append('provinciaProveedor', provinciaProveedor);
    formData.append('telefono1Proveedor', telefono1Proveedor);
    formData.append('telefono2Proveedor', telefono2Proveedor);
    formData.append('emailProveedor', emailProveedor);
    formData.append('cuitProveedor', cuitProveedor);

    // Enviar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../abmproveedores/modificarproveedor/modificar_proveedor.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText); // Muestra la respuesta del servidor

            // Cambiar los valores de los elementos después de recibir la respuesta
            document.getElementById("nombre-proveedor-modificacion-input").value = "";
            document.getElementById("descripcion-proveedor-modificacion-input").value = "";
            document.getElementById("direccion-proveedor-modificacion-input").value = "";
            document.getElementById("localidad-proveedor-modificacion-input").value = "";
            document.getElementById("provincia-proveedor-modificacion-input").value = "";
            document.getElementById("telefono1-proveedor-modificacion-input").value = "";
            document.getElementById("telefono2-proveedor-modificacion-input").value = "";
            document.getElementById("email-proveedor-modificacion-input").value = "";
            document.getElementById("cuit-proveedor-modificacion-input").value = "";
        }
    };
    xhr.send(formData);
}