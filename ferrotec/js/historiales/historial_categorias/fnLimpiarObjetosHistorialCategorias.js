// Funcion: fnLimpiarObjetosHistorialCategorias
// Descripción: función que limpia el contenido de los elementos en la página historial_tipos.php
//

function fnLimpiarObjetosHistorialCategorias(){
    if (document.getElementById('fecha-desde').value != ''
    || document.getElementById('fecha-hasta').value != ''
    || document.getElementById('cat-accion').value != ''
    || document.getElementById('tipo').value != '' 
    || document.getElementById('categoria').value != '' 
    || document.getElementById('descripcion').value != ''
    || document.getElementById('modificado-por').value != ''
    || document.getElementById('cant-registros').value != ''
    || document.getElementById('tabla-body-historial-categorias').length > 0){

        document.getElementById('fecha-desde').value = ''; 
        document.getElementById('fecha-hasta').value = '';
        document.getElementById('tipo').value = ''; 
        document.getElementById('categoria').value = ''; 
        document.getElementById('descripcion').value = '';
        document.getElementById('modificado-por').value = '';
        document.getElementById('cat-accion').value = '';
        document.getElementById('cant-registros').value = '';
        document.getElementById('tabla-body-historial-categorias').innerHTML = '';
        
    }
    else{
        // No hacer nada
    }
}