// Funcion: fnGenerarReporteTipos
// Descripción: función que controla que haya artículos para generar un reporte y envía la información
//              a generar_reporte_tipos.php
//

function fnGenerarReporteTipos() {
    if(document.getElementById('tipo-nombre')){     // Verifica que la tabla de artículos esté generada
        var elementosTipos = document.querySelectorAll('#tabla-body-tipos tr'); // Obtiene todas las filas de la tabla
        var cantidadRegistrosTipos = elementosTipos.length;
    
        var datosTipos = [];        // Inicializa arreglo de artículos
            for (var i = 0; i < cantidadRegistrosTipos; i++) {  // Recorre las filas de la tabla
                var fila = elementosTipos[i];                   // Accede a la fila actual
        
                var nombre = fila.querySelector('.tipo-nombre').innerHTML;
                var descripcion = fila.querySelector('.tipo-descripcion').innerHTML;
                var activo = fila.querySelector('.tipo-activo').innerHTML;
        
                datosTipos.push({
                    'nombre': nombre, 
                    'descripcion': descripcion,
                    'activo': activo
                });
            }
        
        console.log(datosTipos);
    
        var datosTiposJSON = JSON.stringify(datosTipos);    // Convierte a JSON el arreglo para enviar al php
    
        var formData = new FormData();
        formData.append('JSON-tipos', datosTiposJSON);
    
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../consultas/consulta_tipos/generar_reporte_tipos.php", true);
        xhr.responseType = 'blob'; // Indica que la respuesta será un archivo binario
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert('Reporte Generado Exitosamente.');

                // Crear un enlace de descarga y simular el clic en el navegador
                var blob = new Blob([xhr.response], { type: 'application/pdf' });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);

                // Crea una variable para conseguir la fecha actual y usarla en el nombre del archivo
                var fechaHoraActual = new Date();

                // Realiza la descarga por navegador con el nombre del archivo generado y usando la Fecha
                link.download = 'consulta_tipos_' + fechaHoraActual.getDate() + "-" + (fechaHoraActual.getMonth() + 1) + "-" + fechaHoraActual.getFullYear() 
                                + "_" + fechaHoraActual.getHours() + "-" + fechaHoraActual.getMinutes() + "-" + fechaHoraActual.getSeconds() + '.pdf';
                link.click();
            }
        };
        xhr.send(formData);
        
    }
    else{
        alert("No hay tipos para generar el reporte.");
    }
}