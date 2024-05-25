<?php
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $nombrecategoria = $_POST['nombrecategoria'];
    $usuarioLogueado = $_SESSION['id'];

     // Consulta para verificar si el nombre de categoria existe en la tabla
     $consulta = "SELECT * FROM categorias WHERE cat_nombre = '$nombrecategoria'";
     $resultado = $conexion->query($consulta);
 
     // Verificar si se encontró alguna fila (es decir, si el nombre de categoria existe)
     if ($resultado->num_rows > 0) {
         // Si el nombre de categoria existe, se capturan los datos para el historial.
            // Obtener el ID del categoria que se está actualizando
            $fila = $resultado->fetch_assoc();
            $idcategoria_borrar = $fila['id'];
            $idpadretipo = $fila['cat_id_tipo'];
            $descripcionCategoria = $fila['cat_descripcion'];
            $nombreCategoria = $fila['cat_nombre'];
            

            $fechaAlta = $fila['cat_fechaalta'];
            $usuarioAlta = $fila['cat_usuarioalta'];
            $fechaBaja = $fila['cat_fechabaja'];
            $usuarioBaja = $fila['cat_usuariobaja'];
            $activo = $fila['cat_activo'];

        // Se procede a eliminar el categoria
         $eliminarcategoria = "DELETE FROM categorias WHERE cat_nombre = '$nombrecategoria'";

         if ($conexion->query($eliminarcategoria) === TRUE) {
            //Se inserta el historial del cambio en la tabla de historial de modificaciones de categorias
            $insertarHistorial = "INSERT INTO historial_categorias (histcat_accion, histcat_id_usu, histcat_id_cat, histcat_nombre, histcat_descripcion, histcat_fechaalta, histcat_usuarioalta, histcat_fechabaja, histcat_usuariobaja, histcat_activo) 
                                                            VALUES ('borrar_categoria', '$usuarioLogueado', '$idcategoria_borrar', '$nombreCategoria','$descripcionCategoria', '$fechaAlta','$usuarioAlta', NULL, NULL, '$activo')";

            
            if ($conexion->query($insertarHistorial) === TRUE) {
                echo "categoria $nombrecategoria eliminado correctamente";
            } else {
                echo "Error al insertar el historial del categoria en la tabla: " . $conexion->error;
            }
        } else {
             echo "Error al borrar el categoria en la tabla: " . $conexion->error;
         }
     } else {
         // Si el nombre de categoria no existe, muestra un mensaje
         echo "El categoria $nombrecategoria no existe en la base de datos";
     }
?>