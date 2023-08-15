// function fnHabilitarPerfilUsuario
// Descripción: Función que habilita el Combo del Perfil de Usuario 
// tipoFormulario --> A (Alta) / M (Modificación)
// perfilUsuario --> 

function fnHabilitarPerfilUsuario(tipoFormulario,perfilUsuario){
    if(tipoFormulario == 'A'){
        if(perfilUsuario==0){
            document.getElementById("perfil-acceso-alta-usuario-opciones").value = '0';
            document.getElementById("perfil-acceso-alta-usuario-opciones").disabled = true;
          }
          if(perfilUsuario==1){
            document.getElementById("perfil-acceso-alta-usuario-opciones").value = '0';
            document.getElementById("perfil-acceso-alta-usuario-opciones").disabled = false;
          }
          if(document.getElementById("nombre-usuario-alta-input").value.length==0){
            document.getElementById("perfil-acceso-alta-usuario-opciones").value = '0';
            document.getElementById("perfil-acceso-alta-usuario-opciones").disabled = true;
          }
    }

    if(tipoFormulario == 'M'){
        if(perfilUsuario==0){
            document.getElementById("perfil-acceso-modificacion-usuario-opciones").value = '0';
            document.getElementById("perfil-acceso-modificacion-usuario-opciones").disabled = true;
          }
          if(perfilUsuario!=0){
            document.getElementById("perfil-acceso-modificacion-usuario-opciones").value = '0';
            document.getElementById("perfil-acceso-modificacion-usuario-opciones").disabled = false;
          }
    }
}