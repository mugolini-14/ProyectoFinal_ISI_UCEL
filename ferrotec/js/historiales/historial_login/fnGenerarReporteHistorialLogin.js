// Funcion: fnGenerarReporteHistorialLogin
// Descripción: función que controla que haya proveedores para generar un reporte y envía la información
//              a generar_reporte_historial_login.php
//

function fnGenerarReporteHistorialLogin() {
    

    if (document.getElementById('historial-usuario-fecha-registro')) {
        var elementosHistorialLogin = document.querySelectorAll('#tabla-body-historial-login tr');
        var cantidadRegistrosHistorialLogin = elementosHistorialLogin.length;
        var datosHistorialLogin = [];
        for (var i = 0; i < cantidadRegistrosHistorialLogin; i++) {
            var fila = elementosHistorialLogin[i];

            var fechaRegistro = fila.querySelector('.historial-usuario-fecha-registro').innerHTML;
            var tipoActividad = fila.querySelector('.historial-usuario-tipo-actividad').innerHTML;
            var nombreUsuario = fila.querySelector('.historial-usuario-nombre-usuario').innerHTML;

            datosHistorialLogin.push({
                'fecharegistro': fechaRegistro,
                'tipoactividad': tipoActividad,
                'usuarionombre': nombreUsuario
            });
        }

        var datosHistorialLoginJSON = JSON.stringify(datosHistorialLogin);

        var formData = new FormData();
        formData.append('JSON-historial-login', datosHistorialLoginJSON);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../../historiales/historial_login/generar_reporte_historial_login.php", true);
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
                link.download = 'consulta_historial_login_' + fechaHoraActual.getDate() + "-" + (fechaHoraActual.getMonth() + 1) + "-" + fechaHoraActual.getFullYear() 
                                + "_" + fechaHoraActual.getHours() + "-" + fechaHoraActual.getMinutes() + "-" + fechaHoraActual.getSeconds() + '.pdf';
                link.click();
            } 
        };
        xhr.send(formData);

    } else {
        alert("No hay datos para generar el reporte.");
    }
}