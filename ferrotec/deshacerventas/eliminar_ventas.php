<?php
/*
    PHP:            eliminar_ventas.php
    Descripción:    Borra una venta de la base de datos
*/
// Conexión a la base de datos
require('../conectar/conectar.php');
// Iniciar sesión si no está iniciada
session_start();
$usuarioLogueado = $_SESSION['id'];
$iddeshacer_venta = $_POST['idDeshacer'];
$conexion->begin_transaction(); // Iniciar la transacción

try {    //Sirve para probar la transacción, en la cláusula hace rollback
    $consulta_iddeshacer_venta = "SELECT * FROM historial_ventas WHERE id = '$iddeshacer_venta' LIMIT 1";
    $resultado_iddeshacer_venta = $conexion->query($consulta_iddeshacer_venta);

    // Verificar si se encontró alguna fila (es decir, si el nombre de categoria ya existe)
    if ($resultado_iddeshacer_venta->num_rows > 0) {

        //Extraigo los datos de la fila traída por la consulta(todos los datos de la venta)
        $fila = $resultado_iddeshacer_venta->fetch_assoc();
        
        $histventas_id_usuario_adeshacer = $fila['histventas_id_usuario'];
        $histventas_id_modopago_adeshacer = $fila['histventas_id_modopago'];
        $histventas_fechahora_adeshacer = $fila['histventas_fechahora'];
        $histventas_monto_adeshacer = $fila['histventas_monto'];
        $histventas_suc_adeshacer = $fila['histventas_suc'];

        
        // Se procede a eliminar la venta
        $eliminarVenta = "DELETE FROM historial_ventas WHERE id = '$iddeshacer_venta'";

        if ($conexion->query($eliminarVenta) === TRUE) {
            //Se insertan los datos extraidos en la tabla de ventas_eliminados
            $insertarVentasEliminados = "INSERT INTO historial_ventas_eliminados 
                                                                                (histventaselim_userid,
                                                                                histventas_id,
                                                                                histventas_id_usuario,
                                                                                histventas_id_modopago,
                                                                                histventas_fechahora,
                                                                                histventas_monto,
                                                                                histventas_suc) 
                                        VALUES ('$usuarioLogueado',
                                                '$iddeshacer_venta',
                                                '$histventas_id_usuario_adeshacer',
                                                '$histventas_id_modopago_adeshacer',
                                                '$histventas_fechahora_adeshacer',
                                                '$histventas_monto_adeshacer',
                                                '$histventas_suc_adeshacer')";
        
            if ($conexion->query($insertarVentasEliminados) === TRUE) {
                //Consulto si hay entrada/s en ventas_detalle relacionada con el id de la venta a deshacer
                $consulta_iddeshacer_det_venta = "SELECT * FROM historial_ventas_detalle WHERE histvendet_id_venta = $iddeshacer_venta";
                $resultado_iddeshacer_det_venta = $conexion->query($consulta_iddeshacer_det_venta);

                if ($resultado_iddeshacer_det_venta->num_rows > 0) {
                    // Consulto si hay una entrada en historial_ventas_detalle relacionada con el id de la venta a deshacer
                    while ($histventa_detalle_deshacer = $resultado_iddeshacer_det_venta->fetch_assoc()) {
                        $id_vendet_deshacer = $histventa_detalle_deshacer['id'];
                        $histvendet_id_venta_deshacer = (int)$histventa_detalle_deshacer['histvendet_id_venta'];
                        $histvendet_id_art_deshacer = (int)$histventa_detalle_deshacer['histvendet_id_art'];
                        $histvendet_cantidad_deshacer = (int)$histventa_detalle_deshacer['histvendet_cantidad'];
                        $histvendet_monto_deshacer = (float)$histventa_detalle_deshacer['histvendet_monto'];

                    // Obtener el stock actual del artículo
                    $stmtStock = $conexion->prepare("SELECT art_stock FROM articulos WHERE id = ?");
                    $stmtStock->bind_param('i', $histvendet_id_art_deshacer);
                    $stmtStock->execute();
                    $resultStock = $stmtStock->get_result();
                    $stockActual = $resultStock->fetch_assoc()['art_stock'];
                    
                    // Calcular el nuevo stock
                    $nuevoStock = $stockActual + $histvendet_cantidad_deshacer;

                    // Actualizar el stock del artículo
                    $stmtUpArt = $conexion->prepare("UPDATE articulos SET art_stock = ? WHERE id = ?");
                    $stmtUpArt->bind_param('ii', $nuevoStock, $histvendet_id_art_deshacer);
            
                        if ($stmtUpArt->execute()) {
                            // Pegar los datos extraídos en ventas_detalle en ventas_detalle_eliminados
                            $stmtDetVentas = $conexion->prepare("INSERT INTO historial_ventas_detalle_eliminados (
                                                                                                                histvendetelim_id_venta, 
                                                                                                                histvendetelim_id_art, 
                                                                                                                histvendetelim_cantidad, 
                                                                                                                histvendetelim_monto) 
                                                                        VALUES (?, ?, ?, ?)");
                            $stmtDetVentas->bind_param('iiii', 
                                                     $histvendet_id_venta_deshacer, 
                                                     $histvendet_id_art_deshacer, 
                                                     $histvendet_cantidad_deshacer, 
                                                     $histvendet_monto_deshacer);
                            
                            if ($stmtDetVentas->execute()) {
                                $eliminarDetalleVenta = "DELETE FROM historial_ventas_detalle WHERE id = '$id_vendet_deshacer'";
                            
                                    if ($conexion->query($eliminarDetalleVenta) === TRUE) {
                                        //Venta correctamente eliminada, no hacer nada, el alert se muestra después del while
                                    } 
                                    else {
                                        throw new Exception("Error al borrar la fila en ventas_detalle artículo ID: $histvendet_id_art_deshacer");
                                    }

                            } 
                            else {
                                throw new Exception("Error al insertar el campo de ventas_detalle_eliminados artículo ID: $histvendet_id_art_deshacer");
                            }
                        } 
                        else {
                            throw new Exception("Error al copiar en ventas_eliminados: $histvendet_id_art_deshacer");
                        }
                    }   //fin del while
                    // Confirmar transacción
                    $conexion->commit();
                    echo "La venta fue eliminada correctamente.\n";
                } 
                else {
                    // La venta no tiene artículos en su detalle
                    throw new Exception("La venta no tenía ningún detalle asociado.");
                }
            } 
            else {
                throw new Exception("Error al copiar en ventas_eliminados: " . $conexion->error);
            }
        } 
        else {
                throw new Exception("Error al eliminar la venta: " . $conexion->error);
            }
    }
    else{
        // No existe la venta ingresada
        throw new Exception("La venta ingresada no existe.");
    }
} catch (Exception $e) {
    // Revertir los cambios en caso de error
    $conexion->rollback();
    echo $e->getMessage();
}
// Cerrar conexión
$conexion->close();
?>