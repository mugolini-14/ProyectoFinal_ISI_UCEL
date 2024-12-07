//  Función: fnModificarArticulo()
//  Descripción: Función que envía el formulario a la base de datos para Modificar un Artículo
//  A partir de validaciones iniciales
//  Valida si hay campos vacíos
//  Verifica si el precio ingresado es correcto
//  Confirma si se desea envíar el formulario
//  Envía los datos a modificar_articulo.php para actualizar los datos del artículo
//

function fnModificarArticulo() {
    // Obtener los valores de los campos
    
    //  Función: fnValidarNumeros(cadena)
    //  Descripción: Función que verifica que se haya ingresado un número en el campo Precio
    // 

    function fnValidarNumeros(cadena){
        const numero = Number(cadena);
        return Number.isInteger(numero);
    }

    var nombreArticulo = document.getElementById("nombre-articulo-modificacion-input").value;
    var renombreArticulo = document.getElementById("renombre-articulo-modificacion-input").value;
    var marcaArticulo = document.getElementById("marca-articulo-modificacion-input").value;
    var descripcionArticulo = document.getElementById("descripcion-articulo-modificacion-input").value;
    var precioArticulo = document.getElementById("precio-articulo-modificacion-input").value;
    var catArticulo = document.getElementById("cat-articulo-modificacion-input").value;
    var estadoArticulo = document.getElementById("acciones-estado-modificacion-articulo").value;

    // Verifica si no se ingresaron todos los campos
    if( nombreArticulo != ''
        && renombreArticulo != ''
        && marcaArticulo != ''
        && descripcionArticulo != ''
        && precioArticulo != ''
        && catArticulo != ''){
            // Verifica que no se ingreso al menos un campo
            if( nombreArticulo != ''
                || renombreArticulo != ''
                || marcaArticulo != ''
                || descripcionArticulo != ''
                || precioArticulo != ''
                || catArticulo != ''){
                    // Verifica que el precio ingresado sea correcto
                    if(fnValidarNumeros(precioArticulo)== true){
                        if(estadoArticulo != ''){
                            // Confirmar la modificación del articulo
                            if (!confirm("¿Desea Modificar el Articulo " + nombreArticulo + " con los valores ingresados?")) {
                                return;
                            }

                            // Crear objeto FormData para enviar los datos al archivo PHP
                            var formData = new FormData();
                            formData.append('nombreArticulo', nombreArticulo);
                            formData.append('renombreArticulo', renombreArticulo);
                            formData.append('marcaArticulo', marcaArticulo);
                            formData.append('descripcionArticulo', descripcionArticulo);
                            formData.append('precioArticulo', precioArticulo);
                            formData.append('catArticulo', catArticulo);
                            formData.append('estadoArticulo', estadoArticulo);

                            // Enviar la solicitud AJAX
                            var xhr = new XMLHttpRequest();
                            xhr.open("POST", "../abmarticulos/modificararticulo/modificar_articulo.php", true);
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                    
                                    alert(xhr.responseText); // Muestra la respuesta del servidor
                                }
                            };
                            xhr.send(formData); 
                        }
                        else{
                            alert('Por favor seleccione un estado.');
                        }
                    }
                    else{
                        // No se ingreso un precio correcto
                        alert('El precio ingresado no es válido.'); 
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