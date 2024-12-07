<?php
/*
    PHP:            borrar_usuario.php
    Descripción:    Borra de la base de datos un registro de usuario
*/
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $nombreUsuario = $_POST['nombreUsuario'];
    $usuarioLogueado = $_SESSION['id'];

     // Consulta para verificar si el nombre de usuario existe en la tabla
     $consulta = "SELECT * FROM usuarios 
                 WHERE usu_username = '$nombreUsuario'";
     $resultado = $conexion->query($consulta);
 
     // Verificar si se encontró alguna fila (es decir, si el nombre de usuario existe)
     if ($resultado->num_rows > 0) {
         // Si el nombre de usuario existe, se capturan los datos para el historial.
        // Obtener el ID del usuario que se está actualizando
        $fila = $resultado->fetch_assoc();
        $idUsuario_borrar = $fila['id'];
        $perfilAcceso = $fila['usu_id_permisos'];
        $nombrepilaUsuario = $fila['usu_nombre'];
        $apellidoUsuario = $fila['usu_apellido'];
        $direccionUsuario = $fila['usu_direccion'];
        $emailUsuario = $fila['usu_email'];
        
        // Verifica que el usuario ya no se encuentre dado de baja
        if ($perfilAcceso > 1) {
            // Se procede a eliminar el usuario
            // Se actualizan los permisos del usuario a Sin Permisos
            $eliminarUsuario = "UPDATE usuarios 
                                SET usu_id_permisos = 1
                                WHERE usu_username = '$nombreUsuario'"; 

            if ($conexion->query($eliminarUsuario) === TRUE) {
                //Se inserta el historial del cambio en la tabla de historial de modificaciones de usuarios
                $insertarHistorial = "INSERT INTO historial_usuarios (histusu_accion, 
                                                                     histusu_id_usu, 
                                                                     histusu_id_usumodif, 
                                                                     histusu_id_permisos, 
                                                                     histusu_nombre, 
                                                                     histusu_apellido, 
                                                                     histusu_direccion, 
                                                                     histusu_email, 
                                                                     histusu_fechahora) 
                                                   VALUES ('baja_usu', 
                                                          '$usuarioLogueado', 
                                                          '$idUsuario_borrar', 
                                                          '$perfilAcceso',
                                                          '$nombrepilaUsuario',
                                                          '$apellidoUsuario',
                                                          '$direccionUsuario', 
                                                          '$emailUsuario',
                                                          NOW())";
                
                if ($conexion->query($insertarHistorial) === TRUE) {
                    echo "Usuario $nombreUsuario dado de baja correctamente.";
                } else {
                    echo "Error al insertar el historial del usuario en la tabla: " . $conexion->error;
                }
            } else {
                echo "Error al borrar el usuario en la tabla: " . $conexion->error;
            }
        } 
        else{
            // El usuario ya se encuentra dado de baja
            echo "El usuario ya se encuentra dado de baja.";
        }
     } 
     else {
         // Si el nombre de usuario no existe, muestra un mensaje
         echo "El usuario a dar de baja no existe.";
     }
?>