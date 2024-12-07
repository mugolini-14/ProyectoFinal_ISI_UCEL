//  Función: fnSinCambios(tipoFormulario,tipoAccion)
//  Descripción:  Función de los Botones Cancelar y Volver del ABM de tipos
//                Verifica si hay valores ingresados / seleccionados y pregunta según la cadena recibida 
//  Parámetros:
//  tipoFormulario: P--> Principal / A --> Alta / B --> Baja / M --> Modificación
//  tipoAccion:     V --> Volver / C --> Cancelar

function fnSinCambios(tipoFormulario,tipoAccion){

  if(tipoFormulario == 'A'){
    if( document.getElementById("padretipo-categoria-alta-input").value != '' ||
        document.getElementById("nombre-categoria-alta-input").value != '' ||
        document.getElementById("descripcion-categoria-alta-input").value != ''){ 
          if(tipoAccion == 'V'){
              if (confirm("¿Desea Salir Sin Guardar Cambios?")) {
                location="../index/index.php";
              } 
              else {
                // Hacer Nada
              }
            }
          if(tipoAccion == 'C'){
            if (confirm("¿Desea Cancelar la Operación?")) {
              document.getElementById("padretipo-categoria-alta-input").value = '';
              document.getElementById("nombre-categoria-alta-input").value = '';
              document.getElementById("descripcion-categoria-alta-input").value = '';
              document.getElementById("acciones-estado-modificacion-categoria").value = '';
            } 
            else { 
              // Hacer nada
            }
          } 
        }
    else{
      if( document.getElementById("padretipo-categoria-alta-input").value == '' &&
          document.getElementById("nombre-categoria-alta-input").value == '' &&
          document.getElementById("descripcion-categoria-alta-input").value == ''){
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
    if( document.getElementById("nombre-categoria-baja-input").value != ''){ 
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
          document.getElementById("nombre-categoria-baja-input").value = '';
        } 
        else {
          // Hacer nada
        }
      }
    }
    else{
      if( document.getElementById("nombre-categoria-baja-input").value == ''){ 
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
    if( document.getElementById("padretipo-categoria-modificacion-input").value != '' ||
        document.getElementById("nombre-categoria-modificacion-input").value != '' ||
        document.getElementById("renombre-categoria-modificacion-input").value != '' ||
        document.getElementById("descripcion-categoria-modificacion-input").value != '' ||
        document.getElementById("acciones-estado-modificacion-categoria").value != ''){ 
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
              document.getElementById("padretipo-categoria-modificacion-input").value = '';
              document.getElementById("nombre-categoria-modificacion-input").value = '';
              document.getElementById("renombre-categoria-modificacion-input").value = '';
              document.getElementById("descripcion-categoria-modificacion-input").value = '';
              document.getElementById("acciones-estado-modificacion-categoria").value = '';
            } 
            else {
              // Hacer nada
            }
          }
    }
    else{
      if( document.getElementById("padretipo-categoria-modificacion-input").value == '' &&
          document.getElementById("nombre-categoria-modificacion-input").value == '' &&
          document.getElementById("renombre-categoria-modificacion-input").value == '' &&
          document.getElementById("descripcion-categoria-modificacion-input").value == '' &&
          document.getElementById("acciones-estado-modificacion-categoria").value == ''){ 
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