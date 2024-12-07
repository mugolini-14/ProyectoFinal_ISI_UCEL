// Funcion: fnLimpiarObjetosHistorialVentas
// Descripción: función que limpia el contenido de los elementos en la página historial_articulos.php
//

function fnLimpiarObjetosHistorialVentas(){
    if (document.getElementById('fecha-desde').value != ''
    || document.getElementById('fecha-hasta').value != ''
    || document.getElementById('tipo-venta').value != 'S'
    || document.getElementById('modo-pago').value != '' 
    || document.getElementById('monto').value != ''
    || document.getElementById('monto-numero').value != ''
    || document.getElementById('sucursal').value != ''
    || document.getElementById('modificado-por').value != ''
    || document.getElementById('cant-registros').value != ''
    || document.getElementById('tabla-body-historial-ventas').length > 0
    || document.getElementById('tabla-body-historial-ventas-detalle').length > 0){

        document.getElementById('fecha-desde').value = ''; 
        document.getElementById('fecha-hasta').value = '';
        document.getElementById('tipo-venta').value = 'S';
        document.getElementById('modo-pago').value = '';
        document.getElementById('monto').value = '';
        document.getElementById('monto-numero').value = '';
        document.getElementById('monto-numero').disabled = true;
        document.getElementById('sucursal').value = '';
        document.getElementById('modificado-por').value = '';
        document.getElementById('cant-registros').value = '';
        document.getElementById('tabla-body-historial-ventas').innerHTML = '';
        document.getElementById('tabla-body-historial-ventas-detalle').innerHTML = '';
        
    }
    else{
        // No hacer nada
    }
}