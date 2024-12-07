// Funcion: fnGenerarReporteHistorialCategorias
// Descripción: función que controla que haya proveedores para generar un reporte y envía la información
//              a generar_reporte_historial_categorias.php
//

function fnGenerarReporteHistorialCategorias() {
    if(document.getElementById('historial-fecha-registro')){     // Verifica que la tabla de artículos esté generada
        var elementosHistorialCategorias = document.querySelectorAll('#tabla-body-historial-categorias tr'); // Obtiene todas las filas de la tabla
        console.log("Elementos: " . elementosHistorialCategorias);
        var cantidadRegistrosHistorialCategorias = elementosHistorialCategorias.length;
    
        var datosHistorialCategorias = [];        // Inicializa arreglo de artículos
            for (var i = 0; i < cantidadRegistrosHistorialCategorias; i++) {  // Recorre las filas de la tabla
                var fila = elementosHistorialCategorias[i];                   // Accede a la fila actual
        
                var fechaRegistro = fila.querySelector('.historial-fecha-registro').innerHTML;
                var catAccion = fila.querySelector('.historial-cat-accion').innerHTML;
                var modificadoPor = fila.querySelector('.historial-modificado-por').innerHTML;
                var categoria = fila.querySelector('.historial-categoria').innerHTML;
                var tipo = fila.querySelector('.historial-tipo').innerHTML;
                var descripcion = fila.querySelector('.historial-descripcion').innerHTML;
                var activo = fila.querySelector('.historial-activo').innerHTML;

                datosHistorialCategorias.push({
                    'fecha-registro': fechaRegistro, 
                    'cat-accion': catAccion,
                    'modificado-por': modificadoPor,
                    'categoria': categoria,
                    'tipo': tipo,
                    'descripcion': descripcion,
                    'activo': activo
                });
            }
        
        console.log("Elementos-Final: " . datosHistorialCategorias);
    
        var datosHistorialCategoriasJSON = JSON.stringify(datosHistorialCategorias);    // Convierte a JSON el arreglo para enviar al php
    
        var formData = new FormData();
        formData.append('JSON-historial-categorias', datosHistorialCategoriasJSON);
    
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../historiales/historial_categorias/generar_reporte_historial_categorias.php", true);
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
                link.download = 'consulta_historial_categorias_' + fechaHoraActual.getDate() + "-" + (fechaHoraActual.getMonth() + 1) + "-" + fechaHoraActual.getFullYear() 
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