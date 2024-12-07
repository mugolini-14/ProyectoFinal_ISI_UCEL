<?php
/*
    PHP:            insertar_articulo.php
    Descripción:    Inserta en la base de datos un nuevo registro de artículo
*/
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

    $consultacat = "SELECT id 
                    FROM categorias 
                    WHERE cat_nombre = '$catArticulo'
                    AND cat_activo = 1";

    $resultadocat = $conexion->query($consultacat);

    // Verificar si se encontró alguna categoría o está activa
    if ($resultadocat->num_rows == 0) {
        echo "La categoría ingresada no existe o no está activa.";
    }
    else{
        // Si se encuentra la categoría, procede a verificar si el artículo existe
        // Extraigo el id de la fila traída por la consulta (el id de la categoria ingresada)
        $fila = $resultadocat->fetch_assoc();
        $id_cat = $fila['id'];

        $consulta = "SELECT * FROM articulos 
                    WHERE art_nombre = '$nombreArticulo'";

        $resultado = $conexion->query($consulta);

        // Verificar si el artículo ingresado ya existe
        if ($resultado->num_rows > 0) {
            // Si el nombre de articulo ya existe, mostrar un alert con un mensaje de error
            echo "El artículo ingresado ya existe.";
        } 
        else {
            // Si la categoría ingresada existe y el artículo es nuevo, se procede a guardar el artículo
            // Se arma y ejecuta la consulta para grabar el artículo nuevo, sin stock
            $sqli = "INSERT INTO articulos (art_nombre,
                                            art_marca,
                                            art_descripcion,
                                            art_precio,
                                            art_stock,
                                            art_id_categoria,
                                            art_activo) 
                                            VALUES ('$nombreArticulo',
                                            '$marcaArticulo',
                                            '$descripcionArticulo',
                                            '$precioArticulo',
                                            0,
                                            '$id_cat',
                                            1)";
            
            if ($conexion->query($sqli) === TRUE) {
                // Obtener el ID del articulo que se insertó
                $id_nuevo_art_query = $conexion->query("SELECT id 
                                                                FROM articulos 
                                                                WHERE art_nombre = '$nombreArticulo'");
                if ($id_nuevo_art_query) {
                    $id_nuevo_art_row = $id_nuevo_art_query->fetch_assoc();
                    $id_nuevo_art = $id_nuevo_art_row['id'];
            
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
                                                                    VALUES ('$id_nuevo_art',
                                                                            'alta_art',
                                                                            '$usuarioLogueado',
                                                                            '$id_cat',
                                                                            '$nombreArticulo',
                                                                            '$marcaArticulo',
                                                                            '$descripcionArticulo',
                                                                            '$precioArticulo',
                                                                            1)";
                    
                    if ($conexion->query($insertarHistorial) === TRUE) {
                        echo "Articulo $nombreArticulo creado correctamente.";
                    } else {
                        echo "Error al insertar el historial del articulo en la tabla: " . $conexion->error;
                    }
                } 
                else {
                    echo "Error al obtener el ID del nuevo articulo: " . $conexion->error;
                }
            } 
            else {
                echo "Error al insertar el articulo en la tabla: " . $conexion->error;
            }
        }
    }
    // Cerrar conexión
    $conexion->close();
?>
