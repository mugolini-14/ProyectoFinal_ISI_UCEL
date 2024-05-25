<?php
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $nombreUsuario = $_POST['nombreUsuario'];
    $nombrepilaUsuario = $_POST['nombrepilaUsuario'];
    $apellidoUsuario = $_POST['apellidoUsuario'];
    $direccionUsuario = $_POST['direccionUsuario'];
    $emailUsuario = $_POST['emailUsuario'];
    $perfilAcceso = $_POST['perfilAcceso'];
    $usuarioLogueado = $_SESSION['id'];

    // Consulta para verificar si el nombre de usuario ya existe en la tabla
    $consulta = "SELECT * FROM usuarios WHERE usu_username = '$nombreUsuario'";
    $resultado = $conexion->query($consulta);

    // Verificar si se encontró alguna fila (es decir, si el nombre de usuario ya existe)
    if ($resultado->num_rows > 0) {
        // Si el nombre de usuario ya existe, proceder con la actualización
        $actualizarUsuario = "UPDATE usuarios SET usu_id_permisos = '$perfilAcceso',
                            usu_nombre = '$nombrepilaUsuario',
                            usu_apellido = '$apellidoUsuario',
                            usu_direccion = '$direccionUsuario',
                            usu_email = '$emailUsuario',
                            usu_fecha_modif = NOW()
                             WHERE usu_username = '$nombreUsuario'"; // Función NOW() para que inserte la fecha actual ya que como también está el campo usu_fecha_creacion no se puede utilizar el current_timestamp de MySQL
        
        if ($conexion->query($actualizarUsuario) === TRUE) {
            // Obtener el ID del usuario que se está actualizando
            $fila = $resultado->fetch_assoc();
            $idUsuario_a_modif = $fila['id'];
            //Se inserta el historial del cambio en la tabla de historial de modificaciones de usuarios
            $insertarHistorial = "INSERT INTO historial_usuarios (histusu_accion, histusu_id_usu, histusu_id_usumodif, histusu_id_permisos, histusu_nombre, histusu_apellido, histusu_direccion, histusu_email, histusu_fechahora) 
                                VALUES ('modif_usu', '$usuarioLogueado', '$idUsuario_a_modif', '$perfilAcceso','$nombrepilaUsuario', '$apellidoUsuario','$direccionUsuario', '$emailUsuario',NOW())";
            
            if ($conexion->query($insertarHistorial) === TRUE) {
                echo "Usuario $nombreUsuario modificado correctamente";
            } else {
                echo "Error al insertar el historial del usuario en la tabla: " . $conexion->error;
            }
        } else {
            echo "Error al actualizar el usuario en la tabla: " . $conexion->error;
        }
    } else {
        // Si el nombre de usuario no existe, mostrar un alert con un mensaje de error
        echo "El nombre de usuario $nombreUsuario no existe en la base de datos.";
    }
    
    // Cerrar conexión
    $conexion->close();
?>
