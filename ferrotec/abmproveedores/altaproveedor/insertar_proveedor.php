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

    // Consulta para verificar si el nombre de usuario ya existe en la tabla
    $consulta = "SELECT * FROM proveedores WHERE prov_nombre = '$nombreProveedor'";
    $resultado = $conexion->query($consulta);

    // Verificar si se encontró alguna fila (es decir, si el nombre de usuario ya existe)
    if ($resultado->num_rows > 0) {
        // Si el nombre de usuario ya existe, mostrar un alert con un mensaje de error
        echo "El nombre del proveedor $nombreProveedor ya está en uso. Por favor, elige otro nombre de usuario.";
    } else {// Consulta para insertar el usuario en la tabla de MySQL
        $sqli = "INSERT INTO proveedores 
                    (
                        prov_nombre, 
                        prov_descripcion,
                        prov_direccion,
                        prov_localidad,
                        prov_provincia,
                        prov_tel1,
                        prov_tel2,
                        prov_email,
                        prov_cuit,
                        prov_fechaalta,
                        prov_usuarioalta,
                        prov_fechabaja,
                        prov_usuariobaja,
                        prov_activo
                    ) 
                VALUES 
                    (
                        '$nombreProveedor', 
                        '$descripcionProveedor', 
                        '$direccionProveedor', 
                        '$localidadProveedor', 
                        '$provinciaProveedor', 
                        '$telefono1Proveedor',
                        '$telefono2Proveedor', 
                        '$emailProveedor',
                        '$cuitProveedor',
                        NOW(),
                        '$usuarioLogueado', 
                        NULL,
                        NULL,
                        'S'
                    )";
        
        if ($conexion->query($sqli) === TRUE) {
            // Obtener el ID del usuario que se insertó
            $id_nuevo_prov_query = $conexion->query("SELECT id FROM proveedores WHERE prov_nombre = '$nombreProveedor'");
            if ($id_nuevo_prov_query) {
                $id_nuevo_prov_row = $id_nuevo_prov_query->fetch_assoc();
                $id_nuevo_prov = $id_nuevo_prov_row['id'];
        
                //Se inserta el historial del cambio en la tabla de historial de modificaciones de usuarios
                $insertarHistorial = "INSERT INTO historial_proveedores 
                                    (
                                        histprov_accion, 
                                        histprov_id_usu, 
                                        histprov_id_prov, 
                                        histprov_nombre, 
                                        histprov_descripcion, histprov_direccion, 
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
                                        'alta_prov', 
                                        '$usuarioLogueado', 
                                        '$id_nuevo_prov', 
                                        '$nombreProveedor', 
                                        '$descripcionProveedor', 
                                        '$direccionProveedor', 
                                        '$localidadProveedor', 
                                        '$provinciaProveedor', 
                                        '$telefono1Proveedor',
                                        '$telefono2Proveedor', 
                                        '$emailProveedor',
                                        '$cuitProveedor',
                                        NOW(),
                                        '$usuarioLogueado', 
                                        NULL,
                                        NULL,
                                        'S'
                                    )";
                
                if ($conexion->query($insertarHistorial) === TRUE) {
                    echo "Proveedor $nombreProveedor creado correctamente.";
                } else {
                    echo "Error al insertar el historial del Proveedor en la tabla: " . $conexion->error;
                }
            } else {
                echo "Error al obtener el ID del nuevo Proveedor: " . $conexion->error;
            }
        } else {
            echo "Error al insertar el Proveedor en la tabla: " . $conexion->error;
        }
    }
    // Cerrar conexión
    $conexion->close();
?>
