// Funcion: fnGenerarReporteHistorialCompras
// Descripción: función que controla que haya proveedores para generar un reporte y envía la información
//              a generar_reporte_historial_compras.php
//

function fnGenerarReporteHistorialCompras() {
    if(document.getElementById('historial-fecha-registro')){     // Verifica que la tabla de artículos esté generada
        var elementosHistorialCompras = document.querySelectorAll('#tabla-body-historial-compras tr'); // Obtiene todas las filas de la tabla
        var elementosHistorialComprasDetalle = document.querySelectorAll('#tabla-body-historial-compras-detalle tr'); // Obtiene todas las filas de la tabla

        console.log("Elementos: " . elementosHistorialCompras);
        console.log("Elementos Detalle: " . elementosHistorialComprasDetalle);

        var cantidadRegistrosHistorialCompras = elementosHistorialCompras.length;
        var cantidadRegistrosHistorialComprasDetalle = elementosHistorialComprasDetalle.length;

        var datosHistorialCompras = [];        // Inicializa arreglo de artículos
            for (var i = 0; i < cantidadRegistrosHistorialCompras; i++) {  // Recorre las filas de la tabla
                var fila = elementosHistorialCompras[i];                   // Accede a la fila actual
        
                var fechaRegistro = fila.querySelector('.historial-fecha-registro').innerHTML;
                var compraNro = fila.querySelector('.historial-compra-id').innerHTML;
                var modificadoPor = fila.querySelector('.historial-modificado-por').innerHTML;
                var montoTotal = fila.querySelector('.historial-monto-total').innerHTML;
                var sucursal = fila.querySelector('.historial-sucursal').innerHTML;
                var proveedor = fila.querySelector('.historial-proveedor').innerHTML;
                var modoDePago = fila.querySelector('.historial-mododepago').innerHTML;
               

                datosHistorialCompras.push({
                    'fecha-registro': fechaRegistro, 
                    'compranro': compraNro,
                    'modificado-por': modificadoPor,
                    'montototal': montoTotal,
                    'sucursal': sucursal,
                    'proveedor': proveedor,
                    'mododepago': modoDePago,                    
                });
            }
        
            var datosHistorialComprasDetalle = [];        // Inicializa arreglo de artículos
            for (var i = 0; i < cantidadRegistrosHistorialComprasDetalle; i++) {  // Recorre las filas de la tabla
                var fila = elementosHistorialComprasDetalle[i];                   // Accede a la fila actual
        
                var idDetalle = fila.querySelector('.historial-id-detalle').innerHTML;
                var articulo = fila.querySelector('.historial-articulo').innerHTML;
                var cantidad = fila.querySelector('.historial-cantidad').innerHTML;
                var montoDetalle = fila.querySelector('.historial-monto-detalle').innerHTML;
                
                datosHistorialComprasDetalle.push({
                    'id-detalle': idDetalle, 
                    'articulo': articulo,
                    'cantidad': cantidad,
                    'montodetalle': montoDetalle,
                });
            }
        
        var datosHistorialComprasJSON = JSON.stringify(datosHistorialCompras);    // Convierte a JSON el arreglo para enviar al php
        var datosHistorialComprasDetalleJSON = JSON.stringify(datosHistorialComprasDetalle);    // Convierte a JSON el arreglo para enviar al php

        var formData = new FormData();
        formData.append('JSON-historial-compras', datosHistorialComprasJSON);
        formData.append('JSON-historial-compras-detalle', datosHistorialComprasDetalleJSON);
    
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../historiales/historial_compras/generar_reporte_historial_compras.php", true);
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
                link.download = 'consulta_historial_compras_' + fechaHoraActual.getDate() + "-" + (fechaHoraActual.getMonth() + 1) + "-" + fechaHoraActual.getFullYear() 
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