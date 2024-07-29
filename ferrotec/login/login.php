<?php
    require('../conectar/conectar.php');
    $usu_username=$_POST['usuario'];
    $usu_password=$_POST['contrasena'];
    
    function generarCodigoAleatorio($longitud) {    // Función que genera el código aleatorio para mandar por mail
        $codigo = '';
        $expresiones = '1234567890';
        $max = strlen($expresiones)-1;
        for($i=0;$i < $longitud;$i++){
            $codigo .= $expresiones[mt_rand(0,$max)];
        } 
        return $codigo;
    }
    
    function armarCuerpoEmail($codigo){    // Función que arma el cuerpo del email
        $cuerpo_email = "<html><body><hr><h2>Código de Cambiar Contraseña</h2><hr><br>\n."
                        . "Usted solicitó un reestablecimiento de contraseña.<br> \n."
                        . "El código para cambiarla es: \n.<br>" . "<h3>" . $codigo . "</h3>\n."
                        . "</body></html>";
        //$cuerpo_email = str_replace("\n.","\n..",$cuerpo_email);
        return $cuerpo_email;
    }

    $consulta = sprintf("SELECT usu_nombre, usu_apellido, id, usu_id_permisos FROM usuarios 
        WHERE usu_username='$usu_username' AND usu_password='$usu_password'",
        mysqli_real_escape_string($conexion,$usu_username),
        mysqli_real_escape_string($conexion,$usu_password));

    $sql = mysqli_query($conexion,"SELECT * FROM usuarios
                        WHERE usu_username='$usu_username' AND
                        usu_password='$usu_password'
                        LIMIT 1");
    if(mysqli_num_rows($sql) == 1){
        $row = mysqli_fetch_array($sql);
        session_start();
        $_SESSION['id'] = $row['id'];
        $_SESSION['usu_username'] = $row['usu_username'];
        $_SESSION['usu_id_permisos'] = $row['usu_id_permisos'];
        $_SESSION['usu_apellido'] = $row['usu_apellido'];
        $_SESSION['usu_nombre'] = $row['usu_nombre'];
        $_SESSION['usu_email'] = $row['usu_email'];
        $_SESSION['logged'] = TRUE;
        $id = $_SESSION['id'];

        // Verificación de Reestablecer Contraseña
        $sql_reestablecercontrasena = mysqli_query ($conexion,  "SELECT * FROM usuarios
                                                                WHERE id = $id 
                                                                AND usu_username='$usu_username' 
                                                                AND usu_cod_verif_bool = 1
                                                                LIMIT 1"
                                                        );
        $email_usuario = $_SESSION['usu_email'];                                                
        if(mysqli_num_rows($sql_reestablecercontrasena) == 1){  // El usuario necesita resetear la contraseña
            $numeroaleatorio = generarCodigoAleatorio(8);       // Genera código aleatorio
            $sql_numeroaleatorio =  "UPDATE usuarios 
                                            SET usu_cod_verif_bool = 1, usu_cod_verif = '$numeroaleatorio'
                                            WHERE id = $id
                                            AND usu_username = '$usu_username'";
            if($conexion->query($sql_numeroaleatorio) == TRUE){     // Va a la página de reestablecer contraseña
                $headers = "From: ferrotec-noresponder@outlook.com" . "\r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                mail($email_usuario, "Ferr O' Tec - Código de Cambio de Contraseña", armarCuerpoEmail($numeroaleatorio),$headers);  // Envìa el mail con el código aleatorio al mail del usuario
                header("Location: ../restablecercontrasena/restablecer_contrasena.php");
                exit;
            }
            else {
                echo "Error: " . $sqli . "<br>" . $conexion->error;
                header("Location: ../login.php"); // Si hay error en la conexion con la BD, ira al login
            } 
        }
        else {  // El usuario no necesita resetear la contraseña
            $sqli = "INSERT INTO historial_login (login_usu_id,login_in_out) VALUES ('$id','in')";
            // Ejecutar la consulta
            if ($conexion->query($sqli) === TRUE) {     // Va al index
                header("Location: ../index/index.php"); 
                exit;     
            }
            else {
                echo "Error: " . $sqli . "<br>" . $conexion->error;
                header("Location: ../login.php"); // Si hay error en la conexion con la BD, ira al login
            } 
        }
    } 
    else{
        echo'<script type="text/javascript">
            alert("Usuario no registrado");
            window.location.href="../login.php";
            </script>';
        exit;
    }

    while ($fila = mysqli_fetch_assoc($resultado)){
        echo "Nombres: ",$fila['usu_nombre'],"<br>";
        echo "Apellidos: ",$fila['usu_apellido'],"<br>";
        echo "Numero de usuario: ",$fila['id'],"<br>";
        echo "Nivel: ",$fila['usu_id_permisos'];
    }

    // Liberar los recursos asociados con el conjunto de resultados
    // Esto se ejecuta automaticamente al finalizar el script.
    mysqli_free_result($resultado);

    mysqli_close($conexion);
?>
