
// Función fnCrearArticulo
function fnCrearArticulo() {

    // Obtener los valores de los campos
    var nombreArticulo = document.getElementById("nombre-articulo-alta-input").value;
    var marcaArticulo = document.getElementById("marca-articulo-alta-input").value;
    var descripcionArticulo = document.getElementById("descripcion-articulo-alta-input").value;
    var precioArticulo = document.getElementById("precio-articulo-alta-input").value;
    var catArticulo = document.getElementById("cat-articulo-alta-input").value;

    // Verificar si algún campo está vacío
    if (nombreArticulo == '' || marcaArticulo == '' || marcaArticulo == '' || descripcionArticulo == '' || precioArticulo == '' || catArticulo == '') {
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
    formData.append('marcaArticulo', marcaArticulo);
    formData.append('descripcionArticulo', descripcionArticulo);
    formData.append('precioArticulo', precioArticulo);
    formData.append('catArticulo', catArticulo);

    // Enviar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../abmarticulos/altaarticulo/insertar_articulo.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var respuesta = xhr.responseText; // Obtener la respuesta del servidor
            alert(respuesta); // Mostrar la respuesta del servidor

            // Verificar si la respuesta indica que el artículo se creó correctamente
            if (respuesta.includes("creado correctamente")) {
                document.getElementById("nombre-articulo-alta-input").value = "";
                document.getElementById("marca-articulo-alta-input").value = "";
                document.getElementById("descripcion-articulo-alta-input").value = "";
                document.getElementById("precio-articulo-alta-input").value = "";
                document.getElementById("cat-articulo-alta-input").value = "";
            }
        }
    };
    xhr.send(formData);
}


