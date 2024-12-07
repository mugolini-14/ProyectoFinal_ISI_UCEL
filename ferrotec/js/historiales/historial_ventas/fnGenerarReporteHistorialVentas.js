// Funcion: fnGenerarReporteHistorialVentas
// Descripción: función que controla que haya proveedores para generar un reporte y envía la información
//              a generar_reporte_historial_ventas.php
//

function fnGenerarReporteHistorialVentas() {
    if(document.getElementById('historial-fecha-registro')){     // Verifica que la tabla de historial de ventas esté generada
        var elementosHistorialVentas = document.querySelectorAll('#tabla-body-historial-ventas tr'); // Obtiene todas las filas de la tabla
        var elementosHistorialVentasDetalle = document.querySelectorAll('#tabla-body-historial-ventas-detalle tr'); // Obtiene todas las filas de la tabla

        console.log("Elementos: " . elementosHistorialVentas);
        console.log("Elementos Detalle: " . elementosHistorialVentasDetalle);

        var cantidadRegistrosHistorialVentas = elementosHistorialVentas.length;
        var cantidadRegistrosHistorialVentasDetalle = elementosHistorialVentasDetalle.length;

        var datosHistorialVentas = [];        // Inicializa arreglo de historial de ventas
            for (var i = 0; i < cantidadRegistrosHistorialVentas; i++) {  // Recorre las filas de la tabla
                var fila = elementosHistorialVentas[i];                   // Accede a la fila actual
        
                var fechaRegistro = fila.querySelector('.historial-fecha-registro').innerHTML;
                var ventaNro = fila.querySelector('.historial-venta-id').innerHTML;
                var modificadoPor = fila.querySelector('.historial-modificado-por').innerHTML;
                var montoTotal = fila.querySelector('.historial-monto-total').innerHTML;
                var sucursal = fila.querySelector('.historial-sucursal').innerHTML;
                var modoDePago = fila.querySelector('.historial-mododepago').innerHTML;
               

                datosHistorialVentas.push({
                    'fecha-registro': fechaRegistro, 
                    'ventanro': ventaNro,
                    'modificado-por': modificadoPor,
                    'montototal': montoTotal,
                    'sucursal': sucursal,
                    'mododepago': modoDePago,                    
                });
            }
        
            var datosHistorialVentasDetalle = [];        // Inicializa arreglo del detalle de historial de ventas 
            for (var i = 0; i < cantidadRegistrosHistorialVentasDetalle; i++) {  // Recorre las filas de la tabla
                var fila = elementosHistorialVentasDetalle[i];                   // Accede a la fila actual
        
                var idDetalle = fila.querySelector('.historial-id-detalle').innerHTML;
                var articulo = fila.querySelector('.historial-articulo').innerHTML;
                var cantidad = fila.querySelector('.historial-cantidad').innerHTML;
                var montoDetalle = fila.querySelector('.historial-monto-detalle').innerHTML;
                
                datosHistorialVentasDetalle.push({
                    'id-detalle': idDetalle, 
                    'articulo': articulo,
                    'cantidad': cantidad,
                    'montodetalle': montoDetalle,
                });
            }
        
        var datosHistorialVentasJSON = JSON.stringify(datosHistorialVentas);    // Convierte a JSON el arreglo para enviar al php
        var datosHistorialVentasDetalleJSON = JSON.stringify(datosHistorialVentasDetalle);    // Convierte a JSON el arreglo para enviar al php

        var formData = new FormData();
        formData.append('JSON-historial-ventas', datosHistorialVentasJSON);
        formData.append('JSON-historial-ventas-detalle', datosHistorialVentasDetalleJSON);
    
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../historiales/historial_ventas/generar_reporte_historial_ventas.php", true);
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
                link.download = 'consulta_historial_ventas_' + fechaHoraActual.getDate() + "-" + (fechaHoraActual.getMonth() + 1) + "-" + fechaHoraActual.getFullYear() 
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