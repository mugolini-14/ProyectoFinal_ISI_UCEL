<?php

// Conexión a la base de datos
require('../conectar/conectar.php');
// Iniciar sesión si no está iniciada
session_start();
$usuarioLogueado = $_SESSION['id'];

$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$usuario = $_POST['usuario'];
$articulo = $_POST['articulo'];


// Crear consulta SQL
$consulta_prom = "SELECT ROUND(AVG(ventas_monto),2) as promedio FROM ventas WHERE ventas_fecha >= '$fecha_inicio' AND ventas_fecha <= '$fecha_fin'";

$consulta_sum = "SELECT SUM(ventas_monto) as suma FROM ventas WHERE ventas_fecha >= '$fecha_inicio' AND ventas_fecha <= '$fecha_fin'";


if (!empty($usuario)) {
    $consulta_prom .= " AND usuario = '$usuario'";
    $consulta_sum .= " AND usuario = '$usuario'";
}

if (!empty($articulo)) {
    $consulta_id_art = "SELECT id FROM articulos WHERE art_nombre LIKE '%$articulo%'";  //continuar
    $resultado_id_art = $conexion->query($consulta_id_art);
    $id_articulos = [];
    if ($resultado_id_art->num_rows > 0) {

        while($row = $resultado_id_art->fetch_assoc()) {
            $id_articulos[] =$row['id'];
        }

    }  

    if (!empty($id_articulos)) {
        // Convertir el array de IDs a una lista separada por comas
        $ids_lista = implode(",", $id_articulos);
    
        
        $consulta_vendet = "SELECT vendet_id_venta FROM ventas_detalle WHERE vendet_id_art IN ($ids_lista)";
        $resultado_vendet = $conexion->query($consulta_vendet);
        $id_ventas = [];
        if ($resultado_vendet->num_rows > 0) {
            while ($row = $resultado_vendet->fetch_assoc()) {
                $id_ventas[] = $row['vendet_id_venta'];
            }
        }
    
        if (!empty($id_ventas)) {
            // Convertir el array de IDs de ventas a una lista separada por comas
            $ids_ventas_lista = implode(",", $id_ventas);
            // Añadir la condición de los IDs de ventas al query
            $consulta_prom .= " AND id IN ($ids_ventas_lista)";
            $consulta_sum .= " AND id IN ($ids_ventas_lista)";
        }
    }
}




$resultado_prom = $conexion->query($consulta_prom);

$resultado_sum = $conexion->query($consulta_sum);

if ($resultado_prom->num_rows && $resultado_sum->num_rows) {
    $row_prom = $resultado_prom->fetch_assoc();
    $row_sum = $resultado_sum->fetch_assoc();
    echo json_encode(['promedio' => $row_prom['promedio'], 'suma' => $row_sum['suma']]);
} else {
    echo json_encode(['promedio' => 0, 'suma' => 0]);
}
?>