<?php
    // Conexión a la base de datos MySQL
    require('../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $articulo = $_POST['articulo'];
    $marca = $_POST['marca'];
    $descripcion = $_POST['descripcion'];

    // Consulta Inicial
    $consulta = "SELECT * FROM articulos
                WHERE art_nombre LIKE '%$articulo%'";

    // Si la consulta incluye marca, colocarla en la consulta
    if($marca != ''){
        $consulta .= " AND art_marca LIKE '%$marca%'";
    }

    // Si la consulta incluye descripción, colocarla en la consulta
    if($descripcion != ''){
        $consulta .= " AND art_descripcion LIKE '%$descripcion%'";
    }

    // Generar consulta
    $resultado = $conexion->query($consulta);

    // Inicializo el Array de Response y Artículos
    $response = [];
    $articulos = [];

    if($resultado->num_rows > 0){       // Si encontró artículos
        while($fila = $resultado->fetch_assoc()){
            $articulos[] = [
                'articulo' => $fila['art_nombre'],
                'marca' => $fila['art_marca'],
                'descripcion' => $fila['art_descripcion'],
                'precio' => $fila['art_precio'],
                'stock' => $fila['art_stock']
            ];
        }
        $response = [
            'status' => 'success',
            'message' => 'Articulos agregados correctamente',
            'data' => $articulos
        ];
    }
    else{                               // Si no encontró artículos
        $response = [
            'status' => 'success',
            'message' => 'No hay artículos con los criterios ingresados.',
            'data' => []
        ];    
    }
    //ECHO "$response";
    // Envía los datos al JavaScript en formato JSON
    header('Content-Type: application/json');
    echo json_encode($response);

    // Cerrar la Conexión PHP
    $conexion->close();
?>