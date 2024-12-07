//  Función: fnCrearcategoria()
//  Descripción: Función que envía el formulario a la base de datos para Insertar una Categoría de Artículo
//  A partir de validaciones iniciales
//  Valida si hay campos vacíos
//  Confirma si se desea envíar el formulario
//

function fnCrearcategoria() {

    // Obtener los valores de los campos
    var padretipocategoria = document.getElementById("padretipo-categoria-alta-input").value;
    var nombrecategoria = document.getElementById("nombre-categoria-alta-input").value;
    var descripcioncategoria = document.getElementById("descripcion-categoria-alta-input").value;

    // Verifica si todos los campos están vacíos
    if (padretipocategoria != ''
        && nombrecategoria != ''
        && descripcioncategoria !=''){
            // Verifica si todos los campos están vacíos
            if (padretipocategoria != ''
                || nombrecategoria != ''
                || descripcioncategoria !=''){
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
                            var respuesta = xhr.responseText; // Obtener la respuesta del servidor
                            alert(respuesta); // Mostrar la respuesta del servidor

                            // Verificar si la respuesta indica que el artículo se creó correctamente
                            if (respuesta.includes("creado correctamente")) {
                                document.getElementById("padretipo-categoria-alta-input").value = "";
                                document.getElementById("nombre-categoria-alta-input").value = "";
                                document.getElementById("descripcion-categoria-alta-input").value = "";
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
        alert('Por favor complete todos los campos.');
    }
}

