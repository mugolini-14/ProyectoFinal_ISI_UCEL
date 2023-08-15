//  fnBajaUsuario
//  Descripción: Función que envía el formulario a la base de datos para Dar de Baja un Usuario
//  A partir de validaciones iniciales
//  (Baja Lógica)
//  Valida si hay un usuario seleccionado en el Formulario
//  Si está seleccionado envía el formulario con los datos sumnistrados

function fnBajaUsuario(){
    if(document.getElementById("seleccion-usuario-baja").value == '0'){
        alert("Por favor seleccione un usuario para dar de baja.");
    }
    else{
        if(document.getElementById("seleccion-usuario-baja").value != '0'){
            if(confirm("¿Desea Dar de Baja al Usuario " + document.getElementById("seleccion-usuario-baja").selectedIndex.text + "?")) {
                alert("Usuario dado de Baja con Éxito.");
                // Puesto para colocar submit y backend aquí
            }
            else{
                //  Cancelar Sin Hacer Cambios
                //  No Hacer Nada
            } 
        }
    }
}
