<?php
/*
    PHP:            borrar_articulo.php
    Descripción:    Borra de la base de datos un registro de artículo
*/
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $nombreArticulo = $_POST['nombreArticulo'];
    $usuarioLogueado = $_SESSION['id'];

     // Consulta para verificar si el nombre de articulo existe o ya está desactivado
     $consulta = "SELECT * 
                 FROM articulos 
                 WHERE art_nombre = '$nombreArticulo'
                 AND art_activo = 1";

     $resultado = $conexion->query($consulta);
 
     // Verificar si se encontró alguna fila (es decir, si el nombre de articulo existe)
     if ($resultado->num_rows > 0) {
         // Si el nombre de articulo existe, se capturan los datos para el historial.
            // Obtener el ID del articulo que se va a borrar
            $fila = $resultado->fetch_assoc();
            $idArticulo_borrar = $fila['id'];
            $marcaArticulo = $fila['art_marca'];
            $catArticulo = $fila['art_id_categoria'];
            $descripcionArticulo = $fila['art_descripcion'];
            $precioArticulo = $fila['art_precio'];

        // Se procede a eliminar el articulo
        $dardebajaArticulo = "UPDATE articulos 
                              SET art_activo = 0 
                              WHERE art_nombre = '$nombreArticulo'";

        if ($conexion->query($dardebajaArticulo) === TRUE) {
            //Se inserta el historial del cambio en la tabla de historial de modificaciones de articulos
            $insertarHistorial = "INSERT INTO historial_articulos (histart_id_art, 
                                                                  histart_accion, 
                                                                  histart_id_usu, 
                                                                  histart_id_categoria, 
                                                                  histart_nombre, 
                                                                  histart_marca, 
                                                                  histart_descripcion, 
                                                                  histart_precio, 
                                                                  histart_activo) 
                                                        VALUES ('$idArticulo_borrar',
                                                                'baja_art', 
                                                                '$usuarioLogueado',
                                                                '$catArticulo',
                                                                '$nombreArticulo',
                                                                '$marcaArticulo',
                                                                '$descripcionArticulo',
                                                                '$precioArticulo',
                                                                0)";
            
            if ($conexion->query($insertarHistorial) === TRUE) {
                echo "Articulo $nombreArticulo dado de baja correctamente.";
            } 
            else {
                echo "Error al insertar el historial del articulo en la tabla: " . $conexion->error;
            }
        } 
        else {
            echo "Error al borrar el articulo en la tabla: " . $conexion->error;
        }
     } 
     else {
        // Si el nombre de articulo no existe, muestra un mensaje
        echo "El articulo ingresado no existe o no está activo.";
     }
?>