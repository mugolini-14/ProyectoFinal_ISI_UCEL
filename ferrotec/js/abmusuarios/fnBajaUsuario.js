//  fnBajaUsuario()
//  Descripción: Función que envía el formulario a la base de datos para Dar de Baja un Usuario
//  A partir de validaciones iniciales
//  (Baja Lógica)
//  Valida si hay un usuario seleccionado en el Formulario
//  Si está seleccionado envía el formulario con los datos sumnistrados
//

function fnBajaUsuario(){
    var nombreUsuario = document.getElementById("nombre-usuario-baja-input").value;
    if(nombreUsuario == ''){
        alert("Por favor complete todos los campos.");
    }
    else{
        if(confirm("¿Desea Dar de Baja al Usuario " + nombreUsuario + "?")) {
            var formData = new FormData();
            formData.append('nombreUsuario', nombreUsuario);

            // Enviar la solicitud AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../abmusuarios/bajausuario/borrar_usuario.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText); // Muestra la respuesta del servidor

                    // Después de la eliminación. Limpio el campo de Nombre de Usuario a borrar
                    document.getElementById("nombre-usuario-baja-input").value = "";
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