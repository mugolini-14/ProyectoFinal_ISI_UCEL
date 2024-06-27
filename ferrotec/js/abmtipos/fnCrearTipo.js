// Función fnCreartipo
function fnCreartipo() {

    // Obtener los valores de los campos
    var nombretipo = document.getElementById("nombre-tipo-alta-input").value;
    var descripciontipo = document.getElementById("descripcion-tipo-alta-input").value;

    // Verificar si algún campo está vacío
    if (nombretipo == '' || descripciontipo == '0') {
        alert("No se han completado algunos campos. Por favor, complételos para poder continuar.");
        return;
    }

    // Confirmar la creación del tipo
    if (!confirm("¿Desea Crear el tipo " + nombretipo + "?")) {
        return;
    }

    // Crear objeto FormData para enviar los datos al archivo PHP
    var formData = new FormData();
    formData.append('nombretipo', nombretipo);
    formData.append('descripciontipo', descripciontipo);

    // Enviar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../abmtipos/altatipo/insertar_tipo.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var respuesta = xhr.responseText; // Obtener la respuesta del servidor
            alert(respuesta); // Mostrar la respuesta del servidor

            // Verificar si la respuesta indica que el artículo se creó correctamente y si es así limpiar los campos
            if (respuesta.includes("creado correctamente")) {
                document.getElementById("nombre-tipo-alta-input").value = "";
                document.getElementById("descripcion-tipo-alta-input").value = "";
            }
        }
    };
    xhr.send(formData);
}


