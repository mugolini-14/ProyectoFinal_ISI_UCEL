// Función: fnConsultarCategorias()
// Descripción: Función que llama al PHP consultar_tipos.php para que muestre por pantalla los resultados
//              De la consulta de artículos.
//

function fnConsultarCategorias() {
    event.preventDefault();     // Evita el comportamiento por defecto del botón de Consultar

    if (document.getElementById('nombre').value != ''
        || document.getElementById('descripcion').value != ''
        || document.getElementById('depende-tipo').value) {
            
        var nombre = document.getElementById('nombre').value;
        var descripcion = document.getElementById('descripcion').value;
        var dependeDelTipo = document.getElementById('depende-tipo').value;

        var formData = new FormData();
        formData.append('nombre', nombre);
        formData.append('descripcion', descripcion);
        formData.append('depende-tipo', dependeDelTipo);

        // Enviar la solicitud AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../consulta_categorias/consultar_categorias.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.response);    // Parsea la respuesta del JSON enviado de la consulta del PHP
                console.log(response);
                var tablaResultados = document.getElementById('tabla-body-categorias');

                tablaResultados.innerHTML = '';             // Limpiar la tabla antes de agregar nuevas filas

                if (response.status === 'success' && response.message.includes("Categorías agregadas correctamente")) {
                    response.data.forEach(function (categoria) {                                                     // Devuelve los datos para cada arreglo de Artículos
                        var nuevaFila = tablaResultados.insertRow(-1);

                        // Inserta las celdas para asignar los valores
                        var celdaNombre = nuevaFila.insertCell(0);
                        var celdaDescripcion = nuevaFila.insertCell(1);
                        var celdaDependeDelTipo = nuevaFila.insertCell(2);
                        var celdaActiva = nuevaFila.insertCell(3);

                        // Asigna los valores a cada celda
                        celdaNombre.innerHTML = categoria.nombre || 'No disponible';
                        celdaDescripcion.innerHTML = categoria.descripcion || 'No disponible';
                        celdaDependeDelTipo.innerHTML = categoria.dependedeltipo || 'No disponible';
                        celdaActiva.innerHTML = categoria.activo || 'No disponible';

                        // Setea los ids de cada celda para el reporte
                        celdaNombre.setAttribute('id','categoria-nombre');
                        celdaDescripcion.setAttribute('id','categoria-descripcion');
                        celdaDependeDelTipo.setAttribute('id','categoria-depende-tipo');
                        celdaActiva.setAttribute('id','categoria-activo');

                        celdaNombre.classList.add('categoria-nombre');
                        celdaDescripcion.classList.add('categoria-descripcion');
                        celdaDependeDelTipo.classList.add('categoria-depende-tipo');
                        celdaActiva.classList.add('categoria-activo');

                    });
                } else if (response.status === 'success' && response.message.includes("No hay categorías")) {        // No hay artículos a Mostrar
                    var nuevaFila = tablaResultados.insertRow(-1);
                    var celdaSinCategorias = nuevaFila.insertCell(0);
                    celdaSinCategorias.textContent = response.message || 'No disponible';
                    celdaSinCategorias.colSpan = 6;                                                                  // Combinar celdas
                    celdaSinCategorias.style.textAlign = "center";                                                   // Alinear texto al Centro
                    celdaSinCategorias.setAttribute('id','categoria-no-encontrada');
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