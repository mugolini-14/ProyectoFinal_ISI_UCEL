//  Función: fnModificartipo()
//  Descripción: Función que envía el formulario a la base de datos para Modificar un Tipo
//  A partir de validaciones iniciales
//  Valida si hay campos vacíos
//  Confirma si se desea envíar el formulario
//

function fnModificartipo() {
    // Obtener los valores de los campos
    var nombretipo = document.getElementById("nombre-tipo-modificacion-input").value;
    var renombretipo = document.getElementById("renombre-tipo-modificacion-input").value;
    var descripciontipo = document.getElementById("descripcion-tipo-modificacion-input").value;
    var estadoTipo = document.getElementById("acciones-estado-modificacion-tipo").value;

    // Verificar si todos los campos están vacíos
    if( nombretipo != ''
        && renombretipo != ''
        && descripciontipo != ''){
            // Verificar algún campo está vacío
            if( nombretipo != ''
                || renombretipo != ''
                || descripciontipo != ''){
                    // Verificar si el estado está seleccionado
                    if(estadoTipo != ''){
                        // Confirmar la creación del tipo
                        if (!confirm("¿Desea Modificar el tipo " + nombretipo + " con los valores ingresados?")) {
                            return;
                        }

                        // Crear objeto FormData para enviar los datos al archivo PHP
                        var formData = new FormData();
                        formData.append('nombretipo', nombretipo);
                        formData.append('renombretipo', renombretipo);
                        formData.append('descripciontipo', descripciontipo);
                        formData.append('estadoTipo',estadoTipo);

                        // Enviar la solicitud AJAX
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "../abmtipos/modificartipo/modificar_tipo.php", true);
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                alert(xhr.responseText); // Muestra la respuesta del servidor
                            }
                        };
                        xhr.send(formData);
                        }
                    else{
                        // El estado no está seleccionado
                        alert('Por favor seleccione un estado.');
                    }
            }
            else{
                // Todos los campos están vacíos
                alert('Por favor, complete todos los campos.');
            }
    }
    else{
        // Todos los campos están vacíos
        alert('Por favor, complete todos los campos.');
    }
}