// Funcion: fnLimpiarObjetosArticulos
// Descripción: función que limpia el contenido de los elementos en la página consulta_articulos.php
//

function fnLimpiarObjetosArticulos(){
    if (document.getElementById('articulo').value != '' 
    || document.getElementById('marca').value != ''
    || document.getElementById('descripcion').value != ''
    || document.getElementById('tabla-body-articulos').length > 0){

        document.getElementById('articulo').value = '';
        document.getElementById('marca').value = '';
        document.getElementById('descripcion').value = '';
        document.getElementById('tabla-body-articulos').innerHTML = '';
        
    }
    else{
        // No hacer nada
    }
}