// Funcion: fnGenerarReporteHistorialUsuarios
// Descripción: función que controla que haya proveedores para generar un reporte y envía la información
//              a generar_reporte_historial_usuarios.php
//

function fnGenerarReporteHistorialUsuarios() {
    if(document.getElementById('historial-fecha-registro')){     // Verifica que la tabla de historial de usuarios esté generada
        var elementosHistorialUsuarios = document.querySelectorAll('#tabla-body-historial-usuarios tr'); // Obtiene todas las filas de la tabla
        console.log("Elementos: " . elementosHistorialUsuarios);
        var cantidadRegistrosHistorialUsuarios = elementosHistorialUsuarios.length;
    
        var datosHistorialUsuarios = [];        // Inicializa arreglo de artículos
            for (var i = 0; i < cantidadRegistrosHistorialUsuarios; i++) {  // Recorre las filas de la tabla
                var fila = elementosHistorialUsuarios[i];                   // Accede a la fila actual
        
                var fechaRegistro = fila.querySelector('.historial-fecha-registro').innerHTML;
                var tipoAccion = fila.querySelector('.historial-tipo-accion').innerHTML;
                var userName = fila.querySelector('.historial-username').innerHTML;
                var modificadoPor = fila.querySelector('.historial-modificado-por').innerHTML;
                var tipoPermiso = fila.querySelector('.historial-tipo-permiso').innerHTML;
                var nombre = fila.querySelector('.historial-nombre').innerHTML;
                var apellido = fila.querySelector('.historial-apellido').innerHTML;
                var direccion = fila.querySelector('.historial-direccion').innerHTML;
                var sucursal = fila.querySelector('.historial-sucursal').innerHTML;
                var email = fila.querySelector('.historial-email').innerHTML;
                var activo = fila.querySelector('.historial-activo').innerHTML;


                datosHistorialUsuarios.push({
                    'fecha-registro': fechaRegistro, 
                    'tipo-accion': tipoAccion,
                    'username': userName,
                    'modificado-por': modificadoPor,
                    'tipo-permiso': tipoPermiso,
                    'nombre': nombre,
                    'apellido': apellido,
                    'direccion': direccion,
                    'sucursal': sucursal,
                    'email': email,
                    'activo': activo    
                });
            }
        
        console.log("Elementos-Final: " . datosHistorialUsuarios);
    
        var datosHistorialUsuariosJSON = JSON.stringify(datosHistorialUsuarios);    // Convierte a JSON el arreglo para enviar al php
    
        var formData = new FormData();
        formData.append('JSON-historial-usuarios', datosHistorialUsuariosJSON);
    
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../historiales/historial_usuarios/generar_reporte_historial_usuarios.php", true);
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
                link.download = 'consulta_historial_usuarios_' + fechaHoraActual.getDate() + "-" + (fechaHoraActual.getMonth() + 1) + "-" + fechaHoraActual.getFullYear() 
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