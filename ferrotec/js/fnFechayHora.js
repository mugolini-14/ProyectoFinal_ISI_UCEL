//  Función: fnFechayHora()
//  Descripción:    Consigue la fecha y la hora cada vez que se carga una página del sistema
//                  Actualiza la hora cada un segundo (1000 ms.)
//  

window.onload=function(){fnFechayHora()}     
function fnFechayHora(){
                                        // Consigue datos de la fecha
    var today=new Date();
    var d=today.getDate();
    var mo=today.getMonth() + 1;        // Corrección de muestreo del mes
    var a=today.getFullYear();  
    var h=today.getHours();  
    var m=today.getMinutes();  
    var s=today.getSeconds(); 
    m=checkTime(m);  
    s=checkTime(s);   
    document.getElementById('texto-fecha-hora').innerHTML= d + "/" + mo + "/" + a + " - " + h + ":" + m + ":" + s;  
}

setInterval("fnFechayHora()",1000)      // Intervalo de Tiempo de actualización de la función (cada 1 segundo)
    
function checkTime(i){                  // Verifica el nuevo cambio de minutos y segundos
    if (i<10){  
        i="0" + i;  
    }  
return i;  
}  
