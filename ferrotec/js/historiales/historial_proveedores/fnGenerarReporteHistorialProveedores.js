// Funcion: fnGenerarReporteHistorialProveedores()
// Descripción: función que controla que haya proveedores para generar un reporte y envía la información
//              a generar_reporte_historial_proveedores.php
//

function fnGenerarReporteHistorialProveedores() {
    if(document.getElementById('historial-fecha-registro')){     // Verifica que la tabla de artículos esté generada
        var elementosHistorialProveedores = document.querySelectorAll('#tabla-body-historial-proveedores tr'); // Obtiene todas las filas de la tabla
        console.log("Elementos: " . elementosHistorialProveedores);
        var cantidadRegistrosHistorialProveedores = elementosHistorialProveedores.length;
    
        var datosHistorialProveedores = [];        // Inicializa arreglo de artículos
            for (var i = 0; i < cantidadRegistrosHistorialProveedores; i++) {  // Recorre las filas de la tabla
                var fila = elementosHistorialProveedores[i];                   // Accede a la fila actual
        
                var fechaRegistro = fila.querySelector('.historial-fecha-registro').innerHTML;
                var provAccion = fila.querySelector('.historial-prov-accion').innerHTML;
                var modificadoPor = fila.querySelector('.historial-modificado-por').innerHTML;
                var nombre = fila.querySelector('.historial-proveedor').innerHTML;
                var descripcion = fila.querySelector('.historial-descripcion').innerHTML;
                var direccion = fila.querySelector('.historial-direccion').innerHTML;
                var localidad = fila.querySelector('.historial-localidad').innerHTML;
                var telefono1 = fila.querySelector('.historial-telefono1').innerHTML;
                var telefono2 = fila.querySelector('.historial-telefono2').innerHTML;
                var email = fila.querySelector('.historial-email').innerHTML;
                var cuit = fila.querySelector('.historial-cuit').innerHTML;
                var activo = fila.querySelector('.historial-activo').innerHTML;

                datosHistorialProveedores.push({
                    'fecha-registro': fechaRegistro, 
                    'prov-accion': provAccion,
                    'modificado-por': modificadoPor,
                    'nombre': nombre,
                    'descripcion': descripcion,
                    'direccion': direccion,
                    'localidad': localidad,
                    'telefono1': telefono1,
                    'telefono2': telefono2,
                    'email': email,
                    'cuit': cuit,
                    'activo': activo
                });
            };
        
        console.log("Elementos-Final: " . datosHistorialProveedores);
    
        var datosHistorialProveedoresJSON = JSON.stringify(datosHistorialProveedores);    // Convierte a JSON el arreglo para enviar al php
    
        var formData = new FormData();
        formData.append('JSON-historial-proveedores', datosHistorialProveedoresJSON);
    
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../historiales/historial_proveedores/generar_reporte_historial_proveedores.php", true);
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
                link.download = 'consulta_historial_proveedores_' + fechaHoraActual.getDate() + "-" + (fechaHoraActual.getMonth() + 1) + "-" + fechaHoraActual.getFullYear() 
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