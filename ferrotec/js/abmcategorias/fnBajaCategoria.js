//  Función: fnBajacategoria()
//  Descripción: Función que envía el formulario a la base de datos para Dar de Baja una Categoría de Artículo
//  A partir de validaciones iniciales
//  Valida si hay un articulo escrito en el Formulario
//  Si está escrito envía el formulario con los datos sumnistrados
//

function fnBajacategoria(){
    var nombrecategoria = document.getElementById("nombre-categoria-baja-input").value;
    if(nombrecategoria == ''){
        alert("Por favor seleccione una categoria para dar de baja.");
    }
    else{
        if(confirm("¿Desea Dar de Baja al categoria " + nombrecategoria + "?")) {
            var formData = new FormData();
            formData.append('nombrecategoria', nombrecategoria);

            // Enviar la solicitud AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../abmcategorias/bajacategoria/baja_categoria.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText); // Muestra la respuesta del servidor

                    // Después de la eliminación. Limpio el campo de Nombre de categoria a borrar
                    document.getElementById("nombre-categoria-baja-input").value = "";
                }
            };
            xhr.send(formData);
        }
        else{
            //  Cancelar Sin Hacer Cambios
            //  No Hacer Nada
        } 
    }
}