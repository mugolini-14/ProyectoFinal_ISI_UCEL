// Funcion: fnLimpiarObjetosUsuarios
// Descripción: función que limpia el contenido de los elementos en la página consulta_usuarios.php
//

function fnLimpiarObjetosUsuarios(){
    if (document.getElementById('id').value != '' 
    || document.getElementById('tipo-permiso').value != ''
    || document.getElementById('username').value != ''
    || document.getElementById('nombre').value != ''
    || document.getElementById('apellido').value != ''
    || document.getElementById('direccion').value != ''
    || document.getElementById('sucursal').value != ''
    || document.getElementById('email').value != ''
    || document.getElementById('tabla-body-usuarios').length > 0){

        document.getElementById('id').value = ''; 
        document.getElementById('tipo-permiso').value = '';
        document.getElementById('username').value = '';
        document.getElementById('nombre').value = '';
        document.getElementById('apellido').value = '';
        document.getElementById('direccion').value = '';
        document.getElementById('sucursal').value = '';
        document.getElementById('email').value = '';
        document.getElementById('tabla-body-usuarios').innerHTML = '';
        
    }
    else{
        // No hacer nada
    }
}