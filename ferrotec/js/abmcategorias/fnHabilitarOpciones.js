// fnHabilitarOpciones
// Descripción: Función que habilita los diferentes formularios según la acción a realizar

function fnHabilitarOpciones(codigoaccion){ 
    if(codigoaccion==0){ // Inicialización / Seleccione

        // Filas de Alta
        document.getElementById("padretipo-categoria-alta-fila").style.display = "none";
        document.getElementById("nombre-categoria-alta-fila").style.display = "none";
        document.getElementById("descripcion-categoria-alta-fila").style.display = "none";
        document.getElementById("botones-alta-fila").style.display = "none";

        // Filas de Baja
        document.getElementById("nombre-categoria-baja-fila").style.display = "none";
        document.getElementById("botones-baja-fila").style.display = "none";
        
        // Filas de Modificaciòn
        document.getElementById("padretipo-categoria-modificacion-fila").style.display = "none";
        document.getElementById("nombre-categoria-modificacion-fila").style.display = "none";
        document.getElementById("renombre-categoria-modificacion-fila").style.display = "none";
        document.getElementById("descripcion-categoria-modificacion-fila").style.display = "none"
        document.getElementById("botones-modificacion-fila").style.display = "none";
        
        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = '';
    }

    if(codigoaccion==1){ // Alta

        // Filas de Alta
        document.getElementById("padretipo-categoria-alta-fila").style.display = '';
        document.getElementById("nombre-categoria-alta-fila").style.display = '';
        document.getElementById("descripcion-categoria-alta-fila").style.display = '';
        document.getElementById("botones-alta-fila").style.display = '';

        // Filas de Baja
        document.getElementById("nombre-categoria-baja-fila").style.display = 'none';
        document.getElementById("botones-baja-fila").style.display = 'none';

        // Filas de Modificación
        document.getElementById("padretipo-categoria-modificacion-fila").style.display = "none";
        document.getElementById("nombre-categoria-modificacion-fila").style.display = "none";
        document.getElementById("renombre-categoria-modificacion-fila").style.display = "none";
        document.getElementById("descripcion-categoria-modificacion-fila").style.display = "none";
        document.getElementById("botones-modificacion-fila").style.display = "none";

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";

        // Funciones a habilitar por defecto

        fnHabilitarPerfilcategoria('A',0);
        fnPerfilesDecategoria('A',0);
    }

    if(codigoaccion==2){  // Baja

        // Filas de Alta
        document.getElementById("padretipo-categoria-alta-fila").style.display = "none";
        document.getElementById("nombre-categoria-alta-fila").style.display = "none";
        document.getElementById("descripcion-categoria-alta-fila").style.display = "none";
        document.getElementById("botones-alta-fila").style.display = "none";

        // Filas de Baja
        document.getElementById("nombre-categoria-baja-fila").style.display = '';
        document.getElementById("botones-baja-fila").style.display = '';

        // Filas de Modificación
        document.getElementById("padretipo-categoria-modificacion-fila").style.display = "none";
        document.getElementById("nombre-categoria-modificacion-fila").style.display = "none";
        document.getElementById("renombre-categoria-modificacion-fila").style.display = "none";
        document.getElementById("descripcion-categoria-modificacion-fila").style.display = "none";
        document.getElementById("botones-modificacion-fila").style.display = "none";

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";
    }
    
    if(codigoaccion==3){ // Modificación

        // Filas de Alta
        document.getElementById("padretipo-categoria-alta-fila").style.display = "none";
        document.getElementById("nombre-categoria-alta-fila").style.display = "none";
        document.getElementById("descripcion-categoria-alta-fila").style.display = "none";
        document.getElementById("botones-alta-fila").style.display = "none";

        // Filas de Baja
        document.getElementById("nombre-categoria-baja-fila").style.display = "none";
        document.getElementById("botones-baja-fila").style.display = "none";

        // Filas de Modificación
        document.getElementById("padretipo-categoria-modificacion-fila").style.display = '';
        document.getElementById("nombre-categoria-modificacion-fila").style.display = '';
        document.getElementById("renombre-categoria-modificacion-fila").style.display = '';
        document.getElementById("descripcion-categoria-modificacion-fila").style.display = '';
        document.getElementById("botones-modificacion-fila").style.display = '';

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";

        // Funciones a habilitar por defecto

        fnHabilitarPerfilcategoria('M',0);
        fnPerfilesDecategoria('M',0);
    }
  }