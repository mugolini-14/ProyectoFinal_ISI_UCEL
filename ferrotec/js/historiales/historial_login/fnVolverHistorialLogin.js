// Funcion: fnVolverHistorialLogin
// Descripción: Función que verifica si hay contenido en la página historial_login.php, 
//              pregunta y valida si hay contenido y pregunta de volver al index.php, o
//              vuelve directamente al index.php

function fnVolverHistorialLogin(){
    if (document.getElementById('fecha-desde').value != ''
    || document.getElementById('fecha-hasta').value != ''
    || document.getElementById('nombre-usuario').value != ''
    || document.getElementById('tipo-actividad').value != 'S' 
    || document.getElementById('tipo-permiso').value != 'S'  
    || document.getElementById('email').value != ''
    || document.getElementById('sucursal').value != ''
    || document.getElementById('cant-registros').value != ''
    || document.getElementById('tabla-body-historial-login').length > 0){

        if(confirm("¿Desea volver al menú principal?")){        // Si hay contenido, preguntar si desea volver antes de ir al index.php
            location="../../index/index.php";
        }
        
    }
    else{
        location="../../index/index.php";                        // Volver directamente al index.php
    }
}