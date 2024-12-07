<?php
/*
    PHP:            eliminar_compras.php
    Descripción:    Borra una compra de la base de datos
*/
// Conexión a la base de datos
require('../conectar/conectar.php');
// Iniciar sesión si no está iniciada
session_start();
$usuarioLogueado = $_SESSION['id'];
$iddeshacer_compra = $_POST['idDeshacer'];
$conexion->begin_transaction(); // Iniciar la transacción

try {    //Sirve para probar la transacción, en la cláusula hace rollback

    $consulta_iddeshacer_compra = "SELECT * 
                                   FROM historial_compras 
                                   WHERE id = '$iddeshacer_compra' LIMIT 1";

    $resultado_iddeshacer_compra = $conexion->query($consulta_iddeshacer_compra);

    // Verificar si se encontró alguna fila (es decir, si el nombre de categoria ya existe)
    if ($resultado_iddeshacer_compra->num_rows > 0) {

        //Extraigo los datos de la fila traída por la consulta(todos los datos de la compra)
        $fila = $resultado_iddeshacer_compra->fetch_assoc();
        
        $histcompras_id_usuario_adeshacer = $fila['histcompras_id_usuario'];
        $histcompras_id_modopago_adeshacer = $fila['histcompras_id_modopago'];
        $histcompras_fechahora_adeshacer = $fila['histcompras_fechahora'];
        $histcompras_monto_adeshacer = $fila['histcompras_monto'];
        $histcompras_suc_adeshacer = $fila['histcompras_suc'];
        $histcompras_id_prov_adeshacer = $fila['histcompras_id_prov'];

        
        // Se procede a eliminar la compra
        $eliminarCompra = "DELETE FROM historial_compras WHERE id = '$iddeshacer_compra'";

        if ($conexion->query($eliminarCompra) === TRUE) {
            //Se insertan los datos extraidos en la tabla de compras_eliminados
            $insertarComprasEliminados = "INSERT INTO historial_compras_eliminados (histcompraselim_userid, 
                                                                                    histcompras_id, 
                                                                                    histcompras_id_usuario,
                                                                                    histcompras_id_modopago, 
                                                                                    histcompras_fechahora, 
                                                                                    histcompras_id_prov,
                                                                                    histcompras_monto, 
                                                                                    histcompras_suc) 
                                            VALUES ('$usuarioLogueado', 
                                                    '$iddeshacer_compra', 
                                                    '$histcompras_id_usuario_adeshacer',
                                                    '$histcompras_id_modopago_adeshacer', 
                                                    '$histcompras_fechahora_adeshacer', 
                                                    '$histcompras_id_prov_adeshacer', 
                                                    '$histcompras_monto_adeshacer', 
                                                    '$histcompras_suc_adeshacer')";
        
            if ($conexion->query($insertarComprasEliminados) === TRUE) {
                //Consulto si hay entrada/s en historial_compras_detalle relacionada con el id de la compra a deshacer
                $consulta_iddeshacer_det_compra = "SELECT * 
                                                   FROM historial_compras_detalle 
                                                   WHERE histcomdet_id_compra = $iddeshacer_compra";

                $resultado_iddeshacer_det_compra = $conexion->query($consulta_iddeshacer_det_compra);

                if ($resultado_iddeshacer_det_compra->num_rows > 0) {
                    // Consulto si hay una entrada en historial_compras_detalle relacionada con el id de la compra a deshacer
                    while ($histcompra_detalle_deshacer = $resultado_iddeshacer_det_compra->fetch_assoc()) {
                        $id_comdet_deshacer = $histcompra_detalle_deshacer['id'];
                        $histcomdet_id_compra_deshacer = (int)$histcompra_detalle_deshacer['histcomdet_id_compra'];
                        $histcomdet_id_art_deshacer = (int)$histcompra_detalle_deshacer['histcomdet_id_art'];
                        $histcomdet_cantidad_deshacer = (int)$histcompra_detalle_deshacer['histcomdet_cantidad'];
                        $histcomdet_monto_deshacer = (float)$histcompra_detalle_deshacer['histcomdet_monto'];

                        // Obtener el stock actual del artículo
                        $stmtStock = $conexion->prepare("SELECT art_stock FROM articulos WHERE id = ?");
                        $stmtStock->bind_param('i', $histcomdet_id_art_deshacer);
                        $stmtStock->execute();
                        $resultStock = $stmtStock->get_result();
                        $stockActual = $resultStock->fetch_assoc()['art_stock'];
                        
                        // Calcular el nuevo stock
                        $nuevoStock = $stockActual - $histcomdet_id_art_deshacer;

                        // Actualizar el stock del artículo
                        $stmtUpArt = $conexion->prepare("UPDATE articulos SET art_stock = ? WHERE id = ?");
                        $stmtUpArt->bind_param('ii', $nuevoStock, $histcomdet_id_art_deshacer);
            
                        if ($stmtUpArt->execute()) {
                            // Pegar los datos extraídos en historial_compras_detalle en historial_compras_detalle_eliminados
                            $stmtDetCompras = $conexion->prepare("INSERT INTO historial_compras_detalle_eliminados 
                                                                                                        (histcomdetelim_id_compra, 
                                                                                                        histcomdetelim_id_art, 
                                                                                                        histcomdetelim_cantidad, 
                                                                                                        histcomdetelim_monto) 
                                                                        VALUES (?, ?, ?, ?)");
                            $stmtDetCompras->bind_param('iiii',  $histcomdet_id_compra_deshacer, 
                                                                        $histcomdet_id_art_deshacer, 
                                                                        $histcomdet_cantidad_deshacer, 
                                                                        $histcomdet_monto_deshacer);
                            
                            if ($stmtDetCompras->execute()) {
                                $eliminarDetalleCompra = "DELETE 
                                                          FROM historial_compras_detalle 
                                                          WHERE id = '$id_comdet_deshacer'";
                            
                                    if ($conexion->query($eliminarDetalleCompra) === TRUE) {
                                        //Compra correctamente eliminada, no hacer nada, el alert se muestra después del while
                                    } 
                                    else {
                                        throw new Exception("Error al borrar la fila en historial_compras_detalle artículo ID: $histcomdet_id_art_deshacer");
                                    }

                            } 
                            else {
                                throw new Exception("Error al insertar el campo de historial_compras_detalle_eliminados artículo ID: $histcomdet_id_art_deshacer");
                            }
                        } 
                        else {
                            throw new Exception("Error al copiar en historial_compras_eliminados: $histcomdet_id_art_deshacer");
                        }
                    }   //fin del while
                    // Confirmar transacción
                    $conexion->commit();
                    echo "La compra fue eliminada correctamente.\n";
                } else {
                    throw new Exception("La compra no tenía ningún detalle asociado");
                }
            } else {
                throw new Exception("Error al copiar en historial_compras_eliminados: " . $conexion->error);
            }
        } else {
                throw new Exception("Error al eliminar la compra: " . $conexion->error);
            }
    }else{
        throw new Exception("La compra ingresada no existe.");
    }

} catch (Exception $e) {
    // Revertir los cambios en caso de error
    $conexion->rollback();
    echo $e->getMessage();
}
// Cerrar conexión
$conexion->close();
?>