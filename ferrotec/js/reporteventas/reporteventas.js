
$(document).ready(function() {

    $('#generar-reporte-ventas').click(function() {
        var fechaInicio = $('#fecha-inicio').val();
        var fechaFin = $('#fecha-fin').val();
        var usuario = $('#filtrar-usuario').val();
        //var articulo = $('#busqueda-articulo').val();
        //var categoria = $('#busqueda-categoria').val();
        //var tipo = $('#busqueda-tipo').val();
        var filtroOpcion = $('input[name="filtro-opcion"]:checked').val();
        var filtroTexto = $('#filtro-texto').val();

        //Para generar la fecha y hora actual a mostrar en el reporte
        var fechaHoraActual = new Date();
        var fechaActual = fechaHoraActual.toLocaleDateString();
        var horaActual = fechaHoraActual.toLocaleTimeString();

        //alert('Usuario es: ' + usuario + ', el articulo es' + articulo + ', la fecha de inicio es ' + fechaInicio + ', y la fecha fin es ' + fechaFin);
      
        $.ajax({
            url: 'generar_reporte_ventas.php',
            type: 'POST',
            data: {
                fecha_inicio: fechaInicio,
                fecha_fin: fechaFin,
                usuario: usuario,
                filtroOpcion: filtroOpcion,
                filtroTexto: filtroTexto
            },
            success: function(response) {
                var data = JSON.parse(response);
                  // Crear contenido de las filas
                  var tableContent = `
                    <tr>
                        <td>Reporte generado el día ${fechaActual} a la hora ${horaActual}</td>
                    </tr>
                    <tr>
                        <td><b>Datos brindados:</b></td>
                    </tr>
                    <tr>
                        <td><u>Fecha Inicio</u>:  ${fechaInicio} </td>
                    </tr>
                    <tr>
                        <td><u>Fecha Fin</u>:  ${fechaFin}</td>
                    </tr>
                    <tr>
                        <td> <u>Filtrado por Usuario</u>: ${usuario}</td>
                    </tr>
                    <tr>
                        <td> <u>Artículos involucrados</u>: ${data.articulos}</td>
                    </tr>
                    <tr>
                        <td> <u>Categorías involucradas</u>: ${data.categorias}</td>
                    </tr>
                    <tr>
                        <td> <u>Tipos involucrados</u>: ${data.tipos}</td>
                    </tr>
                    <tr>
                        <td><b>Información del reporte:</b></td>
                    </tr>
                    <tr>
                        <td></td> <!-- Fila en blanco -->
                    </tr>
                    <tr>
                        <td>Totales:</td>
                    </tr>
                    <tr>
                        <td><u>----Cantidad de dias computados <b>*</b></u>:  ${data.dias_seleccionados}</td>
                    </tr>
                    <tr>
                        <td><u>----Cantidad vendida </u>:  ${data.suma_cant_art} unidades </td>
                    </tr>
                    </tr>
                    <tr>
                        <td><u>----Cantidad de ventas realizadas <b>**</b></u>: ${data.suma_cant_ventas} ventas </td>
                    </tr>
                    <tr>
                        <td><u>----Monto total vendido<b>***</b></u>: ${data.suma} $ </td>
                    </tr>
                    <tr>
                        <td></td> <!-- Fila en blanco -->
                    </tr>
                    <tr>
                        <td>Medidas estadísticas:</td>
                    </tr>
                    <tr>
                        <td><u>----Cantidad de ventas realizadas promedio por día </u>: ${data.suma_cant_ventas_prom} ventas por día </td>
                    </tr>
                    <tr>
                        <td><u>----Cantidad de unidades vendidas promedio por día </u>: ${data.suma_cant_art_prom} unidades por día </td>
                    </tr>
                    <tr>
                        <td><u>----Monto vendido promedio por día </u>: ${data.suma_prom} $ </td>
                    </tr>
                    <tr>
                        <td></td> <!-- Fila en blanco -->
                    </tr>
                    <tr>
                        <td></td> <!-- Fila en blanco -->
                    </tr>
                    <tr>
                        <td>----------------------------------------</td>
                    </tr>
                    <tr>
                        <td></td> <!-- Fila en blanco -->
                    </tr>                    
                    <tr>
                        <td><b>*</b>:  Se consideran todos los días en el rango seleccionado inclusive feriados y fines de semana. </td>
                    </tr>
                    <tr>
                        <td><b>**</b>:  Se computan todas las ventas que contienen uno o varios artículos seleccionados, la venta es por cliente. </td>
                    </tr>
                    
                    <tr>
                        <td><b>***</b>:  Se considera solamente el/los artículos seleccionados. </td>
                    </tr>
              `;
              
              // Escribir contenido en el tbody
              $('#tabla-reportes tbody').html(tableContent);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error al obtener el promedio de ventas:', textStatus, errorThrown);
            }
        }); 
    });

    $('#descargar-reporte').click(function() {
        var tableContent = '';
        $('#tabla-reportes tbody tr').each(function() {
            var rowText = $(this).find('td').text();
            tableContent += rowText + '\n';
        });

        var blob = new Blob([tableContent], { type: 'text/plain' });
        var url = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'reporte_ventas.txt';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    });

     // Manejo de la visibilidad de la caja de texto de búsqueda
     $('input[name="filtro-opcion"]').change(function() {
        var selectedValue = $('input[name="filtro-opcion"]:checked').val();
        $('#filtro-texto').attr('placeholder', `Buscar ${selectedValue}...`);
    });


});
