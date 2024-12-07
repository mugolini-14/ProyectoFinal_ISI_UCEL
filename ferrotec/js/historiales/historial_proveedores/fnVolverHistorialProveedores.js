// Funcion: fnVolverHistorialProveedores()
// Descripción: Función que verifica si hay contenido en la página historial_proveedores.php, 
//              pregunta y valida si hay contenido y pregunta de volver al index.php, o
//              vuelve directamente al index.php

function fnVolverHistorialProveedores(){
    if (document.getElementById('fecha-desde').value != ''
    || document.getElementById('fecha-hasta').value != ''
    || document.getElementById('nombre').value != 'S'
    || document.getElementById('descripcion').value != '' 
    || document.getElementById('direccion').value != ''
    || document.getElementById('localidad').value != ''
    || document.getElementById('telefono1').value != ''
    || document.getElementById('telefono2').value != ''
    || document.getElementById('email').value != ''
    || document.getElementById('cuit').value != ''
    || document.getElementById('modificado-por').value != ''
    || document.getElementById('tabla-body-historial-proveedores').length > 0){

        if(confirm("¿Desea volver al menú principal?")){        // Si hay contenido, preguntar si desea volver antes de ir al index.php
            location="../../index/index.php";
        }
        
    }
    else{
        location="../../index/index.php";                        // Volver directamente al index.php
    }
}