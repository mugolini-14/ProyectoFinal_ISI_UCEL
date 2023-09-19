//  fnCrearUsuario
//  Descripción: Función que envía el formulario a la base de datos para crear un Nuevo Usuario
//  A partir de validaciones iniciales
//  Valida si hay campos vacíos o sin seleccionar en el formulario de Alta
//  Si están todos completos envía el formulario con los datos sumnistrados

function fnCrearUsuario(){
    // Verifica que haya escrito un Usuario
    if (document.getElementById("nombre-usuario-alta-input").value == ''){
        alert("Por favor escriba un nombre de usuario.");
    }
    // Verifica que el Usuario esté bien escrito y que los accesos estén seleccionados
    else if (   document.getElementById("nombre-usuario-alta-input").value == '' ||
                document.getElementById("perfil-acceso-alta-usuario-opciones").value == '0' ||
                document.getElementById("acceso-ventas-alta-opciones").value == '0' ||
                document.getElementById("acceso-compras-alta-opciones").value == '0' ||
                document.getElementById("acceso-informes-alta-opciones").value == '0' ||
                document.getElementById("acceso-consultas-alta-opciones").value == '0' ||
                document.getElementById("acceso-usuarios-alta-opciones").value == '0'
            ){
                alert("No se han completado algunos campos. Por favor, complételos para poder continuar.");
    }
    else {
        if(confirm("¿Desea Crear el Usuario " + document.getElementById("nombre-usuario-alta-input").value + "?")) {
            document.getElementById("formulario-alta").submit();
            alert("Usuario " + document.getElementById("nombre-usuario-alta-input").value + " creado con éxito."); 
        } 
        else{   
            // Botón Cancelar sin Hacer Alta
            // Hacer Nada
        }
    }
}