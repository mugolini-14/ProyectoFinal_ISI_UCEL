function fnConsultarHistorialVentas() {
    event.preventDefault(); // Evita el comportamiento por defecto del botón de Consultar

    if( document.getElementById('fecha-desde').value != ''
    || document.getElementById('fecha-hasta').value != ''){
        // Verifica que los dos campos de la fecha no estén vacíos
        if( document.getElementById('fecha-desde').value != ''
        && document.getElementById('fecha-hasta').value != ''){
            // Verifica si la Fecha de Inicio es posterior a la de Fin
            // Verifica si la Feche de Fin es anterior a la Inicio
            if((document.getElementById('fecha-desde').value < document.getElementById('fecha-hasta').value) 
            || (document.getElementById('fecha-hasta').value > document.getElementById('fecha-desde').value)){
                if (document.getElementById('tipo-venta').value != 'S') {

                    var fechaDesde = document.getElementById('fecha-desde').value;
                    var fechaHasta = document.getElementById('fecha-hasta').value;
                    var tipoVenta = document.getElementById('tipo-venta').value;
                    var modoPago = document.getElementById('modo-pago').value;
                    var monto = document.getElementById('monto').value;
                    var montoNumero = document.getElementById('monto-numero').value;
                    var sucursal = document.getElementById('sucursal').value;
                    var modificadoPor = document.getElementById('modificado-por').value;
                    var cantRegistros = document.getElementById('cant-registros').value;

                    var formData = new FormData();
                    formData.append('fecha-desde', fechaDesde);
                    formData.append('fecha-hasta', fechaHasta);
                    formData.append('tipo-venta', tipoVenta);
                    formData.append('modo-pago', modoPago);
                    formData.append('monto', monto);
                    formData.append('monto-numero', montoNumero);
                    formData.append('sucursal', sucursal);
                    formData.append('modificado-por', modificadoPor);
                    formData.append('cant-registros', cantRegistros);

                    console.log(formData);

                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "../historial_ventas/consultar_historial_ventas.php", true);
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            console.log(xhr.response);
                            var response = JSON.parse(xhr.response); // Parsea la respuesta del JSON enviado desde el PHP

                            var tablaResultados = document.getElementById('tabla-body-historial-ventas');
                            var tablaResultadosDetalle = document.getElementById('tabla-body-historial-ventas-detalle');

                            tablaResultados.innerHTML = ''; // Limpiar la tabla antes de agregar nuevas filas
                            tablaResultadosDetalle.innerHTML = ''; // Limpiar la tabla antes de agregar nuevas filas

                            // Verifica si la respuesta tiene datos para ventas y ventasdetalle
                            if (response.ventas.status === 'success') {
                                if (response.ventas && response.ventas.data.length > 0) {
                                    response.ventas.data.forEach(function (historialventa) {
                                        var nuevaFila = tablaResultados.insertRow(-1);

                                        // Inserta las celdas para asignar los valores
                                        var celdaFechaRegistro = nuevaFila.insertCell(0);
                                        var celdaVentaNro = nuevaFila.insertCell(1);
                                        var celdaModificadoPor = nuevaFila.insertCell(2);
                                        var celdaMontoTotal = nuevaFila.insertCell(3);
                                        var celdaSucursal = nuevaFila.insertCell(4);
                                        var celdaModoDePago = nuevaFila.insertCell(5);

                                        // Asigna los valores a cada celda
                                        celdaFechaRegistro.innerHTML = historialventa.fecha || 'No disponible';
                                        celdaVentaNro.innerHTML = historialventa.ventanro || 'No disponible';
                                        celdaModificadoPor.innerHTML = historialventa.modificadopor || 'No disponible';
                                        celdaMontoTotal.innerHTML =  "$ " + historialventa.montototal || 'No disponible';
                                        celdaSucursal.innerHTML = historialventa.sucursal || 'No disponible';
                                        celdaModoDePago.innerHTML = historialventa.mododepago || 'No disponible';

                                        // Setea los ids y clases de cada celda para el reporte
                                        celdaFechaRegistro.setAttribute('id', 'historial-fecha-registro');
                                        celdaVentaNro.setAttribute('id', 'historial-venta-id');
                                        celdaModificadoPor.setAttribute('id', 'historial-modificado-por');
                                        celdaMontoTotal.setAttribute('id', 'historial-monto-total');
                                        celdaSucursal.setAttribute('id', 'historial-sucursal');
                                        celdaModoDePago.setAttribute('id', 'historial-mododepago');

                                        celdaFechaRegistro.classList.add('historial-fecha-registro');
                                        celdaVentaNro.classList.add('historial-venta-id');
                                        celdaModificadoPor.classList.add('historial-modificado-por');
                                        celdaMontoTotal.classList.add('historial-monto-total');
                                        celdaSucursal.classList.add('historial-sucursal');
                                        celdaModoDePago.classList.add('historial-mododepago');
                                    });
                                } 
                                else {
                                    // Mostrar mensaje de que no hay datos de ventas
                                    var nuevaFila = tablaResultados.insertRow(-1);
                                    var celdaSinHistorial = nuevaFila.insertCell(0);
                                    celdaSinHistorial.textContent = response.ventas.message || 'No disponible';
                                    celdaSinHistorial.colSpan = 6;
                                    celdaSinHistorial.style.textAlign = "center";
                                }

                                if (response.ventasdetalle && response.ventasdetalle.data.length > 0) {
                                    response.ventasdetalle.data.forEach(function (historialventadetalle) {
                                        var nuevaFila = tablaResultadosDetalle.insertRow(-1);

                                        // Inserta las celdas para asignar los valores
                                        var celdaVentaNro = nuevaFila.insertCell(0);
                                        var celdaArticulo = nuevaFila.insertCell(1);
                                        var celdaCantidad = nuevaFila.insertCell(2);
                                        var celdaMonto = nuevaFila.insertCell(3);

                                        // Asigna los valores a cada celda
                                        celdaVentaNro.innerHTML = historialventadetalle.ventanro || 'No disponible';
                                        celdaArticulo.innerHTML = historialventadetalle.articulo || 'No disponible';
                                        celdaCantidad.innerHTML = historialventadetalle.cantidad || 'No disponible';
                                        celdaMonto.innerHTML = "$ " + (historialventadetalle.montoporarticulo || 'No disponible');

                                        // Setea los ids y clases de cada celda para el reporte
                                        celdaVentaNro.setAttribute('id', 'historial-id-detalle');
                                        celdaArticulo.setAttribute('id', 'historial-articulo');
                                        celdaCantidad.setAttribute('id', 'historial-cantidad');
                                        celdaMonto.setAttribute('id', 'historial-monto-detalle');

                                        celdaVentaNro.classList.add('historial-id-detalle');
                                        celdaArticulo.classList.add('historial-articulo');
                                        celdaCantidad.classList.add('historial-cantidad');
                                        celdaMonto.classList.add('historial-monto-detalle');
                                    });
                                } 
                                else {
                                    // Mostrar mensaje de que no hay datos de detalle de ventas
                                    var nuevaFila = tablaResultadosDetalle.insertRow(-1);
                                    var celdaSinHistorialDetalle = nuevaFila.insertCell(0);
                                    celdaSinHistorialDetalle.textContent = response.ventasdetalle.message || 'No disponible';
                                    celdaSinHistorialDetalle.colSpan = 4;
                                    celdaSinHistorialDetalle.style.textAlign = "center";
                                }
                            } 
                            else {
                                // Manejar errores
                                alert('Hubo un error en la consulta.');
                            }
                        }
                    };
                    xhr.send(formData); // Enviar formData después de definir la función onreadystatechange
                } else {
                    alert('Por favor, seleccione el tipo de venta a consultar.');
                }
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