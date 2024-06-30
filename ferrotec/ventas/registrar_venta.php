<?php

// Conexión a la base de datos
require('../conectar/conectar.php');

// Recibir los datos del GET
if (isset($_GET['articulos'])) {
    $articulos = json_decode($_GET['articulos'], true);

    if ($articulos !== null) {
        foreach ($articulos as $articulo) {
            $nombreArticulo = $articulo['articulo'];
            $cantidad = (int)$articulo['cantidad'];

            // Buscar y actualizar la cantidad en la base de datos
            $stmt = $conexion->prepare("UPDATE articulos SET art_stock = art_stock - ? WHERE art_nombre = ?");
            $stmt->bind_param('is', $cantidad, $nombreArticulo);

            if ($stmt->execute()) {
                echo "Cantidad actualizada para el artículo: $nombreArticulo\n";
            } else {
                echo "Error al actualizar la cantidad para el artículo: $nombreArticulo\n";
            }
        }
    } else {
        echo "Los datos de artículos no están en el formato esperado.";
    }
} else {
    echo "No se recibieron datos de artículos.";
}
?>