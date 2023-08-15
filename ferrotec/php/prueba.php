<?php

error_reporting (E_ALL ^ E_NOTICE);

extract($_REQUEST);

$nombre_usuario = $_POST['nombre_usuario'];
echo $nombre_usuario;
$resultado == 0;
header('Location: ' . '../abmusuarios.php');
?>