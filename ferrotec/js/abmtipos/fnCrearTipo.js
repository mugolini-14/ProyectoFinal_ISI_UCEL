//  Función: fnCreartipo()
//  Descripción: Función que envía el formulario a la base de datos para Insertar un Tipo de Artículo
//  A partir de validaciones iniciales
//  Valida si hay campos vacíos
//  Confirma si se desea envíar el formulario
//

function fnCreartipo() {

    // Obtener los valores de los campos
    var nombretipo = document.getElementById("nombre-tipo-alta-input").value;
    var descripciontipo = document.getElementById("descripcion-tipo-alta-input").value;

    // Verificar si se ingresaron todos los campos
    if (nombretipo != ''
        && descripciontipo != ''){
            // Verificar si no se ingresó algún campo
            if (nombretipo != ''
                || descripciontipo != ''){
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
            else{
                alert('Por favor complete todos los campos.');
            }
        }
    else{
        // No se ingresaron todos los campos
        alert('Por favor complete todos los campos.');
    }
}


