<?php
/*
    PHP:            modificar_tipo.php
    Descripción:    Busca y Modifica de la base de datos un registro de tipo
*/
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $nombreTipo = $_POST['nombretipo'];
    $renombreTipo = $_POST['renombretipo'];
    $descripcionTipo = $_POST['descripciontipo'];
    $estadoTipo = $_POST['estadoTipo'];
    $usuarioLogueado = $_SESSION['id'];

    // Consulta para verificar si el nombre de tipo ya existe en la tabla
    $consulta = "SELECT * 
                FROM tipos 
                WHERE tipos_nombre = '$nombreTipo'";
    $resultado = $conexion->query($consulta);

    // Verificar si se encontró alguna fila (es decir, si el nombre de tipo ya existe)
    if ($resultado->num_rows > 0) {

        // Si los nombres del tipo coinciden, ir directamente a la actualización
        if($nombreTipo == $renombreTipo){
            goto actualizarTipoMismoNombre;
        }

        // Verifica si el nuevo nombre de artículo no exista
        $consulta_nuevo_nombre_tipo = "SELECT *
                                       FROM tipos
                                       WHERE tipos_nombre = '$renombreTipo'";

        $resultado_consulta_nuevo_nombre_tipo = $conexion->query($consulta_nuevo_nombre_tipo);

        if($resultado_consulta_nuevo_nombre_tipo->num_rows >0){
            echo 'El nuevo nombre del tipo de artículo ya existe.';
        }
        else{
            // Si el nombre de tipo ya existe, proceder con la actualización
            // Si el tipo tiene el mismo nombre, actualiza directamente los datos
            actualizarTipoMismoNombre:
            $actualizartipo = "UPDATE tipos SET tipos_nombre = '$renombreTipo',
                                                tipos_descripcion = '$descripcionTipo',
                                                tipos_activo = '$estadoTipo'
                               WHERE tipos_nombre = '$nombreTipo'"; // Modifica el nombre y la descripción.

            if ($conexion->query($actualizartipo) === TRUE) {
                // Consulta para obtener los datos actualizados después de la actualización
                $consulta_actualizada = "SELECT * 
                                        FROM tipos 
                                        WHERE tipos_nombre = '$renombreTipo'";
                $resultado_actualizado = $conexion->query($consulta_actualizada);
                if ($resultado_actualizado->num_rows > 0) {
                    $fila = $resultado_actualizado->fetch_assoc();
                    $idtipo_modif = $fila['id'];

                    //Se inserta el historial del cambio en la tabla de historial de modificaciones de tipos
                    $insertarHistorial = "INSERT INTO historial_tipos (histtipos_accion,
                                                                       histtipos_id_usu, 
                                                                       histtipos_id_tipos,
                                                                       histtipos_nombre, 
                                                                       histtipos_descripcion,
                                                                       histtipos_activo) 
                                                                VALUES ('modif_tipo',
                                                                        '$usuarioLogueado',
                                                                        '$idtipo_modif',
                                                                        '$renombreTipo',
                                                                        '$descripcionTipo',
                                                                        $estadoTipo)";  

                    if ($conexion->query($insertarHistorial) === TRUE) {
                        echo "Tipo $nombreTipo modificado correctamente.";
                    } 
                    else {
                        echo "Error al insertar el historial del tipo en la tabla: " . $conexion->error;
                    }
                }
            } 
            else {
                echo "Error al actualizar el tipo en la tabla: " . $conexion->error;
            }
        }
        
    } else {
        // Si el nombre de tipo no existe, mostrar un alert con un mensaje de error
        echo "El nombre de tipo de artículo no existe.";
    }
    
    // Cerrar conexión
    $conexion->close();
?>
