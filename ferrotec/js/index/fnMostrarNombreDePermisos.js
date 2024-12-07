//  Función: fnMostrarNombreDePermisos()
//  Descripción: Muestra el nombre del Permiso del Usuario en la label del index.php, según el ID
//  Recibido del PHP POST $id_permiso
//

function fnMostrarNombreDePermisos(permisos){
    if(permisos == 1){                          // Sin Permisos
        document.getElementById('label-nombre-permisos').innerHTML = 'Usuario Sin Permisos';
    }
    else if(permisos == 2){                     // Vendedor
        document.getElementById('label-nombre-permisos').innerHTML = 'Vendedor';
    }
    else if(permisos == 3){                     // Supervisor
        document.getElementById('label-nombre-permisos').innerHTML = 'Supervisor';
    }
    else if(permisos == 4){                     // Administrador
        document.getElementById('label-nombre-permisos').innerHTML = 'Administrador';
    }
    else{                                       // Salida por Defecto
        document.getElementById('label-nombre-permisos').innerHTML = 'Permiso Desconocido';
    }
}