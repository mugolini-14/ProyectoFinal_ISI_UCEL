// Función: fnConsultarHistorialProveedores()
// Descripción: Función que llama al PHP consultar_historial_proveedores.php para que muestre por pantalla los resultados
//              De la consulta al historial de proveedores.
//

function fnConsultarHistorialProveedores() {
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
                    var nombre = document.getElementById('nombre').value;
                    var descripcion = document.getElementById('descripcion').value;
                    var direccion = document.getElementById('direccion').value;
                    var localidad = document.getElementById('localidad').value;
                    var telefono1 = document.getElementById('telefono1').value;
                    var telefono2 = document.getElementById('telefono2').value;
                    var email = document.getElementById('email').value;
                    var cuit = document.getElementById('cuit').value;
                    var provAccion = document.getElementById('prov-accion').value;
                    var modificadoPor = document.getElementById('modificado-por').value;
                    var cantRegistros = document.getElementById('cant-registros').value;

                    var formData = new FormData();
                    formData.append('fecha-desde', fechaDesde);
                    formData.append('fecha-hasta', fechaHasta);
                    formData.append('prov-accion', provAccion);
                    formData.append('modificado-por',modificadoPor);
                    formData.append('nombre', nombre);
                    formData.append('descripcion', descripcion);
                    formData.append('direccion', direccion);
                    formData.append('localidad', localidad);
                    formData.append('telefono1', telefono1);
                    formData.append('telefono2', telefono2);
                    formData.append('email', email);
                    formData.append('cuit', cuit);
                    formData.append('cant-registros', cantRegistros);

                    console.log(formData);

                    // Enviar la solicitud AJAX
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "../historial_proveedores/consultar_historial_proveedores.php", true);
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            console.log (xhr.response);
                            var response = JSON.parse(xhr.response);    // Parsea la respuesta del JSON enviado de la consulta del PHP
                            var tablaResultados = document.getElementById('tabla-body-historial-proveedores');

                            tablaResultados.innerHTML = '';             // Limpiar la tabla antes de agregar nuevas filas

                            if (response.status === 'success' && response.message.includes("Datos agregados correctamente")) {
                                response.data.forEach(function (historial) {                                                     // Devuelve los datos para cada arreglo de Artículos
                                    var nuevaFila = tablaResultados.insertRow(-1);

                                    // Inserta las celdas para asignar los valores
                                    var celdaFechaRegistro = nuevaFila.insertCell(0);
                                    var celdaProvAccion = nuevaFila.insertCell(1);
                                    var celdaModificadoPor = nuevaFila.insertCell(2);
                                    var celdaProveedorNombre = nuevaFila.insertCell(3);
                                    var celdaDescripcion = nuevaFila.insertCell(4);
                                    var celdaDireccion = nuevaFila.insertCell(5);
                                    var celdaLocalidad = nuevaFila.insertCell(6);
                                    var celdaTelefono1 = nuevaFila.insertCell(7);
                                    var celdaTelefono2 = nuevaFila.insertCell(8);
                                    var celdaEmail = nuevaFila.insertCell(9);
                                    var celdaCuit = nuevaFila.insertCell(10);
                                    var celdaActivo = nuevaFila.insertCell(11);
                                
                                    // Asigna los valores a cada celda
                                    celdaFechaRegistro.innerHTML = historial.fecha || 'No disponible';
                                    celdaProvAccion.innerHTML = historial.provaccion || 'No disponible';
                                    celdaModificadoPor.innerHTML = historial.modificadopor || 'No disponible';
                                    celdaProveedorNombre.innerHTML = historial.proveedor || 'No disponible';
                                    celdaDescripcion.innerHTML = historial.descripcion || 'No disponible';
                                    celdaDireccion.innerHTML = historial.direccion || 'No disponible';
                                    celdaLocalidad.innerHTML = historial.localidad || 'No disponible';
                                    celdaTelefono1.innerHTML = historial.telefono1 || 'No disponible';
                                    celdaTelefono2.innerHTML = historial.telefono2 || 'No disponible';
                                    celdaEmail.innerHTML = historial.email || 'No disponible';
                                    celdaCuit.innerHTML = historial.cuit || 'No disponible';
                                    celdaActivo.innerHTML = historial.activo || 'No disponible';
                                
                                    // Setea los ids y clases de cada celda para el reporte
                                    celdaFechaRegistro.setAttribute('id','historial-fecha-registro');
                                    celdaProvAccion.setAttribute('id','historial-prov-accion');
                                    celdaModificadoPor.setAttribute('id','historial-modificado-por');
                                    celdaProveedorNombre.setAttribute('id','historial-proveedor');
                                    celdaDescripcion.setAttribute('id','historial-descripcion');
                                    celdaDireccion.setAttribute('id','historial-direccion');
                                    celdaLocalidad.setAttribute('id','historial-localidad');
                                    celdaTelefono1.setAttribute('id','historial-telefono1');
                                    celdaTelefono2.setAttribute('id','historial-telefono2');
                                    celdaEmail.setAttribute('id','historial-email');
                                    celdaCuit.setAttribute('id','historial-cuit');
                                    celdaActivo.setAttribute('id','historial-activo');

                                    celdaFechaRegistro.classList.add('historial-fecha-registro');
                                    celdaProvAccion.classList.add('historial-prov-accion');
                                    celdaModificadoPor.classList.add('historial-modificado-por');
                                    celdaProveedorNombre.classList.add('historial-proveedor');
                                    celdaDescripcion.classList.add('historial-descripcion');
                                    celdaDireccion.classList.add('historial-direccion');
                                    celdaLocalidad.classList.add('historial-localidad');
                                    celdaTelefono1.classList.add('historial-telefono1');
                                    celdaTelefono2.classList.add('historial-telefono2');
                                    celdaEmail.classList.add('historial-email');
                                    celdaCuit.classList.add('historial-cuit');
                                    celdaActivo.classList.add('historial-activo');
                                });
                            } else if (response.status === 'success' && response.message.includes("No hay datos")) {        // No hay artículos a Mostrar
                                var nuevaFila = tablaResultados.insertRow(-1);
                                var celdaSinHistorial = nuevaFila.insertCell(0);
                                celdaSinHistorial.textContent = response.message || 'No disponible';
                                celdaSinHistorial.colSpan = 12;                                                                  // Combinar celdas
                                celdaSinHistorial.style.textAlign = "center";                                                   // Alinear texto al Centro
                                celdaSinHistorial.setAttribute('id','historial-no-encontrado');
                            } else {                                                                    // Error en los datos
                                var nuevaFila = tablaResultados.insertRow(-1);
                                var celdaError = nuevaFila.insertCell(0);
                                celdaError.textContent = 'Hubo un Error en la consulta.';
                                celdaError.colSpan = 12;
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