// Funcion: fnLimpiarObjetosHistorialArticulos
// Descripción: función que limpia el contenido de los elementos en la página historial_articulos.php
//

function fnLimpiarObjetosHistorialArticulos(){
    if (document.getElementById('fecha-desde').value != ''
    || document.getElementById('fecha-hasta').value != ''
    || document.getElementById('tipo-accion').value != ''
    || document.getElementById('articulo').value != '' 
    || document.getElementById('marca').value != ''
    || document.getElementById('descripcion').value != ''
    || document.getElementById('precio').value != ''
    || document.getElementById('modificado-por').value != ''
    || document.getElementById('cant-registros').value != ''
    || document.getElementById('tabla-body-historial-articulos').length > 0){

        document.getElementById('fecha-desde').value = ''; 
        document.getElementById('fecha-hasta').value = '';
        document.getElementById('articulo').value = '';
        document.getElementById('marca').value = '';
        document.getElementById('descripcion').value = '';
        document.getElementById('precio').value = '';
        document.getElementById('modificado-por').value = '';
        document.getElementById('tipo-accion').value = '';
        document.getElementById('cant-registros').value = '';
        document.getElementById('tabla-body-historial-articulos').innerHTML = '';
        
    }
    else{
        // No hacer nada
    }
}