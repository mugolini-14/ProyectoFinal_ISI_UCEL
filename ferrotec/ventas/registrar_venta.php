<?php

// Conexión a la base de datos
require('../conectar/conectar.php');
// Iniciar sesión si no está iniciada
session_start();
$usuarioLogueado = $_SESSION['id'];

// Recibir los datos del GET
if (isset($_GET['articulos']) && isset($_GET['totalGeneral']))  {
    $articulos = json_decode($_GET['articulos'], true);
    $totalGeneral = floatval($_GET['totalGeneral']);
    $modoDePago = $_GET['modoDePago'];

    if ($articulos !== null) {

        // Insertar en la tabla ventas antes del foreach
        $stmtVentas = $conexion->prepare("INSERT INTO ventas (ventas_id_usuario, ventas_id_modopago, ventas_monto, ventas_suc) VALUES (?, ?, ?, ?)");
        $ventas_suc = 1; // De momento solamente sucursal 1

        $stmtVentas->bind_param('iiii', $usuarioLogueado, $modoDePago, $totalGeneral, $ventas_suc);
        
        if ($stmtVentas->execute()) {
            // Consultar el id de la venta realizada
            $id_venta = $conexion->insert_id;

            foreach ($articulos as $articulo) {
                $nombreArticulo = $articulo['articulo'];
                $id_articulo = (int)$articulo['id_article'];
                $cantidad = (int)$articulo['cantidad'];
                $total = (int)$articulo['total'];
    
                // Buscar y actualizar la cantidad en la base de datos
                $stmt = $conexion->prepare("UPDATE articulos SET art_stock = art_stock - ? WHERE art_nombre = ?");
                $stmt->bind_param('is', $cantidad, $nombreArticulo);
    
                if ($stmt->execute()) {
                    // Buscar y actualizar la cantidad en la base de datos
                    $stmtDetVentas = $conexion->prepare("INSERT INTO ventas_detalle (vendet_id_venta, vendet_id_art, vendet_nom_art, vendet_cantidad, vendet_monto) VALUES (?, ?, ?, ?, ?)");
                    $stmtDetVentas->bind_param('iisii', $id_venta, $id_articulo, $nombreArticulo, $cantidad, $total);
        
                    if ($stmtDetVentas->execute()) {
                        echo "Cantidad actualizada para el artículo: $nombreArticulo\n";
                    } else {
                        echo "Error al actualizar la cantidad para el artículo: $nombreArticulo\n";
                    }
                } else {
                    echo "Error al actualizar la cantidad para el artículo: $nombreArticulo\n";
                }
            }
        } else {
            echo "Error al registrar la venta total: $totalGeneral\n";
        }       
    } else {
        echo "Los datos de artículos no están en el formato esperado.";
    }
} else {
    echo "No se recibieron datos de artículos.";
}
?>