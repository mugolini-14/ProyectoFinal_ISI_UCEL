// function fnHabilitarPerfilArticulo
// Descripción: Función que habilita el Combo del Perfil de Articulo 
// tipoFormulario --> A (Alta) / M (Modificación)
// perfilArticulo --> 

function fnHabilitarPerfilArticulo(tipoFormulario,perfilArticulo){
    if(tipoFormulario == 'A'){
        if(perfilArticulo==0){
            document.getElementById("perfil-acceso-alta-articulo-opciones").value = '0';
            document.getElementById("perfil-acceso-alta-articulo-opciones").disabled = true;
          }
          if(perfilArticulo==1){
            document.getElementById("perfil-acceso-alta-articulo-opciones").value = '0';
            document.getElementById("perfil-acceso-alta-articulo-opciones").disabled = false;
          }
          if(document.getElementById("nombre-articulo-alta-input").value.length==0){
            document.getElementById("perfil-acceso-alta-articulo-opciones").value = '0';
            document.getElementById("perfil-acceso-alta-articulo-opciones").disabled = true;
          }
    }

    if(tipoFormulario == 'M'){
        if(perfilArticulo==0){
            document.getElementById("perfil-acceso-modificacion-articulo-opciones").value = '0';
            document.getElementById("perfil-acceso-modificacion-articulo-opciones").disabled = true;
          }
          if(perfilArticulo!=0){
            document.getElementById("perfil-acceso-modificacion-articulo-opciones").value = '0';
            document.getElementById("perfil-acceso-modificacion-articulo-opciones").disabled = false;
          }
    }
}