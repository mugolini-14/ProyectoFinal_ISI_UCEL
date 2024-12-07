//  Función: $(document).ready(function()
//  Descripción: Valida y agrega los artículos en compras.php
//               Busca los artículos en la base de datos para sumarlos al carrito de compras
//               Envía los datos a registrar_compra.php para registrar las compras y su detalle
//

$(document).ready(function() {

    //  Función: $('#busqueda-articulo').on('keyup', function()
    //  Descripción: Busca los artículos existentes y activos y los agrega al carrito de compra
    //               Busca los artículos en la base de datos para sumarlos al carrito de compras
    //               Envía los datos a registrar_compras para registrar las compras y su detalle
    //

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
                        suggestions.append('<li class="list-group-item" data-id="' + item.id_article + '" data-description="' + item.description + '" data-stock="' + item.stock + '">' + item.name + '</li>');
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
        $('#busqueda-articulo').val($(this).text());
        $('#descripcion').val($(this).data('description'));
        $('#stock').val($(this).data('stock'));
        $('#busqueda-articulo').data('id', $(this).data('id')); // Almacena el id_article en el campo de búsqueda
        $('#suggestions').empty();
    });

    //  Función: $('#valor-unitario').on('input', function()
    //  Descripción: Calcula el subtotal de cada fila de artículos y lo muestra en la página
    //

    $('#valor-unitario').on('input', function() {
        var precioUnitario = parseFloat($(this).val());
        var cantidad = parseFloat($('#cantidad').val());
        if (!isNaN(cantidad) && !isNaN(precioUnitario)) {
            var total = cantidad * precioUnitario;
            $('#total-articulo').val(total.toFixed(2));
        } else {
            $('#total-articulo').val('');
        }
    });

    //  Función: $('#cantidad').on('input', function()
    //  Descripción: Calcula el subtotal de cada fila de artículos y lo muestra en la página
    //

    $('#cantidad').on('input', function() {
        var cantidad = parseFloat($(this).val());
        var precioUnitario = parseFloat($('#valor-unitario').val());
        if (!isNaN(cantidad) && !isNaN(precioUnitario)) {
            var total = cantidad * precioUnitario;
            $('#total-articulo').val(total.toFixed(2));
        } else {
            $('#total-articulo').val('');
        }
    });

    //  Función: $('#agregar-articulo').on('click', function()
    //  Descripción: Muestra los artículos almacenados en la página de compras
    //

    $('#agregar-articulo').on('click', function() {
        var articulo = $('#busqueda-articulo').val();
        var valorUnitario = $('#valor-unitario').val();
        var cantidad = $('#cantidad').val();
        var total = $('#total-articulo').val();
        var id_article = $('#busqueda-articulo').data('id'); // Obtiene el id_article

        if (cantidad > 0) {
            if (articulo && valorUnitario && cantidad && total) {
                var fila = '<tr>' +
                    '<td>' + articulo + '</td>' +
                    '<td>' + valorUnitario + '</td>' +
                    '<td>' + cantidad + '</td>' +
                    '<td>' + total + '</td>' +
                    '<td class="d-none">' + id_article + '</td>' + // Ocultar el id_article
                    '<td>' + '<div class="d-flex"> <button type="button" class="btn btn-danger col-10 eliminar-articulo">Eliminar</button>' + '</td> </div>' + // Boton de eliminar articulo 
                    '</tr>';
                $('#tabla-articulos tbody').append(fila);

                actualizarTotalGeneral();

                $('#busqueda-articulo').val('');
                $('#valor-unitario').val('');
                $('#stock').val('');
                $('#cantidad').val('');
                $('#descripcion').val('');
                $('#total-articulo').val('');
            }
        } else{
            alert('Por favor agregue un artículo, el valor unitario y la cantidad a ingresar en la lista de compra.');
        }
    });

    //  Función: actualizarTotalGeneral()
    //  Descripción: Calcula el total de la compra sumando cada subtotal de artículos
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
        $(this).closest('tr').remove();
        actualizarTotalGeneral();
    });

    //  Función: $('#realizar-compra').on('click', function()
    //  Descripción: Genera un arreglo con los articulos de las filas
    //               Convierte el arreglo de artículos a un JSON para enviar a registrar_compra.php
    //               Envía el JSON con los datos de la compra a registrar_compra.php para registrarla en la base de datos
    //

    $('#realizar-compra').on('click', function() {
        // Obtener el total general
        var totalGeneral = $('#total-general').text();

        // Obtener el modo de pago
        var modoDePago = $('#modo-de-pago').val();

        
        var articulos = [];
        $('#tabla-articulos tbody tr').each(function() {
            var articulo = $(this).find('td:eq(0)').text();
            var valorUnitario = $(this).find('td:eq(1)').text();
            var cantidad = $(this).find('td:eq(2)').text();
            var total = $(this).find('td:eq(3)').text();
            var id_article = $(this).find('td:eq(4)').text(); // Obtener el id_article
            articulos.push({ id_article: id_article, articulo: articulo, valorUnitario: valorUnitario, cantidad: cantidad, total: total });
        });
        // Consulta si hay algún artículo en el carrito de compras
        if(articulos.length > 0){ 
            // Consulta si existe un total general
            if(totalGeneral > 0){ 
                // Consulta si existe un modo de pago
                if(modoDePago > 0){ 
                    // Consulta si el proveedor existe
                    if(document.getElementById('proveedor').value != ''){
                        // Envía los datos a la base de datos
                        console.log('Datos de artículos:', articulos);
                        console.log('Modo de Pago:', modoDePago);
                        console.log('Total General:', totalGeneral);
                        

                        var queryString = $.param({ 
                            articulos: JSON.stringify(articulos), 
                            totalGeneral: totalGeneral, 
                            modoDePago: modoDePago,
                            nombreProveedor: document.getElementById('proveedor').value
                        });

                        console.log (queryString.articulos + '//' + queryString.totalGeneral + '//' + queryString.modoDePago + '//' + queryString.nombreProveedor );

                        console.log('URL: ' + 'registrar_compra.php?' + queryString);

                        $.ajax({
                            url: 'registrar_compra.php?' + queryString,
                            method: 'GET',
                            contentType: 'application/json', // Especificar el tipo de contenido como JSON
                            data: { articulos: JSON.stringify(articulos) },
                            success: function(response) {
                                if(response == "Compra generada correctamente."){
                                    alert('Compra generada correctamente.');
                                    $('#tabla-articulos tbody').empty();
                                    $('#total-general').text('0.00');
                                    $('#modo-de-pago').val('');
                                    $('#proveedor').val('');
                                }
                                else{
                                    alert(response);
                                }
                            },
                        });
                    }
                    else{
                        // No se ingresó un proveedor
                        alert('Por favor ingrese un proveedor.');
                    }
                }else {
                    alert('Por favor seleccione un método de pago.');
                }
            }else {
                alert('La compra debe tener un total declarado.');
            }
        } else {
            alert('Por favor agregue valores válidos de artículo, valor unitario y cantidad para ingresar a la lista de compra.');
        }
    });
});