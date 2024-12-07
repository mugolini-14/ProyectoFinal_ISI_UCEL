//  Función: fnBajatipo()
//  Descripción: Función que envía el formulario a la base de datos para Dar de Baja un Tipo
//  A partir de validaciones iniciales
//  Valida si hay un articulo escrito en el Formulario
//  Si está escrito envía el formulario con los datos sumnistrados
//

function fnBajatipo(){
    var nombretipo = document.getElementById("nombre-tipo-baja-input").value;
    if(nombretipo == ''){
        alert("Por favor complete todos los campos.");
    }
    else{
        if(confirm("¿Desea Dar de Baja al tipo " + nombretipo + "?")) {
            var formData = new FormData();
            formData.append('nombretipo', nombretipo);

            // Enviar la solicitud AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../abmtipos/bajatipo/baja_tipo.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText); // Muestra la respuesta del servidor

                    // Después de la eliminación. Limpio el campo de Nombre de tipo a borrar
                    document.getElementById("nombre-tipo-baja-input").value = "";
                }
            };
            xhr.send(formData);
        }
        else{
            //  Cancelar Sin Hacer Cambios
            //  No Hacer Nada
        } 
    }
}