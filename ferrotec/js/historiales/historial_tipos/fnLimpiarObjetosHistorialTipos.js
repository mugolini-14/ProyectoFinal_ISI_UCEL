// Funcion: fnLimpiarObjetosHistorialTipos
// Descripción: función que limpia el contenido de los elementos en la página historial_tipos.php
//

function fnLimpiarObjetosHistorialTipos(){
    if (document.getElementById('fecha-desde').value != ''
    || document.getElementById('fecha-hasta').value != ''
    || document.getElementById('tipo-accion').value != ''
    || document.getElementById('tipo').value != '' 
    || document.getElementById('descripcion').value != ''
    || document.getElementById('modificado-por').value != ''
    || document.getElementById('cant-registros').value != ''
    || document.getElementById('tabla-body-historial-tipos').length > 0){

        document.getElementById('fecha-desde').value = ''; 
        document.getElementById('fecha-hasta').value = '';
        document.getElementById('tipo').value = '';
        document.getElementById('descripcion').value = '';
        document.getElementById('modificado-por').value = '';
        document.getElementById('tipo-accion').value = '';
        document.getElementById('cant-registros').value = '';
        document.getElementById('tabla-body-historial-tipos').innerHTML = '';
        
    }
    else{
        // No hacer nada
    }
}