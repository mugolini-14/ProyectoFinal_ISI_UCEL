<?php
// busqueda.php

header('Content-Type: application/json');

require('../conectar/conectar.php');

$searchTerm = $_GET['term'];

$sql = "SELECT art_nombre, art_precio FROM articulos WHERE art_nombre LIKE '%$searchTerm%' LIMIT 10";
$result = $conexion->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = array('name' => $row['art_nombre'], 'price' => $row['art_precio']);
    }
}

echo json_encode($data);

$conexion->close();
?>