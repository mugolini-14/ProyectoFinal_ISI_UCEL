// Funcion: fnVolverRestablecerContrasena()
// Descripción: Función que verifica si hay contenido en la página restablecercontrasena.php, 
//              pregunta y valida si hay contenido y pregunta de volver al index.php, o
//              vuelve directamente al index.php

function fnVolverRestablecerContrasena(){
    console.log('Función ejecutada');
    if( document.getElementById('codigo-aleatorio').value != ''
        || document.getElementById('contrasena').value != ''
        || document.getElementById('repetir-contrasena').value != ''){

            console.log('Hay contenido en los campos');
            if(confirm("¿Desea volver al menú principal?")){        // Si hay contenido, preguntar si desea volver antes de ir al index.php
                console.log('dirigiendo');
                document.location.href = "../login.php";            
            }
            
        }
    else{
        console.log('No Hay contenido en los campos');
        console.log('dirigiendo');
        document.location.href = "../login.php";    
    }
}   