<?php
/*
    PHP:            registrar_compra.php
    Descripción:    Inserta de la base de datos un registro de compra
*/
// Conexión a la base de datos
require('../conectar/conectar.php');
// Iniciar sesión si no está iniciada
session_start();
$usuarioLogueado = $_SESSION['id'];
$errores = []; // Array para almacenar errores en el procesamiento de los artículos

// Recibir los datos del GET
if (isset($_GET['articulos']) && isset($_GET['totalGeneral']))  {
    $articulos = json_decode($_GET['articulos'], true);
    $totalGeneral = floatval($_GET['totalGeneral']);
    $modoDePago = $_GET['modoDePago'];
    $proveedor = $_GET['nombreProveedor'];

    // Verifica si el proveedor existe o no está activo
    $consulta_proveedor_existente = "SELECT *
                                    FROM proveedores
                                    WHERE prov_nombre = '$proveedor'
                                    AND prov_activo = 1";

    $resultado_consulta_proveedor_existente = $conexion->query($consulta_proveedor_existente);
    
    if($resultado_consulta_proveedor_existente->num_rows > 0){
        if ($articulos !== null) {

            // Guarda el Id del proveedor
            $fila = $resultado_consulta_proveedor_existente->fetch_assoc();
            $id_proveedor = $fila['id'];

            // Insertar en la tabla compras antes del foreach
            $stmtCompras = $conexion->prepare("INSERT INTO historial_compras (histcompras_id_usuario, 
                                                                              histcompras_id_modopago,
                                                                              histcompras_id_prov,
                                                                              histcompras_monto, 
                                                                              histcompras_suc) 
                                                                      VALUES (?, ?, ?, ?, ?)");
            
            $histcompras_suc = 1; // De momento solamente sucursal 1
    
            $stmtCompras->bind_param('iiidi', $usuarioLogueado, $modoDePago, $id_proveedor, $totalGeneral, $histcompras_suc);
            
            if ($stmtCompras->execute()) {
                // Consultar el id de la compra realizada
                $id_compra = $conexion->insert_id;

    
                foreach ($articulos as $articulo) {
                    $nombreArticulo = $articulo['articulo'];
                    $id_articulo = (int)$articulo['id_article'];
                    $cantidad = (int)$articulo['cantidad'];
                    $total = (int)$articulo['total'];
        
                    // Buscar y actualizar la cantidad en la base de datos
                    $stmt = $conexion->prepare("UPDATE articulos 
                                                SET art_stock = art_stock + ? 
                                                WHERE id = ?");
    
                    $stmt->bind_param('ii', $cantidad, $id_articulo);
        
                    if ($stmt->execute()) {
                        // Buscar y actualizar la cantidad en la base de datos
                        $stmtDetCompras = $conexion->prepare("INSERT INTO historial_compras_detalle (histcomdet_id_compra,
                                                                                                    histcomdet_id_art, 
                                                                                                    histcomdet_cantidad, 
                                                                                                    histcomdet_monto) 
                                                                                            VALUES (?, ?, ?, ?)");
    
                        $stmtDetCompras->bind_param('iiid', $id_compra, $id_articulo, $cantidad, $total);
            
                        if (!$stmtDetCompras->execute()) {
                            // Error al registrar el detalle del artículo
                            $errores[] = "Error al registrar el detalle del artículo: $nombreArticulo";
                        }
                    } 
                    else {
                        $errores[] = "Error al registrar la compra: $nombreArticulo";
                    }
                }
            } 
            else {
                $errores[] = "Error al registrar la compra.";
            }       
        } 
        else {
            $errores[] = "Los datos de artículos no están en el formato esperado.";
        }
    } 
    else {
        // El proveedor ingresado no existe
        $errores[] = "El proveedor ingresado no existe o no está activo.";
    }
}
else{
    $errores[] = "No se recibieron datos.";
}

//Función final que valida si hubo errores o no 
if (empty($errores)) {
    echo "Compra generada correctamente.";
} else {
    echo "Errores:\n" . implode("\n", $errores);
}
?>