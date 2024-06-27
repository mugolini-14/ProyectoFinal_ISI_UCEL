<?php
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();
    
    // Obtener los datos enviados desde JavaScript
    $nombreArticulo = $_POST['nombreArticulo'];
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
        $consulta = "SELECT * FROM articulos WHERE art_nombre = '$nombreArticulo'";
        $resultado = $conexion->query($consulta);

        // Verificar si se encontró alguna fila (es decir, si el nombre de articulo ya existe)
        if ($resultado->num_rows > 0) {
            // Si el nombre de articulo ya existe, mostrar un alert con un mensaje de error
            echo "El nombre de articulo $nombreArticulo ya está en uso. Por favor, elige otro nombre de articulo.";
        } else {// Consulta para insertar el articulo en la tabla de MySQL
            $sqli = "INSERT INTO articulos (art_nombre,art_marca,art_descripcion,art_precio,art_stock,art_id_categoria,art_fechaalta,art_usuarioalta) VALUES ('$nombreArticulo', '$marcaArticulo', '$descripcionArticulo', '$precioArticulo',0, '$id_cat', NOW(), '$usuarioLogueado')";
            
            if ($conexion->query($sqli) === TRUE) {
                // Obtener el ID del articulo que se insertó
                $id_nuevo_art_query = $conexion->query("SELECT id FROM articulos WHERE art_nombre = '$nombreArticulo'");
                if ($id_nuevo_art_query) {
                    $id_nuevo_art_row = $id_nuevo_art_query->fetch_assoc();
                    $id_nuevo_art = $id_nuevo_art_row['id'];
            
                    //Se inserta el historial del cambio en la tabla de historial de modificaciones de articulos
                    $insertarHistorial = "INSERT INTO historial_articulos (histart_id_art,histart_accion, histart_id_usu, histart_id_categoria, histart_nombre, histart_marca, histart_descripcion, histart_precio, histart_stock, histart_fechaalta, histart_usuarioalta) 
                                                                    VALUES ('$id_nuevo_art','alta_art', '$usuarioLogueado', '$id_cat', '$nombreArticulo','$marcaArticulo', '$descripcionArticulo', '$precioArticulo',0,NOW(),'$usuarioLogueado')";
                    
                    if ($conexion->query($insertarHistorial) === TRUE) {
                        echo "Articulo $nombreArticulo creado correctamente";
                    } else {
                        echo "Error al insertar el historial del articulo en la tabla: " . $conexion->error;
                    }
                } else {
                    echo "Error al obtener el ID del nuevo articulo: " . $conexion->error;
                }
            } else {
                echo "Error al insertar el articulo en la tabla: " . $conexion->error;
            }
        }
    }
    // Cerrar conexión
    $conexion->close();
?>
