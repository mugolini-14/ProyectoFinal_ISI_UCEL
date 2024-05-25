<?php
require('../conectar/conectar.php');
session_start(); // Para session_unset() y session_destroy() es necesario comenzar la session
$id = $_SESSION['id'];
// Consulta SQL para insertar datos
    $sqli = "INSERT INTO login_historial (login_usu_id,login_in_out) VALUES ('$id','out')";

// Ejecutar la consulta
    if ($conexion->query($sqli) === TRUE) {
    } else {
        echo "Error: " . $sqli . "<br>" . $conexion->error;
        header("Location: ../index/index.php"); // Si hay error en la conexion con la BD, ira al index
    }
session_unset();
session_destroy();
$_SESSION = null;
header("Location: ../login.html"); // A la pagina que tenemos que ir
?>