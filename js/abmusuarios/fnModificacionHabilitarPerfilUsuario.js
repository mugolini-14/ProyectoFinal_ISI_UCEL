// fnModificacionHabilitarPerfilUsuario
//  Descripción: Habilita/Deshabilita las opciones de Perfil de Usuario 
//  Según la Selección del Campo a Modificar

function fnModificacionHabilitarPerfilUsuario(codigoacceso){
    if(codigoacceso==0){
      document.getElementById("perfil-acceso-modificacion-usuario-opciones").value = '0';
      document.getElementById("perfil-acceso-modificacion-usuario-opciones").disabled = true;
    }
    if(codigoacceso!=0){
      document.getElementById("perfil-acceso-modificacion-usuario-opciones").value = '0';
      document.getElementById("perfil-acceso-modificacion-usuario-opciones").disabled = false;
    }
  }