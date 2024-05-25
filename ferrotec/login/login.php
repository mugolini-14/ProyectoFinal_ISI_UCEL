	<?php
require('../conectar/conectar.php');
$usu_username=$_POST['usuario'];
$usu_password=$_POST['contrasena'];


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
        $_SESSION['logged'] = TRUE;
        $id = $_SESSION['id'];
        // Consulta SQL para insertar datos
            $sqli = "INSERT INTO login_historial (login_usu_id,login_in_out) VALUES ('$id','in')";

        // Ejecutar la consulta
            if ($conexion->query($sqli) === TRUE) {
            } else {
                echo "Error: " . $sqli . "<br>" . $conexion->error;
                header("Location: ../login.html"); // Si hay error en la conexion con la BD, ira al login
            }
        header("Location: ../index/index.php"); // A la pagina que tenemos que ir
        exit;
    }else{
        echo'<script type="text/javascript">
    alert("Usuario no registrado");
    window.location.href="../login.html";
    </script>';
        exit;
    }
while ($fila = mysqli_fetch_assoc($conexion,$resultado)) {
    echo "Nombres: ",$fila['usu_nombre'],"<br>";
    echo "Apellidos: ",$fila['usu_apellido'],"<br>";
    echo "Numero de usuario: ",$fila['id'],"<br>";
    echo "Nivel: ",$fila['usu_id_permisos'];
}

// Liberar los recursos asociados con el conjunto de resultados
// Esto se ejecuta automaticamente al finalizar el script.
mysqli_free_result($conexion,$resultado);

mysqli_close($conexion);

?>
