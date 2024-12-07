<?php
/*
    PHP:            insertar_usuario.php
    Descripción:    Inserta en la base de datos un nuevo registro de usuario
*/
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
    $passwordTemporal = $_POST['passwordTemporal'];
    $perfilAcceso = $_POST['perfilAcceso'];
    $usuarioLogueado = $_SESSION['id'];
    //$accesoVentas = $_POST['accesoVentas'];
    //$accesoCompras = $_POST['accesoCompras'];
    //$accesoInformes = $_POST['accesoInformes'];
    //$accesoConsultas = $_POST['accesoConsultas'];
    //$accesoUsuarios = $_POST['accesoUsuarios'];

    // Consulta para verificar si el nombre de usuario ya existe en la tabla
    $consulta = "SELECT * FROM usuarios 
                WHERE usu_username = '$nombreUsuario'";
    $resultado = $conexion->query($consulta);

    // Verifica si el nombre de usuario ya existe
    if ($resultado->num_rows > 0) {
        echo "El nombre del usuario ya existe. Ingrese otro.";
    } 
    else {
        // Hace una consulta para verificar si el mail está en uso por otro usuario
        $consulta_email = "SELECT usu_email
                          FROM usuarios
                          WHERE usu_email = '$emailUsuario'";

        $resultado_consulta_email = $conexion->query($consulta_email);

        // Verifica si el correo ingresado por el usuario está en uso
        if($resultado_consulta_email->num_rows > 0){
            echo "El correo ingresado ya se encuentra en uso por otro usuario. Ingrese otro.";
        }
        else{
            // Si el email no está en uso, procede a insertar el registro del usuario
            $sqli = "INSERT INTO usuarios (usu_id_permisos, 
                                          usu_username,
                                          usu_nombre,
                                          usu_apellido,
                                          usu_direccion,
                                          usu_email,
                                          usu_password,
                                          usu_cod_verif) 
                                VALUES ('$perfilAcceso', 
                                        '$nombreUsuario', 
                                        '$nombrepilaUsuario', 
                                        '$apellidoUsuario', 
                                        '$direccionUsuario', 
                                        '$emailUsuario',
                                        '$passwordTemporal',
                                        '0')";
        
            if ($conexion->query($sqli) === TRUE) {
                // Obtener el ID del usuario que se insertó
                $id_nuevo_user_query = $conexion->query("SELECT id 
                                                                FROM usuarios 
                                                                WHERE usu_username = '$nombreUsuario'");
                if ($id_nuevo_user_query) {
                    $id_nuevo_user_row = $id_nuevo_user_query->fetch_assoc();
                    $id_nuevo_user = $id_nuevo_user_row['id'];
            
                    //Se inserta el historial del cambio en la tabla de historial de modificaciones de usuarios
                    $insertarHistorial = "INSERT INTO historial_usuarios (histusu_accion, 
                                                                         histusu_id_usu, 
                                                                         histusu_id_usumodif, 
                                                                         histusu_id_permisos, 
                                                                         histusu_nombre, 
                                                                         histusu_apellido, 
                                                                         histusu_direccion, 
                                                                         histusu_email) 
                                                        VALUES ('alta_usu', 
                                                                '$usuarioLogueado', 
                                                                '$id_nuevo_user', 
                                                                '$perfilAcceso',
                                                                '$nombrepilaUsuario', 
                                                                '$apellidoUsuario',
                                                                '$direccionUsuario', 
                                                                '$emailUsuario')";
                    
                    if ($conexion->query($insertarHistorial) === TRUE) {
                        echo "Usuario $nombreUsuario creado correctamente.";
                    } 
                    else {
                        echo "Error al insertar el historial del usuario en la tabla: " . $conexion->error;
                    }
                } 
                else {
                    echo "Error al obtener el ID del nuevo usuario: " . $conexion->error;
                }
            } 
            else {
                echo "Error al insertar el usuario en la tabla: " . $conexion->error;
            }
        }
    }
    // Cerrar conexión
    $conexion->close();
?>
