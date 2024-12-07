<?php
/*
    PHP:            borrar_tipo.php
    Descripción:    Borra de la base de datos un registro de tipo
*/
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $nombretipo = $_POST['nombretipo'];
    $usuarioLogueado = $_SESSION['id'];

     // Verifica si el tipo ingreso existe y si no está inactivo
     $consulta = "SELECT * 
                 FROM tipos 
                 WHERE tipos_nombre = '$nombretipo'
                 AND tipos_activo = 1";

     $resultado = $conexion->query($consulta);
 
     // Verificar si se encontró alguna fila (es decir, si el nombre de tipo existe)
     if ($resultado->num_rows > 0) {
         // Si el nombre de tipo existe, se capturan los datos para el historial.
            // Obtener el ID del tipo que se está actualizando
            $fila = $resultado->fetch_assoc();
            $idtipo_borrar = $fila['id'];
            $descripcionTipo = $fila['tipos_descripcion'];
            $nombreTipo = $fila['tipos_nombre'];

        // Se procede a eliminar el tipo
         $eliminartipo = "UPDATE tipos 
                          SET tipos_activo = 0 
                          WHERE tipos_nombre = '$nombretipo'";

         if ($conexion->query($eliminartipo) === TRUE) {
            //Se inserta el historial del cambio en la tabla de historial de modificaciones de tipos
            $insertarHistorial = "INSERT INTO historial_tipos (histtipos_accion, 
                                                               histtipos_id_usu, 
                                                               histtipos_id_tipos, 
                                                               histtipos_nombre, 
                                                               histtipos_descripcion,
                                                               histtipos_activo) 
                                                        VALUES ('baja_tipo', 
                                                                '$usuarioLogueado',
                                                                '$idtipo_borrar',
                                                                '$nombreTipo',
                                                                '$descripcionTipo',
                                                                0)";
            
            if ($conexion->query($insertarHistorial) === TRUE) {
                echo "Tipo $nombretipo dado de baja correctamente.";
            } 
            else {
                echo "Error al insertar el historial del tipo en la tabla: " . $conexion->error;
            }
        } 
        else {
             echo "Error al borrar el tipo en la tabla: " . $conexion->error;
         }
     } 
     else {
         // Si el nombre de tipo no existe, muestra un mensaje
         echo "El tipo de artículo ingresado no existe o no está activo.";
     }
?>