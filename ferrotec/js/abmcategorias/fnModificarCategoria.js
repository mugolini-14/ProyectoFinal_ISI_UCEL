//  Función: fnModificarcategoria()
//  Descripción: Función que envía el formulario a la base de datos para Modificar una Categoría de Artículo
//  A partir de validaciones iniciales
//  Valida si hay campos vacíos
//  Confirma si se desea envíar el formulario
//

function fnModificarcategoria() {
    // Obtener los valores de los campos
    var padretipo = document.getElementById("padretipo-categoria-modificacion-input").value;
    var nombrecategoria = document.getElementById("nombre-categoria-modificacion-input").value;
    var renombrecategoria = document.getElementById("renombre-categoria-modificacion-input").value;
    var descripcioncategoria = document.getElementById("descripcion-categoria-modificacion-input").value;
    var estadocategoria = document.getElementById("acciones-estado-modificacion-categoria").value;

    // Verifica si están ingresados todos los campos
    if (padretipo != ''
        && nombrecategoria != ''
        && renombrecategoria != ''
        && descripcioncategoria != ''){
            if (padretipo != ''
                || nombrecategoria != ''
                || renombrecategoria != ''
                || descripcioncategoria != ''){
                    // Verifica que el estado esté seleccionado
                    if (estadocategoria != ''){
                        // Confirmar la creación del categoria
                        if (!confirm("¿Desea Modificar el categoria " + nombrecategoria + " con los valores ingresados?")) {
                            return;
                        }

                        // Crear objeto FormData para enviar los datos al archivo PHP
                        var formData = new FormData();
                        formData.append('padretipo', padretipo);
                        formData.append('nombrecategoria', nombrecategoria);
                        formData.append('renombrecategoria', renombrecategoria);
                        formData.append('descripcioncategoria', descripcioncategoria);
                        formData.append('estadoCategoria', estadocategoria);

                        // Enviar la solicitud AJAX
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "../abmcategorias/modificarcategoria/modificar_categoria.php", true);
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                alert(xhr.responseText); // Muestra la respuesta del servidor
                            }
                        };
                        xhr.send(formData);
                    }
                    else{
                        alert('Por favor seleccione un estado.');
                    }
            }
            else{
                // No está ingresado al menos un campo
                alert('Por favor complete todos los campos.');
            }
    }
    else{
        // No están ingresados todos los campos
        alert('Por favor complete todos los campos.');
       
    }
}