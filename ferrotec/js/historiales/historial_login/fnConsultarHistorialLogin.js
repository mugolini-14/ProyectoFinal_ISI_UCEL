function fnConsultarHistorialLogin() {
    event.preventDefault();     // Evita el comportamiento por defecto del botón de Consultar
    // Verifica que alguno de los dos campos de la fecha no esté vacío
    if( document.getElementById('fecha-desde').value != ''
    || document.getElementById('fecha-hasta').value != ''){
        // Verifica que los dos campos de la fecha no estén vacíos
        if( document.getElementById('fecha-desde').value != ''
        && document.getElementById('fecha-hasta').value != ''){
            // Verifica si la Fecha de Inicio es posterior a la de Fin
            // Verifica si la Feche de Fin es anterior a la Inicio
            if((document.getElementById('fecha-desde').value < document.getElementById('fecha-hasta').value) 
            || (document.getElementById('fecha-hasta').value > document.getElementById('fecha-desde').value)){
                    var fechaDesde = document.getElementById('fecha-desde').value;
                    var fechaHasta = document.getElementById('fecha-hasta').value;
                    var nombreUsuario = document.getElementById('nombre-usuario').value;
                    var tipoActividad = document.getElementById('tipo-actividad').value;
                    var tipoPermiso = document.getElementById('tipo-permiso').value;
                    var email = document.getElementById('email').value;
                    var sucursal = document.getElementById('sucursal').value;
                    var cantRegistros = document.getElementById('cant-registros').value;

                    var formData = new FormData();
                    formData.append('fecha-desde', fechaDesde);
                    formData.append('fecha-hasta', fechaHasta);
                    formData.append('usuario-nombre', nombreUsuario);
                    formData.append('tipo-actividad', tipoActividad);
                    formData.append('tipo-permiso', tipoPermiso);
                    formData.append('email', email);
                    formData.append('sucursal', sucursal);
                    formData.append('cant-registros', cantRegistros);

                    console.log(formData);

                    // Enviar la solicitud AJAX
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "../historial_login/consultar_historial_login.php", true);
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            console.log (xhr.response);
                            var response = JSON.parse(xhr.response);    // Parsea la respuesta del JSON enviado de la consulta del PHP
                            var tablaResultados = document.getElementById('tabla-body-historial-login');

                            tablaResultados.innerHTML = '';             // Limpiar la tabla antes de agregar nuevas filas

                            if (response.status === 'success' && response.message.includes("Datos agregados correctamente")) {
                                response.data.forEach(function (historial) {                                                     // Devuelve los datos para cada arreglo de Artículos
                                    var nuevaFila = tablaResultados.insertRow(-1);

                                    // Inserta las celdas para asignar los valores
                                    var celdaFechaRegistro = nuevaFila.insertCell(0);
                                    var celdaTipoActividad = nuevaFila.insertCell(1);
                                    var celdaNombreUsuario = nuevaFila.insertCell(2);
                                
                                    // Asigna los valores a cada celda
                                    celdaFechaRegistro.innerHTML = historial.fecharegistro || 'No disponible';
                                    celdaTipoActividad.innerHTML = historial.tipoactividad || 'No disponible';
                                    celdaNombreUsuario.innerHTML = historial.usuarionombre || 'No disponible';
                                                            
                                    // Setea los ids y clases de cada celda para el reporte
                                    celdaFechaRegistro.setAttribute('id','historial-usuario-fecha-registro');
                                    celdaNombreUsuario.setAttribute('id','historial-usuario-nombre-usuario');
                                    celdaTipoActividad.setAttribute('id','historial-usuario-tipo-actividad');

                                    celdaFechaRegistro.classList.add('historial-usuario-fecha-registro');
                                    celdaNombreUsuario.classList.add('historial-usuario-nombre-usuario');
                                    celdaTipoActividad.classList.add('historial-usuario-tipo-actividad');

                                });
                            } else if (response.status === 'success' && response.message.includes("No hay datos")) {        // No hay artículos a Mostrar
                                var nuevaFila = tablaResultados.insertRow(-1);
                                var celdaSinHistorial = nuevaFila.insertCell(0);
                                celdaSinHistorial.textContent = response.message || 'No disponible';
                                celdaSinHistorial.colSpan = 3;                                                                  // Combinar celdas
                                celdaSinHistorial.style.textAlign = "center";                                                   // Alinear texto al Centro
                                celdaSinHistorial.setAttribute('id','historial-no-encontrado');
                            } else {                                                                    // Error en los datos
                                var nuevaFila = tablaResultados.insertRow(-1);
                                var celdaError = nuevaFila.insertCell(0);
                                celdaError.textContent = 'Hubo un Error en la consulta.';
                                celdaError.colSpan = 3;
                                celdaError.style.textAlign = "center";
                            }
                        }
                    };
                    xhr.send(formData);
            }
            else{
                alert('Por favor, ingrese fechas válidas.');
            }
        }
        else{
            alert('Por favor, ingrese las fechas para poder buscar.');
        }
    }
    else{
        alert('Por favor, ingrese las fechas para poder buscar.');
    }
}