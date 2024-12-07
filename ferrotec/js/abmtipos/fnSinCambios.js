//  Función: fnSinCambios(tipoFormulario,tipoAccion)
//  Descripción:  Función de los Botones Cancelar y Volver del ABM de tipos
//                Verifica si hay valores ingresados / seleccionados y pregunta según la cadena recibida 
//  Parámetros:
//  tipoFormulario: P--> Principal / A --> Alta / B --> Baja / M --> Modificación
//  tipoAccion:     V --> Volver / C --> Cancelar
//

function fnSinCambios(tipoFormulario,tipoAccion){

  if(tipoFormulario == 'A'){        // Alta
    // Si alguno de los campos no está vacío
    if( document.getElementById("nombre-tipo-alta-input").value != '' ||
        document.getElementById("descripcion-tipo-alta-input").value != ''){ 
          if(tipoAccion == 'V'){    // Volver
              if (confirm("¿Desea Salir Sin Guardar Cambios?")) {
                location="../index/index.php";
              } 
              else {  
                // Hacer Nada
              }
            }
          if(tipoAccion == 'C'){    // Cancelar
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
      // Si todos los campos están vacíos
      if( document.getElementById("nombre-tipo-alta-input").value == '' &&
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

  if(tipoFormulario == 'B'){      // Baja
    // Si el campo no está vacío
    if( document.getElementById("nombre-tipo-baja-input").value != ''){ 
      if(tipoAccion == 'V'){      // Volver
        if (confirm("¿Desea Salir Sin Guardar Cambios?")) {
          location="../index/index.php";
        } 
        else {
          // Hacer nada
        }
      }
      if(tipoAccion == 'C'){      // Cancelar
        if (confirm("¿Desea Cancelar?")) {
          document.getElementById("nombre-tipo-baja-input").value = '';
        } 
        else {
          // Hacer nada
        }
      }
    }
    else{
    // Si el campo está vacío
      if( document.getElementById("nombre-tipo-baja-input").value == ''){ 
        if(tipoAccion == 'V'){    // Volver
          location="../index/index.php";
        }
        else {
            // Hacer nada
        }
        if(tipoAccion == 'C'){    // Cancelar
          // Hacer Nada
        }
        else {
            // Hacer nada
        }
      }
    }
  }

  if(tipoFormulario == 'M'){        // Modificación
    // Si alguno de los campos no está vacío
    if( document.getElementById("nombre-tipo-modificacion-input").value != '' ||
        document.getElementById("renombre-tipo-modificacion-input").value != '' ||
        document.getElementById("descripcion-tipo-modificacion-input").value != ''){ 
          if(tipoAccion == 'V'){    // Volver
            if (confirm("¿Desea Salir Sin Guardar Cambios?")) {
              location="../index/index.php";
            } 
            else {
              // Hacer nada
            }
          }
          if(tipoAccion == 'C'){    // Cancelar
            if (confirm("¿Desea Cancelar la Operación?")) {
              document.getElementById("nombre-tipo-modificacion-input").value = '';
              document.getElementById("renombre-tipo-modificacion-input").value = '';
              document.getElementById("descripcion-tipo-modificacion-input").value = '';
              document.getElementById("acciones-estado-modificacion-tipo").value = '';
            } 
            else {
              // Hacer nada
            }
          }
    }
    else{
      // Si todos los campos están vacíos
      if( document.getElementById("nombre-tipo-modificacion-input").value == '' &&
          document.getElementById("renombre-tipo-modificacion-input").value == '' &&
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

  if(tipoFormulario == 'P'){    // Principal (Seleccione...)
    if(tipoAccion == 'V'){      // Volver
      location="../index/index.php";
    }
  }
}    