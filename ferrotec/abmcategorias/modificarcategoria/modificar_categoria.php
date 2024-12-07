<?php
/*
    PHP:            modificar_categoria.php
    Descripción:    Busca y Modifica de la base de datos un registro de categoría
*/
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $padretipocategoria = $_POST['padretipo'];
    $nombreCategoria = $_POST['nombrecategoria'];
    $renombreCategoria = $_POST['renombrecategoria'];
    $descripcionCategoria = $_POST['descripcioncategoria'];
    $estadoCategoria = $_POST['estadoCategoria'];
    $usuarioLogueado = $_SESSION['id'];

    
    // Verifica si la categoría ingresa existe y está activa
    $consulta = "SELECT * 
                FROM categorias 
                WHERE cat_nombre = '$nombreCategoria'";

    $resultado = $conexion->query($consulta);

    // Verificar si se encontró alguna categoría y está activa
    if ($resultado->num_rows > 0) {
        // Si los nombres de la categoría coinciden, ir directamente a la consulta del tipo existente
        if($nombreCategoria == $renombreCategoria){
            goto actualizarCategoriaMismoNombre;
        }

        // Verifica que el nuevo nombre de la categoría no exista
        $consulta_nuevo_nombre_categoria = "SELECT *
                                            FROM categorias
                                            WHERE cat_nombre = '$renombreCategoria'";

        $resultado_consulta_nuevo_nombre_categoria = $conexion->query($consulta_nuevo_nombre_categoria);

        if($resultado_consulta_nuevo_nombre_categoria->num_rows == 0){
            // Consulta para verificar si el nombre del tipo ya existe en la tabla
            // Si la categoría tiene el mismo nombre, pasa directamente a verificar el tipo
            actualizarCategoriaMismoNombre:
            $consultatipo = "SELECT * 
                            FROM tipos 
                            WHERE tipos_nombre = '$padretipocategoria'
                            AND tipos_activo = 1";
            $resultadotipo = $conexion->query($consultatipo);

            // Verificar si el tipo existe
            if ($resultadotipo->num_rows == 1) {
                //Si el tipo existe se procede a capturar el id del tipo
                $fila_tipo = $resultadotipo->fetch_assoc();
                $idtipo_modif = $fila_tipo['id'];

                // Si el nombre de categoria y del tipo ya existen, proceder con la actualización, 
                $actualizarcategoria = "UPDATE categorias 
                                        SET cat_nombre = '$renombreCategoria',
                                        cat_descripcion = '$descripcionCategoria',
                                        cat_id_tipo = '$idtipo_modif',
                                        cat_activo = '$estadoCategoria'
                                        WHERE cat_nombre = '$nombreCategoria'"; 

                if ($conexion->query($actualizarcategoria) === TRUE) {
                    // Consulta para obtener los datos actualizados después de la actualización
                    $consulta_actualizada = "SELECT * 
                                            FROM categorias 
                                            WHERE cat_nombre = '$renombreCategoria'";
                    $resultado_actualizado = $conexion->query($consulta_actualizada);
                    if ($resultado_actualizado->num_rows > 0) {
                        $fila = $resultado_actualizado->fetch_assoc();
                        $idcategoria_modif = $fila['id'];

                        //Se inserta el historial del cambio en la tabla de historial de modificaciones de categorias
                        $insertarHistorial = "INSERT INTO historial_categorias (histcat_accion,
                                                                                histcat_id_usu,
                                                                                histcat_id_tipos,
                                                                                histcat_id_cat,
                                                                                histcat_nombre,
                                                                                histcat_descripcion,
                                                                                histcat_activo) 
                                                                        VALUES ('modif_cat',
                                                                                '$usuarioLogueado',
                                                                                '$idtipo_modif',
                                                                                '$idcategoria_modif',
                                                                                '$renombreCategoria',
                                                                                '$descripcionCategoria',
                                                                                '$estadoCategoria')";  

                        if ($conexion->query($insertarHistorial) === TRUE) {
                            echo "Categoria $nombreCategoria modificada correctamente.";
                        } 
                        else {
                            echo "Error al insertar el historial del categoria en la tabla: " . $conexion->error;
                        }
                    }
                    else{
                        echo "Error al leer la categoria modificada en la tabla: " . $conexion->error;
                    }
                } 
                else {
                    echo "Error al actualizar el categoria en la tabla: " . $conexion->error;
                }
            }
            else{
                // El tipo ingresado no existe
                echo 'El nombre del tipo no existe o no está activo.';
            }
        }
        else{
            // El nuevo nombre de la categoría ya existe.
            echo "El nuevo nombre de la categoria ya existe. Por favor, ingrese otro.";
        } 
    }
    else {
        // Si el nombre de categoria no existe, mostrar un alert con un mensaje de error
        echo "El nombre de categoria no existe.";
    }
    
    // Cerrar conexión
    $conexion->close();
?>
