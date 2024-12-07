// fnHabilitarOpciones
// Descripción: Función que habilita los diferentes formularios según la acción a realizar

function fnHabilitarOpciones(codigoaccion){ 
    if(codigoaccion==0){ // Inicialización / Seleccione

        // Filas de Alta
        document.getElementById("nombre-usuario-alta-fila").style.display = "none";
        document.getElementById("nombrepila-usuario-alta-fila").style.display = "none";
        document.getElementById("direccion-usuario-alta-fila").style.display = "none";
        document.getElementById("apellido-usuario-alta-fila").style.display = "none";
        document.getElementById("email-usuario-alta-fila").style.display = "none";
        document.getElementById("perfil-acceso-alta-usuario").style.display = "none";
        document.getElementById("botones-alta-fila").style.display = "none";

        // Filas de Baja
        document.getElementById("nombre-usuario-baja-fila").style.display = "none";
        document.getElementById("botones-baja-fila").style.display = "none";
        
        // Filas de Modificaciòn
        document.getElementById("nombre-usuario-modificacion-fila").style.display = "none";
        document.getElementById("nombrepila-usuario-modificacion-fila").style.display = "none";
        document.getElementById("apellido-usuario-modificacion-fila").style.display = "none";
        document.getElementById("direccion-usuario-modificacion-fila").style.display = "none";
        document.getElementById("email-usuario-modificacion-fila").style.display = "none";
        document.getElementById("perfil-acceso-modificacion-usuario").style.display = "none";
        document.getElementById("botones-modificacion-fila").style.display = "none";
        
        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = '';
    }

    if(codigoaccion==1){ // Alta

        // Filas de Alta
        document.getElementById("nombre-usuario-alta-fila").style.display = '';
        document.getElementById("nombrepila-usuario-alta-fila").style.display = '';
        document.getElementById("direccion-usuario-alta-fila").style.display = '';
        document.getElementById("apellido-usuario-alta-fila").style.display = '';
        document.getElementById("email-usuario-alta-fila").style.display = '';
        document.getElementById("perfil-acceso-alta-usuario").style.display = '';
        document.getElementById("botones-alta-fila").style.display = '';

        // Filas de Baja
        document.getElementById("nombre-usuario-baja-fila").style.display = 'none';
        document.getElementById("botones-baja-fila").style.display = 'none';

        // Filas de Modificación
        document.getElementById("nombre-usuario-modificacion-fila").style.display = "none";
        document.getElementById("nombrepila-usuario-modificacion-fila").style.display = "none";
        document.getElementById("apellido-usuario-modificacion-fila").style.display = "none";
        document.getElementById("direccion-usuario-modificacion-fila").style.display = "none";
        document.getElementById("email-usuario-modificacion-fila").style.display = "none";
        document.getElementById("perfil-acceso-modificacion-usuario").style.display = "none";
        document.getElementById("botones-modificacion-fila").style.display = "none";

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";

    }

    if(codigoaccion==2){  // Baja

        // Filas de Alta
        document.getElementById("nombre-usuario-alta-fila").style.display = "none";
        document.getElementById("nombrepila-usuario-alta-fila").style.display = "none";
        document.getElementById("direccion-usuario-alta-fila").style.display = "none";
        document.getElementById("apellido-usuario-alta-fila").style.display = "none";
        document.getElementById("email-usuario-alta-fila").style.display = "none";
        document.getElementById("perfil-acceso-alta-usuario").style.display = "none";
        document.getElementById("botones-alta-fila").style.display = "none";

        // Filas de Baja
        document.getElementById("nombre-usuario-baja-fila").style.display = '';
        document.getElementById("botones-baja-fila").style.display = '';

        // Filas de Modificación
        document.getElementById("nombre-usuario-modificacion-fila").style.display = "none";
        document.getElementById("nombrepila-usuario-modificacion-fila").style.display = "none";
        document.getElementById("apellido-usuario-modificacion-fila").style.display = "none";
        document.getElementById("direccion-usuario-modificacion-fila").style.display = "none";
        document.getElementById("email-usuario-modificacion-fila").style.display = "none";
        document.getElementById("perfil-acceso-modificacion-usuario").style.display = "none";
        document.getElementById("botones-modificacion-fila").style.display = "none";

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";
    }
    
    if(codigoaccion==3){ // Modificación

        // Filas de Alta
        document.getElementById("nombre-usuario-alta-fila").style.display = "none";
        document.getElementById("nombrepila-usuario-alta-fila").style.display = "none";
        document.getElementById("direccion-usuario-alta-fila").style.display = "none";
        document.getElementById("apellido-usuario-alta-fila").style.display = "none";
        document.getElementById("email-usuario-alta-fila").style.display = "none";
        document.getElementById("perfil-acceso-alta-usuario").style.display = "none";
        document.getElementById("botones-alta-fila").style.display = "none";

        // Filas de Baja
        document.getElementById("nombre-usuario-baja-fila").style.display = "none";
        document.getElementById("botones-baja-fila").style.display = "none";

        // Filas de Modificación
        document.getElementById("nombre-usuario-modificacion-fila").style.display = '';
        document.getElementById("nombrepila-usuario-modificacion-fila").style.display = '';
        document.getElementById("apellido-usuario-modificacion-fila").style.display = '';
        document.getElementById("direccion-usuario-modificacion-fila").style.display = '';
        document.getElementById("email-usuario-modificacion-fila").style.display = '';
        document.getElementById("perfil-acceso-modificacion-usuario").style.display = '';
        document.getElementById("botones-modificacion-fila").style.display = '';

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";
    }
  }