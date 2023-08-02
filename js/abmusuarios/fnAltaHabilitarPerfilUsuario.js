//  fnAltaHabilitarPerfilUsuario
//  Descripción: Habilita/Deshabilita las opciones de Perfil de Usuario 
//  Según la escritura del campo Nombre de Usuario

function fnAltaHabilitarPerfilUsuario(codigoacceso){
    if(codigoacceso==0){
      document.getElementById("perfil-acceso-alta-usuario-opciones").value = '0';
      document.getElementById("perfil-acceso-alta-usuario-opciones").disabled = true;
    }
    if(codigoacceso==1){
      document.getElementById("perfil-acceso-alta-usuario-opciones").value = '0';
      document.getElementById("perfil-acceso-alta-usuario-opciones").disabled = false;
    }
    if(document.getElementById("nombre-usuario-alta-input").value.length==0){
      document.getElementById("perfil-acceso-alta-usuario-opciones").value = '0';
      document.getElementById("perfil-acceso-alta-usuario-opciones").disabled = true;
    }
  }