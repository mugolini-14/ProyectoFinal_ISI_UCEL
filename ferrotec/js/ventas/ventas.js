//  Función: $(document).ready(function()
//  Descripción: Valida y agrega los artículos en ventas.php
//               Busca los artículos en la base de datos para sumarlos al carrito de ventas
//               Envía los datos a registrar_venta.php para registrar las ventas y su detalle
//

$(document).ready(function() {

    //  Función: $('#busqueda-articulo').on('keyup', function()
    //  Descripción: Busca los artículos existentes y activos y los agrega al carrito de venta
    //               Busca los artículos en la base de datos para sumarlos al carrito de ventas
    //               Envía los datos a registrar_venta para registrar las ventas y su detalle
    //
    var articulosAgregados = []; // Array global para almacenar los artículos para no agregar 2 veces los articulos a la compra
    var stockArticulo = 0;

    $('#busqueda-articulo').on('keyup', function() {
        var searchTerm = $(this).val();
        if (searchTerm.length > 0) {
            $.ajax({
                url: '../busqueda/busqueda.php',
                method: 'GET',
                data: { term: searchTerm },
                success: function(data) {
                    var suggestions = $('#suggestions');
                    suggestions.empty();
                    data.forEach(function(item) {
                        suggestions.append('<li class="list-group-item" data-id="' + item.id_article + '" data-price="' + item.price + '" data-description="' + item.description + '" data-stock="' + item.stock + '">' + item.name + '</li>');
                    });
                }
            });
        } else {
            $('#suggestions').empty();
        }
    });

    //  Función: $(document).on('click', '.list-group-item', function()
    //  Descripción: Almacena los datos encontrados de la lista de artículos
    //

    $(document).on('click', '.list-group-item', function() {
        // Extrae y asigna los textos de cada campo
        $('#busqueda-articulo').val($(this).text());
        $('#descripcion').val($(this).data('description'));
        $('#valor-unitario').val($(this).data('price'));
        $('#stock').val($(this).data('stock'));
        $('#busqueda-articulo').data('id', $(this).data('id')); // Almacena el id_article en el campo de búsqueda
        $('#suggestions').empty();

        stockArticulo = parseInt($('#stock').val());
    });

    //  Función: fnValidarStock(cantidadFila)
    //  Descripción: Valida que la cantidad ingresada de un artículo no supere la del stock diponible
    //

    function fnValidarStock(cantidadFila) {
        if(cantidadFila < stockArticulo){
            return true;
        }
        else{
            return false;
        }
    };

    //  Función: $('#cantidad').on('input', function()
    //  Descripción: Calcula el subtotal de cada fila de artículos y lo muestra en la página
    //

    $('#cantidad').on('input', function() {
        // Extrae la cantidad y el precio unitario de cada fila de artículos
        // Multiplica cantidad y precio de cada fila para sacar el subtotal de la fila
        var cantidad = parseFloat($(this).val());
        var precioUnitario = parseFloat($('#valor-unitario').val());
        if (!isNaN(cantidad) && !isNaN(precioUnitario)) {
            var total = cantidad * precioUnitario;
            $('#total-articulo').val(total.toFixed(2));
        } 
        else {
            $('#total-articulo').val('');
        }
    });

    //  Función: $('#agregar-articulo').on('click', function()
    //  Descripción: Muestra los artículos almacenados en la página de ventas
    //

    $('#agregar-articulo').on('click', function() {
        // Lee los datos de cada artículo
        var articulo = $('#busqueda-articulo').val();
        var valorUnitario = $('#valor-unitario').val();
        var cantidad = $('#cantidad').val();
        var total = $('#total-articulo').val();
        var id_article = $('#busqueda-articulo').data('id'); // Obtiene el id_article

        // Verificar si el artículo ya está en el array
        if (articulosAgregados.includes(id_article)) {
            alert('El artículo ya ha sido agregado a la venta.');
            return; // Detener la ejecución si el artículo ya existe
        }

        // Si hay artículos agregados muestra el contenido de cada fila
        if (cantidad > 0) {
            if (articulo && valorUnitario && cantidad && total) {
                // Controla si el stock es menor al disponible
                if (fnValidarStock(cantidad) == true){
                    var fila = '<tr>' +
                    '<td>' + articulo + '</td>' +
                    '<td>' + valorUnitario + '</td>' +
                    '<td>' + cantidad + '</td>' +
                    '<td style="text-align: right;">' + total + '</td>' +
                    '<td class="d-none">' + id_article + '</td>' + // Ocultar el id_article
                    '<td>' + '<div class="d-flex"><button type="button" class="btn btn-danger ms-auto col-10 eliminar-articulo">Eliminar</button>' + '</td></div>' + // Boton de eliminar articulo 
                    '</tr>';
                    $('#tabla-articulos tbody').append(fila);

                    // Agregar el artículo al array global para controlar si va a agregar nuevamente el mismo articulo
                    articulosAgregados.push(id_article);

                    // console.log('array artículosAgregados después de añadir:', articulosAgregados); // Muestra el array en la consola

                    actualizarTotalGeneral();

                    $('#busqueda-articulo').val('');
                    $('#valor-unitario').val('');
                    $('#stock').val('');
                    $('#cantidad').val('');
                    $('#descripcion').val('');
                    $('#total-articulo').val('');
                }
                else{
                    alert('La cantidad ingresada es mayor a la del stock permitido.');
                }
            }
        } 
        else{
            // No hay artículos a mostrar
            alert('Por favor ingrese un artículo y cantidad a agregar.');
        }
    });

    //  Función: actualizarTotalGeneral()
    //  Descripción: Calcula el total de la venta sumando cada subtotal de artículos
    //

    function actualizarTotalGeneral() {
        var totalGeneral = 0;
        $('#tabla-articulos tbody tr').each(function() {
            var total = parseFloat($(this).find('td:eq(3)').text());
            totalGeneral += total;
        });
        $('#total-general').text(totalGeneral.toFixed(2));
    }

    //  Función: $(document).on('click', '.eliminar-articulo', function()
    //  Descripción: Elimina un artículo de la página
    //

    $(document).on('click', '.eliminar-articulo', function() {
        // Obtener el id_article de la fila que se va a eliminar
        var id_article = $(this).closest('tr').find('td:eq(4)').text(); 
    
        // Convertir a número el id_article ya que en la tabla esta como texto
        id_article = parseInt(id_article); 
    
        // Filtrar el array para eliminar el id_article correspondiente
        articulosAgregados = articulosAgregados.filter(function(item) {
            return item !== id_article; // Comparación estricta para eliminar el artículo
        });
    
        // Mostrar el array actualizado en la consola
        // console.log('array artículosAgregados después de eliminar:', articulosAgregados);
    
        // Eliminar la fila de la tabla
        $(this).closest('tr').remove();
    
        // Actualizar el total general
        actualizarTotalGeneral();
    });

    //  Función: $('#generar-venta').on('click', function()
    //  Descripción: Genera un arreglo con los articulos de las filas
    //               Convierte el arreglo de artículos a un JSON para enviar a registrar_venta.php
    //               Envía el JSON con los datos de la venta a registrar_venta.php para registrarla en la base de datos
    //

    $('#generar-venta').on('click', function() {
        // Obtener el total general
        var totalGeneral = $('#total-general').text();

        // Obtener el modo de pago
        var modoDePago = $('#modo-de-pago').val();

        // Genera el arreglo de artículo
        var articulos = [];
        $('#tabla-articulos tbody tr').each(function() {
            var articulo = $(this).find('td:eq(0)').text();
            var valorUnitario = $(this).find('td:eq(1)').text();
            var cantidad = $(this).find('td:eq(2)').text();
            var total = $(this).find('td:eq(3)').text();
            var id_article = $(this).find('td:eq(4)').text(); // Obtener el id_article
            articulos.push({ id_article: id_article, articulo: articulo, valorUnitario: valorUnitario, cantidad: cantidad, total: total });
        });
        // Consulta si hay algún artículo en el carrito de ventas
        if(articulos.length > 0){ 
            // Consulta si hay un total general en la venta
            if(totalGeneral > 0){ 
                // Consulta si el medio de pago está seleccionado
                if(modoDePago > 0){ 

                    console.log('Datos de artículos:', articulos);
                    console.log('Modo de Pago:', modoDePago);
                    console.log('Total General:', totalGeneral);

                    var queryString = $.param({ 
                        articulos: JSON.stringify(articulos), 
                        totalGeneral: totalGeneral, 
                        modoDePago: modoDePago 
                    });

                    $.ajax({
                        url: 'registrar_venta.php?' + queryString,
                        method: 'GET',
                        contentType: 'application/json', // Especificar el tipo de contenido como JSON
                        data: { articulos: JSON.stringify(articulos) },
                        success: function(response) {
                            if(response == "Venta generada correctamente.\n"){
                                alert('Venta generada correctamente.');
                                $('#tabla-articulos tbody').empty();
                                $('#total-general').text('0.00');
                                $('#modo-de-pago').val('');
                                $('#proveedor').val('');
                            }
                            else{
                                alert(response);
                            }
                        }
                    });
                }
                else {
                    // No se seleccionò un medio de pago
                    alert('Por favor seleccione un medio de pago.');
                }
            }
            else {
                // El total de la venta es 0
                alert('La venta debe tener un total declarado.');
            }
        } 
        else {
            // No se registraron artículos para vender
            alert('Por favor agregue un artículo para realizar la venta.');
        }
    });
});