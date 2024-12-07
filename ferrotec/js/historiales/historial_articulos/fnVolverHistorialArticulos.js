// Funcion: fnVolverHistorialArticulos
// Descripción: Función que verifica si hay contenido en la página historial_articulos.php, 
//              pregunta y valida si hay contenido y pregunta de volver al index.php, o
//              vuelve directamente al index.php

function fnVolverHistorialArticulos(){
    if (document.getElementById('fecha-desde').value != ''
    || document.getElementById('fecha-hasta').value != ''
    || document.getElementById('tipo-accion').value != 'S'
    || document.getElementById('articulo').value != '' 
    || document.getElementById('marca').value != ''
    || document.getElementById('descripcion').value != ''
    || document.getElementById('precio').value != ''
    || document.getElementById('stock').value != ''
    || document.getElementById('modificado-por').value != ''
    || document.getElementById('cant-registros').value != ''
    || document.getElementById('tabla-body-historial-articulos').length > 0){

        if(confirm("¿Desea volver al menú principal?")){        // Si hay contenido, preguntar si desea volver antes de ir al index.php
            location="../../index/index.php";
        }
        
    }
    else{
        location="../../index/index.php";                        // Volver directamente al index.php
    }
}