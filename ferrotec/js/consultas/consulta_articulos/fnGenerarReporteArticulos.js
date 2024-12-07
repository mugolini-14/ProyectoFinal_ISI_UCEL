// Funcion: fnGenerarReporteArticulos
// Descripción: función que controla que haya artículos para generar un reporte y envía la información
//              a generar_reporte_articulos.php
//

function fnGenerarReporteArticulos() {
    if(document.getElementById('articulo-nombre')){     // Verifica que la tabla de artículos esté generada
        var elementosArticulos = document.querySelectorAll('#tabla-body-articulos tr'); // Obtiene todas las filas de la tabla
        console.log(elementosArticulos);
        var cantidadRegistrosArticulos = elementosArticulos.length;
    
        var datosArticulos = [];        // Inicializa arreglo de artículos
            for (var i = 0; i < cantidadRegistrosArticulos; i++) {  // Recorre las filas de la tabla
                var fila = elementosArticulos[i];                   // Accede a la fila actual
        
                var nombre = fila.querySelector('.articulo-nombre').innerHTML;
                var marca = fila.querySelector('.articulo-marca').innerHTML;
                var descripcion = fila.querySelector('.articulo-descripcion').innerHTML;
                var precio = fila.querySelector('.articulo-precio').innerHTML;
                var stock = fila.querySelector('.articulo-stock').innerHTML;
                var activo = fila.querySelector('.articulo-activo').innerHTML;
        
                datosArticulos.push({
                    'nombre': nombre, 
                    'marca': marca,
                    'descripcion': descripcion,
                    'precio': precio,
                    'stock': stock,
                    'activo': activo
                });
            }
        
        console.log(datosArticulos);
    
        var datosArticulosJSON = JSON.stringify(datosArticulos);    // Convierte a JSON el arreglo para enviar al php
    
        var formData = new FormData();
        formData.append('JSON-articulos', datosArticulosJSON);
    
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../consultas/consulta_articulos/generar_reporte_articulos.php", true);
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
                link.download = 'consulta_articulos_' + fechaHoraActual.getDate() + "-" + (fechaHoraActual.getMonth() + 1) + "-" + fechaHoraActual.getFullYear() 
                                + "_" + fechaHoraActual.getHours() + "-" + fechaHoraActual.getMinutes() + "-" + fechaHoraActual.getSeconds() + '.pdf';
                link.click();
            }
        };
        xhr.send(formData);
        
    }
    else{
        alert("No hay artículos para generar el reporte.");
    }
}