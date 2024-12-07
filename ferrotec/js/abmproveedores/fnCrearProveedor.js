//  Función: fnCrearProveedor()
//  Descripción: Función que envía el formulario a la base de datos para Insertar un Proveedor
//  A partir de validaciones iniciales
//  Valida si hay campos vacíos
//  Valida números en Teléfonos y el Formato del E-mail
//  Confirma si se desea envíar el formulario
//

function fnCrearProveedor() {

    //  Función: fnValidarNumeros(cadena)
    //  Descripción: Verifica que se haya ingresado un número en los campos Telefono 1, Teléfono 2 y CUIT
    // 

    function fnValidarNumeros(cadena){
        const numero = Number(cadena);
        return Number.isInteger(numero);
    }

    //  Función: fnValidarEmail(email)
    //  Descripción: Valida que el texto ingresado en el campo email sea válido
    //               Mediante expresiones regulares
    //               Verifica que la cadena del campo email cumpla con la expresión determinada
    //               (texto_nombre(n) + "@" + texto_dominio(n) + "." + texto(2))
    //  Parámetros:
    //  - email:     Cadena de texto del email ingresado por el usuario

    function fnValidarEmail(email) {
        const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return regex.test(email);
    }

    // Obtener los valores de los campos
    var nombreProveedor = document.getElementById("nombre-proveedor-alta-input").value;
    var descripcionProveedor = document.getElementById("descripcion-proveedor-alta-input").value;
    var direccionProveedor = document.getElementById("direccion-proveedor-alta-input").value;
    var localidadProveedor = document.getElementById("localidad-proveedor-alta-input").value;
    var provinciaProveedor = document.getElementById("provincia-proveedor-alta-input").value;
    var telefono1Proveedor = document.getElementById("telefono1-proveedor-alta-input").value;
    var telefono2Proveedor = document.getElementById("telefono2-proveedor-alta-input").value;
    var emailProveedor = document.getElementById("email-proveedor-alta-input").value;
    var cuitProveedor = document.getElementById("cuit-proveedor-alta-input").value;

    // Verifica si todos los campos están vacíos
    if( nombreProveedor != ''
        && descripcionProveedor != ''
        && direccionProveedor != ''
        && localidadProveedor != ''
        && provinciaProveedor != ''
        && telefono1Proveedor != ''
        && telefono2Proveedor != ''
        && emailProveedor != ''
        && cuitProveedor != ''){
            // Verifica si al menos un campo está vacio
            if( nombreProveedor != ''
                || descripcionProveedor != ''
                || direccionProveedor != ''
                || localidadProveedor != ''
                || provinciaProveedor != ''
                || telefono1Proveedor != ''
                || telefono2Proveedor != ''
                || emailProveedor != ''
                || cuitProveedor != ''){
                    // Verifica que los campos Teléfono 1 y Teléfono 2 tengan números
                    if(fnValidarNumeros(telefono1Proveedor) == true
                    && fnValidarNumeros(telefono2Proveedor) == true){
                        if(fnValidarNumeros(telefono1Proveedor) == true
                        || fnValidarNumeros(telefono2Proveedor) == true){
                            // Verifica que el campo e-mail esté validado
                            if(fnValidarEmail(emailProveedor)== true){
                                // Verifica que el campo CUIT esté validado
                                if(fnValidarNumeros(cuitProveedor)== true){
                                    // Confirmar la creación del Proveedor
                                    if (!confirm("¿Desea Crear el Proveedor " + nombreProveedor + "?")) {
                                        return;
                                    }

                                    // Crear objeto FormData para enviar los datos al archivo PHP
                                    var formData = new FormData();
                                    formData.append('nombreProveedor', nombreProveedor);
                                    formData.append('descripcionProveedor', descripcionProveedor);
                                    formData.append('direccionProveedor', direccionProveedor);
                                    formData.append('localidadProveedor', localidadProveedor);
                                    formData.append('provinciaProveedor', provinciaProveedor);
                                    formData.append('telefono1Proveedor', telefono1Proveedor);
                                    formData.append('telefono2Proveedor', telefono2Proveedor);
                                    formData.append('emailProveedor', emailProveedor);
                                    formData.append('cuitProveedor', cuitProveedor);

                                    // Enviar la solicitud AJAX
                                    var xhr = new XMLHttpRequest();
                                    xhr.open("POST", "../abmproveedores/altaproveedor/insertar_proveedor.php", true);
                                    xhr.onreadystatechange = function() {
                                        if (xhr.readyState === 4 && xhr.status === 200) {
                                            var respuesta = xhr.responseText; // Obtener la respuesta del servidor
                                            alert(respuesta); // Mostrar la respuesta del servidor

                                            // Verificar si la respuesta indica que el artículo se creó correctamente y si es así limpiar los campos
                                            if (respuesta.includes("creado correctamente")) {
                                                document.getElementById("nombre-proveedor-alta-input").value = "";
                                                document.getElementById("descripcion-proveedor-alta-input").value = "";
                                                document.getElementById("direccion-proveedor-alta-input").value = "";
                                                document.getElementById("localidad-proveedor-alta-input").value = "";
                                                document.getElementById("provincia-proveedor-alta-input").value = "";
                                                document.getElementById("telefono1-proveedor-alta-input").value = "";
                                                document.getElementById("telefono2-proveedor-alta-input").value = "";
                                                document.getElementById("email-proveedor-alta-input").value = "";
                                                document.getElementById("cuit-proveedor-alta-input").value = "";
                                            }
                                        }
                                    };
                                    xhr.send(formData);
                                }
                                else{
                                    alert('Por favor ingrese un CUIT válido.');
                                }
                            }
                            else{
                                alert('Por favor ingrese un correo válido.');
                            }
                        }
                        else{
                            alert('Por favor ingrese teléfonos válidos.');
                        }
                    }
                    else{
                        alert('Por favor ingrese teléfonos válidos.');
                    }
            }
            else{
                alert('Por favor complete todos los campos.');
            }
    }
    else{
        alert('Por favor complete todos los campos.');
    }

}


