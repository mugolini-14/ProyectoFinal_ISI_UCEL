// Funcion: fnVolverHistorialCompras
// Descripción: Función que verifica si hay contenido en la página historial_compras.php, 
//              pregunta y valida si hay contenido y pregunta de volver al index.php, o
//              vuelve directamente al index.php

function fnVolverHistorialCompras(){
    if (document.getElementById('fecha-desde').value != ''
    || document.getElementById('fecha-hasta').value != ''
    || document.getElementById('tipo-compra').value != 'S'
    || document.getElementById('modo-pago').value != 'S' 
    || document.getElementById('monto').value != 'S'
    || document.getElementById('monto-numero').value != ''
    || document.getElementById('sucursal').value != ''
    || document.getElementById('proveedor').value != ''
    || document.getElementById('modificado-por').value != ''
    || document.getElementById('cant-registros').value != ''
    || document.getElementById('tabla-body-historial-compras').length > 0
    || document.getElementById('tabla-body-historial-compras-detalle').length > 0){

        if(confirm("¿Desea volver al menú principal?")){        // Si hay contenido, preguntar si desea volver antes de ir al index.php
            location="../../index/index.php";
        }
        
    }
    else{
        location="../../index/index.php";                        // Volver directamente al index.php
    }
}