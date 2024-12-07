//  Función: fnBajaArticulo()
//  Descripción: Función que envía el formulario a la base de datos para Dar de Baja un Articulo
//  A partir de validaciones iniciales
//  Valida si hay un articulo escrito en el Formulario
//  Si está escrito envía el formulario con los datos sumnistrados
//

function fnBajaArticulo(){
    var nombreArticulo = document.getElementById("nombre-articulo-baja-input").value;
    // Verifica si el campo del Usuario está completo
    if(nombreArticulo == ''){
        alert("Por favor complete todos los campos.");
    }
    else{
        // Envía una confirmación para dar de baja
        if(confirm("¿Desea Dar de Baja el Articulo " + nombreArticulo + "?")) {
            var formData = new FormData();
            formData.append('nombreArticulo', nombreArticulo);

            // Enviar la solicitud AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../abmarticulos/bajaarticulo/baja_articulo.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText); // Muestra la respuesta del servidor

                    // Después de la eliminación. Limpio el campo de Nombre de Articulo a borrar
                    document.getElementById("nombre-articulo-baja-input").value = "";
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