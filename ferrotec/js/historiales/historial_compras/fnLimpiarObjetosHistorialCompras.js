// Funcion: fnLimpiarObjetosHistorialCompras
// Descripción: función que limpia el contenido de los elementos en la página historial_compras.php
//

function fnLimpiarObjetosHistorialCompras(){
    if (document.getElementById('fecha-desde').value != ''
    || document.getElementById('fecha-hasta').value != ''
    || document.getElementById('tipo-compra').value != 'S'
    || document.getElementById('modo-pago').value != '' 
    || document.getElementById('monto').value != ''
    || document.getElementById('monto-numero').value != ''
    || document.getElementById('sucursal').value != ''
    || document.getElementById('proveedor').value != ''
    || document.getElementById('modificado-por').value != ''
    || document.getElementById('cant-registros').value != ''
    || document.getElementById('tabla-body-historial-compras').length > 0
    || document.getElementById('tabla-body-historial-compras-detalle').length > 0){

        document.getElementById('fecha-desde').value = ''; 
        document.getElementById('fecha-hasta').value = '';
        document.getElementById('tipo-compra').value = 'S';
        document.getElementById('modo-pago').value = '';
        document.getElementById('monto').value = '';
        document.getElementById('monto-numero').value = '';
        document.getElementById('monto-numero').disabled = true;
        document.getElementById('sucursal').value = '';
        document.getElementById('proveedor').value = '';
        document.getElementById('modificado-por').value = '';
        document.getElementById('cant-registros').value = '';
        document.getElementById('tabla-body-historial-compras').innerHTML = '';
        document.getElementById('tabla-body-historial-compras-detalle').innerHTML = '';
        
    }
    else{
        // No hacer nada
    }
}