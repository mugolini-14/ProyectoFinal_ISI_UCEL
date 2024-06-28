//  fnBajaArticulo
//  Descripción: Función que envía el formulario a la base de datos para Dar de Baja un Articulo
//  A partir de validaciones iniciales
//  (Baja Lógica)
//  Valida si hay un articulo seleccionado en el Formulario
//  Si está seleccionado envía el formulario con los datos sumnistrados
function fnBajaArticulo(){
    var nombreArticulo = document.getElementById("nombre-articulo-baja-input").value;
    if(nombreArticulo == ''){
        alert("Por favor seleccione un articulo para dar de baja.");
    }
    else{
        if(confirm("¿Desea Dar de Baja el Articulo " + nombreArticulo + "?")) {
            var formData = new FormData();
            formData.append('nombreArticulo', nombreArticulo);

            // Enviar la solicitud AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../abmarticulos/bajaarticulo/borrar_articulo.php", true);
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