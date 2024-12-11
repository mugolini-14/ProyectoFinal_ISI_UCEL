//  Función:     $(document).ready(function()
//  Descripción: Valida los datos suministrados en el Reporte de Ventas
//               A partir de valores de campos de entrada
//               Si pasa las validaciones, envia los datos a la base para consultar al Reporte
//               Para el filtro de texto, rellena los campos de búsqueda del reporte según lo seleccionado
// 

$(document).ready(function() {

    //  Función:     $('#generar-reporte-ventas').click(function()
    //  Descripción: Guarda el filtrado del formulario
    //               Consulta a la base de datos del reporte y guarda los datos en variables locales
    //               En base a lo escrito y seleccionado para filtrar
    //               Si pasa las validaciones, envia los datos a la base para procesar la modificación de precios
    // 

    $('#generar-reporte-ventas').click(function() {
        var fechaInicio = $('#fecha-inicio').val();
        var fechaFin = $('#fecha-fin').val();
        var usuario = $('#filtrar-usuario').val();
        var filtroOpcion = $('input[name="filtro-opcion"]:checked').val();
        var filtroTexto = $('#filtro-texto').val();
        var filtroOpcionPago = $('input[name="filtro-opcion-pago"]:checked').val();

        //Para generar la fecha y hora actual a mostrar en el reporte
        var fechaHoraActual = new Date();
        var fechaActual = fechaHoraActual.toLocaleDateString();
        var horaActual = fechaHoraActual.toLocaleTimeString();

        // Verifica que los dos campos de la fecha no estén vacíos
        if(fechaInicio != '' && fechaFin != ''){
            // Verifica que alguno de los dos campos de la fecha no esté vacío
            if(fechaInicio != '' || fechaFin != ''){
                // Control de Fechas
                // Verifica si la Fecha de Inicio es posterior a la de Fin
                // Verifica si la Feche de Fin es anterior a la Inicio
                if((fechaInicio < fechaFin) || (fechaFin > fechaInicio)){
                    // Hace la consulta al Reporte
                    $.ajax({
                        url: 'consultar_reporte_ventas.php',
                        type: 'POST',
                        data: {
                            fecha_inicio: fechaInicio,
                            fecha_fin: fechaFin,
                            usuario: usuario,
                            filtroOpcion: filtroOpcion,
                            filtroTexto: filtroTexto,
                            filtroOpcionPago: filtroOpcionPago
                        },
                        success: function(response) {
                            var data = response;
                              // Crear contenido de las filas
                              if (data.status === 'error') {
                                $('#tabla-reportes tbody').html(`<tr><td>Sin Datos: ${data.message}</td></tr>`);
                                return; // Salir de la función para no procesar más
                            }
            
                            // Se toma los valores de las fechas de entrada
                            let fechaInicio = document.getElementById('fecha-inicio').value;
                            let fechaFin = document.getElementById('fecha-fin').value;
            
                            // Se descomponen las fechas en día, mes y año
                            let [anioInicio, mesInicio, diaInicio] = fechaInicio.split('-');
                            let [anioFin, mesFin, diaFin] = fechaFin.split('-');
            
                            // Se crean los objetos de las fechas
                            let fechaInicioObjeto = new Date(anioInicio, mesInicio - 1, diaInicio);
                            let fechaFinObjeto = new Date(anioFin, mesFin - 1, diaFin);
            
                            // Se formatean los objetos obtenidos de las fechas
                            let diaFechaInicio = fechaInicioObjeto.getDate().toString();
                            let mesFechaInicio = (fechaInicioObjeto.getMonth() + 1).toString(); 
                            let anioFechaInicio = fechaInicioObjeto.getFullYear();
            
                            let diaFechaFin = fechaFinObjeto.getDate().toString();
                            let mesFechaFin = (fechaFinObjeto.getMonth() + 1).toString();
                            let anioFechaFin = fechaFinObjeto.getFullYear();
            
                            // Se componen la fechas y se guardan en variables locales
                            let FechaInicioFormateada = `${diaFechaInicio}/${mesFechaInicio}/${anioFechaInicio}`;
                            let FechaFinFormateada = `${diaFechaFin}/${mesFechaFin}/${anioFechaFin}`;
            
                            // Se compone la tabla de contenido
                            var tableContent = `
                            <tr>
                                <td colspan=2 id="fechageneracion" class="fechageneracion" colspan=2 ><h4> Reporte generado el día ${fechaActual} a la hora ${horaActual} </h4> </td> 
                                <td> </td>
                            </tr>
                            <tr>
                                <td > <H4> <b>Datos Brindados:</b> </H4> </td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td id="fecha-desde" class="fecha-desde"><b>Fecha de Inicio</b>:  ${FechaInicioFormateada} </td > 
                                <td id="fecha-hasta"class="fecha-hasta"><b>Fecha de Fin</b>:  ${FechaFinFormateada} </td>
                            </tr>
                            <tr>
                                <td> <b> Filtrado por Usuario: </b> </td>
                                <td id="usuarios" class="usuarios">${usuario}</td>
                            </tr>
                            <tr>
                                <td> <b>Artículos Involucrados </b>: </td>
                                <td id="articulos"class="articulos">${data.articulos}</td>
                            </tr>
                            <tr>
                                <td> <b>Categorías Involucradas</b>: </td>
                                <td id="categorias" class="categorias">${data.categorias}</td>
                            </tr>
                            <tr>
                                <td> <b>Tipos Involucrados</b>: </td>
                                <td id="tipos" class="tipos">${data.tipos}</td>
                            </tr>
                            <tr>
                                <td colspan=2> <hr style="border: 2px solid gray;"> </td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td > <H4> <b>Información del Reporte:</b> </H4> </td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td > <h5> <b> Totales: <b> </h5> </td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td><b>Cantidad de dias Computados (*)</b>: </td>
                                <td id="dias-computados" class="dias-computados">  ${data.dias_seleccionados} </td>
                            </tr>
                            <tr>
                                <td><b> Cantidad de Mercadería Vendida </b>: </td>
                                <td id="cantidad-articulos" class="cantidad-articulos"> ${data.suma_cant_art} unidades </td>
                            </tr>
                            <tr>
                                <td><b>Cantidad de Ventas Realizadas (**)</b>: </td>
                                <td id="cantidad-ventas" class="cantidad-ventas"> ${data.suma_cant_ventas} Ventas </td>
                            </tr>
                            <tr>
                                <td><b>Monto Total Cobrado (***)</b>: </td>
                                <td id="monto-total" class="monto-total"> $ ${data.suma} </td>
                            </tr>
                            <tr>
                                <td > <h5> <b> Medidas Estadísticas: </b> </h4> </td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td ><b> Cantidad de Ventas Realizadas Promedio por Día </b>: </td>
                                <td id="cantidad-ventas-promedio-dia" class="cantidad-ventas-promedio-dia"> ${data.suma_cant_ventas_prom} Ventas por día </td>
                            </tr>
                            <tr>
                                <td> <b> Cantidad de Unidades de Mercaderia Vendida Promedio por Día </b>:  </td>
                                <td id="cantidad-articulos-promedio-dia" class="cantidad-articulos-promedio-dia"> ${data.suma_cant_art_prom} Unidades por Día </td>
                            </tr>
                            <tr>
                                <td><b> Monto Cobrado Promedio por Día </b>: </td>
                                <td id="monto-promedio-dia" class="monto-promedio-dia"> $ ${data.suma_prom} </td>
                            </tr>
                            <tr>
                                <td colspan=2> <hr style="border: 2px solid gray;"> </td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td colspan=2> <H4> <b> Referencias: </b> </H4> </td> 
                                <td> </td>
                            </tr>                    
                            <tr>
                                <td colspan=2><b>(*)</b>:  Se consideran todos los días en el rango seleccionado inclusive feriados y fines de semana. </td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td colspan=2><b>(**)</b>:  Se computan todas las ventas que contienen uno o varios artículos seleccionados, la compra es por cliente. </td>
                                <td> </td>
                            </tr>
                            
                            <tr>
                                <td colspan=2><b>(***)</b>:  Se considera solamente el/los artículos seleccionados. </td>
                                <td> </td>
                            </tr>
                            `;
                          
                            // Escribir contenido en el tbody
                            $('#tabla-reportes tbody').html(tableContent);
            
                            // En caso de que los campos opcionales estén vacios, se llena con un texto identificatorio
                            if(document.getElementById('filtro-texto').value == ''){
                                document.getElementById('articulos').innerHTML = 'Ninguno';
                                document.getElementById('categorias').innerHTML = 'Ninguna';
                                document.getElementById('tipos').innerHTML = 'Ninguno';
                            }
                            else{
                                // Consulta si hay algún radio validado para mostrar su contenido
                                var tipo = document.getElementById('filtrar-tipo');
                                var categoria = document.getElementById('filtrar-categoria');
                                var articulo = document.getElementById('filtrar-articulo');
            
                                if(tipo && tipo.checked){
                                    document.getElementById('articulos').innerHTML = 'Ninguno';
                                    document.getElementById('categorias').innerHTML = 'Ninguna';
                                    document.getElementById('tipos').innerHTML = document.getElementById('filtro-texto').value;
                                }
            
                                if(categoria && categoria.checked){
                                    document.getElementById('tipos').innerHTML = 'Ninguno';
                                    document.getElementById('articulos').innerHTML = 'Ninguna';
                                    document.getElementById('categorias').innerHTML = document.getElementById('filtro-texto').value;
                                }
            
                                if(articulo && articulo.checked){
                                    document.getElementById('tipos').innerHTML = 'Ninguno';
                                    document.getElementById('categorias').innerHTML = 'Ninguna';
                                    document.getElementById('articulos').innerHTML = document.getElementById('filtro-texto').value;
                                }
                            }
            
                            if(document.getElementById('filtrar-usuario').value == ''){
                                document.getElementById('usuarios').innerHTML = "Ninguno";
                            }
            
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            $('#tabla-reportes tbody').html(`<tr><td>Error: ${data.message}</td></tr>`);
                        }
                    }); 
                }
                else{
                    alert('Por favor, ingrese fechas válidas.');
                }
            }
            else{
                alert('Por favor complete las fechas.');
            }
        }
        else{
            alert('Por favor complete las fechas.');
        }
    });

    $('#descargar-reporte').click(function() {
       // Verifica que la tabla del reporte esté generada
       if(document.getElementById('fechageneracion')){     

            // Consigue los datos de la tabla generada del Reporte
            var fechaGeneracion = document.querySelector('.fechageneracion').innerHTML;
            var fechaDesde = document.querySelector('.fecha-desde').innerHTML;
            var fechaHasta = document.querySelector('.fecha-hasta').innerHTML;
            var usuarios = document.querySelector('.usuarios').innerHTML || "Ninguno";
            var articulos = document.querySelector('.articulos').innerHTML || "Ninguno";
            var categorias = document.querySelector('.categorias').innerHTML || "Ninguna";
            var tipos = document.querySelector('.tipos').innerHTML || "Ninguno";
            var diasComputados = document.querySelector('.dias-computados').innerHTML;
            var cantidadArticulos = document.querySelector('.cantidad-articulos').innerHTML;
            var cantidadVentas = document.querySelector('.cantidad-ventas').innerHTML;
            var montoTotal = document.querySelector('.monto-total').innerHTML;
            var cantidadVentasPromedioDia = document.querySelector('.cantidad-ventas-promedio-dia').innerHTML;
            var cantidadArticulosPromedioDia = document.querySelector('.cantidad-articulos-promedio-dia').innerHTML;
            var montoPromedioDia = document.querySelector('.monto-promedio-dia').innerHTML;

            console.log("fechaGeneracion: " + fechaGeneracion)
            console.log("fechaDesde: " + fechaDesde)
            console.log("fechaHasta: " + fechaHasta)
            console.log("usuarios: " + usuarios)
            console.log("articulos: " + articulos)
            console.log("categorias: " + categorias)
            console.log("tipos: " + tipos)
            console.log("diasComputados: " + diasComputados)
            console.log("cantidadArticulos: " + cantidadArticulos)
            console.log("cantidadVentas: " + cantidadVentas)
            console.log("montoTotal: " + montoTotal)
            console.log("cantidadVentasPromedioDia: " + cantidadVentasPromedioDia)
            console.log("cantidadArticulosPromedioDia: " + cantidadArticulosPromedioDia)
            console.log("montoPromedioDia: " + montoPromedioDia)

            var formData = new FormData();
            formData.append('fechaGeneracion', fechaGeneracion);
            formData.append('fechaDesde', fechaDesde);
            formData.append('fechaHasta', fechaHasta);
            formData.append('usuarios', usuarios);
            formData.append('articulos', articulos);
            formData.append('categorias', categorias);
            formData.append('tipos', tipos);
            formData.append('diasComputados', diasComputados);
            formData.append('cantidadArticulos', cantidadArticulos);
            formData.append('cantidadVentas', cantidadVentas);
            formData.append('montoTotal', montoTotal);
            formData.append('cantidadVentasPromedioDia', cantidadVentasPromedioDia);
            formData.append('cantidadArticulosPromedioDia', cantidadArticulosPromedioDia);
            formData.append('montoPromedioDia', montoPromedioDia);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../reporteventas/generar_reporte_ventas.php", true);
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
                    link.download = 'reporte_ventas_' + fechaHoraActual.getDate() + "-" + (fechaHoraActual.getMonth() + 1) + "-" + fechaHoraActual.getFullYear() 
                                    + "_" + fechaHoraActual.getHours() + "-" + fechaHoraActual.getMinutes() + "-" + fechaHoraActual.getSeconds() + '.pdf';
                    link.click();
                    }
                };
                xhr.send(formData);
        }
        else{
            alert("No hay datos para generar el reporte.");
        };    
    });

    // Manejo de la visibilidad de la caja de texto de búsqueda
    $('input[name="filtro-opcion"]').change(function() {
        var selectedValue = $('input[name="filtro-opcion"]:checked').val();
        $('#filtro-texto').attr('placeholder', `Buscar ${selectedValue}...`);
    });


});
