//  Función: fnSinCambios(tipoFormulario,tipoAccion)
//  Descripción:  Función de los Botones Cancelar y Volver del ABM de proveedors
//                Verifica si hay valores ingresados / seleccionados y pregunta según la cadena recibida 
//  Parámetros:
//  tipoFormulario: P--> Principal / A --> Alta / B --> Baja / M --> Modificación
//  tipoAccion:     V --> Volver / C --> Cancelar

function fnSinCambios(tipoFormulario,tipoAccion){

  if(tipoFormulario == 'A'){    // Alta
    // Si alguno de los campos no está vacío
    if( document.getElementById("nombre-proveedor-alta-input").value != '' ||
        document.getElementById("descripcion-proveedor-alta-input").value != '' ||
        document.getElementById("direccion-proveedor-alta-input").value != '' ||
        document.getElementById("localidad-proveedor-alta-input").value != '' ||
        document.getElementById("provincia-proveedor-alta-input").value != '' ||
        document.getElementById("telefono1-proveedor-alta-input").value != '' ||
        document.getElementById("telefono2-proveedor-alta-input").value != '' ||
        document.getElementById("email-proveedor-alta-input").value != '' ||
        document.getElementById("cuit-proveedor-alta-input").value != ''){ 
          if(tipoAccion == 'V'){  // Volver
            if (confirm("¿Desea Salir Sin Guardar Cambios?")) {
              location="../index/index.php";
            } 
            else {
              // Hacer Nada
            }
          }
          if(tipoAccion == 'C'){  // Cancelar
            if (confirm("¿Desea Cancelar la Operación?")) {
              document.getElementById("nombre-proveedor-alta-input").value = ""; 
              document.getElementById("descripcion-proveedor-alta-input").value = ""; 
              document.getElementById("direccion-proveedor-alta-input").value = ""; 
              document.getElementById("localidad-proveedor-alta-input").value = ""; 
              document.getElementById("provincia-proveedor-alta-input").value = ""; 
              document.getElementById("telefono1-proveedor-alta-input").value = ""; 
              document.getElementById("telefono2-proveedor-alta-input").value = ""; 
              document.getElementById("email-proveedor-alta-input").value = ""; 
              document.getElementById("cuit-proveedor-alta-input").value = ""; 
            } 
            else { 
              // Hacer nada
            }
          } 
      }
      else{
      // Si todos los campos están vacíos
        if( document.getElementById("nombre-proveedor-alta-input").value == '' &&
        document.getElementById("descripcion-proveedor-alta-input").value == '' &&
        document.getElementById("direccion-proveedor-alta-input").value == '' &&
        document.getElementById("localidad-proveedor-alta-input").value == '' &&
        document.getElementById("provincia-proveedor-alta-input").value == '' &&
        document.getElementById("telefono1-proveedor-alta-input").value == '' &&
        document.getElementById("telefono2-proveedor-alta-input").value == '' &&
        document.getElementById("email-proveedor-alta-input").value == '' &&
        document.getElementById("cuit-proveedor-alta-input").value == ''){
          if(tipoAccion == 'V'){     // ALTA - VOLVER - SIN ESCRIBIR
            location="../index/index.php";
          }
          else {
            // Hacer Nada
          }    
        }
      }
  }

 if(tipoFormulario == 'B'){   // Baja
  // Si el campo no está vacío
    if(document.getElementById("nombre-proveedor-baja-input").value != ''){     
      if(tipoAccion == 'V'){    // Volver
        if (confirm("¿Desea Salir Sin Guardar Cambios?")) {
          location="../index/index.php";
        } 
        else {
          // Hacer nada
        }
      }
      if(tipoAccion == 'C'){    // Cancelar
        if (confirm("¿Desea Cancelar?")) {
          document.getElementById("nombre-proveedor-baja-input").value = '';
        } 
        else {
          // Hacer nada
        }
      }
    }
    else{                  
    // Si el campo está vacío
      if(document.getElementById("nombre-proveedor-baja-input").value == ''){     
        if(tipoAccion == 'V'){    // Volver
          location="../index/index.php";
        } 
        else {
          // Hacer nada
        }
      }
    }
  }

  if(tipoFormulario == 'M'){    // Modificación
    // Si alguno de los campos no está vacío
    if( document.getElementById("nombre-proveedor-modificacion-input").value != '' ||
        document.getElementById("renombre-proveedor-modificacion-input").value != '' ||
        document.getElementById("descripcion-proveedor-modificacion-input").value != '' ||
        document.getElementById("direccion-proveedor-modificacion-input").value != '' ||
        document.getElementById("localidad-proveedor-modificacion-input").value != '' ||
        document.getElementById("provincia-proveedor-modificacion-input").value != '' ||
        document.getElementById("telefono1-proveedor-modificacion-input").value != '' ||
        document.getElementById("telefono2-proveedor-modificacion-input").value != '' ||
        document.getElementById("email-proveedor-modificacion-input").value != '' ||
        document.getElementById("cuit-proveedor-modificacion-input").value != ''){ 
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
              document.getElementById("nombre-proveedor-modificacion-input").value = '';
              document.getElementById("renombre-proveedor-modificacion-input").value = '';
              document.getElementById("descripcion-proveedor-modificacion-input").value = ''; 
              document.getElementById("direccion-proveedor-modificacion-input").value = ''; 
              document.getElementById("localidad-proveedor-modificacion-input").value = ''; 
              document.getElementById("provincia-proveedor-modificacion-input").value = ''; 
              document.getElementById("telefono1-proveedor-modificacion-input").value = ''; 
              document.getElementById("telefono2-proveedor-modificacion-input").value = ''; 
              document.getElementById("email-proveedor-modificacion-input").value = ''; 
              document.getElementById("cuit-proveedor-modificacion-input").value = '';
              document.getElementById("acciones-estado-modificacion-proveedor").value = '';
            } 
            else {
              // Hacer nada
            }
          }
    }
    else{
    // Si todos los campos están vacíos 
      if( document.getElementById("nombre-proveedor-modificacion-input").value == '' &&
        document.getElementById("renombre-proveedor-modificacion-input").value == '' &&
        document.getElementById("descripcion-proveedor-modificacion-input").value == '' &&
        document.getElementById("direccion-proveedor-modificacion-input").value == '' &&
        document.getElementById("localidad-proveedor-modificacion-input").value == '' &&
        document.getElementById("provincia-proveedor-modificacion-input").value == '' &&
        document.getElementById("telefono1-proveedor-modificacion-input").value == '' &&
        document.getElementById("telefono2-proveedor-modificacion-input").value == '' &&
        document.getElementById("email-proveedor-modificacion-input").value == '' &&
        document.getElementById("cuit-proveedor-modificacion-input").value == ''){ 
          if(tipoAccion == 'V'){    // Volver
            location="../index/index.php";
          } 
          else {
            // Hacer nada
          }
        }
    }
  }

  if(tipoFormulario == 'P'){  // Principal
    if(tipoAccion == 'V'){    // Volver
      location="../index/index.php";
    }
  }
}
