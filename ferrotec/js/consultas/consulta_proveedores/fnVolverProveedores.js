// Funcion: fnVolverProveedores
// Descripción: Función que verifica si hay contenido en la página consulta_proveedores.php, 
//              pregunta y valida si hay contenido y pregunta de volver al index.php, o
//              vuelve directamente al index.php

function fnVolverProveedores(){
    if (document.getElementById('nombre').value != '' 
    || document.getElementById('descripcion').value != ''
    || document.getElementById('direccion').value != ''
    || document.getElementById('localidad').value != ''
    || document.getElementById('provincia').value != ''
    || document.getElementById('telefono1').value != ''
    || document.getElementById('telefono2').value != ''
    || document.getElementById('email').value != ''
    || document.getElementById('cuit').value != ''
    || document.getElementById('tabla-body-proveedores').length > 0){

        if(confirm("¿Desea volver al menú principal?")){        // Si hay contenido, preguntar si desea volver antes de ir al index.php
            location="../../index/index.php";
        }
        
    }
    else{
        location="../../index/index.php";                        // Volver directamente al index.php
    }
}