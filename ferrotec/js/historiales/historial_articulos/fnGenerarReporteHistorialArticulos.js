// Funcion: fnGenerarReporteHistorialArticulos
// Descripción: función que controla que haya proveedores para generar un reporte y envía la información
//              a generar_reporte_historial_articulos.php
//

function fnGenerarReporteHistorialArticulos() {
    if(document.getElementById('historial-fecha-registro')){     // Verifica que la tabla de artículos esté generada
        var elementosHistorialArticulos = document.querySelectorAll('#tabla-body-historial-articulos tr'); // Obtiene todas las filas de la tabla
        console.log("Elementos: " . elementosHistorialArticulos);
        var cantidadRegistrosHistorialArticulos = elementosHistorialArticulos.length;
    
        var datosHistorialArticulos = [];        // Inicializa arreglo de artículos
            for (var i = 0; i < cantidadRegistrosHistorialArticulos; i++) {  // Recorre las filas de la tabla
                var fila = elementosHistorialArticulos[i];                   // Accede a la fila actual
        
                var fechaRegistro = fila.querySelector('.historial-fecha-registro').innerHTML;
                var tipoAccion = fila.querySelector('.historial-tipo-accion').innerHTML;
                var modificadoPor = fila.querySelector('.historial-modificado-por').innerHTML;
                var articulo = fila.querySelector('.historial-articulo').innerHTML;
                var marca = fila.querySelector('.historial-marca').innerHTML;
                var descripcion = fila.querySelector('.historial-descripcion').innerHTML;
                var categoria = fila.querySelector('.historial-categoria').innerHTML;
                var precio = fila.querySelector('.historial-precio').innerHTML;
                var activo = fila.querySelector('.historial-activo').innerHTML;

                datosHistorialArticulos.push({
                    'fecha-registro': fechaRegistro, 
                    'tipo-accion': tipoAccion,
                    'modificado-por': modificadoPor,
                    'articulo': articulo,
                    'marca': marca,
                    'descripcion': descripcion,
                    'categoria': categoria,
                    'precio': precio,
                    'activo': activo
                });
            }
        
        console.log("Elementos-Final: " . datosHistorialArticulos);
    
        var datosHistorialArticulosJSON = JSON.stringify(datosHistorialArticulos);    // Convierte a JSON el arreglo para enviar al php
    
        var formData = new FormData();
        formData.append('JSON-historial-articulos', datosHistorialArticulosJSON);
    
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../historiales/historial_articulos/generar_reporte_historial_articulos.php", true);
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
                link.download = 'consulta_historial_articulos_' + fechaHoraActual.getDate() + "-" + (fechaHoraActual.getMonth() + 1) + "-" + fechaHoraActual.getFullYear() 
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