function fnModificarcategoria() {
    // Obtener los valores de los campos
    var padretipo = document.getElementById("padretipo-categoria-modificacion-input").value;
    var nombrecategoria = document.getElementById("nombre-categoria-modificacion-input").value;
    var renombrecategoria = document.getElementById("renombre-categoria-modificacion-input").value;
    var descripcioncategoria = document.getElementById("descripcion-categoria-modificacion-input").value;

    // Verificar si algún campo está vacío
    if (padretipo == '' || nombrecategoria == '' || renombrecategoria == '' || descripcioncategoria == '') {
        alert("No se han completado algunos campos. Por favor, complételos para poder continuar.");
        return;
    }

    // Confirmar la creación del categoria
    if (!confirm("¿Desea Modificar el categoria " + nombrecategoria + " con los valores ingresados?")) {
        return;
    }

    // Crear objeto FormData para enviar los datos al archivo PHP
    var formData = new FormData();
    formData.append('padretipo', padretipo);
    formData.append('nombrecategoria', nombrecategoria);
    formData.append('renombrecategoria', renombrecategoria);
    formData.append('descripcioncategoria', descripcioncategoria);


    // Enviar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../abmcategorias/modificarcategoria/modificar_categoria.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText); // Muestra la respuesta del servidor
        }
    };
    xhr.send(formData);
}