<?php
/*
    PHP:            consultar_articulos.php
    Descripción:    Consulta a la base de datos para traer los artículos con los críterios elegidos
*/

    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $articulo = $_POST['articulo'];
    $marca = $_POST['marca'];
    $descripcion = $_POST['descripcion'];

    // Consulta Inicial
    $consulta = "SELECT art_nombre, art_marca, art_descripcion, art_precio, art_stock,
                CASE art_activo
                    WHEN 1  THEN 'Si'
                    WHEN 0  THEN 'No'
                END AS art_activo
                FROM articulos";

    // Lógica de la consulta según el contenido de las variables
    $condiciones_consulta = [];     // Inicializar el arreglo de las condiciones

    // Por cada variable controlar si no está vacía y agregar la condición al arreglo
    if($articulo !== ''){
        $condiciones_consulta[] = "art_nombre LIKE '%$articulo%'"; 
    } 

    if($marca !== ''){
        $condiciones_consulta[] = "art_marca LIKE '%$marca%'"; 
    } 

    if($descripcion !== ''){
        $condiciones_consulta[] = "art_descripcion LIKE '%$descripcion%'"; 
    } 

    // Controlar si las condiciones no están vacías y concatenarlas en la consulta
    if(!empty($condiciones_consulta)){
        $consulta .= " WHERE " . implode(' AND ' , $condiciones_consulta);
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
                'stock' => $fila['art_stock'],
                'activo' => $fila['art_activo']
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