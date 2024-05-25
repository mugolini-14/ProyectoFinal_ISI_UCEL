// fnPerfilesDetipo
// Descripción: Función que permite seleccionar perfiles de tipos preestablecidos
//              o Crear uno Personalizado
// tipoFormulario --> A (Alta) / M (Modificación)

function fnPerfilesDetipo (tipoFormulario,perfilDetipo){

    if(tipoFormulario == 'A'){
        // Seleccione / Inicializar
        if(perfilDetipo==0){
            document.getElementById("nombre-tipo-alta-input").value = '';

            document.getElementById("acceso-ventas-alta-opciones").value = '0';
            document.getElementById("acceso-ventas-alta-opciones").disabled = true;
    
            document.getElementById("acceso-compras-alta-opciones").value = '0';
            document.getElementById("acceso-compras-alta-opciones").disabled = true;
    
            document.getElementById("acceso-informes-alta-opciones").value = '0';
            document.getElementById("acceso-informes-alta-opciones").disabled = true;
    
            document.getElementById("acceso-consultas-alta-opciones").value = '0';
            document.getElementById("acceso-consultas-alta-opciones").disabled = true;
    
            document.getElementById("acceso-tipos-alta-opciones").value = '0';
            document.getElementById("acceso-tipos-alta-opciones").disabled = true;
        }
        
        // tipo Vendedor
        if(perfilDetipo==1){
            document.getElementById("acceso-ventas-alta-opciones").value = '1';
            document.getElementById("acceso-ventas-alta-opciones").disabled = true;
    
            document.getElementById("acceso-compras-alta-opciones").value = '2';
            document.getElementById("acceso-compras-alta-opciones").disabled = true;
    
            document.getElementById("acceso-informes-alta-opciones").value = '2';
            document.getElementById("acceso-informes-alta-opciones").disabled = true;
    
            document.getElementById("acceso-consultas-alta-opciones").value = '1';
            document.getElementById("acceso-consultas-alta-opciones").disabled = true;
    
            document.getElementById("acceso-tipos-alta-opciones").value = '2';
            document.getElementById("acceso-tipos-alta-opciones").disabled = true;
        }
        
        // tipo Contador
        if(perfilDetipo==2){
            document.getElementById("acceso-ventas-alta-opciones").value = '1';
            document.getElementById("acceso-ventas-alta-opciones").disabled = true;
    
            document.getElementById("acceso-compras-alta-opciones").value = '1';
            document.getElementById("acceso-compras-alta-opciones").disabled = true;
    
            document.getElementById("acceso-informes-alta-opciones").value = '2';
            document.getElementById("acceso-informes-alta-opciones").disabled = true;
    
            document.getElementById("acceso-consultas-alta-opciones").value = '1';
            document.getElementById("acceso-consultas-alta-opciones").disabled = true;
    
            document.getElementById("acceso-tipos-alta-opciones").value = '2';
            document.getElementById("acceso-tipos-alta-opciones").disabled = true;
        }
        
        // tipo Dueño
        if(perfilDetipo==3){
            document.getElementById("acceso-ventas-alta-opciones").value = '1';
            document.getElementById("acceso-ventas-alta-opciones").disabled = true;
    
            document.getElementById("acceso-compras-alta-opciones").value = '1';
            document.getElementById("acceso-compras-alta-opciones").disabled = true;
    
            document.getElementById("acceso-informes-alta-opciones").value = '1';
            document.getElementById("acceso-informes-alta-opciones").disabled = true;
    
            document.getElementById("acceso-consultas-alta-opciones").value = '1';
            document.getElementById("acceso-consultas-alta-opciones").disabled = true;
    
            document.getElementById("acceso-tipos-alta-opciones").value = '2';
            document.getElementById("acceso-tipos-alta-opciones").disabled = true;
        }
    
        // tipo Administrador
        if(perfilDetipo==4){
            document.getElementById("acceso-ventas-alta-opciones").value = '1';
            document.getElementById("acceso-ventas-alta-opciones").disabled = true;
    
            document.getElementById("acceso-compras-alta-opciones").value = '1';
            document.getElementById("acceso-compras-alta-opciones").disabled = true;
    
            document.getElementById("acceso-informes-alta-opciones").value = '1';
            document.getElementById("acceso-informes-alta-opciones").disabled = true;
    
            document.getElementById("acceso-consultas-alta-opciones").value = '1';
            document.getElementById("acceso-consultas-alta-opciones").disabled = true;
    
            document.getElementById("acceso-tipos-alta-opciones").value = '1';
            document.getElementById("acceso-tipos-alta-opciones").disabled = true;
        }
    
        // tipo Personalizado
        if(perfilDetipo==5){
            document.getElementById("acceso-ventas-alta-opciones").value = '0';
            document.getElementById("acceso-ventas-alta-opciones").disabled = false;
    
            document.getElementById("acceso-compras-alta-opciones").value = '0';
            document.getElementById("acceso-compras-alta-opciones").disabled = false;
    
            document.getElementById("acceso-informes-alta-opciones").value = '0';
            document.getElementById("acceso-informes-alta-opciones").disabled = false;
    
            document.getElementById("acceso-consultas-alta-opciones").value = '0';
            document.getElementById("acceso-consultas-alta-opciones").disabled = false;
    
            document.getElementById("acceso-tipos-alta-opciones").value = '0';
            document.getElementById("acceso-tipos-alta-opciones").disabled = false;
        }
    }
    
    if(tipoFormulario == 'M'){
        // Seleccione / Inicializar
        if(perfilDetipo==0){
            document.getElementById("acceso-ventas-modificacion-opciones").value = '0';
            document.getElementById("acceso-ventas-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-compras-modificacion-opciones").value = '0';
            document.getElementById("acceso-compras-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-informes-modificacion-opciones").value = '0';
            document.getElementById("acceso-informes-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-consultas-modificacion-opciones").value = '0';
            document.getElementById("acceso-consultas-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-tipos-modificacion-opciones").value = '0';
            document.getElementById("acceso-tipos-modificacion-opciones").disabled = true;
        }
    
        // tipo Vendedor
        if(perfilDetipo==1){
            document.getElementById("acceso-ventas-modificacion-opciones").value = '1';
            document.getElementById("acceso-ventas-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-compras-modificacion-opciones").value = '2';
            document.getElementById("acceso-compras-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-informes-modificacion-opciones").value = '2';
            document.getElementById("acceso-informes-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-consultas-modificacion-opciones").value = '1';
            document.getElementById("acceso-consultas-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-tipos-modificacion-opciones").value = '2';
            document.getElementById("acceso-tipos-modificacion-opciones").disabled = true;
        }
    
        // tipo Contador
        if(perfilDetipo==2){
            document.getElementById("acceso-ventas-modificacion-opciones").value = '1';
            document.getElementById("acceso-ventas-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-compras-modificacion-opciones").value = '1';
            document.getElementById("acceso-compras-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-informes-modificacion-opciones").value = '2';
            document.getElementById("acceso-informes-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-consultas-modificacion-opciones").value = '1';
            document.getElementById("acceso-consultas-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-tipos-modificacion-opciones").value = '2';
            document.getElementById("acceso-tipos-modificacion-opciones").disabled = true;
        }
    
        // tipo Dueño
        if(perfilDetipo==3){
            document.getElementById("acceso-ventas-modificacion-opciones").value = '1';
            document.getElementById("acceso-ventas-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-compras-modificacion-opciones").value = '1';
            document.getElementById("acceso-compras-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-informes-modificacion-opciones").value = '1';
            document.getElementById("acceso-informes-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-consultas-modificacion-opciones").value = '1';
            document.getElementById("acceso-consultas-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-tipos-modificacion-opciones").value = '2';
            document.getElementById("acceso-tipos-modificacion-opciones").disabled = true;
        }
    
        // tipo Administrador
        if(perfilDetipo==4){
            document.getElementById("acceso-ventas-modificacion-opciones").value = '1';
            document.getElementById("acceso-ventas-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-compras-modificacion-opciones").value = '1';
            document.getElementById("acceso-compras-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-informes-modificacion-opciones").value = '1';
            document.getElementById("acceso-informes-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-consultas-modificacion-opciones").value = '1';
            document.getElementById("acceso-consultas-modificacion-opciones").disabled = true;
    
            document.getElementById("acceso-tipos-modificacion-opciones").value = '1';
            document.getElementById("acceso-tipos-modificacion-opciones").disabled = true;
        }
    
        // tipo Personalizado
        if(perfilDetipo==5){
            document.getElementById("acceso-ventas-modificacion-opciones").value = '0';
            document.getElementById("acceso-ventas-modificacion-opciones").disabled = false;
    
            document.getElementById("acceso-compras-modificacion-opciones").value = '0';
            document.getElementById("acceso-compras-modificacion-opciones").disabled = false;
    
            document.getElementById("acceso-informes-modificacion-opciones").value = '0';
            document.getElementById("acceso-informes-modificacion-opciones").disabled = false;
    
            document.getElementById("acceso-consultas-modificacion-opciones").value = '0';
            document.getElementById("acceso-consultas-modificacion-opciones").disabled = false;
    
            document.getElementById("acceso-tipos-modificacion-opciones").value = '0';
            document.getElementById("acceso-tipos-modificacion-opciones").disabled = false;
        }
    }
}