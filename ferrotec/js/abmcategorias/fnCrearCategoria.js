// Función fnCrearcategoria
function fnCrearcategoria() {

    // Obtener los valores de los campos
    var padretipocategoria = document.getElementById("padretipo-categoria-alta-input").value;
    var nombrecategoria = document.getElementById("nombre-categoria-alta-input").value;
    var descripcioncategoria = document.getElementById("descripcion-categoria-alta-input").value;

    // Verificar si algún campo está vacío
    if (nombrecategoria == '' || padretipocategoria == '' || descripcioncategoria == '0') {
        alert("No se han completado algunos campos. Por favor, complételos para poder continuar.");
        return;
    }

    // Confirmar la creación del categoria
    if (!confirm("¿Desea Crear el categoria " + nombrecategoria + "?")) {
        return;
    }

    // Crear objeto FormData para enviar los datos al archivo PHP
    var formData = new FormData();
    formData.append('padretipocategoria', padretipocategoria);
    formData.append('nombrecategoria', nombrecategoria);
    formData.append('descripcioncategoria', descripcioncategoria);

    // Enviar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../abmcategorias/altacategoria/insertar_categoria.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText); // Muestra la respuesta del servidor

            // Cambiar los valores de los elementos después de recibir la respuesta
            document.getElementById("padretipo-categoria-alta-input").value = "";
            document.getElementById("nombre-categoria-alta-input").value = "";
            document.getElementById("descripcion-categoria-alta-input").value = "";
        }
    };
    xhr.send(formData);
}


