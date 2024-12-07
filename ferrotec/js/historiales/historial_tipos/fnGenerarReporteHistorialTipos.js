// Funcion: fnGenerarReporteHistorialTipos
// Descripción: función que controla que haya proveedores para generar un reporte y envía la información
//              a generar_reporte_historial_tipos.php
//

function fnGenerarReporteHistorialTipos() {
    if(document.getElementById('historial-fecha-registro')){     // Verifica que la tabla de artículos esté generada
        var elementosHistorialTipos = document.querySelectorAll('#tabla-body-historial-tipos tr'); // Obtiene todas las filas de la tabla
        console.log("Elementos: " . elementosHistorialTipos);
        var cantidadRegistrosHistorialTipos = elementosHistorialTipos.length;
    
        var datosHistorialTipos = [];        // Inicializa arreglo de artículos
            for (var i = 0; i < cantidadRegistrosHistorialTipos; i++) {  // Recorre las filas de la tabla
                var fila = elementosHistorialTipos[i];                   // Accede a la fila actual
        
                var fechaRegistro = fila.querySelector('.historial-fecha-registro').innerHTML;
                var tipoAccion = fila.querySelector('.historial-tipo-accion').innerHTML;
                var modificadoPor = fila.querySelector('.historial-modificado-por').innerHTML;
                var tipo = fila.querySelector('.historial-tipo').innerHTML;
                var descripcion = fila.querySelector('.historial-descripcion').innerHTML;
                var activo = fila.querySelector('.historial-activo').innerHTML;

                datosHistorialTipos.push({
                    'fecha-registro': fechaRegistro, 
                    'tipo-accion': tipoAccion,
                    'modificado-por': modificadoPor,
                    'tipo': tipo,
                    'descripcion': descripcion,
                    'activo': activo
                });
            }
        
        console.log("Elementos-Final: " . datosHistorialTipos);
    
        var datosHistorialTiposJSON = JSON.stringify(datosHistorialTipos);    // Convierte a JSON el arreglo para enviar al php
    
        var formData = new FormData();
        formData.append('JSON-historial-tipos', datosHistorialTiposJSON);
    
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../historiales/historial_tipos/generar_reporte_historial_tipos.php", true);
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
                link.download = 'consulta_historial_tipos_' + fechaHoraActual.getDate() + "-" + (fechaHoraActual.getMonth() + 1) + "-" + fechaHoraActual.getFullYear() 
                                + "_" + fechaHoraActual.getHours() + "-" + fechaHoraActual.getMinutes() + "-" + fechaHoraActual.getSeconds() + '.pdf';
                link.click();
            }
        };
        xhr.send(formData);
        
    }
    else{
        alert("No hay datos para generar el reporte.");
    }
}