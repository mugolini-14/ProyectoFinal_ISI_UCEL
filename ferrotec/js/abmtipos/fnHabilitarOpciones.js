//  Función: fnHabilitarOpciones(codigoaccion)
//  Descripción: Función que habilita los diferentes formularios según la acción a realizar
//  Parámetros:
//  - codigoaccion: número entero que determina los elementos a mostrar según la acción seleccionada
//

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
        document.getElementById("estado-tipo-modificacion-fila").style.display = "none";
        
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
        document.getElementById("estado-tipo-modificacion-fila").style.display = "none";

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";

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
        document.getElementById("estado-tipo-modificacion-fila").style.display = "none";

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
        document.getElementById("estado-tipo-modificacion-fila").style.display = '';

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";
    }
  }