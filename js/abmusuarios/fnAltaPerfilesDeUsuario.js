//  fnAltaPerfilesDeUsuario
//  Descripción: Permite preseleccionar los diferentes accesos según el usuario a dar el alta
//  O permite crear un usuario con accesos personalizados

function fnAltaPerfilesDeUsuario(tipoperfil){

    // Seleccione / Inicializar
    if(tipoperfil==0){
      document.getElementById("acceso-ventas-alta-opciones").value = '0';
      document.getElementById("acceso-ventas-alta-opciones").disabled = true;

      document.getElementById("acceso-compras-alta-opciones").value = '0';
      document.getElementById("acceso-compras-alta-opciones").disabled = true;

      document.getElementById("acceso-informes-alta-opciones").value = '0';
      document.getElementById("acceso-informes-alta-opciones").disabled = true;

      document.getElementById("acceso-consultas-alta-opciones").value = '0';
      document.getElementById("acceso-consultas-alta-opciones").disabled = true;

      document.getElementById("acceso-usuarios-alta-opciones").value = '0';
      document.getElementById("acceso-usuarios-alta-opciones").disabled = true;
    }
    
    // Usuario Vendedor
    if(tipoperfil==1){
      document.getElementById("acceso-ventas-alta-opciones").value = '1';
      document.getElementById("acceso-ventas-alta-opciones").disabled = true;

      document.getElementById("acceso-compras-alta-opciones").value = '2';
      document.getElementById("acceso-compras-alta-opciones").disabled = true;

      document.getElementById("acceso-informes-alta-opciones").value = '2';
      document.getElementById("acceso-informes-alta-opciones").disabled = true;

      document.getElementById("acceso-consultas-alta-opciones").value = '1';
      document.getElementById("acceso-consultas-alta-opciones").disabled = true;

      document.getElementById("acceso-usuarios-alta-opciones").value = '2';
      document.getElementById("acceso-usuarios-alta-opciones").disabled = true;
    }
    
    // Usuario Contador
    if(tipoperfil==2){
      document.getElementById("acceso-ventas-alta-opciones").value = '1';
      document.getElementById("acceso-ventas-alta-opciones").disabled = true;

      document.getElementById("acceso-compras-alta-opciones").value = '1';
      document.getElementById("acceso-compras-alta-opciones").disabled = true;

      document.getElementById("acceso-informes-alta-opciones").value = '2';
      document.getElementById("acceso-informes-alta-opciones").disabled = true;

      document.getElementById("acceso-consultas-alta-opciones").value = '1';
      document.getElementById("acceso-consultas-alta-opciones").disabled = true;

      document.getElementById("acceso-usuarios-alta-opciones").value = '2';
      document.getElementById("acceso-usuarios-alta-opciones").disabled = true;
    }
    
    // Usuario Dueño
    if(tipoperfil==3){
      document.getElementById("acceso-ventas-alta-opciones").value = '1';
      document.getElementById("acceso-ventas-alta-opciones").disabled = true;

      document.getElementById("acceso-compras-alta-opciones").value = '1';
      document.getElementById("acceso-compras-alta-opciones").disabled = true;

      document.getElementById("acceso-informes-alta-opciones").value = '1';
      document.getElementById("acceso-informes-alta-opciones").disabled = true;

      document.getElementById("acceso-consultas-alta-opciones").value = '1';
      document.getElementById("acceso-consultas-alta-opciones").disabled = true;

      document.getElementById("acceso-usuarios-alta-opciones").value = '2';
      document.getElementById("acceso-usuarios-alta-opciones").disabled = true;
    }

    // Usuario Administrador
    if(tipoperfil==4){
      document.getElementById("acceso-ventas-alta-opciones").value = '1';
      document.getElementById("acceso-ventas-alta-opciones").disabled = true;

      document.getElementById("acceso-compras-alta-opciones").value = '1';
      document.getElementById("acceso-compras-alta-opciones").disabled = true;

      document.getElementById("acceso-informes-alta-opciones").value = '1';
      document.getElementById("acceso-informes-alta-opciones").disabled = true;

      document.getElementById("acceso-consultas-alta-opciones").value = '1';
      document.getElementById("acceso-consultas-alta-opciones").disabled = true;

      document.getElementById("acceso-usuarios-alta-opciones").value = '1';
      document.getElementById("acceso-usuarios-alta-opciones").disabled = true;
    }

    // Usuario Personalizado
    if(tipoperfil==5){
      document.getElementById("acceso-ventas-alta-opciones").value = '0';
      document.getElementById("acceso-ventas-alta-opciones").disabled = false;

      document.getElementById("acceso-compras-alta-opciones").value = '0';
      document.getElementById("acceso-compras-alta-opciones").disabled = false;

      document.getElementById("acceso-informes-alta-opciones").value = '0';
      document.getElementById("acceso-informes-alta-opciones").disabled = false;

      document.getElementById("acceso-consultas-alta-opciones").value = '0';
      document.getElementById("acceso-consultas-alta-opciones").disabled = false;

      document.getElementById("acceso-usuarios-alta-opciones").value = '0';
      document.getElementById("acceso-usuarios-alta-opciones").disabled = false;
    }
  }
