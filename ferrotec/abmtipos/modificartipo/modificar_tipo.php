<?php
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $nombreTipo = $_POST['nombretipo'];
    $renombreTipo = $_POST['renombretipo'];
    $descripcionTipo = $_POST['descripciontipo'];
    $usuarioLogueado = $_SESSION['id'];

    // Consulta para verificar si el nombre de tipo ya existe en la tabla
    $consulta = "SELECT * FROM tipos WHERE tipos_nombre = '$nombreTipo'";
    $resultado = $conexion->query($consulta);

    // Verificar si se encontró alguna fila (es decir, si el nombre de tipo ya existe)
    if ($resultado->num_rows > 0) {
        // Si el nombre de tipo ya existe, proceder con la actualización, 
        $actualizartipo = "UPDATE tipos SET tipos_nombre = '$renombreTipo',
                            tipos_descripcion = '$descripcionTipo'
                             WHERE tipos_nombre = '$nombreTipo'"; // Modifica el nombre y la descripción.
        
        if ($conexion->query($actualizartipo) === TRUE) {
            // Consulta para obtener los datos actualizados después de la actualización
            $consulta_actualizada = "SELECT * FROM tipos WHERE tipos_nombre = '$renombreTipo'";
            $resultado_actualizado = $conexion->query($consulta_actualizada);
            if ($resultado_actualizado->num_rows > 0) {
                $fila = $resultado_actualizado->fetch_assoc();
                $idtipo_modif = $fila['id'];
                $fechaAlta = $fila['tipos_fechaalta'];
                $usuarioAlta = $fila['tipos_usuarioalta'];
                $fechaBaja = $fila['tipos_fechabaja'];
                $usuarioBaja = $fila['tipos_usuariobaja'];
                $activo = $fila['tipos_activo'];

                //Se inserta el historial del cambio en la tabla de historial de modificaciones de tipos
                $insertarHistorial = "INSERT INTO historial_tipos (histtipos_accion, histtipos_id_usu, histtipos_id_tipos, histtipos_nombre, histtipos_descripcion, histtipos_fechaalta, histtipos_altausu, histtipos_fechabaja, histtipos_usuariobaja) 
                VALUES ('modif_tipo', '$usuarioLogueado', '$idtipo_modif', '$renombreTipo','$descripcionTipo', '$fechaAlta','$usuarioAlta', NULL, NULL)";  


                if ($conexion->query($insertarHistorial) === TRUE) {
                    echo "tipo $nombreTipo modificado correctamente";
                } else {
                    echo "Error al insertar el historial del tipo en la tabla: " . $conexion->error;
                }
            }
        } else {
            echo "Error al actualizar el tipo en la tabla: " . $conexion->error;
        }
    } else {
        // Si el nombre de tipo no existe, mostrar un alert con un mensaje de error
        echo "El nombre de tipo $nombreTipo no existe en la base de datos.";
    }
    
    // Cerrar conexión
    $conexion->close();
?>
