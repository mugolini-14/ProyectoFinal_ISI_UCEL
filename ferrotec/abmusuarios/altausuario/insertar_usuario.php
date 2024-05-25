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
    $numeroAleatorio = $_POST['numeroAleatorio'];
    $perfilAcceso = $_POST['perfilAcceso'];
    $usuarioLogueado = $_SESSION['id'];
    //$accesoVentas = $_POST['accesoVentas'];
    //$accesoCompras = $_POST['accesoCompras'];
    //$accesoInformes = $_POST['accesoInformes'];
    //$accesoConsultas = $_POST['accesoConsultas'];
    //$accesoUsuarios = $_POST['accesoUsuarios'];

    // Consulta para verificar si el nombre de usuario ya existe en la tabla
    $consulta = "SELECT * FROM usuarios WHERE usu_username = '$nombreUsuario'";
    $resultado = $conexion->query($consulta);

    // Verificar si se encontró alguna fila (es decir, si el nombre de usuario ya existe)
    if ($resultado->num_rows > 0) {
        // Si el nombre de usuario ya existe, mostrar un alert con un mensaje de error
        echo "El nombre de usuario $nombreUsuario ya está en uso. Por favor, elige otro nombre de usuario.";
    } else {// Consulta para insertar el usuario en la tabla de MySQL
        $sqli = "INSERT INTO usuarios (usu_id_permisos, usu_username,usu_nombre,usu_apellido,usu_direccion,usu_email,usu_cod_verif,usu_fecha_creacion,usu_fecha_modif) VALUES ('$perfilAcceso', '$nombreUsuario', '$nombrepilaUsuario', '$apellidoUsuario', '$direccionUsuario', '$emailUsuario','$numeroAleatorio', NOW(), NULL)";
        
        if ($conexion->query($sqli) === TRUE) {
            // Obtener el ID del usuario que se insertó
            $id_nuevo_user_query = $conexion->query("SELECT id FROM usuarios WHERE usu_username = '$nombreUsuario'");
            if ($id_nuevo_user_query) {
                $id_nuevo_user_row = $id_nuevo_user_query->fetch_assoc();
                $id_nuevo_user = $id_nuevo_user_row['id'];
        
                //Se inserta el historial del cambio en la tabla de historial de modificaciones de usuarios
                $insertarHistorial = "INSERT INTO historial_usuarios (histusu_accion, histusu_id_usu, histusu_id_usumodif, histusu_id_permisos, histusu_nombre, histusu_apellido, histusu_direccion, histusu_email, histusu_fechahora) 
                                    VALUES ('alta_usu', '$usuarioLogueado', '$id_nuevo_user', '$perfilAcceso','$nombrepilaUsuario', '$apellidoUsuario','$direccionUsuario', '$emailUsuario',NOW())";
                
                if ($conexion->query($insertarHistorial) === TRUE) {
                    echo "Usuario $nombreUsuario creado correctamente";
                } else {
                    echo "Error al insertar el historial del usuario en la tabla: " . $conexion->error;
                }
            } else {
                echo "Error al obtener el ID del nuevo usuario: " . $conexion->error;
            }
        } else {
            echo "Error al insertar el usuario en la tabla: " . $conexion->error;
        }
    }
    // Cerrar conexión
    $conexion->close();
?>
