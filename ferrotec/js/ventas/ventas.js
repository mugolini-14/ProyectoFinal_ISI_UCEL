
        $(document).ready(function() {
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

            $(document).on('click', '.list-group-item', function() {
                $('#busqueda-articulo').val($(this).text());
                $('#descripcion').val($(this).data('description'));
                $('#valor-unitario').val($(this).data('price'));
                $('#stock').val($(this).data('stock'));
                $('#busqueda-articulo').data('id', $(this).data('id')); // Almacena el id_article en el campo de búsqueda
                $('#suggestions').empty();
            });

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

            $('#agregar-articulo').on('click', function() {
                var articulo = $('#busqueda-articulo').val();
                var valorUnitario = $('#valor-unitario').val();
                var cantidad = $('#cantidad').val();
                var total = $('#total-articulo').val();
                var id_article = $('#busqueda-articulo').data('id'); // Obtiene el id_article

                if (articulo && valorUnitario && cantidad && total) {
                    var fila = '<tr>' +
                        '<td>' + '<button type="button" class="btn btn-danger eliminar-articulo">Eliminar</button>' + '</td>' + // Boton de eliminar articulo 
                        '<td>' + articulo + '</td>' +
                        '<td>' + valorUnitario + '</td>' +
                        '<td>' + cantidad + '</td>' +
                        '<td>' + total + '</td>' +
                        '<td class="d-none">' + id_article + '</td>' + // Ocultar el id_article
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
            });

            function actualizarTotalGeneral() {
                var totalGeneral = 0;
                $('#tabla-articulos tbody tr').each(function() {
                    var total = parseFloat($(this).find('td:eq(4)').text());
                    totalGeneral += total;
                });
                $('#total-general').text(totalGeneral.toFixed(2));
            }

            // Función para eliminar fila al hacer clic en el botón de eliminar
            $(document).on('click', '.eliminar-articulo', function() {
                $(this).closest('tr').remove();
                actualizarTotalGeneral();
            });

            $('#generar-venta').on('click', function() {
                var articulos = [];
                $('#tabla-articulos tbody tr').each(function() {
                    var articulo = $(this).find('td:eq(1)').text();
                    var valorUnitario = $(this).find('td:eq(2)').text();
                    var cantidad = $(this).find('td:eq(3)').text();
                    var total = $(this).find('td:eq(4)').text();
                    var id_article = $(this).find('td:eq(5)').text(); // Obtener el id_article
                    articulos.push({ id_article: id_article, articulo: articulo, valorUnitario: valorUnitario, cantidad: cantidad, total: total });
                });

                // Obtener el total general
                var totalGeneral = $('#total-general').text();

                 // Obtener el modo de pago
                var modoDePago = $('#modo-de-pago').val();

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
                        alert('Venta generada con éxito!');
                        $('#tabla-articulos tbody').empty();
                        $('#total-general').text('0.00');
                        $('#modo-de-pago').val('');
                    }
                });
            });
        });