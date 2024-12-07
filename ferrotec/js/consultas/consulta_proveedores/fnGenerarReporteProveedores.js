// Funcion: fnGenerarReporteProveedores
// Descripción: función que controla que haya proveedores para generar un reporte y envía la información
//              a generar_reporte_proveedores.php
//

function fnGenerarReporteProveedores() {
    if(document.getElementById('proveedor-nombre')){     // Verifica que la tabla de artículos esté generada
        var elementosProveedores = document.querySelectorAll('#tabla-body-proveedores tr'); // Obtiene todas las filas de la tabla
        console.log(elementosProveedores);
        var cantidadRegistrosProveedores = elementosProveedores.length;
    
        var datosProveedores = [];        // Inicializa arreglo de artículos
            for (var i = 0; i < cantidadRegistrosProveedores; i++) {  // Recorre las filas de la tabla
                var fila = elementosProveedores[i];                   // Accede a la fila actual
        
                var nombre = fila.querySelector('.proveedor-nombre').innerHTML;
                var descripcion = fila.querySelector('.proveedor-descripcion').innerHTML;
                var direccion = fila.querySelector('.proveedor-direccion').innerHTML;
                var localidad = fila.querySelector('.proveedor-localidad').innerHTML;
                var provincia = fila.querySelector('.proveedor-provincia').innerHTML;
                var telefono1 = fila.querySelector('.proveedor-telefono1').innerHTML;
                var telefono2 = fila.querySelector('.proveedor-telefono2').innerHTML;
                var email = fila.querySelector('.proveedor-email').innerHTML;
                var cuit = fila.querySelector('.proveedor-cuit').innerHTML;
                var activo = fila.querySelector('.proveedor-activo').innerHTML;
        
                datosProveedores.push({
                    'nombre': nombre, 
                    'descripcion': descripcion,
                    'direccion': direccion,
                    'localidad': localidad,
                    'provincia': provincia,
                    'telefono1': telefono1,
                    'telefono2': telefono2,
                    'email': email,
                    'cuit' : cuit,
                    'activo' : activo
                });
            }
        
        console.log(datosProveedores);
    
        var datosArticulosJSON = JSON.stringify(datosProveedores);    // Convierte a JSON el arreglo para enviar al php
    
        var formData = new FormData();
        formData.append('JSON-proveedores', datosArticulosJSON);
    
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../consultas/consulta_proveedores/generar_reporte_proveedores.php", true);
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
                link.download = 'consulta_proveedores_' + fechaHoraActual.getDate() + "-" + (fechaHoraActual.getMonth() + 1) + "-" + fechaHoraActual.getFullYear() 
                                + "_" + fechaHoraActual.getHours() + "-" + fechaHoraActual.getMinutes() + "-" + fechaHoraActual.getSeconds() + '.pdf';
                link.click();
            }
        };
        xhr.send(formData);
        
    }
    else{
        alert("No hay proveedores para generar el reporte.");
    }
}