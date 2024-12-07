// Funcion: fnLimpiarObjetosProveedores
// Descripción: función que limpia el contenido de los elementos en la página consulta_proveedores.php
//

function fnLimpiarObjetosProveedores(){
    if (document.getElementById('nombre').value != '' 
    || document.getElementById('descripcion').value != ''
    || document.getElementById('direccion').value != ''
    || document.getElementById('localidad').value != ''
    || document.getElementById('provincia').value != ''
    || document.getElementById('telefono1').value != ''
    || document.getElementById('telefono2').value != ''
    || document.getElementById('email').value != ''
    || document.getElementById('cuit').value != ''
    || document.getElementById('tabla-body-proveedores').length > 0){

        document.getElementById('nombre').value = ''; 
        document.getElementById('descripcion').value = '';
        document.getElementById('direccion').value = '';
        document.getElementById('localidad').value = '';
        document.getElementById('provincia').value = '';
        document.getElementById('telefono1').value = '';
        document.getElementById('telefono2').value = '';
        document.getElementById('email').value = '';
        document.getElementById('cuit').value = '';
        document.getElementById('tabla-body-proveedores').innerHTML = '';
        
    }
    else{
        // No hacer nada
    }
}