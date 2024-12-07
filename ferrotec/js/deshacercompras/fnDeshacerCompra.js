//  Función: fnDeshacerCompras()
//  Descripción: Función que envía el formulario a la base de datos para Deshacer compras
//  A partir de validaciones iniciales
//  (Baja Lógica)
//  Valida si hay un id seleccionado en el Formulario
//  Si está seleccionado envía el formulario con los datos sumnistrados

function fnDeshacerCompras(){
    var idDeshacer = document.getElementById("iddeshacer").value;
    if(idDeshacer== ''){
        alert("Por favor complete todos los campos.");
    }
    else{
        if(confirm("¿Desea Eliminar la compra Nro " + idDeshacer + "?")) {
            var formData = new FormData();
            formData.append('idDeshacer', idDeshacer);

            // Enviar la solicitud AJAX

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../deshacercompras/eliminar_compras.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText); // Muestra la respuesta del servidor

                    // Después de la eliminación. Limpio el campo de Nombre de Articulo a borrar
                    document.getElementById("idDeshacer").value = "";
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