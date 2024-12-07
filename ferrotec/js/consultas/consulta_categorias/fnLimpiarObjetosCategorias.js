// Funcion: fnLimpiarObjetosCategorias
// Descripción: función que limpia el contenido de los elementos en la página consulta_categorias.php
//

function fnLimpiarObjetosCategorias(){
    if (document.getElementById('nombre').value != '' 
    || document.getElementById('descripcion').value != ''
    || document.getElementById('depende-tipo').value != ''
    || document.getElementById('tabla-body-cateogorias').length > 0){

        document.getElementById('nombre').value = '';
        document.getElementById('descripcion').value = '';
        document.getElementById('depende-tipo').value = '';
        document.getElementById('tabla-body-categorias').innerHTML = '';
        
    }
    else{
        // No hacer nada
    }
}