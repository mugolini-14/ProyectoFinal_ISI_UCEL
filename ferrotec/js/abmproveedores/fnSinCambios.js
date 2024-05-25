//  fnSinCambios
//  Descripción:  Función de los Botones Cancelar y Volver del ABM de proveedors
//                Verifica si hay valores ingresados / seleccionados y pregunta según la cadena recibida 
//  Parámetros:
//  tipoFormulario: P--> Principal / A --> Alta / B --> Baja / M --> Modificación
//  tipoAccion:     V --> Volver / C --> Cancelar

function fnSinCambios(tipoFormulario,tipoAccion){

  if(tipoFormulario == 'P'){  // Principal
    if(tipoAccion == 'V'){    // VOLVER SIN ENTRAR A NINGUN FORMULARIO
      location="../index/index.php";
    }
  }

  if(tipoFormulario == 'A'){    // ALTA - ESCRIBIENDO
    if( document.getElementById("nombre-proveedor-alta-input").value != '' ||
        document.getElementById("descripcion-proveedor-alta-input").value != '' ||
        document.getElementById("direccion-proveedor-alta-input").value != '' ||
        document.getElementById("localidad-proveedor-alta-input").value != '' ||
        document.getElementById("provincia-proveedor-alta-input").value != '' ||
        document.getElementById("telefono1-proveedor-alta-input").value != '' ||
        document.getElementById("telefono2-proveedor-alta-input").value != '' ||
        document.getElementById("email-proveedor-alta-input").value != '' ||
        document.getElementById("cuit-proveedor-alta-input").value != ''){ 
          if(tipoAccion == 'V'){  // ALTA - VOLVER - ESCRIBIENDO
            if (confirm("¿Desea Salir Sin Guardar Cambios?")) {
              location="../../index/index.php";
            } 
            else {
              // Hacer Nada
            }
          }
          if(tipoAccion == 'C'){  // ALTA - CANCELAR - ESCRIBIENDO
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
      else{   // ALTA - SIN ESCRIBIR
        if( document.getElementById("nombre-proveedor-alta-input").value == '' ||
        document.getElementById("descripcion-proveedor-alta-input").value == '' ||
        document.getElementById("direccion-proveedor-alta-input").value == '' ||
        document.getElementById("localidad-proveedor-alta-input").value == '' ||
        document.getElementById("provincia-proveedor-alta-input").value == '' ||
        document.getElementById("telefono1-proveedor-alta-input").value == '' ||
        document.getElementById("telefono2-proveedor-alta-input").value == '' ||
        document.getElementById("email-proveedor-alta-input").value == '' ||
        document.getElementById("cuit-proveedor-alta-input").value == ''){
          if(tipoAccion == 'V'){     // ALTA - VOLVER - SIN ESCRIBIR
            if (confirm("¿Desea Volver al Menú Principal?")) {
              location="../../index/index.php";
            } 
            else {
              // Hacer Nada
            }
          }    
        }
      }
  }

 if(tipoFormulario == 'B'){   // BAJA - ESCRIBIENDO
    if(document.getElementById("nombre-proveedor-baja-input").value != ''){     
      if(tipoAccion == 'V'){    // BAJA - VOLVER - ESCRIBIENDO
        if (confirm("¿Desea Salir Sin Guardar Cambios?")) {
          location="../index/index.php";
        } 
        else {
          // Hacer nada
        }
      }
      if(tipoAccion == 'C'){    // BAJA - CANCELAR - ESCRIBIENDO
        if (confirm("¿Desea Cancelar?")) {
          document.getElementById("nombre-proveedor-baja-input").value = '';
        } 
        else {
          // Hacer nada
        }
      }
    }
    else{                   // BAJA - SIN ESCRIBIR
      if(document.getElementById("nombre-proveedor-baja-input").value == ''){     
        if(tipoAccion == 'V'){    // BAJA - VOLVER - SIN ESCRIBIR
          if (confirm("¿Desea Volver al Menú Principal?")) {
            location="../index/index.php";
          } 
          else {
            // Hacer nada
          }
        }
      }
    }
  }

  if(tipoFormulario == 'M'){    // MODIFICACIÓN - ESCRIBIENDO
    if( document.getElementById("descripcion-proveedor-modificacion-input").value != '' ||
        document.getElementById("direccion-proveedor-modificacion-input").value != '' ||
        document.getElementById("localidad-proveedor-modificacion-input").value != '' ||
        document.getElementById("provincia-proveedor-modificacion-input").value != '' ||
        document.getElementById("telefono1-proveedor-modificacion-input").value != '' ||
        document.getElementById("telefono2-proveedor-modificacion-input").value != '' ||
        document.getElementById("email-proveedor-modificacion-input").value != '' ||
        document.getElementById("cuit-proveedor-modificacion-input").value != ''){ 
          if(tipoAccion == 'V'){    // MODIFICACIÓN - VOLVER - ESCRIBIENDO
            if (confirm("¿Desea Salir Sin Guardar Cambios?")) {
              location="../index/index.php";
            } 
            else {
              // Hacer nada
            }
          }
          if(tipoAccion == 'C'){    // MODIFICACIÓN - CANCELAR - ESCRIBIENDO
            if (confirm("¿Desea Cancelar la Operación?")) {
              document.getElementById("descripcion-proveedor-modificacion-input").value = ''; 
              document.getElementById("direccion-proveedor-modificacion-input").value = ''; 
              document.getElementById("localidad-proveedor-modificacion-input").value = ''; 
              document.getElementById("provincia-proveedor-modificacion-input").value = ''; 
              document.getElementById("telefono1-proveedor-modificacion-input").value = ''; 
              document.getElementById("telefono2-proveedor-modificacion-input").value = ''; 
              document.getElementById("email-proveedor-modificacion-input").value = ''; 
              document.getElementById("cuit-proveedor-modificacion-input").value = '';
            } 
            else {
              // Hacer nada
            }
          }
    }
    else{ 
      if( document.getElementById("descripcion-proveedor-modificacion-input").value == '' ||
        document.getElementById("direccion-proveedor-modificacion-input").value == '' ||
        document.getElementById("localidad-proveedor-modificacion-input").value == '' ||
        document.getElementById("provincia-proveedor-modificacion-input").value == '' ||
        document.getElementById("telefono1-proveedor-modificacion-input").value == '' ||
        document.getElementById("telefono2-proveedor-modificacion-input").value == '' ||
        document.getElementById("email-proveedor-modificacion-input").value == '' ||
        document.getElementById("cuit-proveedor-modificacion-input").value == ''){ 
          if(tipoAccion == 'V'){    // MODIFICACIÓN - VOLVER - SIN ESCRIBIR
            if (confirm("¿Desea Volver al Menú Principal?")) {
              location="../index/index.php";
            } 
            else {
              // Hacer nada
            }
          }
        }
    }
  }
}
