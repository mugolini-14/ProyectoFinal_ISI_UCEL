//  Función: fnSinCambios(tipoFormulario,tipoAccion)
//  Descripción:  Función de los Botones Cancelar y Volver del ABM de Usuarios
//  Verifica si hay valores ingresados / seleccionados y pregunta según la cadena recibida 
//  Parámetros:
//  tipoFormulario: P--> Principal / A --> Alta / B --> Baja / M --> Modificación
//  tipoAccion:     V --> Volver / C --> Cancelar
//

function fnSinCambios(tipoFormulario,tipoAccion){

  if(tipoFormulario == 'A'){        // Alta
    // Si alguno de los valores no es vacío
    if( document.getElementById("nombre-usuario-alta-input").value != '' ||
        document.getElementById('nombrepila-usuario-alta-input').value != '' ||
        document.getElementById('apellido-usuario-alta-input').value != '' ||
        document.getElementById('direccion-usuario-alta-input').value != '' ||
        document.getElementById('email-usuario-alta-input').value != '' ||
        document.getElementById("perfil-acceso-alta-usuario-opciones").value != '0'){ 
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
              document.getElementById("nombre-usuario-alta-input").value = '';
              document.getElementById("nombrepila-usuario-alta-input").value = '';
              document.getElementById("apellido-usuario-alta-input").value = '';
              document.getElementById("direccion-usuario-alta-input").value = '';
              document.getElementById("email-usuario-alta-input").value = '';
              document.getElementById("perfil-acceso-alta-usuario-opciones").value = '0';
            } 
            else { 
              // Hacer nada
            }
          } 
        }
    else{     
      // Si todos los valores son vacíos
      if( document.getElementById("nombre-usuario-alta-input").value == '' &&
      document.getElementById('nombrepila-usuario-alta-input').value == '' &&
      document.getElementById('apellido-usuario-alta-input').value == '' &&
      document.getElementById('direccion-usuario-alta-input').value == '' &&
      document.getElementById('email-usuario-alta-input').value == '' &&
      document.getElementById("perfil-acceso-alta-usuario-opciones").value == '0'){
          if(tipoAccion == 'V'){    // Volver
              location="../index/index.php";
           } 
            else {
              // Hacer Nada
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

  if(tipoFormulario == 'B'){        // Baja
    // Si el valor de Dar de Baja no es vacío
    if( document.getElementById("nombre-usuario-baja-input").value != ''){ 
      if(tipoAccion == 'V'){
        if (confirm("¿Desea Salir Sin Guardar Cambios?")) {
          location="../index/index.php";
        } 
        else {
          // Hacer nada
        }
      }
      if(tipoAccion == 'C'){        // Cancelar
        if (confirm("¿Desea Cancelar?")) {
          document.getElementById("nombre-usuario-baja-input").value = '';
        } 
        else {
          // Hacer nada
        }
      }
    }
    else{
      // Si el valor de Dar de Baja es vacío
      if( document.getElementById("nombre-usuario-baja-input").value == ''){ 
        if(tipoAccion == 'V'){      // Volver
          location="../index/index.php";
        }
        else {
            // Hacer nada
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

  if(tipoFormulario == 'M'){          // Modificación
    // Si alguno de los valores no es vacío
    if( document.getElementById("nombre-usuario-modificacion-input").value != '' ||
        document.getElementById('nombrepila-usuario-modificacion-input').value != '' ||
        document.getElementById('apellido-usuario-modificacion-input').value != '' ||
        document.getElementById('direccion-usuario-modificacion-input').value != '' ||
        document.getElementById('email-usuario-modificacion-input').value != '' ||
        document.getElementById("perfil-acceso-modificacion-usuario-opciones").value != '0'){ 
          if(tipoAccion == 'V'){      // Volver
            if (confirm("¿Desea Salir Sin Guardar Cambios?")) {
              location="../index/index.php";
            } 
            else {
              // Hacer nada
            }
          }
          if(tipoAccion == 'C'){      // Cancelar
            if (confirm("¿Desea Cancelar la Operación?")) {
              document.getElementById("nombre-usuario-modificacion-input").value = '';
              document.getElementById('nombrepila-usuario-modificacion-input').value = '';
              document.getElementById('apellido-usuario-modificacion-input').value = '';
              document.getElementById('direccion-usuario-modificacion-input').value = '';
              document.getElementById('email-usuario-modificacion-input').value = '';
              document.getElementById("perfil-acceso-modificacion-usuario-opciones").value = '0';
            } 
            else {
              // Hacer nada
            }
          }
    }
    else{
      // Si todos los valores son vacíos
      if( document.getElementById("nombre-usuario-modificacion-input").value == '' &&
          document.getElementById('nombrepila-usuario-modificacion-input').value == '' &&
          document.getElementById('apellido-usuario-modificacion-input').value == '' &&
          document.getElementById('direccion-usuario-modificacion-input').value == '' &&
          document.getElementById('email-usuario-modificacion-input').value == '' &&
          document.getElementById("perfil-acceso-modificacion-usuario-opciones").value == '0'){ 
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