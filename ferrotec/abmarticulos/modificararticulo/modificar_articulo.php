<?php
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $nombreArticulo = $_POST['nombreArticulo'];
    $renombreArticulo = $_POST['renombreArticulo'];
    $marcaArticulo = $_POST['marcaArticulo'];
    $descripcionArticulo = $_POST['descripcionArticulo'];
    $precioArticulo = $_POST['precioArticulo'];
    $catArticulo = $_POST['catArticulo'];
    $usuarioLogueado = $_SESSION['id'];

    $consultacat = "SELECT id FROM categorias WHERE cat_nombre = '$catArticulo'";
    $resultadocat = $conexion->query($consultacat);

    // Verificar si se encontró alguna fila (es decir, si el nombre de tipo ya existe)
    if ($resultadocat->num_rows == 0) {
        echo "La categoria $catArticulo no existe. Por favor ingrese una categoría válida.";
    }else{
        //Extraigo el id de la fila traída por la consulta (el id de la categoria ingresada)
        $fila = $resultadocat->fetch_assoc();
        $id_cat = $fila['id'];
        // Consulta para verificar si el nombre de articulo ya existe en la tabla
        $consulta = "SELECT * FROM articulos WHERE art_nombre = '$nombreArticulo'";
        $resultado = $conexion->query($consulta);

        // Verificar si se encontró alguna fila (es decir, si el nombre de articulo ya existe)
        if ($resultado->num_rows > 0) {
            // Si el nombre de articulo ya existe, proceder con la actualización
            $actualizarArticulo = "UPDATE articulos SET art_id_categoria = '$id_cat',
                                art_nombre = '$renombreArticulo',
                                art_marca = '$marcaArticulo',
                                art_descripcion = '$descripcionArticulo',
                                art_precio = '$precioArticulo'
                                WHERE art_nombre = '$nombreArticulo'"; 
            
            if ($conexion->query($actualizarArticulo) === TRUE) {
                // Obtener el ID del articulo que se está actualizando
                $fila = $resultado->fetch_assoc();
                $idArticulo_a_modif = $fila['id'];
                $stockArticulo = $fila['art_stock'];

                //Se inserta el historial del cambio en la tabla de historial de modificaciones de articulos
                $insertarHistorial = "INSERT INTO historial_articulos (histart_id_art, histart_accion, histart_id_usu, histart_id_categoria, histart_nombre, histart_marca, histart_descripcion, histart_precio, histart_stock) 
                                                            VALUES ('$idArticulo_a_modif','modif_art', '$usuarioLogueado', '$id_cat', '$renombreArticulo','$marcaArticulo', '$descripcionArticulo','$precioArticulo', '$stockArticulo')";
                
                if ($conexion->query($insertarHistorial) === TRUE) {
                    echo "Articulo $nombreArticulo modificado correctamente";
                } else {
                    echo "Error al insertar el historial del articulo en la tabla: " . $conexion->error;
                }
            } else {
                echo "Error al actualizar el articulo en la tabla: " . $conexion->error;
            }
        } else {
            // Si el nombre de articulo no existe, mostrar un alert con un mensaje de error
            echo "El nombre de articulo $nombreArticulo no existe en la base de datos.";
        }
    }
    // Cerrar conexión
    $conexion->close();
?>
