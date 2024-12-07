// Funcion: fnVolverUsuarios
// Descripción: Función que verifica si hay contenido en la página consulta_usuarios.php, 
//              pregunta y valida si hay contenido y pregunta de volver al index.php, o
//              vuelve directamente al index.php

function fnVolverUsuarios(){
    if (document.getElementById('id').value != '' 
    || document.getElementById('username').value != ''
    || document.getElementById('tipo-permiso').value != ''
    || document.getElementById('nombre').value != ''
    || document.getElementById('apellido').value != ''
    || document.getElementById('sucursal').value != ''
    || document.getElementById('direccion').value != ''
    || document.getElementById('email').value != ''
    || document.getElementById('tabla-body-usuarios').length > 0){

        if(confirm("¿Desea volver al menú principal?")){        // Si hay contenido, preguntar si desea volver antes de ir al index.php
            location="../../index/index.php";
        }
        
    }
    else{
        location="../../index/index.php";                        // Volver directamente al index.php
    }
}