<?php
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $nombreProveedor = $_POST['nombreProveedor'];
    $descripcionProveedor = $_POST['descripcionProveedor'];
    $direccionProveedor = $_POST['direccionProveedor'];
    $localidadProveedor = $_POST['localidadProveedor'];
    $provinciaProveedor = $_POST['provinciaProveedor'];
    $telefono1Proveedor = $_POST['telefono1Proveedor'];
    $telefono2Proveedor = $_POST['telefono2Proveedor'];
    $emailProveedor = $_POST['emailProveedor'];
    $cuitProveedor = $_POST['cuitProveedor'];
    $usuarioLogueado = $_SESSION['id'];

    // Consulta para verificar si el nombre del proveedor ya existe en la tabla
    $consulta = "SELECT * FROM proveedores WHERE prov_nombre = '$nombreProveedor'";
    $resultado = $conexion->query($consulta);
    
    // Se busca el id del Proveedor para ser usado en consultas más adelante
    $fila = $resultado->fetch_assoc();
    $idProveedor_Modificar = $fila['id'];

    // Verificar si se encontró alguna fila (es decir, si el nombre de usuario ya existe)
    if ($resultado->num_rows > 0) {
        // Se busca la Fecha de Alta y el Usuario de Alta del último registro del historial para guardarla posteriormente
        $consulta_alta_historial = "SELECT TOP 1 histprov_fechaalta, histprov_usuarioalta  
                                    FROM historial_proveedores 
                                    WHERE histprov_id_prov = $idProveedor_Modificar
                                    AND histprov_accion = 'alta_prov'
                                    OR histprov_accion = 'modif_prov'
                                    ORDER BY id desc";
        $resultado_historial = $conexion->query($consulta_alta_historial);
        if ($resultado_historial->num_rows > 0) {
            $fila_historial = $resultado_historial->fetch_assoc();
            $fechaAltaHistorial = $fila_historial['histprov_fechaalta'];
            $usuarioAltaHistorial = $fila_historial['histprov_usuarioalta'];
        }
        
        // Si el nombre de usuario ya existe, proceder con la actualización
        $actualizarProveedor = "UPDATE proveedores 
                                SET prov_descripcion = $descripcionProveedor,
                                    prov_direccion = $direccionProveedor,
                                    prov_localidad = $localidadProveedor,
                                    prov_provincia = $provinciaProveedor,
                                    prov_tel1 = $telefono1Proveedor,
                                    prov_tel2 = $telefono2Proveedor,
                                    prov_email = $emailProveedor,
                                    prov_cuit = $cuitProveedor
                                WHERE id = $idProveedor_Modificar"; // Función NOW() para que inserte la fecha actual ya que como también está el campo usu_fecha_creacion no se puede utilizar el current_timestamp de MySQL
        
        //Se inserta el historial del cambio en la tabla de historial de modificaciones de usuarios
        if ($conexion->query($actualizarProveedor) === TRUE) {
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
                                    'modif_prov', 
                                    '$usuarioLogueado', 
                                    '$idProveedor_Modificar', 
                                    '$nombreProveedor', 
                                    '$descripcionProveedor', 
                                    '$direccionProveedor', 
                                    '$localidadProveedor', 
                                    '$provinciaProveedor', 
                                    '$telefono1Proveedor',
                                    '$telefono2Proveedor', 
                                    '$emailProveedor',
                                    '$cuitProveedor',
                                    '$fechaAltaHistorial',
                                    '$usuarioAltaHistorial', 
                                    NULL,
                                    NULL,
                                    'S'
                                )";
            if ($conexion->query($insertarHistorial) === TRUE) {
                echo "Proveedor $nombreProveedor modificado correctamente";
            } else {
                echo "Error al insertar el historial del Proveedor en la tabla: " . $conexion->error;
            }
        } else {
            echo "Error al actualizar el Proveedor en la tabla: " . $conexion->error;
        }
    } else {
        // Si el nombre de usuario no existe, mostrar un alert con un mensaje de error
        echo "El nombre de Proveedor $nombreProveedor no existe en la base de datos.";
    }
    
    // Cerrar conexión
    $conexion->close();
?>
