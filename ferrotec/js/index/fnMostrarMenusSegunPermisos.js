//  Funcion: fnMostrarMenusSegunPermisos()
//  Descripción: En la página index.php, muestra el acceso a las diferentes páginas 
//  según los permisos que tenga el usuario,
//  extraída de la variable POST $id_permiso 
//

function fnMostrarMenusSegunPermisos(permisos) {    
    if (permisos == 1) {                                    // Sin permisos
        //  Acordión de Menú
        document.getElementById('accordion-index').classList.add('d-none');     // Oculta el Acordión Completo
        
        //  Texto de Sin Permisos
        document.getElementById('div-sin-permisos').style.display = 'block';    // Muestra el div que tiene el label de Sin Permisos

        //  Texto de Permisos Desconocidos
        document.getElementById('div-permisos-desconocidos').style.display = 'none';    // Muestra el div que tiene el label de Sin Permisos
    }
    else if (permisos == 2) {                               // Vendedor
        //  Módulo Ventas
        document.getElementById('accordion-item-deshacer-ventas').classList.add('d-none');
        
        //  Módulo Compras
        document.getElementById('modulo-compras').classList.add('d-none');     // Oculta el Módulo Completo

        //  Módulo Artículos
        document.getElementById('modulo-articulos').classList.add('d-none');     // Oculta el Módulo Completo

        //  Módulo Reportes
        document.getElementById('modulo-reportes').classList.add('d-none');     // Oculta el Módulo Completo

        //  Módulo Consultas
        document.getElementById('accordion-item-consulta-usuarios').classList.add('d-none');        // Oculta la Consulta de Usuarios

        //  Módulo Historiales
        document.getElementById('accordion-item-historial-articulos').classList.add('d-none');
        document.getElementById('accordion-item-historial-tipos').classList.add('d-none');
        document.getElementById('accordion-item-historial-categorias').classList.add('d-none');
        document.getElementById('accordion-item-historial-usuarios').classList.add('d-none');
        document.getElementById('accordion-item-historial-login').classList.add('d-none');

        //  Módulo Usuarios
        document.getElementById('modulo-usuarios').classList.add('d-none');      // Oculta el Módulo Completo
    }
    else if (permisos == 3) {                               // Supervisor
        //  Módulo Ventas
        //  Ninguno - Acceso Completo
        
        //  Módulo Compras
        //  Ninguno - Acceso Completo

        //  Módulo Artículos
        //  Ninguno - Acceso Completo

        //  Módulo Reportes
        document.getElementById('modulo-reportes').classList.add('d-none');     // Oculta el Módulo Completo

        //  Módulo Consultas
        document.getElementById('accordion-item-consulta-usuarios').classList.add('d-none');        // Oculta la Consulta de Usuarios

        //  Módulo Historiales
        document.getElementById('accordion-item-historial-articulos').classList.add('d-none');
        document.getElementById('accordion-item-historial-tipos').classList.add('d-none');
        document.getElementById('accordion-item-historial-categorias').classList.add('d-none');
        document.getElementById('accordion-item-historial-usuarios').classList.add('d-none');

        //  Módulo Usuarios
        document.getElementById('modulo-usuarios').classList.add('d-none');      // Oculta el Módulo Completo
    }
    else if (permisos == 4) {                               // Administrador
        //  Módulo Ventas
        //  Ninguno - Acceso Completo
        
        //  Módulo Compras
        //  Ninguno - Acceso Completo

        //  Módulo Artículos
        //  Ninguno - Acceso Completo

        //  Módulo Reportes
        //  Ninguno - Acceso Completo

        //  Módulo Historiales
        //  Ninguno - Acceso Completo

        //  Módulo Accesos
        //  Ninguno - Acceso Completo

        //  Texto de Sin Permisos
        document.getElementById('div-sin-permisos').style.display = 'none';             // Oculta el div que tiene el label de Sin Permisos

        //  Texto de Permisos Desconocidos
        document.getElementById('div-permisos-desconocidos').style.display = 'none';    // Oculta el div que tiene el label de Sin Permisos
    }
    else {                                                  // Permisos Desconocidos
        //  Acordión de Menú
        document.getElementById('accordion-index').classList.add('d-none');             // Oculta el Acordión Completo
        
        //  Texto de Sin Permisos
        document.getElementById('div-sin-permisos').style.display = 'none';             // Muestra el div que tiene el label de Sin Permisos

        //  Texto de Permisos Desconocidos
        document.getElementById('div-permisos-desconocidos').style.display = 'block';    // Muestra el div que tiene el label de Sin Permisos
    }
}