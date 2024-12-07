// Funcion: fnVolverArticulos
// Descripción: Función que verifica si hay contenido en la página consulta_articulos.php, 
//              pregunta y valida si hay contenido y pregunta de volver al index.php, o
//              vuelve directamente al index.php

function fnVolverArticulos(){
    if (document.getElementById('articulo').value != '' 
    || document.getElementById('marca').value != ''
    || document.getElementById('descripcion').value != ''
    || document.getElementById('tabla-body-articulos').length > 0){

        if(confirm("¿Desea volver al menú principal?")){        // Si hay contenido, preguntar si desea volver antes de ir al index.php
            location="../../index/index.php";
        }
        
    }
    else{
        location="../../index/index.php";                        // Volver directamente al index.php
    }
}