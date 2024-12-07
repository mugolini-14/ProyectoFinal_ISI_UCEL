// Función: fnConsultarArticulos()
// Descripción: Función que llama al PHP consultar_articulos.php para que muestre por pantalla los resultados
//              De la consulta de artículos.
//

function fnConsultarArticulos() {
    event.preventDefault();     // Evita el comportamiento por defecto del botón de Consultar

    if (document.getElementById('articulo').value != ''
        || document.getElementById('marca').value != ''
        || document.getElementById('descripcion').value != '') {
            
        var articulo = document.getElementById('articulo').value;
        var marca = document.getElementById('marca').value;
        var descripcion = document.getElementById('descripcion').value;

        var formData = new FormData();
        formData.append('articulo', articulo);
        formData.append('marca', marca);
        formData.append('descripcion', descripcion);

        // Enviar la solicitud AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../consulta_articulos/consultar_articulos.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.response);    // Parsea la respuesta del JSON enviado de la consulta del PHP
                console.log(response);
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
                        var celdaActivo = nuevaFila.insertCell(5);

                        // Asigna los valores a cada celda
                        celdaArticulo.innerHTML = articulo.articulo || 'No disponible';
                        celdaMarca.innerHTML = articulo.marca || 'No disponible';
                        celdaDescripcion.innerHTML = articulo.descripcion || 'No disponible';
                        celdaPrecioUnitario.innerHTML = articulo.precio || 'No disponible';
                        celdaStock.innerHTML = articulo.stock || 'No disponible';
                        celdaActivo.innerHTML = articulo.activo || 'No disponible';

                        // Setea los ids de cada celda para el reporte
                        celdaArticulo.setAttribute('id','articulo-nombre');
                        celdaMarca.setAttribute('id','articulo-marca');
                        celdaDescripcion.setAttribute('id','articulo-descripcion');
                        celdaPrecioUnitario.setAttribute('id','articulo-precio');
                        celdaStock.setAttribute('id','articulo-stock');
                        celdaActivo.setAttribute('id','articulo-activo');

                        celdaArticulo.classList.add('articulo-nombre');
                        celdaMarca.classList.add('articulo-marca');
                        celdaDescripcion.classList.add('articulo-descripcion');
                        celdaPrecioUnitario.classList.add('articulo-precio');
                        celdaStock.classList.add('articulo-stock');
                        celdaActivo.classList.add('articulo-activo');

                    });
                } else if (response.status === 'success' && response.message.includes("No hay artículos")) {        // No hay artículos a Mostrar
                    var nuevaFila = tablaResultados.insertRow(-1);
                    var celdaSinArticulos = nuevaFila.insertCell(0);
                    celdaSinArticulos.textContent = response.message || 'No disponible';
                    celdaSinArticulos.colSpan = 6;                                                                  // Combinar celdas
                    celdaSinArticulos.style.textAlign = "center";                                                   // Alinear texto al Centro
                    celdaSinArticulos.setAttribute('id','articulo-no-encontrado');
                } else {                                                                    // Error en los datos
                    var nuevaFila = tablaResultados.insertRow(-1);
                    var celdaError = nuevaFila.insertCell(0);
                    celdaError.textContent = 'Hubo un Error en la consulta.';
                    celdaError.colSpan = 6;
                    celdaError.style.textAlign = "center";
                }
            }
        };
        xhr.send(formData);
    } 
    else {
        alert('Por favor, ingrese algún dato.');
    }
}