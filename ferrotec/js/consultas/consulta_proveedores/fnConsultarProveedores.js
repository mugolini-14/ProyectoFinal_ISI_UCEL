function fnConsultarProveedores() {
    event.preventDefault();     // Evita el comportamiento por defecto del botón de Consultar

    if (document.getElementById('nombre').value != ''
        || document.getElementById('descripcion').value != ''
        || document.getElementById('direccion').value != ''
        || document.getElementById('localidad').value != ''
        || document.getElementById('provincia').value != ''
        || document.getElementById('telefono1').value != ''
        || document.getElementById('telefono2').value != ''
        || document.getElementById('email').value != ''
        || document.getElementById('cuit').value) {
        var nombre = document.getElementById('nombre').value;
        var descripcion = document.getElementById('descripcion').value;
        var direccion = document.getElementById('direccion').value;
        var localidad = document.getElementById('localidad').value;
        var provincia = document.getElementById('provincia').value;
        var telefono1 = document.getElementById('telefono1').value;
        var telefono2 = document.getElementById('telefono2').value;
        var email = document.getElementById('email').value;
        var cuit = document.getElementById('cuit').value;

        var formData = new FormData();
        formData.append('nombre', nombre);
        formData.append('descripcion', descripcion);
        formData.append('direccion', direccion);
        formData.append('localidad', localidad);
        formData.append('provincia', provincia);
        formData.append('telefono1', telefono1);
        formData.append('telefono2', telefono2);
        formData.append('email', email);
        formData.append('cuit', cuit);

        console.log(formData);

        // Enviar la solicitud AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../consulta_proveedores/consultar_proveedores.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log (xhr.response);
                var response = JSON.parse(xhr.response);    // Parsea la respuesta del JSON enviado de la consulta del PHP
                var tablaResultados = document.getElementById('tabla-body-proveedores');

                tablaResultados.innerHTML = '';             // Limpiar la tabla antes de agregar nuevas filas

                if (response.status === 'success' && response.message.includes("Proveedores agregados correctamente")) {
                    response.data.forEach(function (proveedor) {                                                     // Devuelve los datos para cada arreglo de Artículos
                        var nuevaFila = tablaResultados.insertRow(-1);

                        // Inserta las celdas para asignar los valores
                        var celdaNombre = nuevaFila.insertCell(0);
                        var celdaDescripcion = nuevaFila.insertCell(1);
                        var celdaDireccion = nuevaFila.insertCell(2);
                        var celdaLocalidad = nuevaFila.insertCell(3);
                        var celdaProvincia = nuevaFila.insertCell(4);
                        var celdaTelefono1 = nuevaFila.insertCell(5);
                        var celdaTelefono2 = nuevaFila.insertCell(6);
                        var celdaEmail = nuevaFila.insertCell(7);
                        var celdaCuit = nuevaFila.insertCell(8);
                        var celdaActivo = nuevaFila.insertCell(9);

                        // Asigna los valores a cada celda
                        celdaNombre.innerHTML = proveedor.nombre || 'No disponible';
                        celdaDescripcion.innerHTML = proveedor.descripcion || 'No disponible';
                        celdaDireccion.innerHTML = proveedor.direccion || 'No disponible';
                        celdaLocalidad.innerHTML = proveedor.localidad || 'No disponible';
                        celdaProvincia.innerHTML = proveedor.provincia || 'No disponible';
                        celdaTelefono1.innerHTML = proveedor.tel1 || 'No disponible';
                        celdaTelefono2.innerHTML = proveedor.tel2 || 'No disponible';
                        celdaEmail.innerHTML = proveedor.email || 'No disponible';
                        celdaCuit.innerHTML = proveedor.cuit || 'No disponible';
                        celdaActivo.innerHTML = proveedor.activo || 'No disponible';

                        // Setea los ids y clases de cada celda para el reporte
                        celdaNombre.setAttribute('id','proveedor-nombre');
                        celdaDescripcion.setAttribute('id','proveedor-descripcion');
                        celdaDireccion.setAttribute('id','proveedor-direccion');
                        celdaLocalidad.setAttribute('id','proveedor-localidad');
                        celdaProvincia.setAttribute('id','proveedor-provincia');
                        celdaTelefono1.setAttribute('id','proveedor-telefono1');
                        celdaTelefono2.setAttribute('id','proveedor-telefono2');
                        celdaEmail.setAttribute('id','proveedor-email');
                        celdaCuit.setAttribute('id','proveedor-cuit');
                        celdaActivo.setAttribute('id','proveedor-activo');

                        celdaNombre.classList.add('proveedor-nombre');
                        celdaDescripcion.classList.add('proveedor-descripcion');
                        celdaDireccion.classList.add('proveedor-direccion');
                        celdaLocalidad.classList.add('proveedor-localidad');
                        celdaProvincia.classList.add('proveedor-provincia');
                        celdaTelefono1.classList.add('proveedor-telefono1');
                        celdaTelefono2.classList.add('proveedor-telefono2');
                        celdaEmail.classList.add('proveedor-email');
                        celdaCuit.classList.add('proveedor-cuit');
                        celdaActivo.classList.add('proveedor-activo');

                    });
                } else if (response.status === 'success' && response.message.includes("No hay proveedores")) {        // No hay artículos a Mostrar
                    var nuevaFila = tablaResultados.insertRow(-1);
                    var celdaSinProveedores = nuevaFila.insertCell(0);
                    celdaSinProveedores.textContent = response.message || 'No disponible';
                    celdaSinProveedores.colSpan = 10;                                                                  // Combinar celdas
                    celdaSinProveedores.style.textAlign = "center";                                                   // Alinear texto al Centro
                    celdaSinProveedores.setAttribute('id','proveedor-no-encontrado');
                } else {                                                                    // Error en los datos
                    var nuevaFila = tablaResultados.insertRow(-1);
                    var celdaError = nuevaFila.insertCell(0);
                    celdaError.textContent = 'Hubo un Error en la consulta.';
                    celdaError.colSpan = 10;
                    celdaError.style.textAlign = "center";
                }
            }
        };
        xhr.send(formData);
    } else {
        alert('Por favor, ingrese algún dato.');
    }
}