function fnModificartipo() {
    // Obtener los valores de los campos
    var nombretipo = document.getElementById("nombre-tipo-modificacion-input").value;
    var renombretipo = document.getElementById("renombre-tipo-modificacion-input").value;
    var descripciontipo = document.getElementById("descripcion-tipo-modificacion-input").value;

    // Verificar si algún campo está vacío
    if (nombretipo == '' || renombretipo == '' || descripciontipo == '') {
        alert("No se han completado algunos campos. Por favor, complételos para poder continuar.");
        return;
    }

    // Confirmar la creación del tipo
    if (!confirm("¿Desea Modificar el tipo " + nombretipo + " con los valores ingresados?")) {
        return;
    }

    // Crear objeto FormData para enviar los datos al archivo PHP
    var formData = new FormData();
    formData.append('nombretipo', nombretipo);
    formData.append('renombretipo', renombretipo);
    formData.append('descripciontipo', descripciontipo);


    // Enviar la solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../abmtipos/modificartipo/modificar_tipo.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText); // Muestra la respuesta del servidor
        }
    };
    xhr.send(formData);
}