<?php
/*
    PHP:            busqueda.php
    Descripción:    Hace una consulta a la base de datos para traer los diferentes artículos
                    En ventas.php y compras.php
*/

header('Content-Type: application/json');

require('../conectar/conectar.php');

$searchTerm = $_GET['term'];

$sql = "SELECT id, 
        art_nombre,
        art_precio,
        art_descripcion,
        art_stock 
        FROM articulos 
        WHERE art_nombre LIKE '%$searchTerm%' LIMIT 10";

$result = $conexion->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = array('id_article' => $row['id'],'name' => $row['art_nombre'], 'price' => $row['art_precio'],'stock' => $row['art_stock'], 'description' => $row['art_descripcion']);
    }
}

echo json_encode($data);

$conexion->close();
?>