// Funcion: fnLimpiarObjetosHistorialUsuarios
// Descripción: función que limpia el contenido de los elementos en la página historial_usuarios.php
//

function fnLimpiarObjetosHistorialUsuarios(){
    if (document.getElementById('fecha-desde').value != ''
    || document.getElementById('fecha-hasta').value != ''
    || document.getElementById('usuario-nombre').value != '' 
    || document.getElementById('modificado-por').value != ''
    || document.getElementById('tipo-accion').value != ''
    || document.getElementById('tipo-permiso').value != ''
    || document.getElementById('email').value != ''
    || document.getElementById('sucursal').value != ''
    || document.getElementById('cant-registros').value != ''
    || document.getElementById('tabla-body-historial-usuarios').length > 0){

        document.getElementById('fecha-desde').value = ''; 
        document.getElementById('fecha-hasta').value = '';
        document.getElementById('usuario-nombre').value = '';
        document.getElementById('modificado-por').value = '';
        document.getElementById('tipo-accion').value = '';
        document.getElementById('tipo-permiso').value = '';
        document.getElementById('email').value = '';
        document.getElementById('sucursal').value = '';
        document.getElementById('cant-registros').value = '';
        document.getElementById('tabla-body-historial-usuarios').innerHTML = '';
        
    }
    else{
        // No hacer nada
    }
}