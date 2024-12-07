//  Función: fnSinCambios(tipoFormulario,tipoAccion)
//  Descripción:  Función de los Botones Cancelar y Volver del ABM de Usuarios
//  Verifica si hay valores ingresados / seleccionados y pregunta según la cadena recibida 
//  Parámetros:
//  tipoFormulario: P--> Principal / A --> Alta / B --> Baja / M --> Modificación
//  tipoAccion:     V --> Volver / C --> Cancelar

function fnSinCambios(tipoFormulario,tipoAccion){

  if(tipoFormulario == 'A'){    // Alta
    // Si alguno de los elementos no está vacío
    if( document.getElementById("nombre-articulo-alta-input").value != '' ||
        document.getElementById("marca-articulo-alta-input").value != '' ||
        document.getElementById("descripcion-articulo-alta-input").value != '' ||
        document.getElementById("precio-articulo-alta-input").value != '' ||
        document.getElementById("cat-articulo-alta-input").value != ''){ 
          if(tipoAccion == 'V'){      // Volver
              if (confirm("¿Desea Salir Sin Guardar Cambios?")) {
                location="../index/index.php";
              } 
              else {
                // Hacer Nada
              }
          }
          if(tipoAccion == 'C'){      // Cancelar
            if (confirm("¿Desea Cancelar la Operación?")) {
              document.getElementById("nombre-articulo-alta-input").value = '';
              document.getElementById("marca-articulo-alta-input").value = '';
              document.getElementById("descripcion-articulo-alta-input").value = '';
              document.getElementById("precio-articulo-alta-input").value = '';
              document.getElementById("cat-articulo-alta-input").value = '';
            } 
            else { 
              // Hacer nada
            }
          } 
        }
    else{
      // Si todos los elementos están vacíos
      if( document.getElementById("nombre-articulo-alta-input").value == '' &&
          document.getElementById("marca-articulo-alta-input").value == '' &&
          document.getElementById("descripcion-articulo-alta-input").value == '' &&
          document.getElementById("precio-articulo-alta-input").value == '' && 
          document.getElementById("cat-articulo-alta-input").value == ''){
          if(tipoAccion == 'V'){      // Volver
              location="../index/index.php";
           } 
            else {
              // Hacer Nada
            }
          if(tipoAccion == 'C'){      // Cancelar
            // Hacer Nada
          } 
          else { 
            // Hacer nada
          }
      }
    }
  }

  if(tipoFormulario == 'B'){          // Baja
    if( document.getElementById("nombre-articulo-baja-input").value != ''){ 
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
          document.getElementById("nombre-articulo-baja-input").value = '';
        } 
        else {
          // Hacer nada
        }
      }
    }
    else{
      if( document.getElementById("nombre-articulo-baja-input").value == ''){ 
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

  if(tipoFormulario == 'M'){        // Modificación
    // Si alguno de los campos no esta vacío
    if( document.getElementById("nombre-articulo-modificacion-input").value != '' ||
        document.getElementById("renombre-articulo-modificacion-input").value != '' ||
        document.getElementById("marca-articulo-modificacion-input").value != '' ||
        document.getElementById("descripcion-articulo-modificacion-input").value != '' ||
        document.getElementById("precio-articulo-modificacion-input").value != '' ||
        document.getElementById("cat-articulo-modificacion-input").value != ''){ 
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
              document.getElementById("nombre-articulo-modificacion-input").value = '';
              document.getElementById("renombre-articulo-modificacion-input").value = '';
              document.getElementById("marca-articulo-modificacion-input").value = '';
              document.getElementById("descripcion-articulo-modificacion-input").value = '';
              document.getElementById("precio-articulo-modificacion-input").value = '';
              document.getElementById("cat-articulo-modificacion-input").value = '';
              document.getElementById("acciones-estado-modificacion-articulo").value = '';
            } 
            else {
              // Hacer nada
            }
          }
    }
    else{
      // Si todos los campos están vacíos
      if( document.getElementById("nombre-articulo-modificacion-input").value == '' &&
          document.getElementById("renombre-articulo-modificacion-input").value == '' &&
          document.getElementById("marca-articulo-modificacion-input").value == '' &&
          document.getElementById("descripcion-articulo-modificacion-input").value == '' &&
          document.getElementById("precio-articulo-modificacion-input").value == '' && 
          document.getElementById("cat-articulo-modificacion-input").value == ''){ 
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

  if(tipoFormulario == 'P'){      // Principal (Sin seleccionar opción de Acción)
    if(tipoAccion == 'V'){        // Volver
      location="../index/index.php";
    }
  }
}    