//  fnModificacionPerfilesDeUsuario
//  Descripción: Permite preseleccionar los diferentes accesos según el usuario a dar el alta
//  O permite crear un usuario con accesos personalizados

function fnModificacionPerfilesDeUsuario(tipoperfil){

    // Seleccione / Inicializar
    if(tipoperfil==0){
      document.getElementById("acceso-ventas-modificacion-opciones").value = '0';
      document.getElementById("acceso-ventas-modificacion-opciones").disabled = true;

      document.getElementById("acceso-compras-modificacion-opciones").value = '0';
      document.getElementById("acceso-compras-modificacion-opciones").disabled = true;

      document.getElementById("acceso-informes-modificacion-opciones").value = '0';
      document.getElementById("acceso-informes-modificacion-opciones").disabled = true;

      document.getElementById("acceso-consultas-modificacion-opciones").value = '0';
      document.getElementById("acceso-consultas-modificacion-opciones").disabled = true;

      document.getElementById("acceso-usuarios-modificacion-opciones").value = '0';
      document.getElementById("acceso-usuarios-modificacion-opciones").disabled = true;
    }

    // Usuario Vendedor
    if(tipoperfil==1){
      document.getElementById("acceso-ventas-modificacion-opciones").value = '1';
      document.getElementById("acceso-ventas-modificacion-opciones").disabled = true;

      document.getElementById("acceso-compras-modificacion-opciones").value = '2';
      document.getElementById("acceso-compras-modificacion-opciones").disabled = true;

      document.getElementById("acceso-informes-modificacion-opciones").value = '2';
      document.getElementById("acceso-informes-modificacion-opciones").disabled = true;

      document.getElementById("acceso-consultas-modificacion-opciones").value = '1';
      document.getElementById("acceso-consultas-modificacion-opciones").disabled = true;

      document.getElementById("acceso-usuarios-modificacion-opciones").value = '2';
      document.getElementById("acceso-usuarios-modificacion-opciones").disabled = true;
    }

    // Usuario Contador
    if(tipoperfil==2){
      document.getElementById("acceso-ventas-modificacion-opciones").value = '1';
      document.getElementById("acceso-ventas-modificacion-opciones").disabled = true;

      document.getElementById("acceso-compras-modificacion-opciones").value = '1';
      document.getElementById("acceso-compras-modificacion-opciones").disabled = true;

      document.getElementById("acceso-informes-modificacion-opciones").value = '2';
      document.getElementById("acceso-informes-modificacion-opciones").disabled = true;

      document.getElementById("acceso-consultas-modificacion-opciones").value = '1';
      document.getElementById("acceso-consultas-modificacion-opciones").disabled = true;

      document.getElementById("acceso-usuarios-modificacion-opciones").value = '2';
      document.getElementById("acceso-usuarios-modificacion-opciones").disabled = true;
    }

    // Usuario Dueño
    if(tipoperfil==3){
      document.getElementById("acceso-ventas-modificacion-opciones").value = '1';
      document.getElementById("acceso-ventas-modificacion-opciones").disabled = true;

      document.getElementById("acceso-compras-modificacion-opciones").value = '1';
      document.getElementById("acceso-compras-modificacion-opciones").disabled = true;

      document.getElementById("acceso-informes-modificacion-opciones").value = '1';
      document.getElementById("acceso-informes-modificacion-opciones").disabled = true;

      document.getElementById("acceso-consultas-modificacion-opciones").value = '1';
      document.getElementById("acceso-consultas-modificacion-opciones").disabled = true;

      document.getElementById("acceso-usuarios-modificacion-opciones").value = '2';
      document.getElementById("acceso-usuarios-modificacion-opciones").disabled = true;
    }

    // Usuario Administrador
    if(tipoperfil==4){
      document.getElementById("acceso-ventas-modificacion-opciones").value = '1';
      document.getElementById("acceso-ventas-modificacion-opciones").disabled = true;

      document.getElementById("acceso-compras-modificacion-opciones").value = '1';
      document.getElementById("acceso-compras-modificacion-opciones").disabled = true;

      document.getElementById("acceso-informes-modificacion-opciones").value = '1';
      document.getElementById("acceso-informes-modificacion-opciones").disabled = true;

      document.getElementById("acceso-consultas-modificacion-opciones").value = '1';
      document.getElementById("acceso-consultas-modificacion-opciones").disabled = true;

      document.getElementById("acceso-usuarios-modificacion-opciones").value = '1';
      document.getElementById("acceso-usuarios-modificacion-opciones").disabled = true;
    }

    // Usuario Personalizado
    if(tipoperfil==5){
      document.getElementById("acceso-ventas-modificacion-opciones").value = '0';
      document.getElementById("acceso-ventas-modificacion-opciones").disabled = false;

      document.getElementById("acceso-compras-modificacion-opciones").value = '0';
      document.getElementById("acceso-compras-modificacion-opciones").disabled = false;

      document.getElementById("acceso-informes-modificacion-opciones").value = '0';
      document.getElementById("acceso-informes-modificacion-opciones").disabled = false;

      document.getElementById("acceso-consultas-modificacion-opciones").value = '0';
      document.getElementById("acceso-consultas-modificacion-opciones").disabled = false;

      document.getElementById("acceso-usuarios-modificacion-opciones").value = '0';
      document.getElementById("acceso-usuarios-modificacion-opciones").disabled = false;
    }
  }