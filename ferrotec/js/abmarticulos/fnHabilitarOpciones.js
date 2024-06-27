// fnHabilitarOpciones
// Descripción: Función que habilita los diferentes formularios según la acción a realizar

function fnHabilitarOpciones(codigoaccion){ 
    if(codigoaccion==0){ // Inicialización / Seleccione

        // Filas de Alta
        document.getElementById("nombre-articulo-alta-fila").style.display = "none";
        document.getElementById("marca-articulo-alta-fila").style.display = "none";
        document.getElementById("descripcion-articulo-alta-fila").style.display = "none";
        document.getElementById("precio-articulo-alta-fila").style.display = "none";
        document.getElementById("tipo-articulo-alta-fila").style.display = "none";
        document.getElementById("botones-alta-fila").style.display = "none";

        // Filas de Baja
        document.getElementById("nombre-articulo-baja-fila").style.display = "none";
        document.getElementById("botones-baja-fila").style.display = "none";
        
        // Filas de Modificaciòn
        document.getElementById("nombre-articulo-modificacion-fila").style.display = "none";
        document.getElementById("renombre-articulo-modificacion-fila").style.display = "none";
        document.getElementById("marca-articulo-modificacion-fila").style.display = "none";
        document.getElementById("descripcion-articulo-modificacion-fila").style.display = "none";
        document.getElementById("precio-articulo-modificacion-fila").style.display = "none";
        document.getElementById("tipo-articulo-modificacion-fila").style.display = "none";
        document.getElementById("botones-modificacion-fila").style.display = "none";
        
        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = '';
    }

    if(codigoaccion==1){ // Alta

        // Filas de Alta
        document.getElementById("nombre-articulo-alta-fila").style.display = '';
        document.getElementById("marca-articulo-alta-fila").style.display = '';
        document.getElementById("descripcion-articulo-alta-fila").style.display = '';
        document.getElementById("precio-articulo-alta-fila").style.display = '';
        document.getElementById("tipo-articulo-alta-fila").style.display = '';
        document.getElementById("botones-alta-fila").style.display = '';

        // Filas de Baja
        document.getElementById("nombre-articulo-baja-fila").style.display = 'none';
        document.getElementById("botones-baja-fila").style.display = 'none';

        // Filas de Modificación
        document.getElementById("nombre-articulo-modificacion-fila").style.display = "none";
        document.getElementById("renombre-articulo-modificacion-fila").style.display = "none";
        document.getElementById("marca-articulo-modificacion-fila").style.display = "none";
        document.getElementById("descripcion-articulo-modificacion-fila").style.display = "none";
        document.getElementById("precio-articulo-modificacion-fila").style.display = "none";
        document.getElementById("tipo-articulo-modificacion-fila").style.display = "none";
        document.getElementById("botones-modificacion-fila").style.display = "none";

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";

        // Funciones a habilitar por defecto

        fnHabilitarPerfilUsuario('A',0);
        fnPerfilesDeUsuario('A',0);
    }

    if(codigoaccion==2){  // Baja

        // Filas de Alta
        document.getElementById("nombre-articulo-alta-fila").style.display = "none";
        document.getElementById("marca-articulo-alta-fila").style.display = "none";
        document.getElementById("descripcion-articulo-alta-fila").style.display = "none";
        document.getElementById("precio-articulo-alta-fila").style.display = "none";
        document.getElementById("tipo-articulo-alta-fila").style.display = "none";
        document.getElementById("botones-alta-fila").style.display = "none";

        // Filas de Baja
        document.getElementById("nombre-articulo-baja-fila").style.display = '';
        document.getElementById("botones-baja-fila").style.display = '';

        // Filas de Modificación
        document.getElementById("nombre-articulo-modificacion-fila").style.display = "none";
        document.getElementById("renombre-articulo-modificacion-fila").style.display = "none";
        document.getElementById("marca-articulo-modificacion-fila").style.display = "none";
        document.getElementById("descripcion-articulo-modificacion-fila").style.display = "none";
        document.getElementById("precio-articulo-modificacion-fila").style.display = "none";
        document.getElementById("tipo-articulo-modificacion-fila").style.display = "none";
        document.getElementById("botones-modificacion-fila").style.display = "none";

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";
    }
    
    if(codigoaccion==3){ // Modificación

        // Filas de Alta
        document.getElementById("nombre-articulo-alta-fila").style.display = "none";
        document.getElementById("marca-articulo-alta-fila").style.display = "none";
        document.getElementById("descripcion-articulo-alta-fila").style.display = "none";
        document.getElementById("precio-articulo-alta-fila").style.display = "none";
        document.getElementById("tipo-articulo-alta-fila").style.display = "none";
        document.getElementById("botones-alta-fila").style.display = "none";

        // Filas de Baja
        document.getElementById("nombre-articulo-baja-fila").style.display = "none";
        document.getElementById("botones-baja-fila").style.display = "none";

        // Filas de Modificación
        document.getElementById("nombre-articulo-modificacion-fila").style.display = '';
        document.getElementById("renombre-articulo-modificacion-fila").style.display = '';
        document.getElementById("marca-articulo-modificacion-fila").style.display = '';
        document.getElementById("descripcion-articulo-modificacion-fila").style.display = '';
        document.getElementById("precio-articulo-modificacion-fila").style.display = '';
        document.getElementById("tipo-articulo-modificacion-fila").style.display = '';
        document.getElementById("botones-modificacion-fila").style.display = '';

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";

        // Funciones a habilitar por defecto

        fnHabilitarPerfilUsuario('M',0);
        fnPerfilesDeUsuario('M',0);
    }
  }