<?php
/*
    PHP:            insertar_tipo.php
    Descripción:    Inserta en la base de datos un nuevo registro de tipo
*/
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();
    
    // Obtener los datos enviados desde JavaScript
    $nombretipo = $_POST['nombretipo'];
    $descripciontipo = $_POST['descripciontipo'];
    $usuarioLogueado = $_SESSION['id'];

    // Consulta para verificar si el nombre de tipo ya existe en la tabla
    $consulta = "SELECT * 
                FROM tipos 
                WHERE tipos_nombre = '$nombretipo'";
    $resultado = $conexion->query($consulta);

    // Verificar si se encontró alguna fila (es decir, si el nombre de tipo ya existe)
    if ($resultado->num_rows > 0) {
        // Si el nombre de tipo ya existe, mostrar un alert con un mensaje de error
        echo "El tipo de artículo ingresado ya existe.";
    } else {// Consulta para insertar el tipo en la tabla de MySQL
        $sqli = "INSERT INTO tipos (tipos_nombre, 
                                    tipos_descripcion,
                                    tipos_activo) 
                            VALUES ('$nombretipo', 
                                    '$descripciontipo',
                                    1)";
        
        if ($conexion->query($sqli) === TRUE) {
            // Obtener el ID del tipo que se insertó
            $id_nuevo_tipo_query = $conexion->query("SELECT id 
                                                            FROM tipos 
                                                            WHERE tipos_nombre = '$nombretipo'");
            if ($id_nuevo_tipo_query) {
                $id_nuevo_tipo_row = $id_nuevo_tipo_query->fetch_assoc();
                $id_nuevo_tipo = $id_nuevo_tipo_row['id'];
        
                //Se inserta el historial del cambio en la tabla de historial de modificaciones de tipos
                $insertarHistorial = "INSERT INTO historial_tipos (histtipos_accion,
                                                                   histtipos_id_usu, 
                                                                   histtipos_id_tipos, 
                                                                   histtipos_nombre, 
                                                                   histtipos_descripcion,
                                                                   histtipos_activo) 
                                                            VALUES ('alta_tipo', 
                                                                    '$usuarioLogueado',
                                                                    '$id_nuevo_tipo',
                                                                    '$nombretipo',
                                                                    '$descripciontipo',
                                                                    1)";
                
                if ($conexion->query($insertarHistorial) === TRUE) {
                    echo "El tipo $nombretipo se ha creado correctamente.";
                } 
                else {
                    echo "Error al insertar el historial del tipo en la tabla: " . $conexion->error;
                }
            } 
            else {
                echo "Error al obtener el ID del nuevo tipo: " . $conexion->error;
            }
        } 
        else {
            echo "Error al insertar el tipo en la tabla: " . $conexion->error;
        }
    }
    // Cerrar conexión
    $conexion->close();
?>
