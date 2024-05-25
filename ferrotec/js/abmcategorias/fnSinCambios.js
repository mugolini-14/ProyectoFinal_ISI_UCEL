//  fnSinCambios
//  Descripción:  Función de los Botones Cancelar y Volver del ABM de tipos
//                Verifica si hay valores ingresados / seleccionados y pregunta según la cadena recibida 
//  Parámetros:
//  tipoFormulario: P--> Principal / A --> Alta / B --> Baja / M --> Modificación
//  tipoAccion:     V --> Volver / C --> Cancelar

function fnSinCambios(tipoFormulario,tipoAccion){

  if(tipoFormulario == 'A'){
    if( document.getElementById("nombre-tipo-alta-input").value != '' ||
        document.getElementById("descripcion-tipo-alta-input").value != ''){ 
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
              document.getElementById("nombre-tipo-alta-input").value = '';
              document.getElementById("descripcion-tipo-alta-input").value = '';
            } 
            else { 
              // Hacer nada
            }
          } 
        }
    else{
      if( document.getElementById("nombre-tipo-alta-input").value == '' ||
          document.getElementById("descripcion-tipo-alta-input").value == '' ){
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
    if( document.getElementById("nombre-tipo-baja-input").value != ''){ 
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
          document.getElementById("nombre-tipo-baja-input").value = '';
        } 
        else {
          // Hacer nada
        }
      }
    }
    else{
      if( document.getElementById("nombre-tipo-baja-input").value == ''){ 
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
    if( document.getElementById("nombre-tipo-modificacion-input").value != '' ||
        document.getElementById("renombre-tipo-modificacion-input").value != '' ||
        document.getElementById("descripcion-tipo-modificacion-input").value != ''){ 
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
              document.getElementById("nombre-tipo-modificacion-input").value = '';
              document.getElementById("renombre-tipo-modificacion-input").value = '';
              document.getElementById("descripcion-tipo-modificacion-input").value = '';
            } 
            else {
              // Hacer nada
            }
          }
    }
    else{
      if( document.getElementById("nombre-tipo-modificacion-input").value == '' ||
          document.getElementById("renombre-tipo-modificacion-input").value == '' ||
          document.getElementById("descripcion-tipo-modificacion-input").value == ''){ 
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