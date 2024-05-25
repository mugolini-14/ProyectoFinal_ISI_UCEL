// fnHabilitarOpciones
// Descripción: Función que habilita los diferentes formularios según la acción a realizar

function fnHabilitarOpciones(codigoaccion){ 
    if(codigoaccion==0){ // Inicialización / Seleccione

        // Filas de Alta
        document.getElementById("nombre-tipo-alta-fila").style.display = "none";
        document.getElementById("descripcion-tipo-alta-fila").style.display = "none";
        document.getElementById("botones-alta-fila").style.display = "none";

        // Filas de Baja
        document.getElementById("nombre-tipo-baja-fila").style.display = "none";
        document.getElementById("botones-baja-fila").style.display = "none";
        
        // Filas de Modificaciòn
        document.getElementById("nombre-tipo-modificacion-fila").style.display = "none";
        document.getElementById("renombre-tipo-modificacion-fila").style.display = "none";
        document.getElementById("descripcion-tipo-modificacion-fila").style.display = "none"
        document.getElementById("botones-modificacion-fila").style.display = "none";
        
        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = '';
    }

    if(codigoaccion==1){ // Alta

        // Filas de Alta
        document.getElementById("nombre-tipo-alta-fila").style.display = '';
        document.getElementById("descripcion-tipo-alta-fila").style.display = '';
        document.getElementById("botones-alta-fila").style.display = '';

        // Filas de Baja
        document.getElementById("nombre-tipo-baja-fila").style.display = 'none';
        document.getElementById("botones-baja-fila").style.display = 'none';

        // Filas de Modificación
        document.getElementById("nombre-tipo-modificacion-fila").style.display = "none";
        document.getElementById("renombre-tipo-modificacion-fila").style.display = "none";
        document.getElementById("descripcion-tipo-modificacion-fila").style.display = "none";
        document.getElementById("botones-modificacion-fila").style.display = "none";

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";

        // Funciones a habilitar por defecto

        fnHabilitarPerfiltipo('A',0);
        fnPerfilesDetipo('A',0);
    }

    if(codigoaccion==2){  // Baja

        // Filas de Alta
        document.getElementById("nombre-tipo-alta-fila").style.display = "none";
        document.getElementById("descripcion-tipo-alta-fila").style.display = "none";
        document.getElementById("botones-alta-fila").style.display = "none";

        // Filas de Baja
        document.getElementById("nombre-tipo-baja-fila").style.display = '';
        document.getElementById("botones-baja-fila").style.display = '';

        // Filas de Modificación
        document.getElementById("nombre-tipo-modificacion-fila").style.display = "none";
        document.getElementById("renombre-tipo-modificacion-fila").style.display = "none";
        document.getElementById("descripcion-tipo-modificacion-fila").style.display = "none";
        document.getElementById("botones-modificacion-fila").style.display = "none";

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";
    }
    
    if(codigoaccion==3){ // Modificación

        // Filas de Alta
        document.getElementById("nombre-tipo-alta-fila").style.display = "none";
        document.getElementById("descripcion-tipo-alta-fila").style.display = "none";
        document.getElementById("botones-alta-fila").style.display = "none";

        // Filas de Baja
        document.getElementById("nombre-tipo-baja-fila").style.display = "none";
        document.getElementById("botones-baja-fila").style.display = "none";

        // Filas de Modificación
        document.getElementById("nombre-tipo-modificacion-fila").style.display = '';
        document.getElementById("renombre-tipo-modificacion-fila").style.display = '';
        document.getElementById("descripcion-tipo-modificacion-fila").style.display = '';
        document.getElementById("botones-modificacion-fila").style.display = '';

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";

        // Funciones a habilitar por defecto

        fnHabilitarPerfiltipo('M',0);
        fnPerfilesDetipo('M',0);
    }
  }