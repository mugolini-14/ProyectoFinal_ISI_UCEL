<?php
    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Datos del Usuario
    $id = $_POST['id'];
    $usu_username = $_POST['usu_username'];

    // Obtener los datos enviados desde JavaScript
    $codigoAleatorio = $_POST['codigo-aleatorio'];
    $contrasena = $_POST['contrasena'];

    $consulta_usuario = "SELECT *
                        FROM usuarios 
                        WHERE id = $id 
                        AND usu_username = $usu_username
                        AND usu_cod_verif_bool = 1
                        AND usu_cod_verif IS NOT NULL
                        LIMIT 1";
    $resultado = $conexion->query($consulta_usuario);

    if($resultado->num_rows>0){ // Se verifica que el usuario a grabar la contraseña existe
        $sql_grabarcontrasena = "UPDATE usuarios
                                SET usu_cod_verif_bool = 0,
                                usu_cod_verif = NULL,
                                usu_password = $contrasena
                                WHERE id = $id
                                AND usu_username = $usu_username
                                AND usu_cod_verif = $codigoAleatorio";
        if ($conexion->query($sql_grabarcontrasena) === TRUE) {     // Se grabò la contraseña nueva
            echo ("La contraseña fue grabada correctamente");
        }
        else{
            echo "Error al actualizar la contraseña del usuario en la tabla: " . $conexion->error;
        }
    }
    else {
        echo "Error al obtener el usuario al actualizar la contraseña: " . $conexion->error;
    }
?>