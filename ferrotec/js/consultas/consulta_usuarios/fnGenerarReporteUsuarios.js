// Funcion: fnGenerarReporteUsuarios
// Descripción: función que controla que haya proveedores para generar un reporte y envía la información
//              a generar_reporte_usuarios.php
//

function fnGenerarReporteUsuarios() {
    if(document.getElementById('usuario-id')){     // Verifica que la tabla de artículos esté generada
        var elementosUsuarios = document.querySelectorAll('#tabla-body-usuarios tr'); // Obtiene todas las filas de la tabla
        console.log(elementosUsuarios);
        var cantidadRegistrosUsuarios = elementosUsuarios.length;
    
        var datosUsuarios = [];        // Inicializa arreglo de artículos
            for (var i = 0; i < cantidadRegistrosUsuarios; i++) {  // Recorre las filas de la tabla
                var fila = elementosUsuarios[i];                   // Accede a la fila actual
        
                var id = fila.querySelector('.usuario-id').innerHTML;
                var username = fila.querySelector('.usuario-username').innerHTML;
                var tipoPermiso = fila.querySelector('.usuario-tipo-permiso').innerHTML;
                var nombre = fila.querySelector('.usuario-nombre').innerHTML;
                var apellido = fila.querySelector('.usuario-apellido').innerHTML;
                var direccion = fila.querySelector('.usuario-direccion').innerHTML;
                var sucursal = fila.querySelector('.usuario-sucursal').innerHTML;
                var email = fila.querySelector('.usuario-email').innerHTML;
                var activo = fila.querySelector('.usuario-activo').innerHTML;
        
                datosUsuarios.push({
                    'id': id, 
                    'username': username,
                    'tipo-permiso': tipoPermiso,
                    'nombre': nombre,
                    'apellido': apellido,
                    'direccion': direccion,
                    'sucursal': sucursal,
                    'email': email,
                    'activo': activo
                });
            }
        
        console.log(datosUsuarios);
    
        var datosUsuariosJSON = JSON.stringify(datosUsuarios);    // Convierte a JSON el arreglo para enviar al php
    
        var formData = new FormData();
        formData.append('JSON-usuarios', datosUsuariosJSON);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../consultas/consulta_usuarios/generar_reporte_usuarios.php", true);
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
                link.download = 'consulta_usuarios_' + fechaHoraActual.getDate() + "-" + (fechaHoraActual.getMonth() + 1) + "-" + fechaHoraActual.getFullYear() 
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