function fnConsultarHistorialCompras() {
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
                if (document.getElementById('tipo-compra').value != 'S' ) {

                        var fechaDesde = document.getElementById('fecha-desde').value;
                        var fechaHasta = document.getElementById('fecha-hasta').value;
                        var tipoCompra = document.getElementById('tipo-compra').value;
                        var modoPago = document.getElementById('modo-pago').value;
                        var monto = document.getElementById('monto').value;
                        var montoNumero = document.getElementById('monto-numero').value;
                        var sucursal = document.getElementById('sucursal').value;
                        var modificadoPor = document.getElementById('modificado-por').value;
                        var proveedor = document.getElementById('proveedor').value;
                        var cantRegistros = document.getElementById('cant-registros').value;

                        var formData = new FormData();
                        formData.append('fecha-desde', fechaDesde);
                        formData.append('fecha-hasta', fechaHasta);
                        formData.append('tipo-compra', tipoCompra);
                        formData.append('modo-pago', modoPago);
                        formData.append('monto', monto);
                        formData.append('monto-numero', montoNumero);
                        formData.append('sucursal', sucursal);
                        formData.append('modificado-por', modificadoPor);
                        formData.append('proveedor', proveedor);
                        formData.append('cant-registros', cantRegistros);

                        console.log(formData);

                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "../historial_compras/consultar_historial_compras.php", true);
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                console.log(xhr.response);
                                var response = JSON.parse(xhr.response); // Parsea la respuesta del JSON enviado desde el PHP

                                var tablaResultados = document.getElementById('tabla-body-historial-compras');
                                var tablaResultadosDetalle = document.getElementById('tabla-body-historial-compras-detalle');

                                tablaResultados.innerHTML = ''; // Limpiar la tabla antes de agregar nuevas filas
                                tablaResultadosDetalle.innerHTML = ''; // Limpiar la tabla antes de agregar nuevas filas

                                // Verifica si la respuesta tiene datos para ventas y ventasdetalle
                                if (response.compras.status === 'success') {
                                    if (response.compras && response.compras.data.length > 0) {
                                        response.compras.data.forEach(function (historialcompra) {
                                            var nuevaFila = tablaResultados.insertRow(-1);

                                            // Inserta las celdas para asignar los valores
                                            var celdaFechaRegistro = nuevaFila.insertCell(0);
                                            var celdaVentaNro = nuevaFila.insertCell(1);
                                            var celdaModificadoPor = nuevaFila.insertCell(2);
                                            var celdaMontoTotal = nuevaFila.insertCell(3);
                                            var celdaSucursal = nuevaFila.insertCell(4);
                                            var celdaProveedor = nuevaFila.insertCell(5);
                                            var celdaModoDePago = nuevaFila.insertCell(6);

                                            // Asigna los valores a cada celda
                                            celdaFechaRegistro.innerHTML = historialcompra.fecha || 'No disponible';
                                            celdaVentaNro.innerHTML = historialcompra.compranro || 'No disponible';
                                            celdaModificadoPor.innerHTML = historialcompra.modificadopor || 'No disponible';
                                            celdaMontoTotal.innerHTML =  "$ " + historialcompra.montototal || 'No disponible';
                                            celdaSucursal.innerHTML = historialcompra.sucursal || 'No disponible';
                                            celdaProveedor.innerHTML = historialcompra.proveedor || 'No disponible';
                                            celdaModoDePago.innerHTML = historialcompra.mododepago || 'No disponible';

                                            // Setea los ids y clases de cada celda para el reporte
                                            celdaFechaRegistro.setAttribute('id', 'historial-fecha-registro');
                                            celdaVentaNro.setAttribute('id', 'historial-compra-id');
                                            celdaModificadoPor.setAttribute('id', 'historial-modificado-por');
                                            celdaMontoTotal.setAttribute('id', 'historial-monto-total');
                                            celdaSucursal.setAttribute('id', 'historial-sucursal');
                                            celdaProveedor.setAttribute('id', 'historial-proveedor');
                                            celdaModoDePago.setAttribute('id', 'historial-mododepago');

                                            celdaFechaRegistro.classList.add('historial-fecha-registro');
                                            celdaVentaNro.classList.add('historial-compra-id');
                                            celdaModificadoPor.classList.add('historial-modificado-por');
                                            celdaMontoTotal.classList.add('historial-monto-total');
                                            celdaSucursal.classList.add('historial-sucursal');
                                            celdaProveedor.classList.add('historial-proveedor');
                                            celdaModoDePago.classList.add('historial-mododepago');
                                        });
                                    } 
                                    else {
                                        // Mostrar mensaje de que no hay datos de ventas
                                        var nuevaFila = tablaResultados.insertRow(-1);
                                        var celdaSinHistorial = nuevaFila.insertCell(0);
                                        celdaSinHistorial.textContent = response.compras.message || 'No disponible';
                                        celdaSinHistorial.colSpan = 7;
                                        celdaSinHistorial.style.textAlign = "center";
                                    }

                                    if (response.comprasdetalle && response.comprasdetalle.data.length > 0) {
                                        response.comprasdetalle.data.forEach(function (historialcompradetalle) {
                                            var nuevaFila = tablaResultadosDetalle.insertRow(-1);

                                            // Inserta las celdas para asignar los valores
                                            var celdaVentaNro = nuevaFila.insertCell(0);
                                            var celdaArticulo = nuevaFila.insertCell(1);
                                            var celdaCantidad = nuevaFila.insertCell(2);
                                            var celdaMonto = nuevaFila.insertCell(3);

                                            // Asigna los valores a cada celda
                                            celdaVentaNro.innerHTML = historialcompradetalle.compranro || 'No disponible';
                                            celdaArticulo.innerHTML = historialcompradetalle.articulo || 'No disponible';
                                            celdaCantidad.innerHTML = historialcompradetalle.cantidad || 'No disponible';
                                            celdaMonto.innerHTML = "$ " + (historialcompradetalle.montoporarticulo || 'No disponible');

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
                                        celdaSinHistorialDetalle.textContent = response.comprasdetalle.message || 'No disponible';
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
                    alert('Por favor, seleccione un tipo de compra.');
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