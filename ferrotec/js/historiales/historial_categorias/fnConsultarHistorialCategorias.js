function fnConsultarHistorialCategorias() {
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
                    var tipo = document.getElementById('tipo').value;
                    var categoria = document.getElementById('categoria').value;
                    var descripcion = document.getElementById('descripcion').value;
                    var catAccion = document.getElementById('cat-accion').value;
                    var modificadoPor = document.getElementById('modificado-por').value;
                    var cantRegistros = document.getElementById('cant-registros').value;

                    var formData = new FormData();
                    formData.append('fecha-desde', fechaDesde);
                    formData.append('fecha-hasta', fechaHasta);
                    formData.append('cat-accion', catAccion);
                    formData.append('modificado-por',modificadoPor);
                    formData.append('categoria',categoria);
                    formData.append('tipo', tipo);
                    formData.append('descripcion', descripcion);
                    formData.append('cant-registros', cantRegistros);

                    console.log(formData);

                    // Enviar la solicitud AJAX
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "../historial_categorias/consultar_historial_categorias.php", true);
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            console.log (xhr.response);
                            var response = JSON.parse(xhr.response);    // Parsea la respuesta del JSON enviado de la consulta del PHP
                            var tablaResultados = document.getElementById('tabla-body-historial-categorias');

                            tablaResultados.innerHTML = '';             // Limpiar la tabla antes de agregar nuevas filas

                            if (response.status === 'success' && response.message.includes("Datos agregados correctamente")) {
                                response.data.forEach(function (historial) {                                                     // Devuelve los datos para cada arreglo de Tipos
                                    var nuevaFila = tablaResultados.insertRow(-1);

                                    // Inserta las celdas para asignar los valores
                                    var celdaFechaRegistro = nuevaFila.insertCell(0);
                                    var celdaCatAccion = nuevaFila.insertCell(1);
                                    var celdaModificadoPor = nuevaFila.insertCell(2);
                                    var celdaCategoria = nuevaFila.insertCell(3);
                                    var celdaTipo = nuevaFila.insertCell(4);
                                    var celdaDescripcion = nuevaFila.insertCell(5);
                                    var celdaActivo = nuevaFila.insertCell(6);

                                    // Asigna los valores a cada celda
                                    celdaFechaRegistro.innerHTML = historial.fecha || 'No disponible';
                                    celdaCatAccion.innerHTML = historial.cataccion || 'No disponible';
                                    celdaModificadoPor.innerHTML = historial.modificadopor || 'No disponible';
                                    celdaCategoria.innerHTML = historial.categoria || 'No disponible';
                                    celdaTipo.innerHTML = historial.tipo || 'No disponible';
                                    celdaDescripcion.innerHTML = historial.descripcion || 'No disponible';
                                    celdaActivo.innerHTML = historial.activo || 'No disponible';
                                
                                    // Setea los ids y clases de cada celda para el reporte
                                    celdaFechaRegistro.setAttribute('id','historial-fecha-registro');
                                    celdaCatAccion.setAttribute('id','historial-cat-accion');
                                    celdaModificadoPor.setAttribute('id','historial-modificado-por');
                                    celdaCategoria.setAttribute('id','historial-categoria');
                                    celdaTipo.setAttribute('id','historial-tipo');
                                    celdaDescripcion.setAttribute('id','historial-descripcion');
                                    celdaActivo.setAttribute('id','historial-activo');

                                    celdaFechaRegistro.classList.add('historial-fecha-registro');
                                    celdaCatAccion.classList.add('historial-cat-accion');
                                    celdaModificadoPor.classList.add('historial-modificado-por');
                                    celdaCategoria.classList.add('historial-categoria');
                                    celdaTipo.classList.add('historial-tipo');
                                    celdaDescripcion.classList.add('historial-descripcion');
                                    celdaActivo.classList.add('historial-activo');
                                });
                            } else if (response.status === 'success' && response.message.includes("No hay datos")) {        // No hay tipos a Mostrar
                                var nuevaFila = tablaResultados.insertRow(-1);
                                var celdaSinHistorial = nuevaFila.insertCell(0);
                                celdaSinHistorial.textContent = response.message || 'No disponible';
                                celdaSinHistorial.colSpan = 7;                                                                  // Combinar celdas
                                celdaSinHistorial.style.textAlign = "center";                                                   // Alinear texto al Centro
                                celdaSinHistorial.setAttribute('id','historial-no-encontrado');
                            } else {                                                                    // Error en los datos
                                var nuevaFila = tablaResultados.insertRow(-1);
                                var celdaError = nuevaFila.insertCell(0);
                                celdaError.textContent = 'Hubo un Error en la consulta.';
                                celdaError.colSpan = 7;
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