<?php
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $nombreProveedor = $_POST['nombreProveedor'];
    $usuarioLogueado = $_SESSION['id'];

     // Consulta para verificar si el nombre de usuario existe en la tabla
     $consulta = "SELECT * FROM proveedores WHERE prov_nombre = '$nombreProveedor'";
     $resultado = $conexion->query($consulta);
 
     // Verificar si se encontró alguna fila (es decir, si el nombre de usuario existe)
     if ($resultado->num_rows > 0) {
         // Si el nombre de usuario existe, se capturan los datos para el historial.
            // Obtener el ID del usuario que se está actualizando
            $fila = $resultado->fetch_assoc();
            $idProveedor_borrar = $fila['id'];
            $nombreProveedor_borrar = $fila['prov_nombre'];
            $descripcionProveedor_borrar = $fila['prov_descripcion'];
            $direccionProveedor_borrar = $fila['prov_direccion'];
            $localidadProveedor_borrar = $fila['prov_localidad'];
            $provinciaProveedor_borrar = $fila['prov_provincia'];
            $telefono1Proveedor_borrar = $fila['prov_tel1'];
            $telefono2Proveedor_borrar = $fila['prov_tel2'];
            $emailProveedor = $fila['prov_email'];
            $cuitProveedor_borrar = $fila['prov_cuit'];

        // Se busca el registro de alta del id del proveedor para guardar el usuario y la fecha de alta en el registro del historial
        $consulta_alta_historial = "SELECT TOP 1 histprov_fechaalta, histprov_usuarioalta  
                                    FROM historial_proveedores 
                                    WHERE histprov_id_prov = $idProveedor_borrar
                                    AND histprov_accion = 'alta_prov'
                                    ORDER BY id desc";
        $resultado_historial = $conexion->query($consulta_alta_historial);
        if ($resultado_historial->num_rows > 0) {
            $fila_historial = $resultado_historial->fetch_assoc();
            $fechaAltaHistorial = $fila_historial['histprov_fechaalta'];
            $usuarioAltaHistorial = $fila_historial['histprov_usuarioalta'];
        }

        // Se procede a eliminar el usuario
         $eliminarProveedor = "DELETE FROM proveedores WHERE prov_nombre = '$nombreProveedor'";

         //Se inserta el historial del cambio en la tabla de historial de modificaciones de proveedores
         if ($conexion->query($eliminarProveedor) === TRUE) {
            
            $insertarHistorial = "INSERT INTO historial_proveedores 
                                (
                                    histprov_accion, 
                                    histprov_id_usu, 
                                    histprov_id_prov, 
                                    histprov_nombre, 
                                    histprov_descripcion, 
                                    histprov_direccion, 
                                    histprov_localidad, 
                                    histprov_provincia, 
                                    histprov_tel1,
                                    histprov_tel2,
                                    histprov_email,
                                    histprov_cuit,
                                    histprov_fechaalta,
                                    histprov_usuarioalta,
                                    histprov_fechabaja,
                                    histprov_usuariobaja,
                                    histprov_activo
                                ) 
                                VALUES 
                                (
                                    'baja_prov', 
                                    '$usuarioLogueado', 
                                    '$idProveedor_borrar', 
                                    '$nombreProveedor_borrar', 
                                    '$descripcionProveedor_borrar', 
                                    '$direccionProveedor_borrar', 
                                    '$localidadProveedor_borrar', 
                                    '$provinciaProveedor_borrar', 
                                    '$telefono1Proveedor_borrar',
                                    '$telefono2Proveedor_borrar', 
                                    '$emailProveedor_borrar',
                                    '$cuitProveedor_borrar',
                                    '$fechaAltaHistorial',
                                    '$usuarioAltaHistorial',
                                    NOW(), 
                                    '$usuarioLogueado',
                                    'N'
                                )";
            
            if ($conexion->query($insertarHistorial) === TRUE) {
                echo "Usuario $nombreUsuario eliminado correctamente";
            } else {
                echo "Error al insertar el historial del usuario en la tabla: " . $conexion->error;
            }
        } else {
             echo "Error al borrar el usuario en la tabla: " . $conexion->error;
         }
     } else {
         // Si el nombre de usuario no existe, muestra un mensaje
         echo "El usuario $nombreUsuario no existe en la base de datos";
     }
?>