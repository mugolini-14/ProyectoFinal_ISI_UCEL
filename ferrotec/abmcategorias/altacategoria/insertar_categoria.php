<?php
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();
    
    // Obtener los datos enviados desde JavaScript
    $padretipocategoria = $_POST['padretipocategoria'];
    $nombrecategoria = $_POST['nombrecategoria'];
    $descripcioncategoria = $_POST['descripcioncategoria'];
    $usuarioLogueado = $_SESSION['id'];

    // Consulta para verificar si el nombre de categoria ya existe en la tabla
    $consulta = "SELECT * FROM categorias WHERE cat_nombre = '$nombrecategoria'";
    $resultado = $conexion->query($consulta);

    // Verificar si se encontró alguna fila (es decir, si el nombre de categoria ya existe)
    if ($resultado->num_rows > 0) {
        // Si el nombre de categoria ya existe, mostrar un alert con un mensaje de error
        echo "El nombre de categoria $nombrecategoria ya está en uso. Por favor, elige otro nombre de categoria.";
    } else {
        // Consulta para verificar si el nombre del tipo ya existe en la tabla
        $consultatipo = "SELECT * FROM tipos WHERE tipos_nombre = '$padretipocategoria'";
        $resultadotipo = $conexion->query($consultatipo);

        // Verificar si se encontró alguna fila (es decir, si el nombre de tipo ya existe)
        if ($resultadotipo->num_rows == 0) {
            echo "El Tipo de categoria $padretipocategoria no existe. Por favor ingrese un tipo válido.";
        }else{
            //Extraigo el id de la fila traída por la consulta (el id del tipo ingresado)
            $fila = $resultadotipo->fetch_assoc();
            $idtipo = $fila['id'];
            
            // Consulta para insertar la categoria en la tabla de MySQL
            $sqli = "INSERT INTO categorias (cat_id_tipo, cat_nombre, cat_descripcion, cat_fechaalta, cat_usuarioalta) 
                    VALUES ('$idtipo', '$nombrecategoria', '$descripcioncategoria', NOW(), '$usuarioLogueado')";

            if ($conexion->query($sqli) === TRUE) {
                // Obtener el ID del categoria que se insertó
                $id_nueva_categoria_query = $conexion->query("SELECT id FROM categorias WHERE cat_nombre = '$nombrecategoria'");
                if ($id_nueva_categoria_query) {
                    $id_nueva_categoria_row = $id_nueva_categoria_query->fetch_assoc();
                    $id_nueva_categoria = $id_nueva_categoria_row['id'];
            
                    //Se inserta el historial del cambio en la tabla de historial de modificaciones de categorias
                    $insertarHistorial = "INSERT INTO historial_categorias (histcat_accion, histcat_id_usu, histcat_id_tipos, histcat_id_cat, histcat_nombre, histcat_descripcion, histcat_usuarioalta, histcat_fechaalta, histcat_activo) 
                                        VALUES ('alta_categoria', '$usuarioLogueado', '$idtipo', '$id_nueva_categoria', '$nombrecategoria','$descripcioncategoria','$usuarioLogueado', NOW(),'S')";
                    
                    if ($conexion->query($insertarHistorial) === TRUE) {
                        echo "categoria $nombrecategoria creado correctamente";
                    } else {
                        echo "Error al insertar el historial del categoria en la tabla: " . $conexion->error;
                    }
                } else {
                    echo "Error al obtener el ID del nuevo categoria: " . $conexion->error;
                }
            } else {
                echo "Error al insertar el categoria en la tabla: " . $conexion->error;
            }
        }
    }
     // Cerrar conexión
    $conexion->close();
?>
