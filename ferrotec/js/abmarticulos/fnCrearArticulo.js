//  Función: fnCrearArticulo()
//  Descripción: Función que envía el formulario a la base de datos para Crear un Artículo
//  A partir de validaciones iniciales
//  Valida si hay campos vacíos
//  Verifica si el precio ingresado es correcto
//  Confirma si se desea envíar el formulario
//  Envía los datos a insertar_articulo.php para insertar los datos del artículo
//

function fnCrearArticulo() {

    //  Función: fnValidarNumeros(cadena)
    //  Descripción: Verifica que se haya ingresado un número en el campo Precio
    // 

    function fnValidarNumeros(cadena){
        const numero = Number(cadena);
        return Number.isInteger(numero);
    }

    // Obtener los valores de los campos
    var nombreArticulo = document.getElementById("nombre-articulo-alta-input").value;
    var marcaArticulo = document.getElementById("marca-articulo-alta-input").value;
    var descripcionArticulo = document.getElementById("descripcion-articulo-alta-input").value;
    var precioArticulo = document.getElementById("precio-articulo-alta-input").value;
    var catArticulo = document.getElementById("cat-articulo-alta-input").value;

    // Verifica si no se ingresaron todos los campos
    if( nombreArticulo != ''
        && marcaArticulo != ''
        && descripcionArticulo != ''
        && precioArticulo != ''
        && catArticulo != ''){
            // Verifica si no se ingresó al menos un campo
            if( nombreArticulo != ''
                || marcaArticulo != ''
                || descripcionArticulo != ''
                || precioArticulo != ''
                || catArticulo != ''){
                    // Verifica si el precio ingresado es correcto
                    if(fnValidarNumeros(precioArticulo) == true){
                        // Confirmar el alta del articulo
                        if (!confirm("¿Desea Crear el Articulo " + nombreArticulo + "?")) {
                            return;
                        }
    
                        // Crear objeto FormData para enviar los datos al archivo PHP
                        var formData = new FormData();
                        formData.append('nombreArticulo', nombreArticulo);
                        formData.append('marcaArticulo', marcaArticulo);
                        formData.append('descripcionArticulo', descripcionArticulo);
                        formData.append('precioArticulo', precioArticulo);
                        formData.append('catArticulo', catArticulo);
    
                        // Enviar la solicitud AJAX
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "../abmarticulos/altaarticulo/insertar_articulo.php", true);
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                var respuesta = xhr.responseText; // Obtener la respuesta del servidor
                                alert(respuesta); // Mostrar la respuesta del servidor
    
                                // Verificar si la respuesta indica que el artículo se creó correctamente
                                if (respuesta.includes("creado correctamente")) {
                                    document.getElementById("nombre-articulo-alta-input").value = "";
                                    document.getElementById("marca-articulo-alta-input").value = "";
                                    document.getElementById("descripcion-articulo-alta-input").value = "";
                                    document.getElementById("precio-articulo-alta-input").value = "";
                                    document.getElementById("cat-articulo-alta-input").value = "";
                                }
                            }
                        };
                        xhr.send(formData);
                    }
                    else{
                        // El precio ingresado es incorrecto
                        alert('Por favor ingrese un precio válido.');
                    }
            }
            else{
                // No se ingresó al menos un campo
                alert('Por favor complete todos los campos.');
            }
    }
    else{
        // No se ingresaron todos los campos
        alert('Por favor complete todos los campos.');
    }
}

