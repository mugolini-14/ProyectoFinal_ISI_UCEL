// fnPerfilesDeUsuario
// Descripción: Función que permite seleccionar perfiles de usuarios preestablecidos
//              o Crear uno Personalizado
// tipoFormulario --> A (Alta) / M (Modificación)

function fnPerfilesDeUsuario (tipoFormulario,perfilDeUsuario){

    if(tipoFormulario == 'A'){
        // Seleccione / Inicializar
        if(perfilDeUsuario==0){
            document.getElementById("nombre-usuario-alta-input").value = '';

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
        if(perfilDeUsuario==1){
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
        if(perfilDeUsuario==2){
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
        if(perfilDeUsuario==3){
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
        if(perfilDeUsuario==4){
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
        if(perfilDeUsuario==5){
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
    
    if(tipoFormulario == 'M'){
        // Seleccione / Inicializar
        if(perfilDeUsuario==0){
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
        if(perfilDeUsuario==1){
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
        if(perfilDeUsuario==2){
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
        if(perfilDeUsuario==3){
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
        if(perfilDeUsuario==4){
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
        if(perfilDeUsuario==5){
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
}