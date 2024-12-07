function fnConsultarUsuarios() {
    event.preventDefault();     // Evita el comportamiento por defecto del botón de Consultar

    if (document.getElementById('username').value != ''
        || document.getElementById('tipo-permiso').value != ''
        || document.getElementById('nombre').value != ''
        || document.getElementById('apellido').value != ''
        || document.getElementById('id').value != ''
        || document.getElementById('direccion').value != ''
        || document.getElementById('sucursal').value != ''
        || document.getElementById('email').value != '') {
        var userName = document.getElementById('username').value;
        var tipoPermiso = document.getElementById('tipo-permiso').value;
        var nombre = document.getElementById('nombre').value;
        var apellido = document.getElementById('apellido').value;
        var id = document.getElementById('id').value;
        var direccion = document.getElementById('direccion').value;
        var sucursal = document.getElementById('sucursal').value;
        var email = document.getElementById('email').value;

        var formData = new FormData();
        formData.append('id', id);
        formData.append('username', userName);
        formData.append('tipo-permiso', tipoPermiso);
        formData.append('nombre', nombre);
        formData.append('apellido', apellido);
        formData.append('direccion', direccion);
        formData.append('sucursal', sucursal);
        formData.append('email', email);

        console.log(formData);

        // Enviar la solicitud AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../consulta_usuarios/consultar_usuarios.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log (xhr.response);
                var response = JSON.parse(xhr.response);    // Parsea la respuesta del JSON enviado de la consulta del PHP
                var tablaResultados = document.getElementById('tabla-body-usuarios');

                tablaResultados.innerHTML = '';             // Limpiar la tabla antes de agregar nuevas filas

                if (response.status === 'success' && response.message.includes("Usuarios agregados correctamente")) {
                    response.data.forEach(function (usuario) {                                                     // Devuelve los datos para cada arreglo de Artículos
                        var nuevaFila = tablaResultados.insertRow(-1);

                        // Inserta las celdas para asignar los valores
                        var celdaId = nuevaFila.insertCell(0);
                        var celdaUserName = nuevaFila.insertCell(1);
                        var celdaTipoPermiso = nuevaFila.insertCell(2);
                        var celdaNombre = nuevaFila.insertCell(3);
                        var celdaApellido = nuevaFila.insertCell(4);
                        var celdaDireccion = nuevaFila.insertCell(5);
                        var celdaSucursal = nuevaFila.insertCell(6);
                        var celdaEmail = nuevaFila.insertCell(7);
                        var celdaActivo = nuevaFila.insertCell(8);

                        // Asigna los valores a cada celda
                        celdaId.innerHTML = usuario.id || 'No disponible';
                        celdaUserName.innerHTML = usuario.username || 'No disponible';
                        celdaTipoPermiso.innerHTML = usuario.tipopermiso || 'No disponible';
                        celdaNombre.innerHTML = usuario.nombre || 'No disponible';
                        celdaApellido.innerHTML = usuario.apellido || 'No disponible';
                        celdaDireccion.innerHTML = usuario.direccion || 'No disponible';
                        celdaSucursal.innerHTML = usuario.sucursal || 'No disponible';
                        celdaEmail.innerHTML = usuario.email || 'No disponible';
                        celdaActivo.innerHTML = usuario.activo || 'No disponible';

                        // Setea los ids y clases de cada celda para el reporte
                        celdaId.setAttribute('id','usuario-id');
                        celdaUserName.setAttribute('username','usuario-username');
                        celdaTipoPermiso.setAttribute('tipo-permiso','usuario-tipo-permiso');
                        celdaNombre.setAttribute('nombre','usuario-nombre');
                        celdaApellido.setAttribute('apellido','usuario-apellido');
                        celdaDireccion.setAttribute('direccion','usuario-direccion');
                        celdaSucursal.setAttribute('sucursal','usuario-sucursal');
                        celdaEmail.setAttribute('email','usuario-email');
                        celdaActivo.setAttribute('email','usuario-activo');

                        celdaId.classList.add('usuario-id');
                        celdaUserName.classList.add('usuario-username');
                        celdaTipoPermiso.classList.add('usuario-tipo-permiso');
                        celdaNombre.classList.add('usuario-nombre');
                        celdaApellido.classList.add('usuario-apellido');
                        celdaDireccion.classList.add('usuario-direccion');
                        celdaSucursal.classList.add('usuario-sucursal');
                        celdaEmail.classList.add('usuario-email');
                        celdaActivo.classList.add('usuario-activo');
                    });
                } else if (response.status === 'success' && response.message.includes("No hay usuarios")) {        // No hay artículos a Mostrar
                    var nuevaFila = tablaResultados.insertRow(-1);
                    var celdaSinUsuarios = nuevaFila.insertCell(0);
                    celdaSinUsuarios.textContent = response.message || 'No disponible';
                    celdaSinUsuarios.colSpan = 9;                                                                  // Combinar celdas
                    celdaSinUsuarios.style.textAlign = "center";                                                   // Alinear texto al Centro
                    celdaSinUsuarios.setAttribute('id','usuario-no-encontrado');
                } else {                                                                    // Error en los datos
                    var nuevaFila = tablaResultados.insertRow(-1);
                    var celdaError = nuevaFila.insertCell(0);
                    celdaError.textContent = 'Hubo un Error en la consulta.';
                    celdaError.colSpan = 9;
                    celdaError.style.textAlign = "center";
                }
            }
        };
        xhr.send(formData);
    } else {
        alert('Por favor, ingrese algún dato.');
    }
}