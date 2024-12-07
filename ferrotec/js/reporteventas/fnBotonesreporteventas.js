//  Función:      fnBotonesventas(tipoAccion)
//  Descripción:  Función de los Botones Cancelar y Volver de ventas
//                Verifica si hay valores ingresados / seleccionados y pregunta según la cadena recibida 
//  Parámetros:
//  tipoAccion:     V --> Volver / C --> Cancelar

function fnBotonesventas(tipoAccion){
    if(tipoAccion == 'V'){
        if (confirm("¿Desea Salir Sin Efectuar Cambios?")) {
          location="../index/index.php";
        } 
        else {
          // Hacer Nada
        }
    }
    if(tipoAccion == 'C'){
        if (confirm("¿Desea Cancelar la Operación?")) {
          location.reload();
        } 
        else { 
          // Hacer nada
        }
    }
}