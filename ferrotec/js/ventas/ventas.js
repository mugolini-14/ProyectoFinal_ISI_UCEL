
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
                                suggestions.append('<li class="list-group-item" data-price="' + item.price + '" data-description="' + item.description + '">' + item.name + '</li>');
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

                if (articulo && valorUnitario && cantidad && total) {
                    var fila = '<tr>' +
                        '<td>' + '<button type="button" class="btn btn-danger eliminar-articulo">Eliminar</button>' + '</td>' + // Boton de eliminar articulo 
                        '<td>' + articulo + '</td>' +
                        '<td>' + valorUnitario + '</td>' +
                        '<td>' + cantidad + '</td>' +
                        '<td>' + total + '</td>' +
                        '</tr>';
                    $('#tabla-articulos tbody').append(fila);

                    actualizarTotalGeneral();

                    $('#busqueda-articulo').val('');
                    $('#valor-unitario').val('');
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
                    var articulo = $(this).find('td:eq(0)').text();
                    var valorUnitario = $(this).find('td:eq(1)').text();
                    var cantidad = $(this).find('td:eq(2)').text();
                    var total = $(this).find('td:eq(3)').text();
                    articulos.push({ articulo: articulo, valorUnitario: valorUnitario, cantidad: cantidad, total: total });
                });
                console.log('Datos de artículos:', articulos);

                var queryString = $.param({ articulos: JSON.stringify(articulos) });
                $.ajax({
                    url: 'registrar_venta.php?' + queryString,
                    method: 'GET',
                    contentType: 'application/json', // Especificar el tipo de contenido como JSON
                    data: { articulos: JSON.stringify(articulos) },
                    success: function(response) {
                        alert('Venta generada con éxito!');
                        $('#tabla-articulos tbody').empty();
                        $('#total-general').text('0.00');
                    }
                });
            });
        });