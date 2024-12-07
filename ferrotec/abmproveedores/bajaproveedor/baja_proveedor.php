<?php
/*
    PHP:            borrar_proveedor.php
    Descripción:    Borra de la base de datos un registro de proveedor
*/
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $nombreProveedor = $_POST['nombreProveedor'];
    $usuarioLogueado = $_SESSION['id'];

     // Consulta para verificar si el nombre de proveedor existe en la tabla
     $consulta = "SELECT * 
                 FROM proveedores 
                 WHERE prov_nombre = '$nombreProveedor'
                 AND prov_activo = 1";
     $resultado = $conexion->query($consulta);
 
     // Verificar si se encontró alguna fila (es decir, si el nombre de usuario existe)
     if ($resultado->num_rows > 0) {
         // Si el nombre de proveedor existe, se capturan los datos para el historial.
            // Obtener el ID del proveedor que se está actualizando
            $fila = $resultado->fetch_assoc();
            $idProveedor_borrar = $fila['id'];
            $nombreProveedor_borrar = $fila['prov_nombre'];
            $descripcionProveedor_borrar = $fila['prov_descripcion'];
            $direccionProveedor_borrar = $fila['prov_direccion'];
            $localidadProveedor_borrar = $fila['prov_localidad'];
            $provinciaProveedor_borrar = $fila['prov_provincia'];
            $telefono1Proveedor_borrar = $fila['prov_tel1'];
            $telefono2Proveedor_borrar = $fila['prov_tel2'];
            $emailProveedor_borrar = $fila['prov_email'];
            $cuitProveedor_borrar = $fila['prov_cuit'];

        // Se busca en el registro de alta mediante el id del proveedor
        $consulta_alta_historial = "SELECT * 
                                    FROM proveedores 
                                    WHERE id = $idProveedor_borrar";

        $resultado_historial = $conexion->query($consulta_alta_historial);

        if ($resultado_historial->num_rows > 0) {
            $fila_historial = $resultado_historial->fetch_assoc();
        }

        // Se procede a eliminar el proveedor
         $eliminarProveedor = "UPDATE proveedores 
                              SET prov_activo = 0 
                              WHERE id = '$idProveedor_borrar'";

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
                                    0
                                )";
            
            if ($conexion->query($insertarHistorial) === TRUE) {
                echo "Proveedor $nombreProveedor dado de baja correctamente";
            } else {
                echo "Error al insertar el historial del proveedor en la tabla: " . $conexion->error;
            }
        } else {
             echo "Error al borrar el proveedor en la tabla: " . $conexion->error;
         }
     } else {
         // Si el nombre de proveedor no existe, muestra un mensaje
         echo "El proveedor ingresado no existe o no está activo.";
     }
?>