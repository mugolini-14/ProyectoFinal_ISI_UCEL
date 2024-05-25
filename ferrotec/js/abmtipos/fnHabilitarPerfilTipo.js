// function fnHabilitarPerfiltipo
// Descripción: Función que habilita el Combo del Perfil de tipo 
// tipoFormulario --> A (Alta) / M (Modificación)
// perfiltipo --> 

function fnHabilitarPerfiltipo(tipoFormulario,perfiltipo){
    if(tipoFormulario == 'A'){
        if(perfiltipo==0){
            document.getElementById("perfil-acceso-alta-tipo-opciones").value = '0';
            document.getElementById("perfil-acceso-alta-tipo-opciones").disabled = true;
          }
          if(perfiltipo==1){
            document.getElementById("perfil-acceso-alta-tipo-opciones").value = '0';
            document.getElementById("perfil-acceso-alta-tipo-opciones").disabled = false;
          }
          if(document.getElementById("nombre-tipo-alta-input").value.length==0){
            document.getElementById("perfil-acceso-alta-tipo-opciones").value = '0';
            document.getElementById("perfil-acceso-alta-tipo-opciones").disabled = true;
          }
    }

    if(tipoFormulario == 'M'){
        if(perfiltipo==0){
            document.getElementById("perfil-acceso-modificacion-tipo-opciones").value = '0';
            document.getElementById("perfil-acceso-modificacion-tipo-opciones").disabled = true;
          }
          if(perfiltipo!=0){
            document.getElementById("perfil-acceso-modificacion-tipo-opciones").value = '0';
            document.getElementById("perfil-acceso-modificacion-tipo-opciones").disabled = false;
          }
    }
}