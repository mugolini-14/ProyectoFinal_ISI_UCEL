<?php
/*
    PHP:            consultar_categorias.php
    Descripción:    Consulta a la base de datos para traer las categorías con los críterios elegidos
*/

    // Conexión a la base de datos MySQL
    require('../../conectar/conectar.php');

    // Iniciar sesión si no está iniciada
    session_start();

    // Obtener los datos enviados desde JavaScript
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $depende_tipo = $_POST['depende-tipo'];

    // Consulta Inicial (con JOIN para guardar la descripción del Tipo Asociado)
    $consulta = "SELECT C.cat_nombre, C.cat_descripcion, T.tipos_nombre,
                CASE C.cat_activo
                WHEN 0  THEN 'No'
                WHEN 1  THEN 'Si'
                END AS cat_activo  
                FROM categorias C
                INNER JOIN tipos T
                ON T.id = C.cat_id_tipo";

    // Lógica de la consulta según el contenido de las variables
    $condiciones_consulta = [];     // Inicializar el arreglo de las condiciones

    // Por cada variable controlar si no está vacía y agregar la condición al arreglo
    if($nombre !== ''){
        $condiciones_consulta[] = "C.cat_nombre LIKE '%$nombre%'"; 
    } 

    if($descripcion !== ''){
        $condiciones_consulta[] = "C.cat_descripcion LIKE '%$descripcion%'"; 
    } 

    if($depende_tipo !== ''){
        $condiciones_consulta[] = "T.tipos_nombre LIKE '%$depende_tipo%'"; 
    } 

    // Controlar si las condiciones no están vacías y concatenarlas en la consulta
    if(!empty($condiciones_consulta)){
        $consulta .= " WHERE " . implode(' AND ' , $condiciones_consulta);
    }

    // Generar consulta
    $resultado = $conexion->query($consulta);

    // Inicializo el Array de Response y Artículos
    $response = [];
    $categorias = [];

    if($resultado->num_rows > 0){       // Si encontró artículos
        while($fila = $resultado->fetch_assoc()){
            $categorias[] = [
                'nombre' => $fila['cat_nombre'],
                'descripcion' => $fila['cat_descripcion'],
                'dependedeltipo' => $fila['tipos_nombre'],
                'activo' => $fila['cat_activo']
            ];
        }
        $response = [
            'status' => 'success',
            'message' => 'Categorías agregadas correctamente',
            'data' => $categorias
        ];
    }
    else{                               // Si no encontró artículos
        $response = [
            'status' => 'success',
            'message' => 'No hay categorías con los criterios ingresados.',
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