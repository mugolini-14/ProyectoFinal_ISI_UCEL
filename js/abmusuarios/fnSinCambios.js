//  fnSinCambios
//  Descripción:  Función de los Botones Cancelar y Volver del ABM de Usuarios
//                Verifica si hay valores ingresados / seleccionados y pregunta según la cadena recibida 
//  Parámetros:
//  tipoFormulario: A --> Alta / B --> Baja / M --> Modificación
//  tipoAccion:     V --> Volver / C --> Cancelar

function fnSinCambios(tipoFormulario,tipoAccion){

  if(tipoFormulario == 'A'){
    if( document.getElementById("nombre-usuario-alta-input").value != '' ||
        document.getElementById("perfil-acceso-alta-usuario-opciones").value != '0' ||
        document.getElementById("acceso-ventas-alta-opciones").value != '0' ||
        document.getElementById("acceso-compras-alta-opciones").value != '0' ||
        document.getElementById("acceso-informes-alta-opciones").value != '0' ||
        document.getElementById("acceso-consultas-alta-opciones").value != '0' ||
        document.getElementById("acceso-usuarios-alta-opciones").value != '0'){ 
          if(tipoAccion == 'V'){
            if (confirm("¿Desea Salir Sin Guardar Cambios?")) {
              location="index.html";
            } 
            else {
              // Hacer nada
            }
          }
          if(tipoAccion == 'C'){
            if (confirm("¿Desea Cancelar la Operación?")) {
              document.getElementById("nombre-usuario-alta-input").value = '';
              document.getElementById("perfil-acceso-alta-usuario-opciones").value = '0';
              document.getElementById("acceso-ventas-alta-opciones").value = '0';
              document.getElementById("acceso-compras-alta-opciones").value = '0';
              document.getElementById("acceso-informes-alta-opciones").value = '0';
              document.getElementById("acceso-consultas-alta-opciones").value = '0';
              document.getElementById("acceso-usuarios-alta-opciones").value = '0';
            } 
            else {
              // Hacer nada
            }
          }
    }
    else{
      location="index.html"
    }
  }

  if(tipoFormulario == 'B'){
    if( document.getElementById("seleccion-usuario-baja").value != '0'){ 
      if(tipoAccion == 'V'){
        if (confirm("¿Desea Salir Sin Guardar Cambios?")) {
          location="index.html";
        } 
        else {
          // Hacer nada
        }
      }
      if(tipoAccion == 'C'){
        if (confirm("¿Desea Cancelar?")) {
          document.getElementById("seleccion-usuario-baja").value = '0';
        } 
        else {
          // Hacer nada
        }
      }
    }
    else{
      location="index.html"
    }
  }

  if(tipoFormulario == 'M'){
    if( document.getElementById("seleccion-usuario-modificacion").value != '0' ||
        document.getElementById("perfil-acceso-modificacion-usuario-opciones").value != '0' ||
        document.getElementById("acceso-ventas-modificacion-opciones").value != '0' ||
        document.getElementById("acceso-compras-modificacion-opciones").value != '0' ||
        document.getElementById("acceso-informes-modificacion-opciones").value != '0' ||
        document.getElementById("acceso-consultas-modificacion-opciones").value != '0' ||
        document.getElementById("acceso-usuarios-modificacion-opciones").value != '0'){ 
          if(tipoAccion == 'V'){
            if (confirm("¿Desea Salir Sin Guardar Cambios?")) {
              location="index.html";
            } 
            else {
              // Hacer nada
            }
          }
          if(tipoAccion == 'C'){
            if (confirm("¿Desea Cancelar la Operación?")) {
              document.getElementById("seleccion-usuario-modificacion").value = '0';
              document.getElementById("perfil-acceso-modificacion-usuario-opciones").value = '0';
              document.getElementById("acceso-ventas-modificacion-opciones").value = '0';
              document.getElementById("acceso-compras-modificacion-opciones").value = '0';
              document.getElementById("acceso-informes-modificacion-opciones").value = '0';
              document.getElementById("acceso-consultas-modificacion-opciones").value = '0';
              document.getElementById("acceso-usuarios-modificacion-opciones").value = '0';
            } 
            else {
              // Hacer nada
            }
          }
    }
    else{
      location="index.html";
    }
  }
}
    