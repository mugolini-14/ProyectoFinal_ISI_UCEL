//  $(document).ready(function()
//  Descripción: Valida los datos suministrados en la Modificación de Precios
//               A partir de valores de campos de entrada
//               Si pasa la validación, envia los datos a la base para procesar la modificación de precios
// 

$(document).ready(function() {

    $('#modificar-precios').click(function() {
        var seleccionOpcion = $('input[name="seleccion-opcion"]:checked').val();
        var seleccionNombre = $('#seleccion-nombre').val();
        var porcentualModificacion = $('#porcentual-modificacion').val();

        //  Función: fnValidarNumeros(cadena)
        //  Descripción: Verifica que se haya ingresado un número en el campo Porcentaje
        // 

        function fnValidarNumeros(porcentaje){
            const cadenaporcentaje = Number(porcentaje);
            return Number.isInteger(cadenaporcentaje);
        }

        var nombreEntidad = document.getElementById('seleccion-nombre').value;
        var porcentaje = document.getElementById('porcentual-modificacion').value;

        // Verifica que estén ingresados los dos campos
        if( nombreEntidad != ''
            && porcentaje != ''){
            // Verifica que estén ingresados los dos campos
            if( nombreEntidad != ''
                || porcentaje != ''){
                // Verifica que el campo Porcentaje contenga números
                if(fnValidarNumeros(porcentaje) == true){
                    $.ajax({
                        url: 'modificar_precios.php',
                        type: 'POST',
                        data: {
                            seleccionOpcion: seleccionOpcion,
                            seleccionNombre: seleccionNombre,
                            porcentualModificacion: porcentualModificacion,
                            preConfirm: true // Indicador para obtener los datos preliminares
                        },
                        success: function(response) {
                            var data = JSON.parse(response);
                            
                            if (data.status === 'error') {
                                alert('Error: ' + data.message);
                                return; // Salir de la función para no procesar más
                            }
            
                            var confirmMessage = "Estás a punto de modificar los siguientes datos:\n\n" +
                                                 "Tipos modificados: " + data.tipos + "\n" +
                                                 "Categorías modificadas: " + data.categorias + "\n" +
                                                 "Artículos modificados: " + data.articulos + "\n\n" +
                                                 "¿Deseas continuar?";
            
                            if (confirm(confirmMessage)) {
                                // Usuario confirmó, proceder con la modificación
                                $.ajax({
                                    url: 'modificar_precios.php',
                                    type: 'POST',
                                    data: {
                                        seleccionOpcion: seleccionOpcion,
                                        seleccionNombre: seleccionNombre,
                                        porcentualModificacion: porcentualModificacion
                                    },
                                    success: function(response) {
                                        console.log(response);
                                        var data = JSON.parse(response);
                                        
                                        if (data.status === 'error') {
                                            $('#tabla-reportes tbody').html(`<tr><td>Sin Datos: ${data.message}</td></tr>`);
                                            return; // Salir de la función para no procesar más
                                        }
            
                                        var tableContent = `
                                            <tr>
                                                <td><b>Datos tipos modificados</b>:  ${data.tipos} </td>
                                            </tr>
                                            <tr>
                                                <td><b>Datos categorías modificadas</b>:  ${data.categorias} </td>
                                            </tr>
                                            <tr>
                                                <td><b>Datos artículos modificados</b>:  ${data.articulos} </td>
                                            </tr>
                                        `;
                                        
                                        // Escribir contenido en el tbody
                                        $('#tabla-reportes tbody').html(tableContent);
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        $('#tabla-reportes tbody').html(`<tr><td>Error: ${errorThrown}</td></tr>`);
                                    }
                                });
                            } else {
                                // Usuario canceló la acción
                                alert('Modificación cancelada');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error: ' + errorThrown);
                        }
                    });
                }
                else{  
                    alert('Por favor ingrese un porcentaje válido.');
                }
            }
            else{
                // No esta ingresado al menos un campo
                alert('Por favor complete todos los campos.');
            }
        }
        else{
            // No están ingresados todos los campos
            alert('Por favor complete todos los campos.');
        }
    });


});
