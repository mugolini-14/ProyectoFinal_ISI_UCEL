// Funcion: fnHabilitarMontoVentas
// Descripción: función que habilita el campo de texto del Monto en la página historial_ventas.php
//

function fnHabilitarMontoVentas(){
    if(document.getElementById('monto').value === 'S'
    || document.getElementById('monto').value === ''){
        document.getElementById('monto-numero').disabled = true;
    }
    else{
        document.getElementById('monto-numero').disabled = false;
    }
}