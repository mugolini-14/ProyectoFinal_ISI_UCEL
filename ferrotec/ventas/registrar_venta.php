<?php
/*
    PHP:            registrar_venta.php
    Descripción:    Inserta de la base de datos un registro de venta
*/
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
        $stmtVentas = $conexion->prepare("INSERT INTO historial_ventas (histventas_id_usuario, 
                                                                        histventas_id_modopago,
                                                                        histventas_monto, 
                                                                        histventas_suc) 
                                                                VALUES (?, ?, ?, ?)");
        
        $histventas_suc = 1; // De momento solamente sucursal 1

        $stmtVentas->bind_param('iidi', $usuarioLogueado, $modoDePago, $totalGeneral, $histventas_suc);
        
        if ($stmtVentas->execute()) {
            // Consultar el id de la venta realizada
            $id_venta = $conexion->insert_id;

            foreach ($articulos as $articulo) {
                $nombreArticulo = $articulo['articulo'];
                $id_articulo = (int)$articulo['id_article'];
                $cantidad = (int)$articulo['cantidad'];
                $total = floatval($articulo['total']);
    
                // Buscar y actualizar la cantidad en la base de datos
                $stmt = $conexion->prepare("UPDATE articulos 
                                            SET art_stock = art_stock - ? 
                                            WHERE id = ?");

                $stmt->bind_param('ii', $cantidad, $id_articulo);
    
                if ($stmt->execute()) {
                    // Insertar la venta detalle
                    $stmtDetVentas = $conexion->prepare("INSERT INTO historial_ventas_detalle (histvendet_id_venta,
                                                                                              histvendet_id_art, 
                                                                                              histvendet_cantidad, 
                                                                                              histvendet_monto) 
                                                                                       VALUES (?, ?, ?, ?)");

                    $stmtDetVentas->bind_param('iiid', $id_venta, $id_articulo, $cantidad, $total);

        
                    if ($stmtDetVentas->execute()) {
                        echo "Venta generada correctamente.\n";
                    } 
                    else {
                        echo "Error al actualizar la cantidad para el artículo: $nombreArticulo\n";
                    }
                }
                else {
                    echo "Error al actualizar la cantidad para el artículo: $nombreArticulo\n";
                }
            }
        } 
        else {
            echo "Error al registrar la venta: " . $conexion->error;
        }       
    } 
    else {
        echo "Los datos de artículos no están en el formato esperado.";
    }
} 
else {
    echo "No se recibieron datos de artículos.";
}
?>