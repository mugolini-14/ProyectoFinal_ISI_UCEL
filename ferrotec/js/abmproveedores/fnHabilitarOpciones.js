// fnHabilitarOpciones
// Descripción: Función que habilita los diferentes formularios según la acción a realizar

function fnHabilitarOpciones(codigoaccion){ 
    if(codigoaccion==0){ // Inicialización / Seleccione

        // Filas de Alta
        document.getElementById("nombre-proveedor-alta-fila").style.display = "none";
        document.getElementById("descripcion-proveedor-alta-fila").style.display = "none";
        document.getElementById("direccion-proveedor-alta-fila").style.display = "none";
        document.getElementById("localidad-proveedor-alta-fila").style.display = "none";
        document.getElementById("provincia-proveedor-alta-fila").style.display = "none";
        document.getElementById("telefono1-proveedor-alta-fila").style.display = "none";
        document.getElementById("telefono2-proveedor-alta-fila").style.display = "none";
        document.getElementById("email-proveedor-alta-fila").style.display = "none";
        document.getElementById("cuit-proveedor-alta-fila").style.display = "none";
        document.getElementById("botones-alta-fila").style.display = "none";

        // Filas de Baja
        document.getElementById("nombre-proveedor-baja-fila").style.display = "none";
        document.getElementById("botones-baja-fila").style.display = "none";
        
        // Filas de Modificaciòn
        document.getElementById("descripcion-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("direccion-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("localidad-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("provincia-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("telefono1-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("telefono2-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("email-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("cuit-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("botones-modificacion-fila").style.display = "none";

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = '';
    }

    if(codigoaccion==1){ // Alta

        // Filas de Alta
        document.getElementById("nombre-proveedor-alta-fila").style.display = '';
        document.getElementById("descripcion-proveedor-alta-fila").style.display = '';
        document.getElementById("direccion-proveedor-alta-fila").style.display = '';
        document.getElementById("localidad-proveedor-alta-fila").style.display = '';
        document.getElementById("provincia-proveedor-alta-fila").style.display = '';
        document.getElementById("telefono1-proveedor-alta-fila").style.display = '';
        document.getElementById("telefono2-proveedor-alta-fila").style.display = '';
        document.getElementById("email-proveedor-alta-fila").style.display = '';
        document.getElementById("cuit-proveedor-alta-fila").style.display = '';
        document.getElementById("botones-alta-fila").style.display = '';

        // Filas de Baja
        document.getElementById("nombre-proveedor-baja-fila").style.display = "none";
        document.getElementById("botones-baja-fila").style.display = "none";
        
        // Filas de Modificaciòn
        document.getElementById("descripcion-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("direccion-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("localidad-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("provincia-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("telefono1-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("telefono2-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("email-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("cuit-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("botones-modificacion-fila").style.display = "none";

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";
    }

    if(codigoaccion==2){  // Baja

        // Filas de Alta
        document.getElementById("nombre-proveedor-alta-fila").style.display = "none";
        document.getElementById("descripcion-proveedor-alta-fila").style.display = "none";
        document.getElementById("direccion-proveedor-alta-fila").style.display = "none";
        document.getElementById("localidad-proveedor-alta-fila").style.display = "none";
        document.getElementById("provincia-proveedor-alta-fila").style.display = "none";
        document.getElementById("telefono1-proveedor-alta-fila").style.display = "none";
        document.getElementById("telefono2-proveedor-alta-fila").style.display = "none";
        document.getElementById("email-proveedor-alta-fila").style.display = "none";
        document.getElementById("cuit-proveedor-alta-fila").style.display = "none";
        document.getElementById("botones-alta-fila").style.display = "none";

        // Filas de Baja
        document.getElementById("nombre-proveedor-baja-fila").style.display = '';
        document.getElementById("botones-baja-fila").style.display = '';
        
        // Filas de Modificaciòn
        document.getElementById("descripcion-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("direccion-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("localidad-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("provincia-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("telefono1-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("telefono2-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("email-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("cuit-proveedor-modificacion-fila").style.display = "none";
        document.getElementById("botones-modificacion-fila").style.display = "none";

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";
    }
    
    if(codigoaccion==3){ // Modificación

        // Filas de Alta
        document.getElementById("nombre-proveedor-alta-fila").style.display = "none";
        document.getElementById("descripcion-proveedor-alta-fila").style.display = "none";
        document.getElementById("direccion-proveedor-alta-fila").style.display = "none";
        document.getElementById("localidad-proveedor-alta-fila").style.display = "none";
        document.getElementById("provincia-proveedor-alta-fila").style.display = "none";
        document.getElementById("telefono1-proveedor-alta-fila").style.display = "none";
        document.getElementById("telefono2-proveedor-alta-fila").style.display = "none";
        document.getElementById("email-proveedor-alta-fila").style.display = "none";
        document.getElementById("cuit-proveedor-alta-fila").style.display = "none";
        document.getElementById("botones-alta-fila").style.display = "none";

        // Filas de Baja
        document.getElementById("nombre-proveedor-baja-fila").style.display = "none";
        document.getElementById("botones-baja-fila").style.display = "none";
        
        // Filas de Modificaciòn
        document.getElementById("descripcion-proveedor-modificacion-fila").style.display = '';
        document.getElementById("direccion-proveedor-modificacion-fila").style.display = '';
        document.getElementById("localidad-proveedor-modificacion-fila").style.display = '';
        document.getElementById("provincia-proveedor-modificacion-fila").style.display = '';
        document.getElementById("telefono1-proveedor-modificacion-fila").style.display = '';
        document.getElementById("telefono2-proveedor-modificacion-fila").style.display = '';
        document.getElementById("email-proveedor-modificacion-fila").style.display = '';
        document.getElementById("cuit-proveedor-modificacion-fila").style.display = '';
        document.getElementById("botones-modificacion-fila").style.display = '';

        // Boton Principal Volver
        document.getElementById("botones-principal-volver-fila").style.display = "none";

    }
  }