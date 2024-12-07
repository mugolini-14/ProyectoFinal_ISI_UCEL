<?php
/*
    PHP:            login_restablecer.php
    Descripción:    Genera un código cleatorio al mail registrado del Usuario por motivos de seguridad
                    Arma y Envía un mail al correo registrado del Usuario con el código aleatorio generado
                    Actualiza el registro del Usuario con el código aleatorio para ser validado 
*/
    require('../conectar/conectar.php');

    session_start();

    $usu_username=$_POST['usuario-restablecer'];
    
    /*
        Función:        generarCodigoAleatorio($longitud)
        Descripción:    Genera un código aleatorio numérico de 8 digitos en base a una
                        función de generación aleatoria
        Parámetros:
        - $longitud:    Número entero que indica la cantidad de nùmeros a generar
    */
    function generarCodigoAleatorio($longitud) {    
        $codigo = '';
        $expresiones = '1234567890';
        $max = strlen($expresiones)-1;
        for($i=0;$i < $longitud;$i++){
            $codigo .= $expresiones[mt_rand(0,$max)];
        } 
        return $codigo;
    }
    
    /*
        Función:        armarCuerpoEmail($codigo)
        Descripción:    Compone y formatea en HTML el mail a enviar con el código aleatorio
        Parámetros:
        - $codigo:      Cadena de números que generó la función generarCodigoAleatorio($longitud)
    */

    function armarCuerpoEmail($codigo){    // Función que arma el cuerpo del email
        $cuerpo_email = "<html><body><hr><h2>Código de Cambiar Contraseña</h2><hr><br>\n."
                        . "Usted solicitó un reestablecimiento de contraseña.<br> \n."
                        . "El código para cambiarla es: \n.<br>" . "<h3>" . $codigo . "</h3>\n."
                        . "</body></html>";
        return $cuerpo_email;
    }

    // El usuario no ingresó un Usuario
    if($usu_username == NULL || $usu_username == ''){
        echo'<script type="text/javascript">
            alert("Por favor, ingrese un Usuario.");
            window.location.href="../login.php";
            </script>';
        exit;
    }

    $sql = mysqli_query($conexion,"SELECT * FROM usuarios
                                                WHERE usu_username='$usu_username'
                                                LIMIT 1");
    if(mysqli_num_rows($sql) == 1){
        $row = mysqli_fetch_array($sql);
        $id = $row['id'];
        $usu_email = $row['usu_email'];
        $usu_id_permisos = $row['usu_id_permisos'];
        $_SESSION['usu_email'] = $row['usu_email'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['usu_username'] = $_POST['usuario-restablecer'];

         // Se busca el usuario en la base de datos
        $sql_reestablecercontrasena = mysqli_query ($conexion,  "SELECT * FROM usuarios
                                                                WHERE id = $id 
                                                                AND usu_username='$usu_username'
                                                                LIMIT 1"
                                                    );
        // Si encuentra el usuario, procede a validar si no está dado de baja
        if(mysqli_num_rows($sql_reestablecercontrasena) == 1){  
            if($usu_id_permisos != 1){
                // Si el usuario no está dado de baja, se proceede a restablecer la contraseña
                $numeroaleatorio = generarCodigoAleatorio(8);       // Genera código aleatorio
                $_SESSION['numeroAleatorio'] = $numeroaleatorio;
                $sql_numeroaleatorio =  "UPDATE usuarios 
                                        SET usu_cod_verif = '$numeroaleatorio'
                                        WHERE id = $id
                                        AND usu_username = '$usu_username'";
                if($conexion->query($sql_numeroaleatorio) == TRUE){     // Va a la página de reestablecer contraseña
                    $headers = "From: ferrotec-noresponder@outlook.com" . "\r\n";
                    $headers .= "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'Reply-To: ferrotec-noresponder@outlook.com' . "\r\n";

                    mail($usu_email, "Ferr O' Tec - Código de Cambio de Contraseña", armarCuerpoEmail($numeroaleatorio),$headers);  // Envìa el mail con el código aleatorio al mail del usuario
                    
                    $sql_grabarhistorial = "INSERT INTO historial_login (histlogin_usu_id,
                                                                        histlogin_in_out) 
                                                                        VALUES ('$id',
                                                                        'reestablecer_mail')";
                    if($conexion->query($sql_grabarhistorial) == TRUE){
                        header("Location: ../restablecercontrasena/restablecercontrasena.php");
                        exit;
                    }
                    else{
                        echo "Error: " . $sqli . "<br>" . $conexion->error;
                        header("Location: ../login.php"); // Si hay error en la conexion con la BD, ira al login
                    }
                }
                else {
                    echo "Error: " . $sqli . "<br>" . $conexion->error;
                    header("Location: ../login.php"); // Si hay error en la conexion con la BD, ira al login
                } 
            }
            else{
                // El usuario se encuentra dado de baja - Se desloguea y resetea la sesión
                session_unset();
                session_destroy();
                $_SESSION = null;
                echo'<script type="text/javascript">
                    alert("Usuario Deshabilitado. Contacte con el Administrador.");
                    window.location.href="../login.php";
                </script>';
                exit;
            }
        }
        else {
            echo "Error: " . $sqli . "<br>" . $conexion->error;
            header("Location: ../login.php"); // Si hay error en la conexion con la BD, ira al login
        } 
    } 
    else{
        echo'<script type="text/javascript">
            alert("Usuario inexistente.");
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
