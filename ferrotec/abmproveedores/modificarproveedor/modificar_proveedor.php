<?php
/*
    PHP:            modificar_proveedor.php
    Descripción:    Busca y Modifica de la base de datos un registro de proveedor
*/
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $nombreProveedor = $_POST['nombreProveedor'];
    $renombreProveedor = $_POST['renombreProveedor'];
    $descripcionProveedor = $_POST['descripcionProveedor'];
    $direccionProveedor = $_POST['direccionProveedor'];
    $localidadProveedor = $_POST['localidadProveedor'];
    $provinciaProveedor = $_POST['provinciaProveedor'];
    $telefono1Proveedor = $_POST['telefono1Proveedor'];
    $telefono2Proveedor = $_POST['telefono2Proveedor'];
    $emailProveedor = $_POST['emailProveedor'];
    $cuitProveedor = $_POST['cuitProveedor'];
    $estadoProveedor = $_POST['estadoProveedor'];
    $usuarioLogueado = $_SESSION['id'];

    // Consulta para verificar si el nombre del proveedor ya existe en la tabla
    $consulta = "SELECT * 
                FROM proveedores 
                WHERE prov_nombre = '$nombreProveedor'";

    $resultado = $conexion->query($consulta);

    // Verificar si se encontró alguna fila (es decir, si el nombre de proveedor ya existe)
    if ($resultado->num_rows > 0) {

        // Se busca el id del Proveedor para ser usado en consultas más adelante
        $fila = $resultado->fetch_assoc();
        $idProveedor_Modificar = $fila['id'];

        // Si los nombres del proveedor coinciden, ir directamente a la actualización
        if($nombreProveedor == $renombreProveedor){
            goto actualizarProveedorMismoNombre;
        }

        $consulta_nuevo_nombre_proveedor = "SELECT *
                                            FROM proveedores
                                            WHERE prov_nombre = '$renombreProveedor'";
        
        $resultado_consulta_nuevo_nombre_proveedor = $conexion->query($consulta_nuevo_nombre_proveedor);

        if($resultado_consulta_nuevo_nombre_proveedor->num_rows > 0){
            echo "El nuevo nombre del proveedor ya existe. Por favor, ingrese otro.";
        }
        else{
            // Si el nombre del proveedor ya existe, proceder con la actualización
            // Si el proveedor tiene el mismo nombre, actualiza directamente los datos            
            actualizarProveedorMismoNombre:
            $actualizarProveedor = "UPDATE proveedores 
                                    SET prov_nombre = '$renombreProveedor',
                                        prov_descripcion = '$descripcionProveedor',
                                        prov_direccion = '$direccionProveedor',
                                        prov_localidad = '$localidadProveedor',
                                        prov_provincia = '$provinciaProveedor',
                                        prov_tel1 = '$telefono1Proveedor',
                                        prov_tel2 = '$telefono2Proveedor',
                                        prov_email = '$emailProveedor',
                                        prov_cuit = '$cuitProveedor',
                                        prov_activo = '$estadoProveedor'
                                    WHERE id = '$idProveedor_Modificar'"; 
            
            $consulta_alta_historial = "SELECT *  
                                        FROM proveedores 
                                        WHERE id = $idProveedor_Modificar";

            $resultado_historial = $conexion->query($consulta_alta_historial);
    
            //Se inserta el historial del cambio en la tabla de historial de modificaciones de proveedores
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
                                        histprov_activo
                                    ) 
                                    VALUES 
                                    (
                                        'modif_prov', 
                                        '$usuarioLogueado', 
                                        '$idProveedor_Modificar', 
                                        '$renombreProveedor', 
                                        '$descripcionProveedor', 
                                        '$direccionProveedor', 
                                        '$localidadProveedor', 
                                        '$provinciaProveedor', 
                                        '$telefono1Proveedor',
                                        '$telefono2Proveedor', 
                                        '$emailProveedor',
                                        '$cuitProveedor',
                                        '$estadoProveedor'
                                        )";
                if ($conexion->query($insertarHistorial) === TRUE) {
                    echo "Proveedor $nombreProveedor modificado correctamente.";
                } 
                else {
                    echo "Error al insertar el historial del Proveedor en la tabla: " . $conexion->error;
                }
            } 
            else {
                echo "Error al actualizar el Proveedor en la tabla: " . $conexion->error;
            }
        }
        
    } 
    else {
        // Si el nombre de proveedor no existe, mostrar un alert con un mensaje de error
        echo "El nombre del proveedor ingresado no existe.";
    }
    
    // Cerrar conexión
    $conexion->close();
?>
