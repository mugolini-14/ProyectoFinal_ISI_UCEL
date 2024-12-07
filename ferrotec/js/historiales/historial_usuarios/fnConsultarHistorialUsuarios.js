function fnConsultarHistorialUsuarios() {
    event.preventDefault();     // Evita el comportamiento por defecto del botón de Consultar

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
                var nombreUsuario = document.getElementById('usuario-nombre').value;
                var tipoPermiso = document.getElementById('tipo-permiso').value;
                var email = document.getElementById('email').value;
                var sucursal = document.getElementById('sucursal').value;
                var cantRegistros = document.getElementById('cant-registros').value;
                var tipoAccion = document.getElementById('tipo-accion').value;
                var modificadoPor = document.getElementById('modificado-por').value;

                var formData = new FormData();
                formData.append('fecha-desde', fechaDesde);
                formData.append('fecha-hasta', fechaHasta);
                formData.append('usuario-nombre', nombreUsuario);
                formData.append('tipo-permiso', tipoPermiso);
                formData.append('email', email);
                formData.append('sucursal', sucursal);
                formData.append('cant-registros', cantRegistros);
                formData.append('tipo-accion', tipoAccion);
                formData.append('modificado-por',modificadoPor);

                console.log(formData);

                // Enviar la solicitud AJAX
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "../historial_usuarios/consultar_historial_usuarios.php", true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        console.log (xhr.response);
                        var response = JSON.parse(xhr.response);    // Parsea la respuesta del JSON enviado de la consulta del PHP
                        var tablaResultados = document.getElementById('tabla-body-historial-usuarios');

                        tablaResultados.innerHTML = '';             // Limpiar la tabla antes de agregar nuevas filas

                        if (response.status === 'success' && response.message.includes("Datos agregados correctamente")) {
                            response.data.forEach(function (historial) {                                                     // Devuelve los datos para cada arreglo del historial
                                var nuevaFila = tablaResultados.insertRow(-1);

                                // Inserta las celdas para asignar los valores
                                var celdaFechaRegistro = nuevaFila.insertCell(0);
                                var celdaTipoAccion = nuevaFila.insertCell(1);
                                var celdaUsername = nuevaFila.insertCell(2);
                                var celdaModificadoPor = nuevaFila.insertCell(3);
                                var celdaTipoPermiso = nuevaFila.insertCell(4);
                                var celdaNombre = nuevaFila.insertCell(5);
                                var celdaApellido = nuevaFila.insertCell(6);
                                var celdaDireccion = nuevaFila.insertCell(7);
                                var celdaSucursal = nuevaFila.insertCell(8);
                                var celdaEmail = nuevaFila.insertCell(9);
                                var celdaActivo = nuevaFila.insertCell(10);
                            
                                // Asigna los valores a cada celda
                                celdaFechaRegistro.innerHTML = historial.fecha || 'No disponible';
                                celdaTipoAccion.innerHTML = historial.tipoaccion || 'No disponible';
                                celdaUsername.innerHTML = historial.username || 'No disponible';
                                celdaModificadoPor.innerHTML = historial.modificadopor || 'No disponible';
                                celdaTipoPermiso.innerHTML = historial.tipopermiso || 'No disponible';
                                celdaNombre.innerHTML = historial.nombre || 'No disponible';
                                celdaApellido.innerHTML = historial.apellido || 'No disponible';
                                celdaDireccion.innerHTML = historial.direccion || 'No disponible';
                                celdaSucursal.innerHTML = historial.sucursal || 'No disponible';
                                celdaEmail.innerHTML = historial.email || 'No disponible';
                                celdaActivo.innerHTML = historial.activo || 'No disponible';
                            
                                // Setea los ids y clases de cada celda para el reporte
                                celdaFechaRegistro.setAttribute('id','historial-fecha-registro');
                                celdaTipoAccion.setAttribute('id','historial-tipo-accion');
                                celdaUsername.setAttribute('id','historial-username');
                                celdaModificadoPor.setAttribute('id','historial-modificado-por');
                                celdaTipoPermiso.setAttribute('id','historial-tipo-permiso');
                                celdaNombre.setAttribute('id','historial-nombre');
                                celdaApellido.setAttribute('id','historial-apellido');
                                celdaDireccion.setAttribute('id','historial-direccion');
                                celdaSucursal.setAttribute('id','historial-sucursal');
                                celdaEmail.setAttribute('id','historial-email');
                                celdaActivo.setAttribute('id','historial-activo');

                                celdaFechaRegistro.classList.add('historial-fecha-registro');
                                celdaTipoAccion.classList.add('historial-tipo-accion');
                                celdaUsername.classList.add('historial-username');
                                celdaModificadoPor.classList.add('historial-modificado-por');
                                celdaTipoPermiso.classList.add('historial-tipo-permiso');
                                celdaNombre.classList.add('historial-nombre');
                                celdaApellido.classList.add('historial-apellido');
                                celdaDireccion.classList.add('historial-direccion');
                                celdaSucursal.classList.add('historial-sucursal');
                                celdaEmail.classList.add('historial-email');
                                celdaActivo.classList.add('historial-activo');
                        });
                        } 
                        else if (response.status === 'success' && response.message.includes("No hay datos")) {        // No hay artículos a Mostrar
                            var nuevaFila = tablaResultados.insertRow(-1);
                            var celdaSinHistorial = nuevaFila.insertCell(0);
                            celdaSinHistorial.textContent = response.message || 'No disponible';
                            celdaSinHistorial.colSpan = 11;                                                                  // Combinar celdas
                            celdaSinHistorial.style.textAlign = "center";                                                   // Alinear texto al Centro
                            celdaSinHistorial.setAttribute('id','historial-no-encontrado');
                        } 
                        else {                                                                    // Error en los datos
                            var nuevaFila = tablaResultados.insertRow(-1);
                            var celdaError = nuevaFila.insertCell(0);
                            celdaError.textContent = 'Hubo un Error en la consulta.';
                            celdaError.colSpan = 11;
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
    