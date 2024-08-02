function fnConsultarArticulos() {
    event.preventDefault();     // Evita el comportamiento por defecto del botón de Consultar

    if (document.getElementById('articulo').value != '') {
        var articulo = document.getElementById('articulo').value;
        var marca = document.getElementById('marca').value;
        var descripcion = document.getElementById('descripcion').value;

        var formData = new FormData();
        formData.append('articulo', articulo);
        formData.append('marca', marca);
        formData.append('descripcion', descripcion);

        // Enviar la solicitud AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../consultas/consultar_articulos.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.response);    // Parsea la respuesta del JSON enviado de la consulta del PHP
                var tablaResultados = document.getElementById('tabla-body-articulos');

                tablaResultados.innerHTML = '';             // Limpiar la tabla antes de agregar nuevas filas

                if (response.status === 'success' && response.message.includes("Articulos agregados correctamente")) {
                    response.data.forEach(function (articulo) {                                                     // Devuelve los datos para cada arreglo de Artículos
                        var nuevaFila = tablaResultados.insertRow(-1);

                        // Inserta las celdas para asignar los valores
                        var celdaArticulo = nuevaFila.insertCell(0);
                        var celdaMarca = nuevaFila.insertCell(1);
                        var celdaDescripcion = nuevaFila.insertCell(2);
                        var celdaPrecioUnitario = nuevaFila.insertCell(3);
                        var celdaStock = nuevaFila.insertCell(4);

                        // Asigna los valores a cada celda
                        celdaArticulo.innerHTML = articulo.articulo || 'No disponible';
                        celdaMarca.innerHTML = articulo.marca || 'No disponible';
                        celdaDescripcion.innerHTML = articulo.descripcion || 'No disponible';
                        celdaPrecioUnitario.innerHTML = articulo.precio || 'No disponible';
                        celdaStock.innerHTML = articulo.stock || 'No disponible';
                    });
                } else if (response.status === 'success' && response.message.includes("No hay artículos")) {        // No hay artículos a Mostrar
                    var nuevaFila = tablaResultados.insertRow(-1);
                    var celdaSinArticulos = nuevaFila.insertCell(0);
                    celdaSinArticulos.textContent = response.message || 'No disponible';
                    celdaSinArticulos.colSpan = 5;                                                                  // Combinar celdas
                    celdaSinArticulos.style.textAlign = "center";                                                   // Alinear texto al Centro
                } else {                                                                    // Error en los datos
                    var nuevaFila = tablaResultados.insertRow(-1);
                    var celdaError = nuevaFila.insertCell(0);
                    celdaError.textContent = 'Hubo un Error en la consulta.';
                    celdaError.colSpan = 5;
                    celdaError.style.textAlign = "center";
                }
            }
        };
        xhr.send(formData);
    } else {
        alert('Por favor, ingrese un artículo.');
    }
}