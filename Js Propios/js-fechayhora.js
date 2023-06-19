window.onload=function(){getTime()}     // Cuando carga la página, consigue la hora
function getTime(){
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

setInterval("getTime()",1000)    // Intervalo de Tiempo de actualización de la función (cada 1 segundo)
    
function checkTime(i){          // Verifica el nuevo cambio de minutos y segundos
    if (i<10){  
        i="0" + i;  
    }  
return i;  
}  
