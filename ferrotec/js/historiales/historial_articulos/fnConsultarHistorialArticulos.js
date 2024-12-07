function fnConsultarHistorialArticulos() {
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
                    var articulo = document.getElementById('articulo').value;
                    var marca = document.getElementById('marca').value;
                    var precio = document.getElementById('precio').value;
                    var descripcion = document.getElementById('descripcion').value;
                    var tipoAccion = document.getElementById('tipo-accion').value;
                    var modificadoPor = document.getElementById('modificado-por').value;
                    var cantRegistros = document.getElementById('cant-registros').value;

                    var formData = new FormData();
                    formData.append('fecha-desde', fechaDesde);
                    formData.append('fecha-hasta', fechaHasta);
                    formData.append('tipo-accion', tipoAccion);
                    formData.append('modificado-por',modificadoPor);
                    formData.append('articulo', articulo);
                    formData.append('marca', marca);
                    formData.append('precio', precio);
                    formData.append('descripcion', descripcion);
                    formData.append('cant-registros', cantRegistros);

                    console.log(formData);

                    // Enviar la solicitud AJAX
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "../historial_articulos/consultar_historial_articulos.php", true);
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            console.log (xhr.response);
                            var response = JSON.parse(xhr.response);    // Parsea la respuesta del JSON enviado de la consulta del PHP
                            var tablaResultados = document.getElementById('tabla-body-historial-articulos');

                            tablaResultados.innerHTML = '';             // Limpiar la tabla antes de agregar nuevas filas

                            if (response.status === 'success' && response.message.includes("Datos agregados correctamente")) {
                                response.data.forEach(function (historial) {                                                     // Devuelve los datos para cada arreglo de Artículos
                                    var nuevaFila = tablaResultados.insertRow(-1);

                                    // Inserta las celdas para asignar los valores
                                    var celdaFechaRegistro = nuevaFila.insertCell(0);
                                    var celdaTipoAccion = nuevaFila.insertCell(1);
                                    var celdaModificadoPor = nuevaFila.insertCell(2);
                                    var celdaArticuloNombre = nuevaFila.insertCell(3);
                                    var celdaMarca = nuevaFila.insertCell(4);
                                    var celdaDescripcion = nuevaFila.insertCell(5);
                                    var celdaCategoria = nuevaFila.insertCell(6);
                                    var celdaPrecio = nuevaFila.insertCell(7);
                                    var celdaActivo = nuevaFila.insertCell(8);

                                
                                    // Asigna los valores a cada celda
                                    celdaFechaRegistro.innerHTML = historial.fecha || 'No disponible';
                                    celdaTipoAccion.innerHTML = historial.tipoaccion || 'No disponible';
                                    celdaModificadoPor.innerHTML = historial.modificadopor || 'No disponible';
                                    celdaArticuloNombre.innerHTML = historial.articulo || 'No disponible';
                                    celdaMarca.innerHTML = historial.marca || 'No disponible';
                                    celdaDescripcion.innerHTML = historial.descripcion || 'No disponible';
                                    celdaCategoria.innerHTML = historial.categoria || 'No disponible';
                                    celdaPrecio.innerHTML = historial.precio || 'No disponible';
                                    celdaActivo.innerHTML = historial.activo || 'No disponible';
                                
                                    // Setea los ids y clases de cada celda para el reporte
                                    celdaFechaRegistro.setAttribute('id','historial-fecha-registro');
                                    celdaTipoAccion.setAttribute('id','historial-tipo-accion');
                                    celdaModificadoPor.setAttribute('id','historial-modificado-por');
                                    celdaArticuloNombre.setAttribute('id','historial-articulo');
                                    celdaMarca.setAttribute('id','historial-marca');
                                    celdaDescripcion.setAttribute('id','historial-descripcion');
                                    celdaCategoria.setAttribute('id','historial-categoria');
                                    celdaPrecio.setAttribute('id','historial-precio');
                                    celdaActivo.setAttribute('id','historial-activo');

                                    celdaFechaRegistro.classList.add('historial-fecha-registro');
                                    celdaTipoAccion.classList.add('historial-tipo-accion');
                                    celdaModificadoPor.classList.add('historial-modificado-por');
                                    celdaArticuloNombre.classList.add('historial-articulo');
                                    celdaMarca.classList.add('historial-marca');
                                    celdaDescripcion.classList.add('historial-descripcion');
                                    celdaCategoria.classList.add('historial-categoria');
                                    celdaPrecio.classList.add('historial-precio');
                                    celdaActivo.classList.add('historial-activo');
                                });
                            } else if (response.status === 'success' && response.message.includes("No hay datos")) {        // No hay artículos a Mostrar
                                var nuevaFila = tablaResultados.insertRow(-1);
                                var celdaSinHistorial = nuevaFila.insertCell(0);
                                celdaSinHistorial.textContent = response.message || 'No disponible';
                                celdaSinHistorial.colSpan = 9;                                                                  // Combinar celdas
                                celdaSinHistorial.style.textAlign = "center";                                                   // Alinear texto al Centro
                                celdaSinHistorial.setAttribute('id','historial-no-encontrado');
                            } else {                                                                    // Error en los datos
                                var nuevaFila = tablaResultados.insertRow(-1);
                                var celdaError = nuevaFila.insertCell(0);
                                celdaError.textContent = 'Hubo un Error en la consulta.';
                                celdaError.colSpan = 9;
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