<?php
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $padretipocategoria = $_POST['padretipo'];
    $nombreCategoria = $_POST['nombrecategoria'];
    $renombreCategoria = $_POST['renombrecategoria'];
    $descripcionCategoria = $_POST['descripcioncategoria'];
    $usuarioLogueado = $_SESSION['id'];

    
    // Consulta para verificar si el nombre de categoria ya existe en la tabla
    $consulta = "SELECT * FROM categorias WHERE cat_nombre = '$nombreCategoria'";
    $resultado = $conexion->query($consulta);

    // Verificar si se encontró alguna fila (es decir, si el nombre de categoria ya existe)
    if ($resultado->num_rows > 0) {


        // Consulta para verificar si el nombre del tipo ya existe en la tabla
        $consultatipo = "SELECT * FROM tipos WHERE tipos_nombre = '$padretipocategoria'";
        $resultadotipo = $conexion->query($consultatipo);
        

        // Verificar si el tipo existe
        if ($resultadotipo->num_rows == 1) {
            //Si el tipo existe se procede a capturar el id del tipo
            $fila_tipo = $resultadotipo->fetch_assoc();
            $idtipo_modif = $fila_tipo['id'];





            // Si el nombre de categoria y del tipo ya existen, proceder con la actualización, 
            $actualizarcategoria = "UPDATE categorias SET cat_nombre = '$renombreCategoria',
                                cat_descripcion = '$descripcionCategoria',
                                cat_id_tipo = '$idtipo_modif'
                                WHERE cat_nombre = '$nombreCategoria'"; // Modifica el nombre, el tipo y la descripción.
            
            if ($conexion->query($actualizarcategoria) === TRUE) {
                // Consulta para obtener los datos actualizados después de la actualización
                $consulta_actualizada = "SELECT * FROM categorias WHERE cat_nombre = '$renombreCategoria'";
                $resultado_actualizado = $conexion->query($consulta_actualizada);
                if ($resultado_actualizado->num_rows > 0) {
                    $fila = $resultado_actualizado->fetch_assoc();
                    $idcategoria_modif = $fila['id'];
                    $fechaAlta = $fila['cat_fechaalta'];
                    $usuarioAlta = $fila['cat_usuarioalta'];
                    $fechaBaja = $fila['cat_fechabaja'];
                    $usuarioBaja = $fila['cat_usuariobaja'];
                    $activo = $fila['cat_activo'];

                    //Se inserta el historial del cambio en la tabla de historial de modificaciones de categorias
                    $insertarHistorial = "INSERT INTO historial_categorias (histcat_accion, histcat_id_usu, histcat_id_tipos, histcat_id_cat, histcat_nombre, histcat_descripcion, histcat_fechaalta, histcat_usuarioalta, histcat_fechabaja, histcat_usuariobaja, histcat_activo) 
                    VALUES ('modif_categoria', '$usuarioLogueado', '$idtipo_modif', '$idcategoria_modif', '$renombreCategoria','$descripcionCategoria', '$fechaAlta','$usuarioAlta', NULL, NULL, '$activo' )";  


                    if ($conexion->query($insertarHistorial) === TRUE) {
                        echo "categoria $nombreCategoria modificado correctamente";
                    } else {
                        echo "Error al insertar el historial del categoria en la tabla: " . $conexion->error;
                    }
                }else{
                    echo "Error al leer la categoria modificada en la tabla: " . $conexion->error;
                }
            } else {
                echo "Error al actualizar el categoria en la tabla: " . $conexion->error;
            }




        }else{
            echo "El nombre del tipo es inexistente: " . $conexion->error;
        }
    



    } else {
        // Si el nombre de categoria no existe, mostrar un alert con un mensaje de error
        echo "El nombre de categoria $nombreCategoria no existe en la base de datos.";


    }
    
    // Cerrar conexión
    $conexion->close();
?>
