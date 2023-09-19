function fechadehoy(){
    var fecha= new Date();
    var meses= new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    
    dia=fecha.getDate(); 
    mes=meses[fecha.getMonth()]; 
    anio=fecha.getFullYear(); 
    hora=fecha.getHours(); 
    minutos=fecha.getMinutes(); 
    if (minutos < 10) { 
    minutos = '0' + minutos;
     } else {
     minutos = minutos + '';
     }				
    segundos=fecha.getSeconds();
    if (segundos < 10) { 
    segundos = '0' + segundos;
     } else {
     segundos = segundos + '';
     }				
    fechaactual=dia+" de "+mes+" de "+anio+" - "+hora+":"+minutos+":"+segundos;
    document.getElementById("reloj").value=fechaactual;
    setTimeout("fechadehoy()",1000);
}