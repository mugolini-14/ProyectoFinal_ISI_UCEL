//  fnSinCambios
//  Descripción:  Función de los Botones Cancelar y Volver del ABM de Usuarios
//                Verifica si hay valores ingresados / seleccionados y pregunta según la cadena recibida 
//  Parámetros:
//  tipoFormulario: P--> Principal / A --> Alta / B --> Baja / M --> Modificación
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
                location="../../index/index.php";
              } 
              else {
                // Hacer Nada
              }
            }
          if(tipoAccion == 'C'){
            if (confirm("¿Desea Cancelar la Operación?")) {
              document.getElementById("nombre-usuario-alta-input").value = '';
              document.getElementById("nombrepila-usuario-alta-input").value = '';
              document.getElementById("apellido-usuario-alta-input").value = '';
              document.getElementById("direccion-usuario-alta-input").value = '';
              document.getElementById("email-usuario-alta-input").value = '';
              document.getElementById("perfil-acceso-alta-usuario-opciones").value = '0';
              document.getElementById("perfil-acceso-alta-usuario-opciones").disabled = "true";
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
      if( document.getElementById("nombre-usuario-alta-input").value == '' ||
        document.getElementById("perfil-acceso-alta-usuario-opciones").value == '0' ||
        document.getElementById("acceso-ventas-alta-opciones").value == '0' ||
        document.getElementById("acceso-compras-alta-opciones").value == '0' ||
        document.getElementById("acceso-informes-alta-opciones").value == '0' ||
        document.getElementById("acceso-consultas-alta-opciones").value == '0' ||
        document.getElementById("acceso-usuarios-alta-opciones").value == '0'){
          if(tipoAccion == 'V'){
              location="../index/index.php";
           } 
            else {
              // Hacer Nada
            }
          if(tipoAccion == 'C'){
            // Hacer Nada
          } 
          else { 
            // Hacer nada
          }
      }
    }
  }

  if(tipoFormulario == 'B'){
    if( document.getElementById("nombre-usuario-baja-input").value != ''){ 
      if(tipoAccion == 'V'){
        if (confirm("¿Desea Salir Sin Guardar Cambios?")) {
          location="../index/index.php";
        } 
        else {
          // Hacer nada
        }
      }
      if(tipoAccion == 'C'){
        if (confirm("¿Desea Cancelar?")) {
          document.getElementById("nombre-usuario-baja-input").value = '';
        } 
        else {
          // Hacer nada
        }
      }
    }
    else{
      if( document.getElementById("nombre-usuario-baja-input").value == ''){ 
        if(tipoAccion == 'V'){
          location="../index/index.php";
        }
        else {
            // Hacer nada
        }
        if(tipoAccion == 'C'){
          // Hacer Nada
        }
        else {
            // Hacer nada
        }
      }
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
              location="../index/index.php";
            } 
            else {
              // Hacer nada
            }
          }
          if(tipoAccion == 'C'){
            if (confirm("¿Desea Cancelar la Operación?")) {
              document.getElementById("seleccion-usuario-modificacion").value = '0';
              document.getElementById("perfil-acceso-modificacion-usuario-opciones").value = '0';
              document.getElementById("perfil-acceso-modificacion-usuario-opciones").disabled = "True";
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
      if( document.getElementById("seleccion-usuario-modificacion").value == '0' ||
        document.getElementById("perfil-acceso-modificacion-usuario-opciones").value == '0' ||
        document.getElementById("acceso-ventas-modificacion-opciones").value == '0' ||
        document.getElementById("acceso-compras-modificacion-opciones").value == '0' ||
        document.getElementById("acceso-informes-modificacion-opciones").value == '0' ||
        document.getElementById("acceso-consultas-modificacion-opciones").value == '0' ||
        document.getElementById("acceso-usuarios-modificacion-opciones").value == '0'){ 
          if(tipoAccion == 'V'){
            location="../index/index.php";
          }
          else {
            // Hacer nada
          }
          if(tipoAccion == 'C'){
            // Hacer Nada
          }
          else {
            // Hacer nada
          }
      }      
    }
  }

  if(tipoFormulario == 'P'){
    if(tipoAccion == 'V'){
      location="../index/index.php";
    }
  }
}    