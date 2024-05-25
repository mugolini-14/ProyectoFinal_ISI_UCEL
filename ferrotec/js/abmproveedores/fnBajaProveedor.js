//  fnBajaProveedor
//  Descripción: Función que envía el formulario a la base de datos para Dar de Baja un Proveedor
//  A partir de validaciones iniciales
//  (Baja Lógica)
//  Valida si hay un Proveedor seleccionado en el Formulario
//  Si está seleccionado envía el formulario con los datos sumnistrados
function fnBajaProveedor(){
    var nombreProveedor = document.getElementById("nombre-proveedor-baja-input").value;
    if(nombreProveedor == ''){
        alert("Por favor seleccione un usuario para dar de baja.");
    }
    else{
        if(confirm("¿Desea Dar de Baja al Usuario " + nombreProveedor + "?")) {
            var formData = new FormData();
            formData.append('nombreProveedor', nombreProveedor);

            // Enviar la solicitud AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../abmproveedores/bajaproveedor/borrar_proveedor.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText); // Muestra la respuesta del servidor

                    // Después de la eliminación. Limpio el campo de Nombre de Usuario a borrar
                    document.getElementById("nombre-proveedor-baja-input").value = "";
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