// Función: fnConsultarTipos()
// Descripción: Función que llama al PHP consultar_tipos.php para que muestre por pantalla los resultados
//              De la consulta de artículos.
//

function fnConsultarTipos() {
    event.preventDefault();     // Evita el comportamiento por defecto del botón de Consultar

    if (document.getElementById('nombre').value != ''
        || document.getElementById('descripcion').value != '') {
            
        var nombre = document.getElementById('nombre').value;
        var descripcion = document.getElementById('descripcion').value;

        var formData = new FormData();
        formData.append('nombre', nombre);
        formData.append('descripcion', descripcion);

        // Enviar la solicitud AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../consulta_tipos/consultar_tipos.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.response);    // Parsea la respuesta del JSON enviado de la consulta del PHP
                console.log(response);
                var tablaResultados = document.getElementById('tabla-body-tipos');

                tablaResultados.innerHTML = '';             // Limpiar la tabla antes de agregar nuevas filas

                if (response.status === 'success' && response.message.includes("Tipos agregados correctamente")) {
                    response.data.forEach(function (tipo) {                                                     // Devuelve los datos para cada arreglo de Artículos
                        var nuevaFila = tablaResultados.insertRow(-1);

                        // Inserta las celdas para asignar los valores
                        var celdaNombre = nuevaFila.insertCell(0);
                        var celdaDescripcion = nuevaFila.insertCell(1);
                        var celdaActivo = nuevaFila.insertCell(2);

                        // Asigna los valores a cada celda
                        celdaNombre.innerHTML = tipo.nombre || 'No disponible';
                        celdaDescripcion.innerHTML = tipo.descripcion || 'No disponible';
                        celdaActivo.innerHTML = tipo.activo || 'No disponible';

                        // Setea los ids de cada celda para el reporte
                        celdaNombre.setAttribute('id','tipo-nombre');
                        celdaDescripcion.setAttribute('id','tipo-descripcion');
                        celdaActivo.setAttribute('id','tipo-activo');

                        celdaNombre.classList.add('tipo-nombre');
                        celdaDescripcion.classList.add('tipo-descripcion');
                        celdaActivo.classList.add('tipo-activo');

                    });
                } else if (response.status === 'success' && response.message.includes("No hay tipos")) {        // No hay artículos a Mostrar
                    var nuevaFila = tablaResultados.insertRow(-1);
                    var celdaSinTipos = nuevaFila.insertCell(0);
                    celdaSinTipos.textContent = response.message || 'No disponible';
                    celdaSinTipos.colSpan = 3;                                                                  // Combinar celdas
                    celdaSinTipos.style.textAlign = "center";                                                   // Alinear texto al Centro
                    celdaSinTipos.setAttribute('id','tipo-no-encontrado');
                } else {                                                                    // Error en los datos
                    var nuevaFila = tablaResultados.insertRow(-1);
                    var celdaError = nuevaFila.insertCell(0);
                    celdaError.textContent = 'Hubo un Error en la consulta.';
                    celdaError.colSpan = 3;
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