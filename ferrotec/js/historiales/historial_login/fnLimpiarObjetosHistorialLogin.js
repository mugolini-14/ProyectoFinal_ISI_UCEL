// Funcion: fnLimpiarObjetosHistorialLogin
// Descripción: función que limpia el contenido de los elementos en la página historial_login.php
//

function fnLimpiarObjetosHistorialLogin(){
    if (document.getElementById('fecha-desde').value != '' 
    || document.getElementById('fecha-hasta').value != ''
    || document.getElementById('nombre-usuario').value != ''
    || document.getElementById('tipo-actividad').value != ''
    || document.getElementById('tipo-permiso').value != ''
    || document.getElementById('email').value != ''
    || document.getElementById('sucursal').value != ''
    || document.getElementById('cant-registros').value != ''
    || document.getElementById('tabla-body-historial-login').length > 0){

        document.getElementById('fecha-desde').value = ''; 
        document.getElementById('fecha-hasta').value = '';
        document.getElementById('nombre-usuario').value = '';
        document.getElementById('tipo-actividad').value = '';
        document.getElementById('tipo-permiso').value = '';
        document.getElementById('email').value = '';
        document.getElementById('sucursal').value = '';
        document.getElementById('cant-registros').value = '';
        document.getElementById('tabla-body-historial-login').innerHTML = '';
        
    }
    else{
        // No hacer nada
    }
}