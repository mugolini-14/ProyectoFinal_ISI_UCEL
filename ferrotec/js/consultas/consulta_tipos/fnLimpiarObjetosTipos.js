// Funcion: fnLimpiarObjetosTipos
// Descripción: función que limpia el contenido de los elementos en la página consulta_tipos.php
//

function fnLimpiarObjetosTipos(){
    if (document.getElementById('nombre').value != '' 
    || document.getElementById('descripcion').value != ''
    || document.getElementById('tabla-body-tipos').length > 0){

        document.getElementById('nombre').value = '';
        document.getElementById('descripcion').value = '';
        document.getElementById('tabla-body-tipos').innerHTML = '';
        
    }
    else{
        // No hacer nada
    }
}