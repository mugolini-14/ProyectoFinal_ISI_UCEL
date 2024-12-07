// Funcion: fnLimpiarObjetosHistorialProveedores()
// Descripción: función que limpia el contenido de los elementos en la página historial_proveedores.php
//

function fnLimpiarObjetosHistorialProveedores(){
    if (document.getElementById('fecha-desde').value != ''
    || document.getElementById('fecha-hasta').value != ''
    || document.getElementById('nombre').value != ''
    || document.getElementById('descripcion').value != '' 
    || document.getElementById('direccion').value != ''
    || document.getElementById('localidad').value != ''
    || document.getElementById('telefono1').value != ''
    || document.getElementById('telefono2').value != ''
    || document.getElementById('email').value != ''
    || document.getElementById('cuit').value != ''
    || document.getElementById('prov-accion').value != ''
    || document.getElementById('cant-registros').value != ''
    || document.getElementById('modificado-por').value != ''
    || document.getElementById('tabla-body-historial-proveedores').length > 0){

        document.getElementById('fecha-desde').value = ''; 
        document.getElementById('fecha-hasta').value = '';
        document.getElementById('nombre').value = '';
        document.getElementById('descripcion').value = '';
        document.getElementById('direccion').value = '';
        document.getElementById('localidad').value = '';
        document.getElementById('telefono1').value = '';
        document.getElementById('telefono2').value = '';
        document.getElementById('email').value = '';
        document.getElementById('cuit').value = '';
        document.getElementById('prov-accion').value = '';
        document.getElementById('cant-registros').value = '';
        document.getElementById('modificado-por').value = '';
        document.getElementById('tabla-body-historial-proveedores').innerHTML = '';
        
    }
    else{
        // No hacer nada
    }
}