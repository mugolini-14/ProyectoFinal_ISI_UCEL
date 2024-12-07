//  Función: fnCrearProveedor()
//  Descripción: Función que envía el formulario a la base de datos para dar de baja un Proveedor
//  A partir de validaciones iniciales
//  Valida el campo del Nombre del Proveedor
//  Confirma si se desea envíar el formulario
//

function fnBajaProveedor(){
    var nombreProveedor = document.getElementById("nombre-proveedor-baja-input").value;
    if(nombreProveedor == ''){
        alert("Por favor complete todos los campos.");
    }
    else{
        if(confirm("¿Desea Dar de Baja al Usuario " + nombreProveedor + "?")) {
            var formData = new FormData();
            formData.append('nombreProveedor', nombreProveedor);

            // Enviar la solicitud AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../abmproveedores/bajaproveedor/baja_proveedor.php", true);
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