<?php
/*
    PHP:            modificar_articulo.php
    Descripción:    Busca y Modifica de la base de datos un registro de artículo
*/
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
    $estadoArticulo = $_POST['estadoArticulo'];
    $usuarioLogueado = $_SESSION['id'];

    $consultacat = "SELECT id 
                    FROM categorias 
                    WHERE cat_nombre = '$catArticulo'
                    AND cat_activo = 1";

    $resultadocat = $conexion->query($consultacat);

    // Verificar si se encontró alguna fila (es decir, si el nombre de categoria ya existe)
    if ($resultadocat->num_rows == 0) {
        echo "La categoría ingresada no existe o no está activa.";
    }
    else{
        //Extraigo el id de la fila traída por la consulta (el id de la categoria ingresada)
        $fila = $resultadocat->fetch_assoc();
        $id_cat = $fila['id'];
        // Consulta para verificar si el nombre de articulo ya existe
        // La consulta toma en cuenta que los nombres sean iguales (modifica el contenido el artículo y no su nombre)
        $consulta = "SELECT * 
                    FROM articulos 
                    WHERE art_nombre = '$nombreArticulo'";
        $resultado = $conexion->query($consulta);

        // Verificar si se encontró alguna fila (es decir, si el nombre de articulo ya existe)
        if ($resultado->num_rows > 0) {

            // Si los nombres del artículo coinciden, ir directamente a la actualización
            if($nombreArticulo == $renombreArticulo){
                goto actualizarArticuloMismoNombre;
            }

            // Verifica que el nuevo nombre del artículo no exista
            $consulta_nuevo_nombre_articulo = "SELECT *
                                               FROM articulos
                                               WHERE art_nombre = '$renombreArticulo'";

            $resultado_consulta_nuevo_nombre_articulo = $conexion->query($consulta_nuevo_nombre_articulo);
            
            if($resultado_consulta_nuevo_nombre_articulo->num_rows >0){
                echo 'El nuevo nombre del artículo ya existe. Por favor, ingrese otro.';
            }
            else{
                // Si el nombre de articulo ya existe, proceder con la actualización
                // Si el artículo tiene el mismo nombre, actualiza directamente los datos
                actualizarArticuloMismoNombre:
                $actualizarArticulo = "UPDATE articulos 
                                       SET art_id_categoria = '$id_cat',
                                       art_nombre = '$renombreArticulo',
                                       art_marca = '$marcaArticulo',
                                       art_descripcion = '$descripcionArticulo',
                                       art_precio = '$precioArticulo',
                                       art_activo = '$estadoArticulo'
                                       WHERE art_nombre = '$nombreArticulo'"; 

                if ($conexion->query($actualizarArticulo) === TRUE) {
                    // Obtener el ID del articulo que se está actualizando
                    $fila = $resultado->fetch_assoc();
                    $idArticulo_a_modif = $fila['id'];
                    $stockArticulo = $fila['art_stock'];

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
                                                            VALUES ('$idArticulo_a_modif',
                                                            'modif_art', 
                                                            '$usuarioLogueado', 
                                                            '$id_cat', 
                                                            '$renombreArticulo',
                                                            '$marcaArticulo', 
                                                            '$descripcionArticulo',
                                                            '$precioArticulo',
                                                            '$estadoArticulo')";

                    if ($conexion->query($insertarHistorial) === TRUE) {
                        echo "Articulo $nombreArticulo modificado correctamente";
                    } 
                    else {
                        echo "Error al insertar el historial del articulo en la tabla: " . $conexion->error;
                    }
                } 
                else {
                    echo "Error al actualizar el articulo en la tabla: " . $conexion->error;
                }
            }
        } 
        else {
            // El artículo ingresado no existe
            echo "El nombre de articulo no existe.";
        }
    }
    // Cerrar conexión
    $conexion->close();
?>
