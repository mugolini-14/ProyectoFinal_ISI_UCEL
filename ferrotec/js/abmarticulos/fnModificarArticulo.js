function fnModificarArticulo() {
    // Obtener los valores de los campos
    var nombreArticulo = document.getElementById("nombre-articulo-modificacion-input").value;
    var renombreArticulo = document.getElementById("renombre-articulo-modificacion-input").value;
    var marcaArticulo = document.getElementById("marca-articulo-modificacion-input").value;
    var descripcionArticulo = document.getElementById("descripcion-articulo-modificacion-input").value;
    var precioArticulo = document.getElementById("precio-articulo-modificacion-input").value;
    var catArticulo = document.getElementById("cat-acceso-modificacion-articulo-opciones").value;

    // Verificar si algún campo está vacío
    if (nombreArticulo == '' || renombreArticulo == '' || marcaArticulo == '' || descripcionArticulo == '' || precioArticulo == '' || catArticulo == '') {
        alert("No se han completado algunos campos. Por favor, complételos para poder continuar.");
        return;
    }

    // Confirmar la creación del articulo
    if (!confirm("¿Desea Modificar el Articulo " + nombreArticulo + " con los valores ingresados?")) {
        return;
    }

    // Crear objeto FormData para enviar los datos al archivo PHP
    var formData = new FormData();
    formData.append('nombreArticulo', nombreArticulo);
    formData.append('renombreArticulo', renombreArticulo);
    formData.append('marcaArticulo', marcaArticulo);
    formData.append('descripcionArticulo', descripcionArticulo);
    formData.append('precioArticulo', precioArticulo);
    formData.append('catArticulo', catArticulo);

    // Enviar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../abmarticulos/modificararticulo/modificar_articulo.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText); // Muestra la respuesta del servidor
        }
    };
    xhr.send(formData);
}