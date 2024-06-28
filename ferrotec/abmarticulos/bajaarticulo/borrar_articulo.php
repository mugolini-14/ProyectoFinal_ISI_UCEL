<?php
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $nombreArticulo = $_POST['nombreArticulo'];
    $usuarioLogueado = $_SESSION['id'];

     // Consulta para verificar si el nombre de articulo existe en la tabla
     $consulta = "SELECT * FROM articulos WHERE art_nombre = '$nombreArticulo'";
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
            $stockArticulo = $fila['art_stock'];
            $fechaaltaArticulo = $fila['art_fechaalta'];
            $usuarioaltaArticulo = $fila['art_usuarioalta'];

        // Se procede a eliminar el articulo
         $eliminarArticulo = "DELETE FROM articulos WHERE art_nombre = '$nombreArticulo'";

         if ($conexion->query($eliminarArticulo) === TRUE) {
            //Se inserta el historial del cambio en la tabla de historial de modificaciones de articulos
            $insertarHistorial = "INSERT INTO historial_articulos (histart_id_art, histart_accion, histart_id_usu, histart_id_categoria, histart_nombre, histart_marca, histart_descripcion, histart_precio, histart_stock, histart_fechaalta, histart_usuarioalta, histart_fechabaja, histart_usuariobaja) 
                                                    VALUES ('$idArticulo_borrar','borrar_art', '$usuarioLogueado', '$catArticulo', '$nombreArticulo','$marcaArticulo', '$descripcionArticulo','$precioArticulo', '$stockArticulo','$fechaaltaArticulo','$usuarioaltaArticulo',NOW(),'$usuarioLogueado')";
            
            if ($conexion->query($insertarHistorial) === TRUE) {
                echo "Articulo $nombreArticulo eliminado correctamente";
            } else {
                echo "Error al insertar el historial del articulo en la tabla: " . $conexion->error;
            }
        } else {
             echo "Error al borrar el articulo en la tabla: " . $conexion->error;
         }
     } else {
         // Si el nombre de articulo no existe, muestra un mensaje
         echo "El articulo $nombreArticulo no existe en la base de datos";
     }
?>