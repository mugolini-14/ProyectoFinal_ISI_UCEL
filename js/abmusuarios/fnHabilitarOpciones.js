// fnHabilitarOpciones
// Descripción: Función que habilita los diferentes formularios según la acción a realizar

function fnHabilitarOpciones(codigoaccion){ 
          
    if(codigoaccion==0){ // Inicialización / Seleccione

        // Filas de Alta
        document.getElementById("nombre-usuario-alta-fila").style.display = "none";
        document.getElementById("perfil-acceso-alta-usuario").style.display = "none";
        document.getElementById("acceso-ventas-alta-fila").style.display = "none";
        document.getElementById("acceso-compras-alta-fila").style.display = "none";
        document.getElementById("acceso-informes-alta-fila").style.display = "none";
        document.getElementById("acceso-consultas-alta-fila").style.display = "none";
        document.getElementById("acceso-usuarios-alta-fila").style.display = "none";
        document.getElementById("botones-alta-fila").style.display = "none";

        // Filas de Baja
        document.getElementById("nombre-usuario-baja-fila").style.display = "none";
        document.getElementById("botones-baja-fila").style.display = "none";
        
        // Filas de Modificaciòn
        document.getElementById("nombre-usuario-modificacion-fila").style.display = "none";
        document.getElementById("perfil-acceso-modificacion-usuario").style.display = "none";
        document.getElementById("acceso-ventas-modificacion-fila").style.display = "none";
        document.getElementById("acceso-compras-modificacion-fila").style.display = "none";
        document.getElementById("acceso-informes-modificacion-fila").style.display = "none";
        document.getElementById("acceso-consultas-modificacion-fila").style.display = "none";
        document.getElementById("acceso-usuarios-modificacion-fila").style.display = "none";
        document.getElementById("botones-modificacion-fila").style.display = "none";
        
        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = '';
    }

    if(codigoaccion==1){ // Alta

        // Filas de Alta
        document.getElementById("nombre-usuario-alta-fila").style.display = '';
        document.getElementById("perfil-acceso-alta-usuario").style.display = '';
        document.getElementById("acceso-ventas-alta-fila").style.display = '';
        document.getElementById("acceso-compras-alta-fila").style.display = '';
        document.getElementById("acceso-informes-alta-fila").style.display = '';
        document.getElementById("acceso-consultas-alta-fila").style.display = '';
        document.getElementById("acceso-usuarios-alta-fila").style.display = '';
        document.getElementById("botones-alta-fila").style.display = '';

        // Filas de Baja
        document.getElementById("nombre-usuario-baja-fila").style.display = 'none';
        document.getElementById("botones-baja-fila").style.display = 'none';

        // Filas de Modificación
        document.getElementById("nombre-usuario-modificacion-fila").style.display = "none";
        document.getElementById("perfil-acceso-modificacion-usuario").style.display = "none";
        document.getElementById("acceso-ventas-modificacion-fila").style.display = "none";
        document.getElementById("acceso-compras-modificacion-fila").style.display = "none";
        document.getElementById("acceso-informes-modificacion-fila").style.display = "none";
        document.getElementById("acceso-consultas-modificacion-fila").style.display = "none";
        document.getElementById("acceso-usuarios-modificacion-fila").style.display = "none";
        document.getElementById("botones-modificacion-fila").style.display = "none";

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";

        // Funciones a habilitar por defecto

        fnHabilitarPerfilUsuario('A',0);
        fnPerfilesDeUsuario('A',0);
    }

    if(codigoaccion==2){  // Baja

        // Filas de Alta
        document.getElementById("nombre-usuario-alta-fila").style.display = "none";
        document.getElementById("perfil-acceso-alta-usuario").style.display = "none";
        document.getElementById("acceso-ventas-alta-fila").style.display = "none";
        document.getElementById("acceso-compras-alta-fila").style.display = "none";
        document.getElementById("acceso-informes-alta-fila").style.display = "none";
        document.getElementById("acceso-consultas-alta-fila").style.display = "none";
        document.getElementById("acceso-usuarios-alta-fila").style.display = "none";
        document.getElementById("botones-alta-fila").style.display = "none";

        // Filas de Baja
        document.getElementById("nombre-usuario-baja-fila").style.display = '';
        document.getElementById("botones-baja-fila").style.display = '';

        // Filas de Modificación
        document.getElementById("nombre-usuario-modificacion-fila").style.display = "none";
        document.getElementById("perfil-acceso-modificacion-usuario").style.display = "none";
        document.getElementById("acceso-ventas-modificacion-fila").style.display = "none";
        document.getElementById("acceso-compras-modificacion-fila").style.display = "none";
        document.getElementById("acceso-informes-modificacion-fila").style.display = "none";
        document.getElementById("acceso-consultas-modificacion-fila").style.display = "none";
        document.getElementById("acceso-usuarios-modificacion-fila").style.display = "none";
        document.getElementById("botones-modificacion-fila").style.display = "none";

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";
    }
    
    if(codigoaccion==3){ // Modificación

        // Filas de Alta
        document.getElementById("nombre-usuario-alta-fila").style.display = "none";
        document.getElementById("perfil-acceso-alta-usuario").style.display = "none";
        document.getElementById("acceso-ventas-alta-fila").style.display = "none";
        document.getElementById("acceso-compras-alta-fila").style.display = "none";
        document.getElementById("acceso-informes-alta-fila").style.display = "none";
        document.getElementById("acceso-consultas-alta-fila").style.display = "none";
        document.getElementById("acceso-usuarios-alta-fila").style.display = "none";
        document.getElementById("botones-alta-fila").style.display = "none";

        // Filas de Baja
        document.getElementById("nombre-usuario-baja-fila").style.display = "none";
        document.getElementById("botones-baja-fila").style.display = "none";

        // Filas de Modificación
        document.getElementById("nombre-usuario-modificacion-fila").style.display = '';
        document.getElementById("perfil-acceso-modificacion-usuario").style.display = '';
        document.getElementById("acceso-ventas-modificacion-fila").style.display = '';
        document.getElementById("acceso-compras-modificacion-fila").style.display = '';
        document.getElementById("acceso-informes-modificacion-fila").style.display = '';
        document.getElementById("acceso-consultas-modificacion-fila").style.display = '';
        document.getElementById("acceso-usuarios-modificacion-fila").style.display = '';
        document.getElementById("botones-modificacion-fila").style.display = '';

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";

        // Funciones a habilitar por defecto

        fnHabilitarPerfilUsuario('M',0);
        fnPerfilesDeUsuario('M',0);
    }
  }