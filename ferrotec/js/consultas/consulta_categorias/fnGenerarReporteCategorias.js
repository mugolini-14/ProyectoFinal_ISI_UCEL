// Funcion: fnGenerarReporteCategorias
// Descripción: función que controla que haya artículos para generar un reporte y envía la información
//              a generar_reporte_categorias.php
//

function fnGenerarReporteCategorias() {
    if(document.getElementById('categoria-nombre')){     // Verifica que la tabla de artículos esté generada
        var elementosCategorias = document.querySelectorAll('#tabla-body-categorias tr'); // Obtiene todas las filas de la tabla
        var cantidadRegistrosCategorias = elementosCategorias.length;
    
        var datosCategorias = [];        // Inicializa arreglo de artículos
            for (var i = 0; i < cantidadRegistrosCategorias; i++) {  // Recorre las filas de la tabla
                var fila = elementosCategorias[i];                   // Accede a la fila actual
        
                var nombre = fila.querySelector('.categoria-nombre').innerHTML;
                var descripcion = fila.querySelector('.categoria-descripcion').innerHTML;
                var dependeDe = fila.querySelector('.categoria-depende-tipo').innerHTML;
                var activo = fila.querySelector('.categoria-activo').innerHTML;
        
                datosCategorias.push({
                    'nombre': nombre, 
                    'descripcion': descripcion,
                    'dependedeltipo': dependeDe,
                    'activo': activo
                });
            }
        
        console.log(datosCategorias);
    
        var datosCategoriasJSON = JSON.stringify(datosCategorias);    // Convierte a JSON el arreglo para enviar al php
    
        var formData = new FormData();
        formData.append('JSON-categorias', datosCategoriasJSON);
    
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../consultas/consulta_categorias/generar_reporte_categorias.php", true);
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
                link.download = 'consulta_categorias_' + fechaHoraActual.getDate() + "-" + (fechaHoraActual.getMonth() + 1) + "-" + fechaHoraActual.getFullYear() 
                                + "_" + fechaHoraActual.getHours() + "-" + fechaHoraActual.getMinutes() + "-" + fechaHoraActual.getSeconds() + '.pdf';
                link.click();
            }
        };
        xhr.send(formData);
        
    }
    else{
        alert("No hay categorías para generar el reporte.");
    }
}